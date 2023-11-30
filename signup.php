<?php
session_start();
require_once "database.php";
// Calling the database class
$pdo = new database();

// If already logged in, redirect to the profile
if(!isset($_SESSION['email']) == 0 ){
    header('Location: dashboard.php');
}

if (isset($_POST['submit'])){

    // Preventing duplicate email in the database
    $email = $_POST['email'];
    $check_data = $pdo->check_data($email);

     // Preventing empty data from entering the database
    if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['phone_number'])) {
        echo '<div class="box"><div class="square">';
        echo("Fields cannot be empty!!");
        echo '</div></div>';
    }

    // Message that appears if the email already exists in the database
    else if($check_data > 0){
        echo '<div class="box"><div class="square">';
        echo("Email already exists, please use a different email!");
        echo '</div></div>';
    }

    //Input Data
    else{
        $_SESSION['message'] = 'Signup successful! Thank you for joining with us! <a href="login.php">Login to continue</a> ';
        echo '<div class="box"><div class="square">';
        echo $_SESSION['message'];
        echo '</div></div>';
        unset($_SESSION['message']);
        
        // Insert data into the database
        $pdo->tambah_data($_POST['name'], $_POST['email'], $_POST['password'], $_POST['phone_number']);
    }
} 
?>

<!DOCTYPE html>
<head>
    <title>Signup - Spin Solutions</title>
    <link rel="stylesheet" type="text/css" href="css/signup.css">
    <link rel="stylesheet" type="text/css" href="css/signup_2.css">
</head>

<body style="background-image: url('images/bg-01.jpg'); background-size: cover;">>
    <div class="login-page">
        <div class="form">
            <h1>Signup</h1>   
            <br>     
            <form method="POST">
                <p>Name</p>
                <input type="text" name="name" placeholder="Enter your name">
                <p>E-Mail</p>
                <input type="email" name="email" placeholder="Enter your e-mail">
                <p>Phone Number</p>
                <input type="tel" name="phone_number" placeholder="0123456789" pattern=".{10,14}" required>
                <p>Password</p>
                <input type="password" name="password" id="password" pattern=".{8,}" required title="Minimum 8 characters" placeholder="Enter your password">
                <input type="checkbox" onclick="myFunction()"> Show Password
                <br><br>
                <p>
                    <button name="submit">Signup</button>
                </p>
                <br>
                <p>
                    <a href="login.php">
                    Already registered? Please login</a>
                </p>
                <p>
                    <a href="index.php">
                        <-- Back to Home</a>
                </p>
            </form>
        </div>
    </div>
</body>
<script type="application/javascript">
    // To show password in the form
    function myFunction(){
        var x = document.getElementById("password");
        if (x.type === "password"){
            x.type = "text";
        } 
        else{
            x.type = "password";
        }
    }
</script>