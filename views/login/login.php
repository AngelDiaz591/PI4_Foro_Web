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
    <title>Sign In: Access the account</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="./../../resources/stylesheets/main.css" />
    <script src="./../../resources/js/main.js"></script>
    <link rel="icon" href="./../../resources/img/logo.png" type="image/x-icon">
</head>
<body>
    <a class="back2">
        <span class="material-symbols-outlined">arrow_back</span>
    </a>
    <div class="content2">
        <div class="left">
            <div class="principal2">
                <img src="./../../resources/img/fondo25.jpg" class="img">
            </div>
        </div>
        <div class="right">
            <div class="principal">
                <form action="<?= redirect_to('sessions', 'create'); ?>"method="POST" autocomplete="">
                    <div class="slogan3">
                        <h2>WELCOME BACK!</h2>
                    </div>
                    <?php
                    if (isset($_SESSION['error'])) {
                        $error_message = $_SESSION['error'];
                    // Una vez que has recuperado el mensaje de error, puedes eliminarlo de la sesión
                    unset($_SESSION['error']);
                    ?>
                        <div id="error-alert" class="alert2">
                        <span class="icon-alert material-symbols-outlined">info</span>
                        <p>Error: <?php echo $error_message; ?></p>
                        </div>
                    <?php   
                    }
                    ?>
                    <div class="user-input">
                        <input class="input" type="email" name="email" id="user-input" placeholder="Email or username">
                        <span class="icon material-symbols-outlined" id="user-input">person</span>
                    </div>
                    
                    <div class="user-input">
                        <input class="input" type="password" name="password" id="user-input" placeholder="Password">
                        <span class="icon material-symbols-outlined" id="user-input">lock</span>
                    </div>
                    <div class="box-small">
                        <a href="../forgot_password/_password.php" class="forgot">Forgot my password?</a>
                    </div>
                    <div class="option">
                        <button class="btn-sign" name= "login">SIGN IN</button>
                    </div>
                </form>
                    <div class="register">
                        <p>Do not you have an account yet?</p>
                        <a href="../RegistroUsers/registro.php" class="new">Sign up</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="errorMessages"></div>
    <script src="validacion.js"></script>
</body>
</html>