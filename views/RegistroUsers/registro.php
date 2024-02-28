<?php require_once "../controllUser/controllerUserData.php"; ?>
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
    <div class="fondo">
        <a class="back">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <div class="left2">
            <div class="slogan2">
                <h1>Welcome!</h1>
                <h2>Thank you for joining this community</h2>
            </div>
            <div class="principal2">
                <img src="./../../resources/img/prueba5.svg" class="present2">
            </div>
        </div>
        <div class="right2">
            <div class="principal5">
                <form action="registro.php" method="POST" autocomplete="">
                <div class="slogan3">
                    <h1>Register</h1>
                    <p>Start your account with us</p>
                    <!-- <p>Enter your information</p> -->
                </div>
                    <?php
                    if(count($errors) == 1){
                        ?>
                        <div class="alert">
                        <span class="icon-alert material-symbols-outlined">info</span>
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }elseif(count($errors) > 1){
                        ?>
                        <div class="alert">
                            <?php
                            foreach($errors as $showerror){
                                ?>
                                <li><?php echo $showerror; ?></li>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <label for="" class="label2">Username</label>
                    <div class="user-input">
                        <input id="user-input" class="input" type="text" name="name" placeholder="Username" required value="<?php echo $name ?>">    
                        <span class="icon material-symbols-outlined" id="user-input">person</span>
                    </div>
                    <label for="" class="label2">Email</label>
                    <div class="user-input">
                        <input id="user-input" class="input <?php echo (isset($errors['email'])) ? 'error' : ''; ?>" type="email" name="email" placeholder="Email" required value="<?php echo $email ?>">
                        <span class="icon material-symbols-outlined" id="user-input">mail</span>
                    </div>
                    <label for="" class="label2">Password</label>
                    <div class="user-input">
                        <input type="password" class="input <?php echo (isset($errors['password'])) ? 'error' : ''; ?>" name="password" placeholder="Password" id="user-input" required>
                        <span class="icon material-symbols-outlined" id="user-input">lock</span>
                    </div>
                    <label for="" class="label2">Confirm Password</label>
                    <div class="user-input">
                        <input type="password" class="input <?php echo (isset($errors['password'])) ? 'error' : ''; ?>" name="cpassword" placeholder="Confirm password" id="user-input" required>
                        <span class="icon material-symbols-outlined" id="user-input">private_connectivity</span>
                    </div>
                    <div class="option2">
                        <div class="button3">
                            <input class="signup" type="submit" name="signup" value="SIGN UP">
                        </div>
                    </div>
                    <div class="register">
                        <p>Already have an account?</p>
                        <a href="../login/login.php" class="new">Sign In</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>