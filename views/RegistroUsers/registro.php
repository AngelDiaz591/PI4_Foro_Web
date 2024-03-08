<?php 
include './../../controllers/application_controller.php';
$action = isset($_GET['action']) ? $_GET['action'] : ''; 
$errors = isset($errors) ? $errors : array();
session_start(); // Inicia la sesión para poder acceder a las variables de sesión
?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign up: Register New User</title>
    <!--     <link rel="stylesheet" href="style.css"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="./../../resources/stylesheets/main.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
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
                <form action="<?= redirect_to('users', 'create'); ?>"method="POST" autocomplete="">
                <div class="slogan3">
                    <h1>Create an account</h1>
                    <p>Start your account with us</p>
                
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
                        <input  class="input" type="text" name="name" placeholder="Username" required >    
                        <span class="icon material-symbols-outlined" >person</span>
                    </div>
                    <div class="user-input">
                        
                        <input class="input" type="email" name="email" placeholder="Email" id="email" required>
                        <span class="icon material-symbols-outlined" >mail</span>
                        <p id="emailmsg"><span id="emailstrenght"></span></p>
                    </div>
                    <div class="user-input">
                        <input type="password" class="input" name="password" placeholder="Password" id="password" required>
                        <span class="icon material-symbols-outlined">lock</span>
                        <p id="message">Password is <span id="strenght"></span></p>
                    </div>
                    <div class="user-input">
                        
                        <input type="password" class="input" name="cpassword" placeholder="Confirm password" id="cpassword" required>
                        <span class="icon material-symbols-outlined">lock</span>
                        <p id="nomessage">Password <span id="constrength"></span></p>
                    </div>
                    <div class="option2">
                        <div class="button3">
                            <input class="signup" type="submit" name="signup" value="Create an account">
                        </div>
                    </div>
                </form>
                <div class="register">
                        <p>Already have an account?</p>
                        <a href="../login/login.php" class="new">Sign In</a>
                    </div>
            </div>
        </div>
    </div>
    <script src="../../resources/js/form.js"></script>
   <script>
        setTimeout(function(){
            document.getElementById("error-alert").style.display = "none";
        }, 3000); // 3000 milisegundos = 3 segundos
    </script>
</body>
</html>