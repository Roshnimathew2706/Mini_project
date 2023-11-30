<?php
session_start();
require_once "database.php";
// Calling the database class
$pdo = new Database();

// If the user is already logged in, they will be redirected to the user/admin dashboard
if (isset($_SESSION['email']) == 0) {
    
} 
else {
    header("Location: dashboard.php");    
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>SS - Index</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
 <!-- Google Fonts -->
 <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
   <!-- Template Main CSS File -->
   <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center">
      <div class="container">
        <div class="header-container d-flex align-items-center justify-content-between">
          <div class="logo">
            <h1 class="text-light"><a href="index.html"><span>Spin Solutions</span></a></h1>
        </div>

        <nav id="navbar" class="navbar">
            <ul>
              <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
              <li><a class="nav-link scrollto" href="#about">About</a></li>
              <li><a class="nav-link scrollto" href="#services">Services</a></li>
              <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
              <li class="dropdown , getstarted scrollto">
                <a href="#"><span>Login / Signup</span> <i class="bi bi-chevron-down"></i></a>
                <ul>
                  <li><a href="login.php">Login</a></li>
                  <li><a href="signup.php" id="signupLink">Signup</a></li>
                </ul>
              </li>
            </ul>
                  
            <i class="bi bi-list mobile-nav-toggle"></i>
          </nav><!-- .navbar -->
  
      </div><!-- End Header Container -->
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container text-center position-relative" data-aos="fade-in" data-aos-delay="200">
      <h1>Find your nearest Laundromat!</h1>
      <h2>Laundry & Dry-Clean with 48h delivery</h2>
      <a href="signup.php" class="btn-get-started scrollto">Get Started</a>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="row content">
          <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
            <img src="images\laundry-feature.webp" height="363" width="450" class="attachment-full size-full wp-image-67332 sp-no-webp lazyloaded" alt="" decoding="async" fetchpriority="high" data-ll-status="loaded">
            
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-left" data-aos-delay="200">
            <h2>IMPECCABLE QUALITY, EVERYTIME!</h2>
            <h3>Equipped with global standard machines and cleaning solution to deliver fresh and sparkling clothes, everytime!</h3>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    
    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
      <div class="container">

        <div class="row">
          <div class="col-lg-4 d-flex align-items-stretch" data-aos="fade-right">
            <div class="content">
              <h3>Why We Are The Best ?</h3>
              <p>
                How we wish maintaining ourwhite clothes was easy as watching those commercials. With SPIN SOLUTIONS, it is Easier!At SPIN SOLUTIONS, we bring the best-in-class Laundry, Dry Cleaning and Home Cleaning Services at your doorstep!
              </p>
              <div class="text-center">
                <a href="#" class="more-btn">Learn More <i class="bx bx-chevron-right"></i></a>
              </div>
            </div>
          </div>
          <div class="col-lg-8 d-flex align-items-stretch">
            <div class="icon-boxes d-flex flex-column justify-content-center">
              <div class="row">
                <div class="col-xl-4 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-receipt"></i>
                    <h4>Free Pickup Drop</h4>
                    <p>Free pick-up and delivery at your doorsteps so that you can enjoy hassle-free dry cleaning and laundry services.</p>
                  </div>
                </div>
                <div class="col-xl-4 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="200">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-cube-alt"></i>
                    <h4>Affordable</h4>
                    <p>Spin Solutions is a quick, efficient and cost effective way for your dry cleaning needs. Online laundry space was never that affordable.</p>
                  </div>
                </div>
                <div class="col-xl-4 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="300">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-images"></i>
                    <h4>Fast Processing</h4>
                    <p>We ensure that you get your articles processed within committed time. Most of our processes have been automated to ensure same experience every time</p>
                  </div>
                </div>
              </div>
            </div><!-- End .content-->
          </div>
        </div>

      </div>
    </section><!-- End Why Us Section -->

   
    <!-- ======= SERVICE Section ======= -->
    <section id="services" class="team">
      <div class="container">

        <div class="row">
          <div class="col-lg-4">
            <div class="section-title" data-aos="fade-right">
              <h2>Our Services</h2>
              <p> We provide you the best Online Dry-Cleaning and Laundry services with affordable pricing.Every cloth goes through a comprehensive
              6 stage process enabling us to deliver on the promise of sparkling & fresh clothes,everytime.</p>
            </div>
          </div>
          <div class="col-lg-8">
            <div class="row">

              <div class="col-lg-6">
                <div class="member" data-aos="zoom-in" data-aos-delay="100">
                  <div class="pic"><img src="assets/img/team/s2.webp" class="img-fluid" alt=""></div>
                  <div class="member-info">
                    <h4>DRY CLEAN</h4>
                    
                    
                  </div>
                </div>
              </div>

              <div class="col-lg-6 mt-4 mt-lg-0">
                <div class="member" data-aos="zoom-in" data-aos-delay="200">
                  <div class="pic"><img src="assets/img/team/s4.webp" class="img-fluid" alt=""></div>
                  <div class="member-info">
                    <h4>WASH + FOLD</h4>
                   
                    
                  </div>
                </div>
              </div>

              <div class="col-lg-6 mt-4">
                <div class="member" data-aos="zoom-in" data-aos-delay="300">
                  <div class="pic"><img src="assets/img/team/s3.webp" class="img-fluid" alt=""></div>
                  <div class="member-info">
                    <h4>WASH + IRON</h4>
                  
                   
                  </div>
                </div>
              </div>

              <div class="col-lg-6 mt-4">
                <div class="member" data-aos="zoom-in" data-aos-delay="400">
                  <div class="pic"><img src="assets/img/team/s1.webp" class="img-fluid" alt=""></div>
                  <div class="member-info">
                    <h4>STEAM IRON</h4>
                    
                   
                  </div>
                </div>
              </div>

            </div>

          </div>
        </div>

      </div>
    </section><!-- End Team Section -->


  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <tbody>
  <footer id="contact">

    <div class="footer-top">
    <div class="jumbotron jumbotron-fluid bg-dark text-light">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>SPIN SOLUTIONS</h3>
            
            <p>We at SPIN SOLUTIONS will save time, effort precious resources for all our delighted customers,we are all set to bring to you compelling and innovative services...</p>
          </div>

          
          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">DRY CLEAN</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">WASH + IRON</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">STEAM IRON</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">WASH + FOLD</a></li>
              
            </ul>
          </div>
          <div class="col-lg-2 col-md-6 footer-links">
            <h4>CONTACT US</h4>
            
                <p>
                    <strong>Phone:</strong> +918078449539<br>
                    <strong>Email:</strong> spinsolution@example.com<br>
                  </p>
            
          </div>

          

        </div>
      </div>
    </div>

   
     
    </div>
    
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>