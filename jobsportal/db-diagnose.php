<?php
require_once('config.php');
ini_set('display_errors', '1');
error_reporting(E_ALL);

echo "<h2>DB Diagnose</h2>";
if (!$connection) {
    echo "<pre>DB connection failed: " . htmlspecialchars(mysqli_connect_error()) . "</pre>";
    exit;
}

// Check if table exists
$res = $connection->query("SHOW TABLES LIKE 'transaction_table'");
if (!$res) {
    echo "<pre>SHOW TABLES query failed: " . htmlspecialchars($connection->error) . "</pre>";
    exit;
}

if ($res->num_rows === 0) {
    echo "<pre>transaction_table does not exist in database 'jobs'.</pre>";
    exit;
}

// Show columns
$cols = $connection->query("SHOW COLUMNS FROM transaction_table");
if (!$cols) {
    echo "<pre>SHOW COLUMNS failed: " . htmlspecialchars($connection->error) . "</pre>";
    exit;
}

echo "<h3>Columns:</h3><pre>";
while ($row = $cols->fetch_assoc()) {
    echo htmlspecialchars(print_r($row, true)) . "\n";
}
echo "</pre>";

// Show a sample row
$s = $connection->query("SELECT * FROM transaction_table LIMIT 5");
if ($s) {
    echo "<h3>Sample rows:</h3><pre>" . htmlspecialchars(print_r($s->fetch_all(MYSQLI_ASSOC), true)) . "</pre>";
} else {
    echo "<pre>Sample select failed: " . htmlspecialchars($connection->error) . "</pre>";
}

?>