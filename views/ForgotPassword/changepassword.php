
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email</title>
</head>
<body>
    <center><h2>Enter your email for send code for change password </h2>
    <input type= "email"name= "email" id= "email" placeholder= "Email" required></input>
    <div class="option">
                        <button class="btn-sign" name="login">SIGN IN</button>
                    </div></center>
    <script>
        setTimeout(function(){
            var errorAlert = document.getElementById("error-alert");
            if (errorAlert) {
                errorAlert.style.display = "none";
            }
        }, 3000);
    </script>
</body>
</html>