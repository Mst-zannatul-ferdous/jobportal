<?php
require_once('config.php');

$session_id = $_GET['session_id'] ?? null;
if (!$session_id) {
    echo "No session id provided.";
    exit;
}

$is_local = (strpos($session_id, 'ls_') === 0);
$amount_display = '';
$trnid_display = '';
$message = '';

if ($is_local) {
    require_once('local_sessions.php');
    $s = get_local_session($session_id);
    if (!$s) {
        $message = "Local session not found.";
    } else {
        $amount_display = "$" . number_format($s['amount_total']/100, 2);
        $trnid_display = htmlspecialchars($s['trnid']);
        $message = "Payment successful (local simulation).";
    }
} else {
    if (file_exists(__DIR__ . '/vendor/autoload.php')) {
        require_once __DIR__ . '/vendor/autoload.php';
        \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);
        try {
            $session = \Stripe\Checkout\Session::retrieve($session_id, []);
            $amount_display = isset($session->amount_total) ? ('$' . number_format($session->amount_total/100, 2)) : '';
            $trnid_display = ''; // Stripe session may include metadata
            $message = "Payment successful.";
        } catch (Exception $e) {
            $message = "Error retrieving session: " . $e->getMessage();
        }
    } else {
        $message = "Payment complete. Session ID: " . htmlspecialchars($session_id) . " (no Stripe SDK available locally).";
    }
}

?>
<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Payment Result</title>
  <link rel="stylesheet" href="css/w3.css">
  <link rel="stylesheet" href="style.css">
  <style>
  .result-card {
    max-width: 600px;
    margin: 40px auto;
  }

  .result-amount {
    font-size: 28px;
    font-weight: 700;
  }
  </style>
</head>

<body>
  <div class="w3-container result-card">
    <div class="w3-card-4 w3-padding">
      <h3><?php echo htmlspecialchars($message); ?></h3>
      <?php if ($amount_display): ?>
      <p>Amount: <span class="result-amount"><?php echo $amount_display; ?></span></p>
      <?php endif; ?>
      <?php if ($trnid_display): ?>
      <p>Transaction ID: <?php echo $trnid_display; ?></p>
      <?php endif; ?>
      <p>The transaction status should be updated in the admin list.</p>
      <a href="admin-transactionlist.php" class="w3-button w3-green">Return to Admin</a>
    </div>
  </div>
</body>

</html>