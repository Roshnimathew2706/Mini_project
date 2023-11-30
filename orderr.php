<?php
session_start();
require_once "database.php";
//create object.
$pdo = new database();

//If the user is not logged in and opens the order page, they should be redirected to the login page
if(isset($_SESSION['email']) == 0){
    header('Location: login.php');
}

//If the admin is logged in, they will be automatically redirected to the admin dashboard page.

//'Change the email if you want to switch admin accounts
if($_SESSION['email'] == 'admin@laundryonlinemks.com'){
    header('Location: admin_dash.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Fetching data from the form
    $type_of_laundry = isset($_POST['type_of_laundry']) ? $_POST['type_of_laundry'] : '';
    $weight_of_the_item = isset($_POST['weight_of_the_item']) ? $_POST['weight_of_the_item'] : null;
    $item_quantity = isset($_POST['item_quantity']) ? $_POST['item_quantity'] : null;
    $pickup_date = isset($_POST['pickup_date']) ? $_POST['pickup_date'] : '';
    $delivery_date = isset($_POST['delivery_date']) ? $_POST['delivery_date'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $remark = isset($_POST['remark']) ? $_POST['remark'] : '';
    $lat = isset($_POST['lat']) ? $_POST['lat'] : null;
    $lng = isset($_POST['lng']) ? $_POST['lng'] : null;
    $total_price = isset($_POST['total_price']) ? $_POST['total_price'] : '';
    $unit_list = isset($_POST['unit_list']) ? $_POST['unit_list'] : '';
	echo "<script>alert('Order Successfully Added!'); window.location.href='index.php'; </script>";

        $status = "Waiting for Confirmation";
        // Insert order data into the database
        $pdo->add_order($type_of_laundry, $weight_of_the_item, $item_quantity, $pickup_date, $delivery_date, $address, $remark, $lat, $lng, $total_price, $status, $_SESSION['id'], $unit_list);
}
?>

<!DOCTYPE html>
<html lang="id">
	<head>
		<title>Laundry Booking</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="stylesheet" type="text/css" href="css/order.css"/>
		<link rel="stylesheet" type="text/css" href="css/roboto-font.css">
		<link rel="stylesheet" type="text/css" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
		<script src="js/jquery-3.3.1.min.js"></script>
		<script src="js/jquery.steps.js"></script>
		<script src="js/jquery-ui.min.js"></script>
		<script src="js/orderr.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKtmUDqFDJ8-D3F0nJM4bpiD4hAR-fzeo"></script>
	</head>
	<body>
		<div class="page-content" style="background-image: url('images/bg-01.jpg')">
			<div class="booking">
				<div class="order-form">
					<div class="order-header">
						<h3 class="heading">Spin Solutions</h3>
						<p>  </p>
					</div>
					<form class="form-order" action="" method="post" name="form-order" id="form-order">
						<h2>
							<span class="step-icon"><i class="zmdi zmdi-shopping-cart"></i></span>
							<span class="step-text">cart</span>
						</h2>
						<section>
							<div class="inner">
								<h3>Please Fill in Your Order Form</h3>
								<div class="form-group" id="radio">
									<label>Select the items:</label>
									<label>
										<input type="radio" class="type_of_laundry" name="type_of_laundry" id="SteamIroningCheck" value="DryClean" checked>
									</label>Weight-Based
									
								</div>
								<div class="form-row" id="SteamIroning_checked" name="SteamIroning_checked">
									<div class="form-holder form-holder-1">
										<h5>Service Description:</h5> 
										<ol>
											<li>CLOTHES (Dry-Clean) 5KG = 800 OR 160/KG</li>
											
										</ol>
										<label class="form-row-inner">
											<input type="number" class="form-control" id="weight_of_the_item" name="weight_of_the_item" min="1" max="50">
											<span class="label">Weight of Items (Kg)</span>
											<span class="border"></span>
										</label>
									</div>
								</div>
								
								<div class="form-row">
									<div class="form-holder form-holder-1">
										<label class="form-row-inner" for="pickup_date">Choose Pickup Date:</label>
										<div class="form-holder form-holder-1">
											<input type="date" id="pickup_date" name="pickup_date" required>
										</div>
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder form-holder-1">
										<label class="form-row-inner" for="delivery_date">Choose Delivery Date:</label>
										<div class="form-holder form-holder-1">
											<input type="date" id="delivery_date" name="delivery_date" required>
										</div>
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<label class="form-row-inner">
											<input type="text" class="form-control" id="remark" name="remark">
											<span class="label">Add Notes</span>
											<span class="border"></span>
										</label>
									</div>
								</div>
								<p class="harga-total">
									<label>Total Price: Rs. <input type="text" id="total_price" name="total_price" class="harga-total" value="0" readonly="readonly" /></label>
								</p>
								<input type="hidden" id="harga-sementara" name="harga-sementara" value="0">
								<input type="hidden" id="unit_list" name="unit_list" value="">
							</div>
						</section>
						<!-- services 2 -->
						<h2>
							<span class="step-icon"><i class="zmdi zmdi-home"></i></span>
							<span class="step-text">Address</span>
						</h2>
						<section>
							<div class="inner">
								<h3>Please Enter Your Address</h3>
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<label class="form-row-inner">
											<input type="text" class="form-control" id="address" name="address" required>
											<span class="label">Complete Address</span>
											<span class="border"></span>
										</label>
									</div>
								</div>
							
						</section>
						<!-- services 3 -->
						<h2>
							<span class="step-icon"><i class="zmdi zmdi-card"></i></span>
							<span class="step-text">payment</span>
						</h2>
						<section>
							<div class="inner">
								<h3>payment Method:</h3>
								<div class="form-row table-responsive">
									<table class="table">
										<tbody>
											<tr class="space-row">
												<input type="radio" class="pay" name="pay" id="cod" value="COD" checked>
												<span class="label">Cash On Delivery</span>
												<th class="space-row">
													<img src="images/cod192.png" alt="pay-1">
												</th>
											</tr>
											
										</tbody>
										
									</table>
								</div>
							</div>
						</section>
						<!-- services 4 -->
						<h2>
							<span class="step-icon"><i class="zmdi zmdi-receipt"></i></span>
							<span class="step-text">Details</span>
						</h2>
						<section>
							<div class="inner">
								<h3>Confirmation Details :</h3>
								<div class="form-row table-responsive">
									<table class="table">
										<tbody>
											
											<tr class="space-row">
												<th>Laundry Type </th>
												<td id="type_of_laundry-val"></td>
											</tr>
											<tr class="space-row">
												<th id="weight_of_the_itemText">Weight of Goods</th>
												<td id="weight_of_the_item-val"></td>
											</tr>
											
											<tr class="space-row">
												<th>Additional Notes </th>
												<td id="remark-val"></td>
											</tr>
											<tr class="space-row">
												<th>Pickup Time </th>
												<td id="pickup_time-val"></td>
											</tr>
											<tr class="space-row">
												<th>Delivery Time </th>
												<td id="delivery_time-val"></td>
											</tr>
											<tr class="space-row">
												<th>Address </th>
												<td id="address-val"></td>
											</tr>
											
											
											<tr class="space-row">
												<th>Payment Method </th>
												<td id="pay-val"></td>
											</tr>
											
										</tbody>
									</table>
								</div>
							</div>
						</section>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>