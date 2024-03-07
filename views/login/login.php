<!-- <?php require_once "../controllUser/ControllerUserData.php"; ?> -->

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
    <div class="content2">
        <!-- <a class="back">
            <span class="material-symbols-outlined">arrow_back</span>
        </a> -->
        <div class="left">
            <!-- <div class="logo">
                <img src="./../../resources/img/logo.png">
                <h1>CulturEdge</h1>
            </div> -->
            <div class="slogan2">
                <h2>"Let's Chat Sustainability and Spark Action!"</h2>
            </div>
            <div class="principal2">
                <img src="./../../resources/img/login.svg" class="present">
            </div>
        </div>
        <div class="right">
            <div class="principal">
                <form action="login.php" method="post">
                    <div class="slogan3">
                        <h2>WELCOME BACK!</h2>
                    </div>
                    <?php
                    # Show the errors, save the error in array the error in archive controlluserdata.php
                    if(count($errors) > 0){
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
                    <label for="" class="label2">Email or username</label>
                    <div class="user-input">
                        <input class="input <?php echo (isset($errors['email'])) ? 'error' : ''; ?>" type="email" name="email" id="user-input" placeholder="Email or username">
                        <span class="icon material-symbols-outlined" id="user-input">person</span>
                    </div>
                    <label for="" class="label2">Password</label>
                    <div class="user-input">
                        <input class="input <?php echo (isset($errors['password'])) ? 'error' : ''; ?>" type="password" name="password" id="user-input" placeholder="Password">
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
    <script>
        setTimeout(function(){
            document.getElementById("error-alert").style.display = "none";
        }, 3000); // 3000 milisegundos = 3 segundos
    </script>
    <div id="errorMessages"></div>
    <script src="validacion.js"></script>
</body>
</html>