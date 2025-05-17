 <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();

    $errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'db_conn.php';  // gives you $conn (mysqli)

    // 1) Trim & sanitize inputs
    $first   = trim($_POST['First_Name']   ?? '');
    $last    = trim($_POST['Last_Name']    ?? '');
    $email   = filter_var($_POST['email']  ?? '', FILTER_VALIDATE_EMAIL);
    $phone   = trim($_POST['phone']        ?? '');
    $pass    = $_POST['password']          ?? '';
    $confirm = $_POST['confirmPassword']   ?? '';

    // 2) Validate & collect errors
    if ($first === '') {
        $errors[] = 'First name is required.';
    }
    if ($last === '') {
        $errors[] = 'Last name is required.';
    }
    if (! $email) {
        $errors[] = 'A valid email is required.';
    }
    if ($pass === '' || $confirm === '') {
        $errors[] = 'Both password fields are required.';
    } elseif ($pass !== $confirm) {
        $errors[] = 'Passwords do not match.';
    } elseif (strlen($pass) < 8) {
        $errors[] = 'Password must be at least 8 characters.';
    }

    // 3) If no errors, attempt insert
    if (empty($errors)) {
        $pwHash = password_hash($pass, PASSWORD_DEFAULT);

        $stmt = $conn->prepare(
            "INSERT INTO users 
               (First_Name, Last_name, email, phone, password, date)
             VALUES (?,?,?,?,?, NOW())"
        );
        $stmt->bind_param('sssss', $first, $last, $email, $phone, $pwHash);

        if ($stmt->execute()) {
            // Success! Redirect back to login with a flag
            header('Location: login.php?registered=1');
            exit;
        } else {
            $errors[] = 'Registration failed: ' . $stmt->error;
        }
        $stmt->close();
    }
    $conn->close();
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sign Up | MMAFIA</title>

    <!-- Fonts & Styles -->
    <link
      href="https://fonts.googleapis.com/css2?family=Anton&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="style.css" />

    <!-- Bootstrap -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT"
      crossorigin="anonymous"
    />
  </head>

  <body
    style="
      background-color: #111;
      color: white;
      font-family: 'Anton', sans-serif;
    "
  >
    <!-- Navbar -->
    <nav
      class="navbar navbar-expand-lg"
      id="navbar"
      style="background-color: black"
    >
      <div class="container-fluid">
        <a class="navbar-brand" href="index.html" id="logo">
          <img
            src="images/logo.png"
            alt="Company Logo"
            width="120"
            height="auto"
          />
        </a>

        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav justify-content-center mx-auto">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./index.php#instructor-bio">Instructor Bio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./index.php#muay-thai">Muay Thai</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./index.php#timetable">Timetable</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./index.php#memberships">Memberships</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./index.php#events">Events</a>
          </li>
          <li class="nav-item">
           <a class="nav-link" href="./index.php#contact">Contact</a>
          </li>
            <li class="nav-item">
              <a class="nav-link active" href="login.php">Login</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

 <!-- Signup Form -->
<div class="container py-5">
  <h1 class="text-center mb-4">Create Your MMAFIA Account</h1>

  <!-- Show errors -->
  <?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
      <ul>
        <?php foreach ($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>

  <form class="signup-form mx-auto" style="max-width: 600px" method="POST" action="register.php">
    
    <div class="mb-3 row">
      <label for="firstName" class="col-sm-3 col-form-label">First Name</label>
      <div class="col-sm-9">
        <input
          type="text"
          class="form-control"
          id="firstName"
          name="First_Name"
          required
        />
      </div>
    </div>

    <div class="mb-3 row">
      <label for="lastName" class="col-sm-3 col-form-label">Last Name</label>
      <div class="col-sm-9">
        <input
          type="text"
          class="form-control"
          id="lastName"
          name="Last_Name"
          required
        />
      </div>
    </div>

    <div class="mb-3 row">
      <label for="email" class="col-sm-3 col-form-label">Email</label>
      <div class="col-sm-9">
        <input
          type="email"
          class="form-control"
          id="email"
          name="email"
          placeholder="Enter your email"
          required
        />
      </div>
    </div>

    <div class="mb-3 row">
      <label for="phone" class="col-sm-3 col-form-label">Phone</label>
      <div class="col-sm-9">
        <input
          type="tel"
          class="form-control"
          id="phone"
          name="phone"
          placeholder="Optional"
        />
      </div>
    </div>

    <div class="mb-3 row">
      <label for="password" class="col-sm-3 col-form-label">Password</label>
      <div class="col-sm-9">
        <input
          type="password"
          class="form-control"
          id="password"
          name="password"
          placeholder="Enter password"
          required
        />
      </div>
    </div>

    <div class="mb-3 row">
      <label for="confirmPassword" class="col-sm-3 col-form-label">Confirm</label>
      <div class="col-sm-9">
        <input
          type="password"
          class="form-control"
          id="confirmPassword"
          name="confirmPassword"
          placeholder="Confirm password"
          required
        />
      </div>
    </div>

    

    <div class="text-end">
      <button type="submit" class="btn btn-danger px-4">Sign Up</button>
      <a href="login.php" class="btn btn-danger px-4">Back to Login</a>
    </div>
  </form>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
