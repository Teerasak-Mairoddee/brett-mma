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
                    <a class="nav-link" href="#">Instructor Bio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Muay Thai</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Time Table</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Memberships</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
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

           



            <!--nav bar end-->
            <!--Carousel start-->
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="3000">
                        <img src="images/class2.png" class="d-block w-100" alt="..." id="carousel-img-1">
                    </div>
                    <div class="carousel-item" data-bs-interval="3000">
                        <img src="images/class2.png" class="d-block w-100" alt="..." id="carousel-img-2">
                    </div>
                    <div class="carousel-item" data-bs-interval="3000">
                        <img src="images/class2.png" class="d-block w-100" alt="..." id="carousel-img-3">
                    </div>
                </div>
            </div>



            <!--carousel end-->
            <!--Instructor Bio start-->
            <h1 id="instructor-bio">INSTRUCTOR BIO</h1>
            <h2>Brett Healey</h2>
            <p>insert picture</p>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi.

                Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue.

                Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede. Praesent blandit odio eu enim. Pellentesque sed dui ut augue blandit sodales. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam nibh.

                Mauris ac mauris sed pede pellentesque fermentum. Maecenas adipiscing ante non diam sodales hendrerit. Ut velit mauris, egestas sed, gravida nec, ornare ut, mi. Aenean ut orci vel massa suscipit pulvinar. Nulla sollicitudin.

                Integer in mauris eu nibh euismod gravida. Duis ac tellus et risus vulputate vehicula. Donec lobortis risus a elit. Etiam tempor. Ut ullamcorper, ligula eu tempor congue, eros est euismod turpis, id tincidunt sapien risus a quam.
            </p>
            <!--Instructor Bio end-->
            <!--Muay Thai start-->
            <h1 id="muay-thai">MUAY THAI</h1>

            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi.

                Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue.

                Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede. Praesent blandit odio eu enim. Pellentesque sed dui ut augue blandit sodales. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam nibh.

                Mauris ac mauris sed pede pellentesque fermentum. Maecenas adipiscing ante non diam sodales hendrerit. Ut velit mauris, egestas sed, gravida nec, ornare ut, mi. Aenean ut orci vel massa suscipit pulvinar. Nulla sollicitudin.

                Integer in mauris eu nibh euismod gravida. Duis ac tellus et risus vulputate vehicula. Donec lobortis risus a elit. Etiam tempor. Ut ullamcorper, ligula eu tempor congue, eros est euismod turpis, id tincidunt sapien risus a quam.
            </p>
            <!--Muay Thai end-->

            <!--Timetable start-->
            <h1 id="timetable">TIMETABLE</h1>
            <div class="container my-5">
                <h2 class="mb-4">Sessions</h2>
                <div class="container my-5">
                    <h2 class="mb-4">Weekly Timetable</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered timetable">
                            <thead>
                                <tr>
                                    <th class="time-col">Time</th>
                                    <th>Monday</th>
                                    <th>Tuesday</th>
                                    <th>Wednesday</th>
                                    <th>Thursday</th>
                                    <th>Friday</th>
                                    <th>Saturday</th>
                                    <th>Sunday</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="time-col">08:00 - 09:00</td>
                                    <td>Math</td>
                                    <td>English</td>
                                    <td>History</td>
                                    <td>Science</td>
                                    <td>PE</td>
                                    <td>Art</td>
                                    <td>Free</td>
                                </tr>
                                <tr>
                                    <td class="time-col">09:00 - 10:00</td>
                                    <td>Art</td>
                                    <td>Math</td>
                                    <td>English</td>
                                    <td>History</td>
                                    <td>Science</td>
                                    <td>Workshop</td>
                                    <td>Free</td>
                                </tr>
                                <tr>
                                    <td class="time-col">10:00 - 11:00</td>
                                    <td>Break</td>
                                    <td>Break</td>
                                    <td>Break</td>
                                    <td>Break</td>
                                    <td>Break</td>
                                    <td>Break</td>
                                    <td>Break</td>
                                </tr>
                                <tr>
                                    <td class="time-col">11:00 - 12:00</td>
                                    <td>Computer Science</td>
                                    <td>Art</td>
                                    <td>Math</td>
                                    <td>English</td>
                                    <td>History</td>
                                    <td>Computer Science</td>
                                    <td>Free</td>
                                </tr>
                                <tr>
                                    <td class="time-col">12:00 - 13:00</td>
                                    <td>Lunch</td>
                                    <td>Lunch</td>
                                    <td>Lunch</td>
                                    <td>Lunch</td>
                                    <td>Lunch</td>
                                    <td>Lunch</td>
                                    <td>Lunch</td>
                                </tr>
                                <tr>
                                    <td class="time-col">13:00 - 14:00</td>
                                    <td>Science</td>
                                    <td>Computer Science</td>
                                    <td>Art</td>
                                    <td>Math</td>
                                    <td>English</td>
                                    <td>Science</td>
                                    <td>Free</td>
                                </tr>
                                <tr>
                                    <td class="time-col">14:00 - 15:00</td>
                                    <td>History</td>
                                    <td>Science</td>
                                    <td>Computer Science</td>
                                    <td>Art</td>
                                    <td>Math</td>
                                    <td>History</td>
                                    <td>Free</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--Timetable end-->
                <!--membership start-->
                <!-- Membership Cards -->
                <div class="membership-container">
                    <!-- Gold Membership -->
                    <div class="card shadow-sm membership-card gold">
                        <div class="card-header text-center">
                            Gold Membership
                        </div>
                        <div class="card-body text-center">
                            <p class="card-text mb-3">
                                • Priority support<br>
                                • Exclusive articles<br>
                                • Monthly newsletter
                            </p>
                            <a href="#" class="btn btn-outline-dark btn-gold">Join Now</a>
                        </div>
                    </div>
                    <!-- Diamond Membership -->
                    <div class="card shadow-sm membership-card diamond">
                        <div class="card-header text-center">
                            Diamond Membership
                        </div>
                        <div class="card-body text-center">
                            <p class="card-text mb-3">
                                • 24/7 dedicated support<br>
                                • Access to beta features<br>
                                • Quarterly gifts
                            </p>
                            <a href="#" class="btn btn-outline-dark btn-diamond">Join Now</a>
                        </div>
                    </div>
                    <!-- Platinum Membership -->
                    <div class="card shadow-sm membership-card platinum">
                        <div class="card-header text-center">
                            Platinum Membership
                        </div>
                        <div class="card-body text-center">
                            <p class="card-text mb-3">
                                • Personal account manager<br>
                                • Invitations to VIP events<br>
                                • Annual premium swag
                            </p>
                            <a href="#" class="btn btn-outline-dark btn-platinum">Join Now</a>
                        </div>
                    </div>
                </div>
                <!--membership end-->

                <!--Events start-->
                <h1 id="events">EVENTS</h1>

                <div class="card mb-4 shadow-sm event-card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Upcoming Event</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">Saturday, May 17, 2025</h6>
                        <p class="card-text">
                            Join us for a special workshop on advanced web development techniques. Learn about modern CSS, JavaScript frameworks, and best practices for responsive design.
                        </p>
                        <ul class="list-group list-group-flush mb-3">
                            <li class="list-group-item">🕒 10:00 AM - 1:00 PM</li>
                            <li class="list-group-item">📍 London Tech Hub, 123 Tech Street</li>
                        </ul>

                    </div>
                </div>
                <!--Events End-->

                <!--Contact start-->
                <h1 id="contact">Contact</h1>
                <div class="card mb-4 shadow-sm contact-card">
                    <div class="card-header">
                        Contact Information
                    </div>
                    <div class="card-body">
                        <p class="card-text mb-2"><strong>Email:</strong> <a href="mailto:example@example.com">example@example.com</a></p>
                        <p class="card-text"><strong>Phone:</strong> <a href="tel:+1234567890">+1 (234) 567-890</a></p>
                    </div>
                </div>
                <!--contact end-->



                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
                        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
                        crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.4.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
