<?php
include './../../controllers/application_controller.php';
session_start();
$errors = isset($_SESSION['code_verification_errors']) ? $_SESSION['code_verification_errors'] : array();
?>
<script>
// Function to redirect to login page and close sessions
function redirectToLoginAndCloseSessions() {
    // Redirect to the login page
    window.location.href = "../login/login.php";
    
    // Destroy all sessions
    <?php session_start(); session_destroy(); ?>
}
// Check if there is an email in the session parameter
window.addEventListener('DOMContentLoaded', function() {
    var email = "<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>";
    if (email === '') {
        // Show the warning message and redirect after a few seconds
        alert("Your verification has expired. Please log in to try again.\nYou will be redirected to login.");
        setTimeout(redirectToLoginAndCloseSessions, 2000); // Redirect after 2 seconds
    }
});
</script>
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
        <p>We have sent code to your email <?php echo $_SESSION['email'];?></p>
        <?php if (!empty($errors)): ?>
            <div class="error"><?php echo end($errors); ?></div>
        <?php endif; ?>
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
        window.addEventListener('beforeunload', function(event) {
            // Check if the user is leaving the page and there are no errors
            if (sessionStorage.getItem('page_status') !== 'error') {
                // Send a request to the server to delete the email
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'borrar_email.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.send('action=borrar_email_on_exit');
            }
        });
    </script>
</body>
</html>
