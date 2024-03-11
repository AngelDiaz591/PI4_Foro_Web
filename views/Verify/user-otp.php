<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Code verification</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="./../../resources/stylesheets/main.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<link rel="icon" href="./../../resources/img/fav.png" type="image/x-icon">
</head>
<body>
    <div class="container">
        <div class="abarcar">
            <img src="./../../resources/img/verification3.svg" class="codever">
            <h1 class="text">Verification Code</h1>   
            <div class="row">
                <div class="col">
                    <form action="user-otp.php" method="POST" autocomplete="off">
                        <p class="instruction">Enter verification code</p>
                        <div class="user-input2">
                            <input id="user-input2" class="input2" type="text" name="otp" placeholder="" maxlength="6" required>
                        </div>
                        <div class="option2">
                            <div class="button3">
                                <input class="verifity" type="submit" name="check" value="VERIFITY">
                            </div>
                    </form>
                </div>
            </div>
            <p class="text2">Verification Code is valid only for 5 min</p> 
        </div>
    </div>
</body>
</html>