<?php
require_once('local_sessions.php');
require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo 'Method not allowed';
    exit;
}

$session_id = $_POST['session_id'] ?? null;
$session = get_local_session($session_id);
if (!$session) {
    echo "Invalid session";
    exit;
}

// Mark session paid
set_local_session_status($session_id, 'paid');

// Simulate sending a checkout.session.completed webhook by calling stripe-webhook.php with a JSON payload
$event = [
    'type' => 'checkout.session.completed',
    'data' => [ 'object' => [
        'id' => $session_id,
        'amount_total' => $session['amount_total'],
        'metadata' => [ 'trnid' => $session['trnid'] ],
    ]]
];

$payload = json_encode($event);

// Call stripe-webhook.php locally using file_get_contents (internal request)
$webhook_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/jobshere/stripe-webhook.php';
$opts = ['http' => ['method' => 'POST', 'header' => 'Content-Type: application/json', 'content' => $payload]];
$context = stream_context_create($opts);
@file_get_contents($webhook_url, false, $context);

// Redirect to success page (mimic Stripe's ?session_id=... behavior)
$redirect = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/jobshere/success.php?session_id=' . urlencode($session_id);
header('Location: ' . $redirect);
exit;