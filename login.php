<?php
session_start();
require_once "database.php";
// Calling the database class
$pdo = new database();

// If the user has already logged in, redirect to the profile page
if(!isset($_SESSION['email']) == 0 ){
    header('Location: dashboard.php');
}

if(isset($_POST['submit'])){
    // Initialization
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Checking if the login matches the database
    $login = $pdo -> login($email);

    // Checking if the password matches
    if (password_verify($password, $login['password'])){
       // Storing data in the session
        $id = $login['id'];
        $_SESSION['id'] = $login['id'];
        $_SESSION['name'] = $login['name'];
        $_SESSION['email'] = $email;
        $_SESSION['phone_number'] = $login['phone_no'];
        setcookie('user_id', $id, time()+(7 * 24 * 60 * 60), '/');
        header("Location: dashboard.php");
    }
    // Displaying an error message if the email or password is incorrect
    else{
        echo '<div class="box"><div class="square">';
        echo("Incorrect email or password, please try again");
        echo '</div></div>';
    }
}
?>

<!DOCTYPE HTML>
<head>
    <title>Login - Spin Solutions</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="stylesheet" type="text/css" href="css/login_2.css">
</head>

<body style="background-image: url('images/bg-01.jpg'); background-size: cover;">

    <div class="login-page">
        <div class="form">
        <b><u><span class="login100-form-title p-b-43">
						Login to continue
					</span> </u></b>
            <br>     
            <form method="POST">
                <p>Email</p>
                <input type="email" name="email" required placeholder="Enter Your e-mail id">
                <p>Password</p>
                <input type="password" id="password" name="password" required placeholder="Enter password">
                <input type="checkbox" onclick="myFunction()"> Show Password
                <br><br>
                <p>
                    <button name="submit">Login</button>
                </p>
                <br>
                <p>
                    <a href="signup.php">
                    Not registered yet? Sign up now!!</a>
                </p>
                <p>
                    <a href="index.php">
                        <-- Back to Home</a>
                </p>
            </form>
        </div>
    </div>
    
				</div>
</body>
<script type="application/javascript">
    // To show the password in the form
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