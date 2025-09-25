<?php
require_once('config.php');

$payload = @file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'] ?? '';
$event = null;

// Try to decode payload first (used by local simulation)
$event = json_decode($payload);

// If it looks like a real Stripe webhook and we have the SDK + secret, validate signature
if ((!$event || !isset($event->type)) && defined('STRIPE_WEBHOOK_SECRET') && STRIPE_WEBHOOK_SECRET && STRIPE_WEBHOOK_SECRET !== 'whsec_replace_me') {
    // fallback to Stripe SDK verification if available
    try {
        require_once __DIR__ . '/vendor/autoload.php';
        \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);
        $event = \Stripe\Webhook::constructEvent($payload, $sig_header, STRIPE_WEBHOOK_SECRET);
    } catch (Exception $e) {
        http_response_code(400);
        exit();
    }
}

// Handle the event
switch ($event->type ?? ($event['type'] ?? null)) {
    case 'checkout.session.completed':
        $session_payload = $event->data->object ?? $event['data']['object'];

        // If this is a local simulated session (id starts with ls_), use payload directly
        $session_id = $session_payload->id ?? $session_payload['id'] ?? null;
        $trnid = null;
        $amount_total = null;

        if ($session_id && strpos($session_id, 'ls_') === 0) {
            // local simulation: metadata included in payload
            $meta = $session_payload->metadata ?? ($session_payload['metadata'] ?? null);
            $trnid = $meta->trnid ?? $meta['trnid'] ?? null;
            $amount_total = $session_payload->amount_total ?? ($session_payload['amount_total'] ?? null);
        } else {
            // real Stripe event: try to retrieve session via Stripe SDK if available
            if (file_exists(__DIR__ . '/vendor/autoload.php')) {
                try {
                    require_once __DIR__ . '/vendor/autoload.php';
                    \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);
                    $session_obj = \Stripe\Checkout\Session::retrieve($session_id, []);
                    $meta = $session_obj->metadata ?? null;
                    $trnid = $meta->trnid ?? ($meta['trnid'] ?? null);
                    $amount_total = $session_obj->amount_total ?? null;
                } catch (Exception $e) {
                    // unable to retrieve session; fall back to payload metadata if present
                    $meta = $session_payload->metadata ?? ($session_payload['metadata'] ?? null);
                    $trnid = $meta->trnid ?? ($meta['trnid'] ?? null);
                    $amount_total = $session_payload->amount_total ?? ($session_payload['amount_total'] ?? null);
                }
            } else {
                // No SDK available; try payload metadata
                $meta = $session_payload->metadata ?? ($session_payload['metadata'] ?? null);
                $trnid = $meta->trnid ?? ($meta['trnid'] ?? null);
                $amount_total = $session_payload->amount_total ?? ($session_payload['amount_total'] ?? null);
            }
        }

        if ($trnid) {
            // Mark transaction completed and update freelancer balance
            $res = $connection->query("SELECT * FROM transaction_table WHERE trnid = " . intval($trnid));
            if ($res && $res->num_rows) {
                $row = $res->fetch_assoc();
                if ($row['status'] !== 'completed') {
                    $money = $row['money'];
                    $freelancer = $row['freelancer'];
                    $connection->query("UPDATE transaction_table SET status='completed' WHERE trnid = " . intval($trnid));
                    $connection->query("UPDATE freelancer SET balance = balance + " . floatval($money) . ", jobs_completed = jobs_completed + 1 WHERE username='" . $connection->real_escape_string($freelancer) . "'");
                }
            }
        }
        break;
    // Add other event types as needed
    default:
        // Unexpected event type
        break;
}

http_response_code(200);

?>