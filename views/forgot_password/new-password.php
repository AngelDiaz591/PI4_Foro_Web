<?php require_once "../controllUser/controllerUserData.php"; ?>
<?php 
$email = $_SESSION['email'];
if($email == false){
  header('Location: ..view/login/login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crear Nueva contraseña</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="new-password.php" method="POST" autocomplete="off">
                    <h3 class="text-center text-uppercase">Nueva Contraseña</h3>
                    <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="alert-error"><i class="bi bi-exclamation-circle-fill"></i>
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }else{
                    ?>
                    <?php 
                    if(isset($_SESSION['info'])){
                        ?>
                        <div class="alert-success"><i class="bi bi-check-circle-fill"></i>
                            <?php echo $_SESSION['info']; ?>
                        </div>
                        <?php
                    }
                }
                    ?>
                    
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Crea Nueva contraseña" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="cpassword" placeholder="Confirma tu contraseña" required>
                    </div>
                    <div class="form-group" id="btn">
                        <input class="form-control button text-uppercase" type="submit" name="change-password" value="Cambiar">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>