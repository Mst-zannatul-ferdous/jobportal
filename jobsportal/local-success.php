<?php
require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo 'Method not allowed';
    exit;
}

$trnid = intval($_POST['trnid'] ?? 0);
if (!$trnid) {
    http_response_code(400);
    echo 'Missing trnid';
    exit;
}

$res = $connection->query("SELECT * FROM transaction_table WHERE trnid = $trnid");
if (!$res || $res->num_rows === 0) {
    echo 'Transaction not found';
    exit;
}
$row = $res->fetch_assoc();
if ($row['status'] === 'completed') {
    echo 'Transaction already completed';
    exit;
}

$money = $row['money'];
$freelancer = $connection->real_escape_string($row['freelancer']);

$connection->query("UPDATE transaction_table SET status='completed' WHERE trnid = $trnid");
$connection->query("UPDATE freelancer SET balance = balance + " . floatval($money) . ", jobs_completed = jobs_completed + 1 WHERE username = '$freelancer'");

echo "Transaction $trnid marked as completed and freelancer $freelancer credited with $money.";

?>