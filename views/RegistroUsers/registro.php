<?php require_once "../controllUser/controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
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
        <div class="left">
            <div class="slogan2">
                <h2>¡Welcome!</h2>
                <h4>Thank you for joining this community</h4>
            </div>
            <div class="principal2">
                <img src="./../../resources/img/prueba5.svg" class="present2">
            </div>
        </div>
        <div class="right">
            <form action="registro.php" method="POST" autocomplete="">
                <div class="instruc">
                    <div>
                        <h2>REGISTER</h2>
                        <h5>Start your account with us</h5>
                    </div>
                </div>
                <?php
                if(count($errors) == 1){
                    ?>
                    <div class="alert alert-danger text-center">
                        <?php
                        foreach($errors as $showerror){
                            echo $showerror;
                        }
                        ?>
                    </div>
                    <?php
                }elseif(count($errors) > 1){
                    ?>
                    <div class="alert alert-danger">
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
                <label for="" class="label">Nombre completo</label>
                <div class="user-input">
                    <input id="user-input" type="text" name="name" placeholder="Nombre Completo" required value="<?php echo $name ?>">
                    <span class="icon material-symbols-outlined" id="user-input">person</span>
                </div>
                <label for="" class="label">Correo electronico</label>
                <div class="user-input">
                    <input id="user-input" type="email" name="email" placeholder="Correo Electronico" required value="<?php echo $email ?>">
                    <span class="icon material-symbols-outlined" id="user-input">mail</span>
                </div>
                <label for="" class="label">Contraseña</label>
                <div class="password">
                    <input type="password" name="password" placeholder="Contraseña" id="password" required>
                    <span class="icon material-symbols-outlined" id="password">lock</span>
                </div>
                <label for="" class="label">Confirmar contraseña</label>
                <div class="password">
                    <input type="password" name="cpassword" placeholder="Confirmar Contraseña" id="password" required>
                    <span class="icon material-symbols-outlined" id="user-input">private_connectivity</span>
                </div>
                <div class="option">
                    <div class="registrate">
                        <input class="sign in" type="submit" name="signup" value="Registrate">
                    </div>
                </div>
                <div class="register">
                    <p>Already have an account?</p>
                    <a href="../RegistroUsers/registro.php" class="new">Sign In</a>
                </div>
            </form>
        </div>
    </div>
    
</body>
</html>