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

$connection->query("UPDATE transaction_table SET status='cancelled' WHERE trnid = $trnid");

echo "Transaction $trnid marked as cancelled.";

?>