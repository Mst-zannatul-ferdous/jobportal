<?php
require_once('config.php');
session_start();
if(!isset($_SESSION['username'])){
  header('location:index.php');
  exit;
}

$trnid = intval($_GET['trnid'] ?? 0);
if (!$trnid) {
    echo "Invalid transaction id.";
    exit;
}

$res = $connection->query("SELECT * FROM transaction_table WHERE trnid = $trnid");
if (!$res || $res->num_rows === 0) {
    echo "Transaction not found.";
    exit;
}
$tx = $res->fetch_assoc();

?>
<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Confirm Transfer</title>
  <link rel="stylesheet" href="css/w3.css">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="w3-container">
    <h2>Confirm Transfer</h2>
    <p>Trans. No: <?php echo htmlspecialchars($tx['trnid']); ?></p>
    <p>Job Id: <?php echo htmlspecialchars($tx['postid']); ?></p>
    <p>Client: <?php echo htmlspecialchars($tx['client']); ?></p>
    <p>Freelancer: <?php echo htmlspecialchars($tx['freelancer']); ?></p>
    <p>Amount: <?php echo htmlspecialchars($tx['money']); ?></p>
    <p>Client-to-Freelancer Rating: <?php echo htmlspecialchars($tx['c_to_f']); ?></p>

    <form method="post" action="admin-transactionlist.php">
      <input type="hidden" name="confirm_transfer" value="1">
      <input type="hidden" name="trnid" value="<?php echo htmlspecialchars($tx['trnid']); ?>">
      <button type="submit" class="w3-button w3-green">Confirm Transfer</button>
      <a href="admin-transactionlist.php" class="w3-button w3-red">Cancel</a>
    </form>
  </div>
</body>

</html>