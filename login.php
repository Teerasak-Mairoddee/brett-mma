<?php
// login.php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include __DIR__ . '/db_conn.php'; // provides $conn

    // 1) Trim & validate inputs
    $email    = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'] ?? '';
    if (!$email) {
        $errors[] = 'Please enter a valid email.';
    }
    if ($password === '') {
        $errors[] = 'Please enter your password.';
    }

    // 2) Attempt login if no input errors
    if (empty($errors)) {
        function try_login($conn, $email, $password, $table, $roleName, $redirect) {
            $stmt = $conn->prepare("SELECT user_id, First_Name, Last_name, email, password FROM `$table` WHERE email = ? LIMIT 1");
            if (! $stmt) {
                throw new Exception('DB error: ' . $conn->error);
            }
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();

            if ($result && $row = $result->fetch_assoc()) {
                if (password_verify($password, $row['password'])) {
                    // Set session
                    $_SESSION['user_id']    = $row['user_id'];
                    $_SESSION['First_Name'] = $row['First_Name'];
                    $_SESSION['Last_Name']  = $row['Last_name'];
                    $_SESSION['email']      = $row['email'];
                    $_SESSION['role']       = $roleName;
                    header('Location: ' . $redirect);
                    exit;
                }
            }
            return false;
        }

        // Admin first
        if (! try_login($conn, $email, $password, 'admins', 'admin', 'admin_index.php')) {
            // Regular user next
            if (! try_login($conn, $email, $password, 'users', 'user', 'index.php')) {
                $errors[] = 'Invalid email or password.';
            }
        }
        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login | MMAFIA</title>
  <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="style.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #111; color: white; font-family: 'Anton', sans-serif;">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg" style="background-color: black;">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php" id="logo">
        <img src="images/logo.png" alt="Logo" width="120">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
              aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php#instructor-bio">Instructor Bio</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php#muay-thai">Muay Thai</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php#timetable">Timetable</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php#memberships">Memberships</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php#events">Events</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php#contact">Contact</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Login Form -->
  <div class="container py-5">
    <h1 class="text-center mb-4">Login to MMAFIA</h1>
    <?php if (!empty($errors)): ?>
      <div class="alert alert-danger mx-auto" style="max-width:600px;">
        <ul class="mb-0">
          <?php foreach ($errors as $e): ?>
            <li><?= htmlspecialchars($e, ENT_QUOTES) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>
    <form class="login-form mx-auto" style="max-width: 600px;" method="POST" action="login.php">
      <div class="mb-3 row">
        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
          <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Enter your email" required
                 value="<?= htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES) ?>">
        </div>
      </div>
      <div class="mb-3 row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
          <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Enter password" required>
        </div>
      </div>
      <div class="text-end">
        <button type="submit" class="btn btn-danger px-4">Login</button>
        <a href="register.php" class="btn btn-outline-light px-4">Register</a>
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
