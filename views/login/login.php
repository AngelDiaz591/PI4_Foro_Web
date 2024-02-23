<?php require_once "../controllUser/controllerUserData.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitante</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="./../../resources/stylesheets/main.css" />
    <script src="./../../resources/js/main.js"></script>
    <link rel="icon" href="./../../resources/img/logo.png" type="image/x-icon">
</head>
<body>
    <div class="content2">
        <div class="left">
            <div class="slogan">
                <h2>"Let's Chat Sustainability and Spark Action!"</h2>
            </div>
            <div class="principal">
                <img src="./../../resources/img/login.svg" class="present">
            </div>
        </div>
        <div class="right">
            <div class="box2">
                <div class="logo">
                    <img src="./../../resources/img/logo.png">
                    <p>CulturEdge</p>
                </div>
                <div class="login_sp">
                    <div class="greeting">
                        <h2>Welcome back!</h2>
                    </div>
                    <?php
                    # Show the errors, save the error in array the error in archive controlluserdata.php
                    if(count($errors) > 0){
                        ?>
                        <div id="error-alert" class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                <form action="login.php" method="post"> 
                    <label for="" class="label">Email</label>
                    <div class="user-input">
                        <input  type="email" name="email" id="user-input" placeholder="j4m0ncito@example.com">
                        <span class="icon material-symbols-outlined" id="user-input">person</span>
                    </div>
                    <label for="" class="label">Password</label>
                    <div class="password">
                        <input type="password" name="password" id="password" placeholder="*  *  *  *  *  *  *  *  *  *">
                        <span class="icon material-symbols-outlined" id="password">lock</span>
                    </div>
                    <div class="box-small">
                        <a href="#" class="forgot">Forgot my password?</a>
                    </div>
                    <div class="option">
                        <button class="btn-sign" name= "login">Login</button>
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
</body>
</html>