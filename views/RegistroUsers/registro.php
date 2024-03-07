<?php 
include './../../controllers/application_controller.php';
$action = isset($_GET['action']) ? $_GET['action'] : ''; // Verificar si la clave 'action' está definida antes de acceder a ella


$data = array(
  "method" => $_POST ? $_POST : $_GET,
  "files" => $_FILES,
);
$email = "";
$name = "";
$errors = array();
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
    <div class="content2">
        <!-- <a class="back">
            <span class="material-symbols-outlined">arrow_back</span>
        </a> -->
        
        <div class="right">
            <div class="principal">
                <form action="<?= redirect_a('users', 'createUsers'); ?>" method="post" enctype="multipart/form-data">
                <div class="slogan3">
                    <h1>Register</h1>
                    <p>Start your account with us</p>
                    <!-- <p>Enter your information</p> -->
                </div>
                <?php
                    # Show the errors, save the error in array the error in archive controlluserdata.php
                    if(count($errors) > 0 && isset($errors)){
                        ?>
                        <div id="error-alert" class="alert2">
                        <span class="icon-alert material-symbols-outlined">info</span>
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <label for="" class="label2">Username</label>
                    <div class="user-input">
                        <input id="user-input" class="input" type="text" name="name" placeholder="Username" required>    
                        <span class="icon material-symbols-outlined" id="user-input">person</span>
                    </div>
                    <label for="" class="label2">Email</label>
                    <div class="user-input">
                        <input id="user-input" class="input" type="email" name="email" placeholder="Email" required>
                        <span class="icon material-symbols-outlined" id="user-input">mail</span>
                    </div>
                    <label for="" class="label2">Password</label>
                    <div class="user-input">
                        <input type="password" class="input" name="password" placeholder="Password" id="user-input" required>
                        <span class="icon material-symbols-outlined" id="user-input">lock</span>
                    </div>
                    <div class="option2">
                        <div class="button3">
                            <input class="signup" type="submit">
                        </div>
                    </div>
                    <div class="register">
                        <p>Already have an account?</p>
                        <a href="../login/login.php" class="new">Sign In</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="left">
            <div class="slogan2">
                <h1>Welcome!</h1>
                <h2>Thank you for joining this community</h2>
            </div>
            <div class="principal2">
                <img src="./../../resources/img/prueba5.svg" class="present2">
            </div>
        </div>
    </div>
  
</body>
</html>