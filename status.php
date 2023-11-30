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
    $update = $pdo->updateData($_POST['name'], $_POST['email'], $_POST['password'], $_POST['phone_no'], $id);
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
  <title>Status view</title>
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
              <li><a class="nav-link scrollto active" href="dashboard.php">Home</a></li>
              <li class="dropdown"><a href="#"><span>Services</span> <i class="bi bi-chevron-down"></i></a>
              <ul>
                <li><a href="drycleaning.html">DRY CLEAN</a></li>
                <li><a href="washiron.html">WASH + IRON</a></li>
                <li><a href="steam.html">STEAM IRON</a></li>
                <li><a href="washfold.html">WASH + FOLD</a></li>
            </ul>
              
              
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
    <h2 class="elementor-heading-title elementor-size-default">
<strong>WELCOME <?php echo ($_SESSION['name']) ?> </strong><br></br><span>Here, we keep you informed about the current operational status of your laundry services. </span></h2>
     
      
    </div>
  </section><!-- End Hero -->
 
  
  


    <!--================ statusview Area  =================-->
    <br><div class="jumbotron jumbotron-fluid bg-white">
    <div class="container">
        <center><h1 class="btn btn-outline-success active" id="status-order">ORDER  STATUS</h1></center>
        
        <br>
        <table id="pagination" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">Laundry Type</th>
                    <th scope="col">Weight</th>
                    
                    <th scope="col">Pickup Time</th>
                    <th scope="col">Delivery Time</th>
                    <th scope="col">Address</th>
                    <th scope="col">Note</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Order Status</th>
                </tr>
            </thead>
            <tbody>
            <?php
                        foreach ( $rows as $row ) {
                    ?>
                    <tr>
    <td><?=$row['laundry_type'] ?></td>
    <td><?=$row['item_mass'] ?></td>
    
    <td><?=$row['pickup_time'] ?></td>
    <td><?=$row['delivery_time'] ?></td>
    <td><?=$row['address'] ?></td>
    <td><?=$row['note'] ?></td>
    <td><?=$row['price_total'] ?></td>
    <td><?=$row['order_status'] ?></td>
</tr>
<?php
                        }
                    ?>
                </tbody>
            </table>
    
<!--================ Statusview Area  =================-->

           
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
        