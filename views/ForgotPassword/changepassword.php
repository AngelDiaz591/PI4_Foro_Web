<?php
include './../../controllers/application_controller.php';
$action = isset($_GET['action']) ? $_GET['action'] : ''; 
$errors = isset($errors) ? $errors : array();
session_start(); 

// Verifica si NO existe la sesión 'forgot_password'
#if(!isset($_SESSION['forgot_password'])) {
    // Muestra un mensaje emergente en inglés
  #  echo '<script>alert("Password reset has expired. Please try again.");</script>';
    
    // Redirige al usuario a la página de inicio de sesión
    #echo '<script>window.location.href = "../login/login.php";</script>';
    #exit(); // Termina el script después de redirigir
#}

if (isset($_SESSION['error'])) {
    echo "<script>alert('" . $_SESSION['error'] . "');</script>";
    unset($_SESSION['error']);
}
$email = isset($_SESSION['forgot_password']['email']) ? $_SESSION['forgot_password']['email'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email</title>
</head>
<body>
    <center>
        <h2>Enter your new password and confirm password</h2>
        <?php
        if (isset($_SESSION['user_email'])) {
            $user_email = $_SESSION['user_email'];
            echo "<h2>Welcome back, $user_email!</h2>";
        }
        ?>
        <form action="<?= redirect_to('passwords', 'create'); ?>" method="POST" autocomplete="">
        <div class="user-input">
            <input type="password" class="input" name="newpassword" placeholder="newPassword" id="newpassword" required>
        </div>
        <div class="user-input">
            <input type="password" class="input" name="cpassword" placeholder="Confirm password" id="cpassword" required>
        </div>
        <div class="confirm">
            <input type="submit" class="change" name="check" value="Confirm">
        </div>
        </form>
    </center>
    <script>
        setTimeout(function(){
            var errorAlert = document.getElementById("error-alert");
            if (errorAlert) {
                errorAlert.style.display = "none";
            }
        }, 3000);
    </script>
</body>
</html>
