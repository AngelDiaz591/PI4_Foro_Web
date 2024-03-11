<?php 
include './../../controllers/application_controller.php';
$action = isset($_GET['action']) ? $_GET['action'] : ''; 
$errors = isset($errors) ? $errors : array();
session_start(); 
?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Verification</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="./../../resources/stylesheets/main.css" />
    <script src="./../../resources/js/main.js"></script>
    <link rel="icon" href="./../../resources/img/fav.png" type="image/x-icon">
</head>
<body>
    <section class="code_verify">
        <img src="./../../resources/img/confirm.svg" class="codever">
        <div class="title">Email Verification</div>
        <p>We have sent code to you email</p>
        <form action="user-otp.php" method="POST" autocomplete="off">
            <div>
                <input type="hidden" id="otp" name="otp">
                <div id="inputs">
                    <input class="inputs" id="input1" type="text" placeholder="0" maxLength="1" requiered/>
                    <input class="inputs" id="input2" type="text" placeholder="0" maxLength="1" requiered/>
                    <input class="inputs" id="input3" type="text" placeholder="0" maxLength="1" requiered/>
                    <input class="inputs" id="input4" type="text" placeholder="0" maxLength="1" requiered/>
                    <input class="inputs" id="input5" type="text" placeholder="0" maxLength="1" requiered/>
                    <input class="inputs" id="input6" type="text" placeholder="0" maxLength="1" requiered/>
                </div>
                <div class="resend_code">
                    <p>Didn't receive code?</p>
                    <a href="#" class="resend">Resend Code</a>
                </div>
                <div class="confirm">
                    <input type="submit" class="verify" name="check" value="Confirm">
                </div>
                <!-- <button type="submit" name="check" class="verify">Confirm</button> -->
            </div>
        </form> 
            <p class="warning">Verification Code is valid only for 5 min</p>
    </section>
    <script src="../../resources/js/veri_code.js"></script>
</body>
</html>
