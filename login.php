<?php
//only Connect to database if form is sent 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("db_conn.php");
    session_start();

//user inputs email and password-> Form submission
    $email = $_POST['email'];
    $password = $_POST['password'];
//function 
    function try_login($conn, $email, $password, $table, $redirect) {
        $stmt = $conn->prepare("SELECT * FROM $table WHERE email = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        //Paramter binding(? becomes email in string form) to avoid SQL injection
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        //$result && $result -> prevent crashing as it double checks database
        if ($result && $result->num_rows === 1) {
            $user = $result->fetch_assoc();
            //if found email -> execute this code below and store on page with $_SESSION
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['First_Name'] = $user['First_Name'];
                $_SESSION['Last_Name'] = $user['Last_name'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role']    = 'admin';
                //redirect to admin or index -> try_login function
                header("Location: $redirect");
                exit();
            } else {
                echo "Invalid password.<br>";
                echo "Input: " . $password . "<br>";
                echo "DB pass: " . $user['password'] . "<br>";
            }
        }

        $stmt->close();
    }

// funtion  Try login for "admins" and "user" = $table ... "admin_index.php" and "index.php" = $redirect
    try_login($conn, $email, $password, "admins", "admin_index.php");
    try_login($conn, $email, $password, "users", "index.php");

    echo "User not found or invalid credentials.";
    $conn->close();
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
  <nav class="navbar navbar-expand-lg" id="navbar" style="background-color: black;">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php" id="logo">
        <img src="images/logo.png" alt="Company Logo" width="120" height="auto">
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav justify-content-center">
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
        </ul>
      </div>
    </div>
  </nav>

  <!-- Login Form -->
  <div class="container py-5">
    <h1 class="text-center mb-4">Login to MMAFIA</h1>
    <form class="login-form mx-auto" style="max-width: 600px" method="POST" action="login.php">

      <div class="mb-3 row">
        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
          <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Enter your email" />
        </div>
      </div>
      <div class="mb-3 row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
          <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Enter password" />
        </div>
      </div>
      <div class="text-end">
        <button type="submit" class="btn btn-danger px-4">Login</button>
        <a href="register.php" class="btn btn-danger px-4">Register</a>
      </div>
    </form>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
