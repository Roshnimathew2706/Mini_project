<?php
session_start();
require_once "database.php";
//Memanggil kelas database
$pdo = new database();
$edit_form = false;
$view_order = false;

//Init
$garisLintang = "";
$garisBujur = "";

//Jika user belum login dan membuka ini, maka langsung diarahkan ke halaman login
if(isset($_SESSION['email']) == 0){
    exit("<h1>Access Denied</h1>");
}

//Akses selain e-mail admin akan ditolak
//'Change the email if you want to switch admin accounts
if($_SESSION['email'] != 'admin@laundryonlinemks.com'){
    exit("<h1>Access Denied</h1>");
}

//Memunculkan data customers
$rows = $pdo -> showData();

//Memunculkan data order
$orders = $pdo -> showorder();

//Menghapus data
if (isset($_POST['delete'])){
    //Jika tekan hapus admin
    //Ubah nomor jika id admin berubah
    if($_POST['id'] == 1){
        echo('<div class="alert alert-danger" role="alert">');
        echo('Tidak bisa hapus administrator');
        echo('</div>');
    }
    else{
        $pdo -> deleteData($_POST['id']);
        header("Location: admin_dash.php#customers");
    }
}

//Mengambil data dan menaruh di kotak edit customer
if(isset($_GET['edit'])){
    $data = $pdo -> getData($_GET['edit']);
    $edit_form = true;
    $name = $data['name'];
    $email = $data['email'];
    $phone_no = $data['phone_no'];
    $id = $data['id'];
}

//Mengambil data dan menaruh di kotak view order
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

//Mengupdate data customers
if(isset($_POST['update'])){
    $update = $pdo -> updateData($_POST['nama'], $_POST['email'], $_POST['password'], $_POST['phone_no'], $id);
    header("Location: admin_dash.php#customers");
}

//Mengupdate data order
if(isset($_POST['update_order'])){
    $radio_status = $_POST['status'];
    $update = $pdo -> updateStatus($radio_status, $orderId);
    header("Location: admin_dash.php#pesanan");
}

//Untuk tombol membatalkan edit
if(isset($_POST['cancel'])){
    header("Location: admin_dash.php#customers");
}

//Untuk tombol membatalkan edit
if(isset($_POST['cancel_update'])){
    header("Location: admin_dash.php#pesanan");
}

//Mengambil jumlah data customers
$banyakdata = $pdo -> banyak_data();

//Mengambil jumlah data pesanan
$banyakpesanan = $pdo -> banyak_pesanan();
?>

<!DOCTYPE html>
<html lang="en">
<div class="jumbotron jumbotron-fluid bg-light">
        <div class="container">
            <h1 class="center" id ="pesanan">orders</h1>
            <p class="center">List of orders from customers.
            </p>
            <br>
            <table id="pagination" class="table table-striped table-bordered">
                <thead>
                <tr>
    <th scope="col">User ID</th>
    <th scope="col">Laundry Type</th>
    <th scope="col">Item List</th>
    <th scope="col">Weight</th>
    <th scope="col">Quantity</th>
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
                        <td><?=$order['unit_list'] ?></td>
                        <td><?=$order['item_mass'] ?></td>
                        <td><?=$order['item_quantity'] ?></td>
                        <td><?=$order['price_total'] ?></td>
                        <td><?=$order['order_status'] ?></td>
                        <td>
                            <form action="admin_dash.php?view=<?php echo $order['id']; ?>#pesanan" method="post">
                                <input type="hidden" name="id" value="<?=$order['id']?>">
                                <input type="submit" value="View" name="view">
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
                    // Kosong
                }
                else{
            ?>
                    <h4 class="center">View Data</h4>
                    
                        <p>ID User : <?php echo $userId; ?><br>
                        laundry_type : <?php echo $laundry_type; ?><br>
                        <li>List Satuan : <?php echo $listSatuan; ?></li><br>
                        <li>item_mass : <?php echo $item_mass; ?></li><br>
                        <li>item_quantity : <?php echo $item_quantity; ?></li><br>
                        <li>Pickup Date : <?php echo $pickup_time; ?></li><br>
                        <li>Delivery Date : <?php echo $delivery_time; ?></li><br>
                        <li>Address : <?php echo $address; ?></li><br>
                        <li>Note : <?php echo $note; ?></li><br>
                        <li>price Total : <?php echo $priceTotal; ?></li><br>
                        <li>Lokasi : </li><br>
                        <div id="googleMaps" style="width:50%; height:440px; border:solid black 1px;"></div>
                        <br>
                        <form method="post">
                        <li>Order Status:</li><br>
<input type="radio" id="waiting_confirmation" name="status" value="Waiting for Confirmation" checked>
<label for="waiting_confirmation">Waiting for Confirmation</label><br>
<input type="radio" id="courier_pickup" name="status" value="Courier picks up laundry">
<label for="courier_pickup">Courier picks up laundry</label><br>
<input type="radio" id="being_washed" name="status" value="Currently being washed">
<label for="being_washed">Currently being washed</label><br>
<input type="radio" id="courier_delivery" name="status" value="Courier delivers laundry">
<label for="courier_delivery">Courier delivers laundry</label><br>

                        <input type="radio" id="selesai" name="status" value="Selesai">
                        <label for="selesai">Selesai</label>
                    
                    <?php
                }
                    ?>
                <?php 
                    if($view_order == false){
                        //Kosong
                    } 
                    else{ ?>
                        <p class="center">
                            <input type="submit" name="update_order" value="Update"/>
                            <input type="submit" name="cancel_update" value="Cancel"/>
                        </p>
                    </form>
                <?php
                    } 
                ?>
        </div>
    </div>
