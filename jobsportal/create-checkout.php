<?php
require_once('config.php');
require_once __DIR__ . '/vendor/autoload.php';
\Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);

// Expected POST parameters: postid, client (username), freelancer (username), amount (in decimal)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo 'Method not allowed';
    exit;
}

$postId = $_POST['postid'] ?? null;
$client = $_POST['client'] ?? null;
$freelancer = $_POST['freelancer'] ?? null;
$amount = $_POST['amount'] ?? null; // e.g. "12.34"

if (!$postId || !$client || !$freelancer || !$amount) {
    http_response_code(400);
    echo 'Missing required parameters';
    exit;
}

// Create a pending transaction row in DB and get an internal transaction id
$amount_cents = intval(round(floatval($amount) * 100));

$stmt = $connection->prepare("INSERT INTO transaction_table (postid, client, freelancer, money, c_to_f, f_to_c, status) VALUES (?, ?, ?, ?, 0, 0, 'pending')");
$stmt->bind_param('isss', $postId, $client, $freelancer, $amount);
$stmt->execute();
$trnid = $stmt->insert_id;
$stmt->close();

try {
    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => "Job #{$postId}",
                    'metadata' => [
                        'trnid' => $trnid
                    ]
                ],
                'unit_amount' => $amount_cents,
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/jobshere/success.php?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/jobshere/cancel.php',
    ]);

    // Redirect user to Stripe Checkout
    header('Location: ' . $session->url);
    exit;
} catch (Exception $e) {
    // roll back transaction row
    $connection->query("DELETE FROM transaction_table WHERE trnid = $trnid");
    http_response_code(500);
    echo 'Error creating Stripe Checkout session: ' . $e->getMessage();
    exit;
}

?>