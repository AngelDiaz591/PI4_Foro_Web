<?php 
include './../../controllers/application_controller.php';
session_start(); 
unset($_SESSION['email']);
unset($_SESSION['error']);
$action = isset($_GET['action']) ? $_GET['action'] : ''; 
$errors = isset($errors) ? $errors : array();
session_start();
?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign up: Register New User</title>
    <link rel="stylesheet" href="./../../resources/stylesheets/main.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="icon" href="./../../resources/img/fav.png" type="image/x-icon">
    <script>
        function showWarningMessage() {
            alert("Your account will be deleted if not verified within 5 minutes. Proceed with caution.");
        }
    </script>
</head>
<body>
    <a class="back">
        <span class="material-symbols-outlined">arrow_back</span>
    </a>
    <div class="container">
        <div class="left">
            <div class="principal2">
                <img src="./../../resources/img/login.jpg" class="img">
            </div>
        </div>
        <div class="right">
            <div class="principal">
                <form action="<?= redirect_to('users', 'create'); ?>" method="POST" autocomplete="">
                    <div class="slogan">
                        <h1>Create an account</h1>
                        <p>Start your account with us</p>
                    </div>
                    <?php
                    if (isset($_SESSION['error'])) {
                        $error_message = $_SESSION['error'];
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
                        <input class="input" type="text" name="name" placeholder="Username" required>
                        <span class="icon material-symbols-outlined">person</span>
                    </div>
                    <div class="user-input">
                        <input class="input" type="email" name="email" placeholder="Email" id="email" required>
                        <span class="icon material-symbols-outlined">mail</span>
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
                        <div class="btn-create">
                            <input class="signup" type="submit" name="signup" value="Create an account" onclick="showWarningMessage()">
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
            var errorAlert = document.getElementById("error-alert");
            if (errorAlert) {
                errorAlert.style.display = "none";
            }
        }, 3000);
    </script>
</body>
</html>
