<?php
include './../../controllers/application_controller.php';
$action = isset($_GET['action']) ? $_GET['action'] : ''; 
$errors = isset($errors) ? $errors : array();
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email</title>
</head>
<body>
    <center><h2>Enter your email for send code for change password </h2>
    <?php
                    if (isset($_SESSION['error'])) {
                        $error_message = $_SESSION['error'];
                        
                    ?>
                    <div id="error-alert" class="alert2">
                        <span class="icon-alert material-symbols-outlined">info</span>
                        <p>Error: <?php echo $error_message; ?></p>
                    </div>
                    <?php
                    }
                    ?>
    <form action="<?= redirect_to('passwords', 'update'); ?>" method="POST" autocomplete="">
    <input type= "email"name= "email" id= "email" placeholder= "Email" required></input>
    <div class="option">
                        <button class="btn-sign" name="login">SIGN IN</button>
                    </div></center>
    </form>
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