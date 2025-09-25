<?php
// Session-backed local sessions for mock Stripe checkout
if (session_status() === PHP_SESSION_NONE) session_start();

function load_local_sessions() {
    if (!isset($_SESSION['local_sessions']) || !is_array($_SESSION['local_sessions'])) {
        $_SESSION['local_sessions'] = [];
    }
    return $_SESSION['local_sessions'];
}

function save_local_sessions($data) {
    $_SESSION['local_sessions'] = $data;
}

function create_local_session($trnid, $amount_cents) {
    $sessions = load_local_sessions();
    $id = 'ls_' . bin2hex(random_bytes(6));
    $sessions[$id] = [
        'id' => $id,
        'trnid' => $trnid,
        'amount_total' => intval($amount_cents),
        'currency' => 'usd',
        'status' => 'open',
        'created' => time(),
    ];
    save_local_sessions($sessions);
    return $sessions[$id];
}

function get_local_session($id) {
    $sessions = load_local_sessions();
    return $sessions[$id] ?? null;
}

function set_local_session_status($id, $status) {
    $sessions = load_local_sessions();
    if (!isset($sessions[$id])) return false;
    $sessions[$id]['status'] = $status;
    $sessions[$id]['updated'] = time();
    save_local_sessions($sessions);
    return true;
}