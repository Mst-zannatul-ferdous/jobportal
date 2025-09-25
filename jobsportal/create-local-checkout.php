<?php
// Debug: show basic diagnostics (remove in production)
// Enable full error reporting for local debugging
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once('config.php');
// show connection error inline (helpful locally)
if (!$connection) {
    echo "<pre>DB connection failed: " . htmlspecialchars(mysqli_connect_error()) . "</pre>";
}

// If GET with query params, allow direct link support (so simulate buttons can be links)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['postid'], $_GET['client'], $_GET['freelancer'], $_GET['amount'])) {
                // promote GET to POST for processing below
                $_POST['postid'] = $_GET['postid'];
                $_POST['client'] = $_GET['client'];
                $_POST['freelancer'] = $_GET['freelancer'];
                $_POST['amount'] = $_GET['amount'];
                $_SERVER['REQUEST_METHOD'] = 'POST';
        } else {
                ?>
<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Local Checkout Simulator</title>
</head>

<body>
  <h2>Local Checkout Simulator</h2>
  <form method="post" action="create-local-checkout.php">
    <label>Post ID: <input name="postid" required></label><br>
    <label>Client (username): <input name="client" required></label><br>
    <label>Freelancer (username): <input name="freelancer" required></label><br>
    <label>Amount (e.g. 12.34): <input name="amount" required></label><br>
    <button type="submit">Create Pending Transaction</button>
  </form>
</body>

</html>
<?php
                exit;
        }
}

// POST: create a pending transaction and show simulate buttons
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo 'Method not allowed';
    exit;
}


$postId = isset($_POST['postid']) ? intval($_POST['postid']) : null;
$client = $_POST['client'] ?? null;
$freelancer = $_POST['freelancer'] ?? null;
$amount = $_POST['amount'] ?? null; // e.g. "12.34"
$provided_trnid = isset($_GET['trnid']) ? intval($_GET['trnid']) : (isset($_POST['trnid']) ? intval($_POST['trnid']) : null);

if (!$postId || !$client || !$freelancer || !$amount) {
    http_response_code(400);
    echo 'Missing required parameters';
    exit;
}
// If a trnid is provided, use existing pending transaction instead of inserting a new one
if ($provided_trnid) {
    $res = $connection->query("SELECT * FROM transaction_table WHERE trnid = " . intval($provided_trnid));
    if ($res && $res->num_rows) {
        $row = $res->fetch_assoc();
        $trnid = $provided_trnid;
        // override amount from DB if not provided
        if (!$amount) $amount = $row['money'];
    } else {
        echo "Provided trnid not found.";
        exit;
    }
} else {
    $stmt = $connection->prepare("INSERT INTO transaction_table (postid, client, freelancer, money, c_to_f, f_to_c, status) VALUES (?, ?, ?, ?, 0, 0, 'pending')");
    if (!$stmt) {
        echo "DB prepare failed: " . htmlspecialchars($connection->error);
        exit;
    }

    if (!$stmt->bind_param('isss', $postId, $client, $freelancer, $amount)) {
        echo "DB bind_param failed: " . htmlspecialchars($stmt->error);
        exit;
    }

    if (!$stmt->execute()) {
        echo "DB execute failed: " . htmlspecialchars($stmt->error);
        exit;
    }

    $trnid = $stmt->insert_id;
    $stmt->close();
}

// Create a local "checkout session" that mimics Stripe Checkout and redirect to a mock checkout page
require_once('local_sessions.php');
$amount_cents = intval(round(floatval($amount) * 100));
$session = create_local_session($trnid, $amount_cents);

$redirect = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/jobshere/local-checkout-page.php?session_id=' . urlencode($session['id']);
header('Location: ' . $redirect);
exit;

?>