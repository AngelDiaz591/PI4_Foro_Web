<?php require_once "../controllUser/controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>cambiar contraseña</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="_password.php" method="POST" autocomplete="">
                    <h2 class="text-center text-uppercase">Olvide mi contraseña</h2>
                    <p class="text-center text-uppercase">Ingresa tu correo electronico</p>
                    <?php
                        if(count($errors) > 0){
                            ?>
                            <div class="alert-error"><i class="bi bi-envelope-exclamation-fill"></i>
                                <?php 
                                    foreach($errors as $error){
                                        echo $error;
                                    }
                                ?>
                            </div>
                            <?php
                        }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Introduce tu correo electronico" required value="<?php echo $email ?>"/>
                    </div>
                    <div class="form-group" id="btn">
                    <button onclick="redirectToDefaultPage()" class="form-control button text-uppercase">Regresar</button>
                    <script>
                        function redirectToDefaultPage() {
                            window.location.href = "../view/login/login.php";                        }
                    </script>
                    </div>
                    <div class="form-group" id="btn">
                        <input class="form-control button text-uppercase" type="submit" name="check-email" value="Enviar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>