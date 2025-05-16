<?php
session_start();
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
?>
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>MMAFIA</title>
  
  <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="style.css" />
  <link 
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT"
    crossorigin="anonymous"
  />
</head>

<body>
  <div class="all-content">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg" id="navbar" style="background-color: black;">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php" id="logo">
          <img src="images/logo.png" alt="Company Logo" width="120" height="auto">
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

            <!-- Login Link -->
            <?php if (isset($_SESSION['user_id'])): ?>
              <li class="nav-item">
                <span class="nav-link">Hi, <?php echo htmlspecialchars($_SESSION['First_Name']); ?></span>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
              </li>
            <?php else: ?>
              <li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
              </li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->

    <!-- When Logged in, show data / page -->
    <?php if (isset($_SESSION['user_id'])): ?>
        <h1> Manage Account</h1>      
        <h2> Account Number: <?php echo htmlspecialchars($_SESSION['user_id']); ?></h2>
        <h2> Name: <?php echo htmlspecialchars($_SESSION['First_Name']); ?></h2>
        <h2> Name: <?php echo htmlspecialchars($_SESSION['Last_Name']); ?></h2>
        <h2> Email: <?php echo htmlspecialchars($_SESSION['email']); ?></h2>
        
      
        

              
    <?php else: ?>
      <h2>display error</h2>
    <?php endif; ?>
    

    <a href="./index.php#instructor-bio">Back to Top</a>
  </div>

  <script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
    crossorigin="anonymous"
  ></script>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.4.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
