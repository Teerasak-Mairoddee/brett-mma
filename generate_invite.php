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

// 3) Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Generate raw token + its SHA-256 hash
    $rawToken = bin2hex(random_bytes(32));      // 64 hex chars
    $hash     = hash('sha256', $rawToken);
    $expires  = (new DateTime('+48 hours'))->format('Y-m-d H:i:s');

    // Insert into admin_invites table
    $stmt = $conn->prepare("
        INSERT INTO admin_invites 
          (token_hash, created_by, created_at, expires_at)
        VALUES 
          (?, ?, NOW(), ?)
    ");
    if (! $stmt) {
        die('Prepare failed: ' . $conn->error);
    }
    // s = string, i = integer, s = string
    $stmt->bind_param('sis', $hash, $_SESSION['user_id'], $expires);
    $stmt->execute();
    $stmt->close();

    // Build invite link
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
              ? 'https' : 'http';
    $link = sprintf(
      '%s://%s/brett-mma/registeradmin.php?token=%s',
      $scheme,
      $_SERVER['HTTP_HOST'],
      $rawToken
    );

    // Show the link exactly once
    echo '<p> Invite link (copy this now; it will not be shown again):</p>';
    echo '<pre>' . htmlspecialchars($link, ENT_QUOTES) . '</pre>';
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Generate Admin Invite</title>
</head>
<body>
  <h1>Generate Admin Invite</h1>
  <p>Anyone with this link can complete the admin registration form.</p>
  <form method="post">
    <button type="submit">Generate New Invite Link</button>
  </form>
</body>
</html>
