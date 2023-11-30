<?php
session_start();
require_once "database.php";
$pdo = new Database();
$edit_form = false;

// If the user is not logged in and tries to access this page, redirect them to the login page
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
}

// If an admin is logged in, redirect them to the admin dashboard
// Change the email if you want to use a different admin account
if ($_SESSION['email'] == 'admin@laundryonlinemks.com') {
    header('Location: admin_dash.php');
}

// Fetching orders table
$rows = $pdo->getPesanan($_SESSION['id']);

// Fetching data and populating the edit box
if (isset($_GET['edit'])) {
    $data = $pdo->GetEditorder($_GET['edit']);
    $edit_form = true;
    $name = $data['name'];
    $email = $data['email'];
    $phone_no = $data['phone_no'];
    $id = $data['id'];
}

// Updating data
if (isset($_POST['update'])) {
    $update = $pdo->updateData($_POST['nama'], $_POST['email'], $_POST['password'], $_POST['phone_no'], $id);
    $_SESSION['name'] = $_POST['nama'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['phone_number'] = $_POST['phone_no'];
    // Retrieving data from a specific order name and sending it here
    header("Location: dashboard.php#profil");
}

// For the cancel edit button
if (isset($_POST['cancel'])) {
    header("Location: dashboard.php#profil");
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

        <nav id="navbar user" class="navbar">
            <ul>
              <li><a class="nav-link scrollto active" href="#about">Home</a></li>
              <li class="dropdown"><a href="#"><span>Services</span> <i class="bi bi-chevron-down"></i></a>
              <ul>
                <li><a href="drycleaning.html">DRY CLEAN</a></li>
                <li><a href="washiron.html">WASH + IRON</a></li>
                <li><a href="steam.html">STEAM IRON</a></li>
                <li><a href="washfold.html">WASH + FOLD</a></li>
            </ul>
              <li><a class="nav-link scrollto" href="status.php">Status</a></li>
              
              <li><a class="getstarted scrollto" href="logout.php">logout</a></li>
             
            </ul>
                  
            <i class="bi bi-list mobile-nav-toggle"></i>
          </nav><!-- .navbar -->
  
      </div><!-- End Header Container -->
    </div>
  </header><!-- End Header -->
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container text-center position-relative" data-aos="fade-in" data-aos-delay="200">
    <h2 class="elementor-heading-title elementor-size-default"><span>Looking For The "BEST DRY CLEANING SERVICE?"</span><br></br>
<strong>WELCOME TO SPIN OLUTIONS</strong></h2>
     
      
    </div>
  </section><!-- End Hero -->
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
  
  <!--================ service Area  =================-->
 <section id="services" class="services">
      <div class="container">

        <div class="section-title text-center">
          <h2>Services</h2>
            <p>We provide you the best Online Dry-Cleaning and Laundry services with affordable pricing. </p>
        </div>
        <div class="row ">
            <div class="col-lg-3 col-sm-6">
                <div class="service_item text-center">
                    <div class="service_img">
                        <a href="#"><h4 class="sec_h4">DRY CLEAN</h4></a>
                        <img src="assets/img/team/s2.webp" alt=""><h1></h1>
                        <a href="drycleaning.html" class="more-btn">Learn More <i class="bx bx-chevron-right"></i></a>
                    </div>
                    
                    
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                
                <div class="service_item text-center">
                    <div class="service_img">
                        <a href="#"><h4 class="sec_h4">WASH + IRON</h4></a>
                        <img src="assets/img/team/s3.webp" alt=""><h1></h1>
                        <a href="washiron.html" class="more-btn">Learn More <i class="bx bx-chevron-right"></i></a>
                    </div>
                    
                    
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="service_item text-center">
                    <div class="service_img">
                        <a href="#"><h4 class="sec_h4">STEAM IRON</h4></a>
                        <img src="assets/img/team/s1.webp" alt=""><h1></h1>
                        <a href="steam.html" class="more-btn">Learn More <i class="bx bx-chevron-right"></i></a>
                    </div>
                    
                    
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="service_item text-center">
                    <div class="hotel_img">
                        <a href="#"><h4 class="sec_h4">WASH + FOLD</h4></a>
                        <img src="assets/img/team/s4.webp" alt=""><h1></h1>
                        <a href="washfold.html" class="more-btn">Learn More <i class="bx bx-chevron-right"></i></a>
                    </div>
                    
                    
                </div>
            </div>
    </div>
</section>


    
    
<!--================ service Area  =================-->

            <tbody>
                <div class="jumbotron jumbotron-fluid bg-dark text-light">
                    <div class="container">
                        <h3 class="center" id="profile"><b>Profile Information</b></h3>
                        
                        
                            <p>Name: <?php echo ($_SESSION['name']) ?><br>
                            
                            Email: <?php echo ($_SESSION['email']) ?> <br>
                            
                            Phone Number: <?php echo ($_SESSION['phone_number']) ?> </p>
                        
                        <br>
</div>
</div>

                        <form action="dashboard.php?edit=<?php echo $_SESSION['id']; ?>#profile" method="post">
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
        