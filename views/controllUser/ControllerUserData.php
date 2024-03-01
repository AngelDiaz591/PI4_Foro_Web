
<?php
session_start();

// Establecer conexión a la base de datos
$con = mysqli_connect('localhost', 'root', '', 'foroUnesco');

// Verificar la conexión
/* if (!$con) {
    die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
} else {
    echo "La conexión a la base de datos fue exitosa!";
}
 */

$email = "";
$name = "";
$errors = array();



// If the user clicks on the Login button
if(isset($_POST['login'])){
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $check_email = "SELECT * FROM usertable WHERE email = '$email'";
    $res = mysqli_query($con, $check_email);
    if(mysqli_num_rows($res) > 0){
        $fetch = mysqli_fetch_assoc($res);
        $fetch_pass = $fetch['password'];
        if(password_verify($password, $fetch_pass)){
            $user_type = $fetch['user_type'];
            $_SESSION['email'] = $email;
            $status = $fetch['status'];
            if($status == 'verified'){
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                if($user_type == 0){
                    header('location:../index.html'); // 
                } 
                if($user_type ==1){
                    header('location:../index.html'); // 
                }
            }else{
                $info = "It seems you haven't verified your email yet - $email";
                $_SESSION['info'] = $info;
                header('location: ../RegistroUsers/user-otp.php');
            }
        }else{
            $errors['email'] = "Incorrect email or password";
        }
    }else{
        $errors['email'] = "It seems you are not a member yet, sign up now!";
    }
}

// If the user clicks on the Check button in code OTP
if(isset($_POST['check'])){
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
    $check_code = "SELECT * FROM usertable WHERE code = $otp_code";
    $code_res = mysqli_query($con, $check_code);
    $check_email = "SELECT * FROM usertable WHERE email = '$email'";
    $res = mysqli_query($con, $check_email);
    if(mysqli_num_rows($code_res) > 0){
        $fetch = mysqli_fetch_assoc($res);
        $fetch_data = mysqli_fetch_assoc($code_res);
        $fetch_code = $fetch_data['code'];
        $email = $fetch_data['email'];
        $code = 0;
        $status = 'verified';
        $user_type = $fetch['user_type'];
        $update_otp = "UPDATE usertable SET code = $code, status = '$status' WHERE code = $fetch_code";
        $update_res = mysqli_query($con, $update_otp);
        if($update_res){
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            if($user_type == 0){
                header('location: ../index.html');//Dashboard Admin 
            } 
            if($user_type == 1){
                header('location: ../index.html');//Dashboard UserVisit
            }
            exit();
        }else{
            $errors['otp-error'] = "Error updating code!";
        }
    }else{
        $errors['otp-error'] = "You have entered an incorrect code!";
    }
}

//If the user clicks on signup
if(isset($_POST['signup'])){
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    $check_email = "SELECT * FROM usertable WHERE email = '$email'";
    $res = mysqli_query($con, $check_email);
    if ($password != $cpassword && mysqli_num_rows($res) > 0) {
        $errors['DatesIncorrect'] = "The dates are incorrects";
    } elseif ($password !== $cpassword) {
        $errors['password'] = "Passwords do not match!";
    } elseif (mysqli_num_rows($res) > 0) {
        $errors['email'] = "The email you have entered already exists!";
    }
    if(count($errors) === 0){
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $code = rand(999999, 111111);
        $status = "notverified";
        $user_type = 1;
        $insert_data = "INSERT INTO usertable (name, email, password, code, status, user_type)
                        values('$name', '$email', '$encpass', '$code', '$status', '$user_type')";
        $data_check = mysqli_query($con, $insert_data);
        if($data_check){
            $subject = "Email Verification Code";
            $message = "Your verification code is: $code";
            $sender = "From: proyectos0903@gmail.com";
            if(mail($email, $subject, $message, $sender)){
                $info = "We've sent a verification code to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                header('location: ../RegistroUsers/user-otp.php');
                exit();
            }else{
                $errors['otp-error'] = "Error sending code!";
            }
        }else{
            $errors['db-error'] = "Error inserting data into database!";
        }
    }
}

//Si el usuario hace clic en el botón Continuar en el formulario Olvidé mi contraseña
if(isset($_POST['check-email'])){
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $check_email = "SELECT * FROM usertable WHERE email='$email'";
    $run_sql = mysqli_query($con, $check_email);
    if(mysqli_num_rows($run_sql) > 0){
        $code = rand(999999, 111111); 
        $insert_code = "UPDATE usertable SET code = $code WHERE email = '$email'";
        $run_query =  mysqli_query($con, $insert_code);
        if($run_query){
            $subject = "Codigo para cambiar contraseña";
            $message = "Tu codigo para cambiar tu contraseña es este: $code";
            $sender = "From: proyectos0903@gmail.com";
            if(mail($email, $subject, $message, $sender)){
                $info = "Hemos enviado un codigo a tu correo electronico para el cambio de contraseña - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                header('location: ../forgot_password/reset-code.php');
                exit();
            }else{
                $errors['otp-error'] = "¡Error al enviar el codigo!";
            }
        }else{
            $errors['db-error'] = "¡Algo salio mal!";
        }
    }else{
        $errors['email'] = "¡Esta dirección de correo electrónico no existe!";
    }
}

//Si el usuario, hace clic en el botón Restablecer OTP
if(isset($_POST['check-reset-otp'])){
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
    $check_code = "SELECT * FROM usertable WHERE code = $otp_code";
    $code_res = mysqli_query($con, $check_code);
    if(mysqli_num_rows($code_res) > 0){
        $fetch_data = mysqli_fetch_assoc($code_res);
        $email = $fetch_data['email'];
        $_SESSION['email'] = $email;
        $info = "Crea una nueva contraseña que no utilice en ningún otro sitio.";
        $_SESSION['info'] = $info;
        header('location: ../forgot_password/new-password.php');
        exit();
    }else{
        $errors['otp-error'] = "¡Has introducido un codigo incorrecto!";
    }
}

//Si clic en el boton de cmabio de contraseña
if(isset($_POST['change-password'])){
    $_SESSION['info'] = "";
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    if($password !== $cpassword){
        $errors['password'] = "¡La contraseña no coincide, vuelve a verificarlo!";
    }else{
        $code = 0;
        $email = $_SESSION['email']; 
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $update_pass = "UPDATE usertable SET code = $code, password = '$encpass' WHERE email = '$email'";
        $run_query = mysqli_query($con, $update_pass);
        if($run_query){
            $info = " Tu contraseña a cambiado. Ingresa ahora con tu nueva contraseña.";
            $_SESSION['info'] = $info;
            header('Location: ../login/login.php');
        }else{
            $errors['db-error'] = "No se pudo cambiar tu contraseña";
        }
    }
}
?>
