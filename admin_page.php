<?php
session_start();
include __DIR__ . '/db_conn.php';  // gives $conn (mysqli)

// 1) Safely grab role (default to empty string)
$role = $_SESSION['role'] ?? '';

// 2) Guard: only logged-in admins or super-admins
if (empty($_SESSION['user_id']) || ! in_array($role, ['admin','super_admin'], true)) {
    header('HTTP/1.1 403 Forbidden');
    exit('Access denied. You need admin privileges.');
}
?>
<?php echo "admin page" ?>
<a href="./generate_invite.php" class="btn btn-outline-dark btn-platinum">Invite an admin</a>

