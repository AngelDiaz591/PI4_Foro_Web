<?php
include './../../controllers/application_controller.php';
$errors = isset($errors) ? $errors : array();
session_start();
$errors = isset($_SESSION['code_verification_errors']) ? $_SESSION['code_verification_errors'] : array();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Verification</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Almarai:wght@700&display=swap">
    <link rel="stylesheet" href="./../../resources/stylesheets/main.css">
    <link rel="icon" href="./../../resources/img/fav.png" type="image/x-icon">
</head>
<body>
    <section class="code_verify">
        <img src="./../../resources/img/confirm.svg" class="codever">
        <div class="title">Email Verification</div>
        <p>We have sent code to your email </p>
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
        <form action="<?= redirect_to('codes', 'update'); ?>" method="POST" autocomplete="off">
            <div>
                <input type="hidden" id="code" name="code">
                <div id="inputs">
                    <input class="inputs" id="input1" type="text" placeholder="0" maxLength="1" required>
                    <input class="inputs" id="input2" type="text" placeholder="0" maxLength="1" required>
                    <input class="inputs" id="input3" type="text" placeholder="0" maxLength="1" required>
                    <input class="inputs" id="input4" type="text" placeholder="0" maxLength="1" required>
                    <input class="inputs" id="input5" type="text" placeholder="0" maxLength="1" required>
                    <input class="inputs" id="input6" type="text" placeholder="0" maxLength="1" required>
                </div>
                <div class="resend_code">
                    <p>Didn't receive code?</p>
                    <a href="#" class="resend">Resend Code</a>
                </div>
                <div class="confirm">
                    <input type="submit" class="verify" name="check" value="Confirm">
                </div>
            </div>
        </form>
        <p class="warning">Verification Code is valid only for 5 minutes</p>
    </section>
    <script src="../../resources/js/veri_code.js"></script>
    <script>
        setTimeout(function(){
            var errorAlert = document.getElementById("error-alert");
            if (errorAlert) {
                errorAlert.style.display = "none";
            }
        }, 3000);
    </script>
    <?php if (isset($_SESSION['error_message'])): ?>
        <script>
            var errorMessage = "<?php echo $_SESSION['error_message']; ?>";
            if (errorMessage) {
                var confirmed = confirm(errorMessage);
                if (confirmed) {
                    // Borrar las sesiones relevantes
                    <?php
                    unset($_SESSION['error_message']);
                    unset($_SESSION['email']);
                    // Aquí puedes agregar más sesiones que necesites eliminar
                    ?>
                    // Redirigir al inicio de sesión
                    window.location.href = '../login/login.php';
                }
            }
        </script>
    <?php endif; ?>
</body>
</html>