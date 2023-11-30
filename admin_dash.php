<?php
session_start();
require_once "database.php";
//Calling the database class
$pdo = new database();
$edit_form = false;
$view_order = false;



// If the user is not logged in and tries to access this page, redirect them to the login page
if(isset($_SESSION['email']) == 0){
    exit("<h1>Access Denied</h1>");
}

// Access denied for emails other than admin
// Change the email if you want to change the admin account
if($_SESSION['email'] != 'admin@laundryonlinemks.com'){
    exit("<h1>Access Denied</h1>");
}

// Display customer data
$rows = $pdo -> showData();

// Display order data
$orders = $pdo -> showorder();


if (isset($_POST['delete'])){
    
    if($_POST['id'] == 1){
        echo('<div class="alert alert-danger" role="alert">');
        echo('Cannot delete administrator');
        echo('</div>');
    }
    else{
        $pdo -> deleteData($_POST['id']);
        header("Location: admin_dash.php#customers");
    }
}


if(isset($_GET['edit'])){
    $data = $pdo -> getData($_GET['edit']);
    $edit_form = true;
    $name = $data['name'];
    $email = $data['email'];
    $phone_no = $data['phone_no'];
    $id = $data['id'];
}


if(isset($_GET['view'])){
    $booking = $pdo -> getOrder($_GET['view']);
    $view_order = true;
    $userId = $booking['user_id'];
    $laundry_type = $booking['laundry_type'];
    $item_mass = $booking['item_mass'];
    $item_quantity = $booking['item_quantity'];
    $pickup_time = $booking['pickup_time'];
    $delivery_time = $booking['delivery_time'];
    $address = $booking['address'];
    $note = $booking['note'];
    $garisLintang = "".$booking['total_price'].", ";
    $garisBujur = $booking['garis_bujur'];
    $priceTotal = $booking['price_total'];
    $statusbooking = $booking['order_status'];
    $orderId = $booking['id'];
    $listSatuan = $booking['unit_list'];
}

//Updating customer data
if(isset($_POST['update'])){
    $update = $pdo -> updateData($_POST['name'], $_POST['email'], $_POST['password'], $_POST['phone_no'], $id);
    header("Location: admin_dash.php#customers");
}

//Updating order data
if(isset($_POST['update_order'])){
    $radio_status = $_POST['status'];
    $update = $pdo -> updateStatus($radio_status, $orderId);
    header("Location: admin_dash.php#pesanan");
}

//For the cancel edit button
if(isset($_POST['cancel'])){
    header("Location: admin_dash.php#customers");
}

//For the cancel edit button
if(isset($_POST['cancel_update'])){
    header("Location: admin_dash.php#pesanan");
}

//Retrieve total customer data
$banyakdata = $pdo -> banyak_data();

//Retrieve order quantity data
$banyakpesanan = $pdo -> banyak_pesanan();
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
    <h1 class="elementor-heading-title elementor-size-default"><span>Welcome,
 <?php echo $_SESSION['name']; ?>!</h1></span><br></br>
<strong><h2 class="lead">You are in the admin space, check orders and customer profiles here.
</strong></h2>
     
      
    </div>
  </section><!-- End Hero -->

    <!-- Isi -->
    <div data-spy="scroll" data-target="#navbar-admin" data-offset="0">
    
    <div class="jumbotron jumbotron-fluid bg-white">
        <div class="container">
        
<h1 class="text-center">Viewing the number of orders and registered customers</h1>

            <br>
            
            <div class="row">
            <div class="col-6">
    <div class="center">
        
    </div>
</div>

<div class="col-6">
    <div class="center">
        
    </div>
</div>

            </div>
            <br>
            <div class="row">
                <div class="col-6"><div class="center"><img src="images/pesanan.png" width="100px"></div></div>
                <div class="col-6"><div class="center"><img src="images/users.png" width="100px"></div></div>
            </div>
            <br>
            <div class="row">
            <div class="col-6">
    <div class="center">
        <h5><?php echo $banyakpesanan ?> orders</h5>
    </div>
</div>

<div class="col-6">
    <div class="center">
         <?php
        // Assuming $banyakdata is the variable representing the number of customers
        $banyakdata--; // Decrease the count by 1
        ?>
        <h5><?php echo $banyakdata; ?> customers</h5><br><br>
    </div>
</div>

            </div>
        </div>
    </div>
    
    <div class="jumbotron jumbotron-fluid bg-light">
        <br><div class="container">
            <h1 class="text-center"  id ="pesanan">Orders</h1>
            
            <br>
            <table id="pagination" class="table table-striped table-bordered">
                <thead>
                <tr>
    <th scope="col">User ID</th>
    
    <th scope="col">Laundry Type</th>
    
    <th scope="col">Weight</th>
    
    <th scope="col">Total Price</th>
    <th scope="col">Order Status</th>
    <th scope="col">Action</th>
</tr>

                </thead>
                <tbody>
                    <?php
                        foreach( $orders as $order){
                    ?>
                    <tr>
                        <th scope="row"><?=$order['user_id'] ?></th>
                        
                        <td><?=$order['laundry_type'] ?></td>
                        
                        <td><?=$order['item_mass'] ?></td>
                        
                        <td><?=$order['price_total'] ?></td>
                        <td><?=$order['order_status'] ?></td>
                        <td>
                            <form action="admin_dash.php?view=<?php echo $order['id']; ?>#pesanan" method="post">
                                <input type="hidden" name="id" value="<?=$order['id']?>">
                                <input type="submit" class="btn btn-outline-success active-center" value="View" name="view">
                            </form>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
            <br><br>
            <?php 
                if ($view_order == false){
                    // Empty
                }
                else{
            ?><div class="form-container">
                   <u> <h2 class="center">View Data</h2></u>
                   
                    
                        <p><b>ID User :</b> <?php echo $userId; ?></li><br>
                        <b>Laundry Type : </b><?php echo $laundry_type; ?></li><br>
                        
                        <b> Item Quantity : </b><?php echo $item_mass; ?></li><br>
                        
                        <b> pickup date : </b><?php echo $pickup_time; ?></li><br>
                        <b> Delivery date :</b> <?php echo $delivery_time; ?></li><br>
                        <b> Address :</b><?php echo $address; ?></li><br>
                        <b> Note : </b><?php echo $note; ?></li><br>
                        <b> price Total :</b> <?php echo $priceTotal; ?><br>
                        
                        <form method="post">
                        <h2><u>Order Status:</u><br></h2>
<input type="radio" id="waiting_confirmation" name="status" value="Waiting for Confirmation" checked>
<label for="waiting_confirmation">Waiting for Confirmation</label><br>
<input type="radio" id="courier_pickup" name="status" value="Laundry Received">
<label for="courier_pickup">Laundry Received</label><br>
<input type="radio" id="being_washed" name="status" value="Currently being Proceesing">
<label for="being_washed">Currently being Proceesing</label><br>
<input type="radio" id="courier_delivery" name="status" value="Out for Delivery">
<label for="courier_delivery">Out for Delivery</label><br>

<input type="radio" id="completed" name="status" value="Completed">
<label for="completed">Delivered</label>
                    <p>
                    <?php
                }
                    ?>
                <?php 
                    if($view_order == false){
                        //Empty
                    } 
                    else{ ?>
                        <p class="center">
                            <input type="submit" class="btn btn-outline-success active-center" name="update_order" value="Update"/>
                            <input type="submit" class="btn btn-outline-success active-center" name="cancel_update" value="Cancel"/>
                        </p>
                    </form>
                <?php
                    } 
                ?>
        </div><br>
    </div>
    
    <div class="jumbotron jumbotron-fluid bg-white">
       <br> <div class="container">
        <h1 class="text-center" id="customers">Customer Profile</h1>


            </p>
            <br>
            <table id="pagination2" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID User</th>
                        <th scope="col">Name</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Mobile Number</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ( $rows as $row ) {
                    ?>
                    <tr>
                        <th><?=$row['id']?></th>
                        <th><?=$row['name'] ?></th>
                        <td><?=$row['email'] ?></td>
                        <td><?=$row['phone_no']?></td>
                        <td>
                            <form action="admin_dash.php?edit=<?php echo $row['id']; ?>#customers" method="post">
                                <input type="hidden" name="id" value="<?=$row['id']?>">
                                <input type="submit" class="btn btn-outline-success active-center"value="Edit" name="edit">
                            </form>
                        </td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="id" value="<?=$row['id']?>">
                                <input type="submit" class="btn btn-outline-success active-center" value="Delete" name="delete">
                            </form>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <br>
        <?php 
    if($edit_form == false){
    // Empty
    } 
    else { ?>
        <!-- To display the edit customer -->
        <div class="jumbotron jumbotron-fluid bg-light">
       <br> <div class="container">
        <h4 class="text-center">Edit Customer Details</h4> <form method="post">
        <div class="form-group">
        <p class="center">Name: </p>
        <p class="center"><input type="text" class="center" name="name" value="<?php echo $name; ?>"></p>
        </div>
        <div class="form-group">
        <p class="center">E-mail: </p>
        <p class="center"><input type="email" class="center" name="email" value="<?php echo $email; ?>"></p>
        </div>
        <!-- <p class="center">Password : </p>
            <p class="center"><input type="password" class = "center" name="password" id="password"></p>
            <p class="center"><input type="checkbox" onclick="myFunction()"> Show Password</p> -->
        <div class="form-group">
             
        <p class="center">Phone Number: </p>
        </div>
        <div class="form-group">
             <p class="center"><input type="text" class="center" name="phone_no" value="<?php echo $phone_no; ?>"></p>
             </div>
            
        <?php
    } ?>
    <br>
<?php 
    if($edit_form == false){ ?>
    <?php
    } 
    else{ ?>
        <p class="center"><input type="submit" class="btn btn-outline-success active-center" name="update" value="Update"/>
        <input type="submit"class="btn btn-outline-success active-center" name="cancel" value="Cancel"/>
        </p>
       
        </form>
        </div>
    <?php
    } ?>
    </div>
</div>


<!-- Footer -->
<footer class="page-footer font-small blue">
  <div class="footer-copyright text-center py-3 bg-dark text-white">
     Spin solutions
  </div>
</footer>

</div>
</div>
</body>

<script>
    //Using the DataTables library
    $(document).ready(function() {
        $('#pagination').DataTable();
    } );

    $(document).ready(function() {
        $('#pagination2').DataTable();
    } );

//Bring up the password
function myFunction(){
        var x = document.getElementById("password");
        if (x.type === "password"){
            x.type = "text";
        } 
        else{
            x.type = "password";
        }
    }

// // initialize function to prepare the map
// function initMap() {

//         // Determine the initial map coordinates, magnification, and map type
//         var propertiPeta = {
//             center:new google.maps.LatLng(<?php echo $garisLintang; ?> <?php echo $garisBujur; ?>),
//             zoom:15,
//             mapTypeId:google.maps.MapTypeId.ROADMAP
//         };

//         // Initiate the map according to the specified ID
//         var peta = new google.maps.Map(document.getElementById("googleMaps"), propertiPeta);
        
//         // Add markers to the map
//         var marker=new google.maps.Marker({
//             position: new google.maps.LatLng(<?php echo $garisLintang; ?> <?php echo $garisBujur; ?>),
//             map: peta,
//             animation: google.maps.Animation.BOUNCE
//         });
//     }
//     // window load event
//     google.maps.event.addDomListener(window, 'load', initMap);
</script>
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
        