<?php
require_once('local_sessions.php');
require_once('config.php');

$session_id = $_GET['session_id'] ?? null;
$session = get_local_session($session_id);
if (!$session) {
    echo "Invalid session";
    exit;
}

?>
<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Mock Checkout</title>
</head>

<body>
  <h2>Mock Checkout (Local)</h2>
  <p>Session: <?php echo htmlspecialchars($session['id']); ?></p>
  <p>Amount: $<?php echo number_format($session['amount_total']/100, 2); ?></p>
  <form method="post" action="local-complete.php">
    <input type="hidden" name="session_id" value="<?php echo htmlspecialchars($session['id']); ?>">
    <button type="submit">Pay (simulate)</button>
  </form>
  <form method="post" action="local-cancel.php">
    <input type="hidden" name="trnid" value="<?php echo htmlspecialchars($session['trnid']); ?>">
    <button type="submit">Cancel</button>
  </form>
</body>

</html>