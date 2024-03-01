<?php require_once "../controllUser/controllerUserData.php"; ?>
<?php 
$email = $_SESSION['email'];
if($email == false){
  header('Location: login-user.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Codigo de Verification</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="reset-code.php" method="POST" autocomplete="off">
                    <h2 class="text-center text-uppercase">Código de Verificación</h2>
                    <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="alert-error">
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
                        <div class="alert-success" style="padding: 0.4rem 0.4rem"><i class="bi bi-envelope-check"></i>
                            <?php echo $_SESSION['info']; ?>
                        </div>
                        <?php
                    } 
                }
                ?>
                    <div class="form-group">
                        <input class="form-control" type="number" name="otp" placeholder="Ingresa Codigo" required>
                    </div>
                    <div class="form-group" id="btn">
                        <input class="form-control button text-uppercase" type="submit" name="check-reset-otp" value="Verificar">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>