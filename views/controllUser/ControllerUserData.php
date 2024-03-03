
<?php
session_start();

// Establecer conexión a la base de datos
$con = mysqli_connect('localhost', 'root', '', 'foroweb');

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


#ESTE ES UN ARCHIVO DE PROTOTIPO EN LO QUE ME PUEDO HAYAR MAS EN EL PROCEDURE
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

// Si el usuario hace clic en el botón de verificación del código OTP
if(isset($_POST['check'])){
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($con, $_POST['otp']);

    // Consulta preparada para evitar inyección SQL
    $check_code = "SELECT * FROM usertable WHERE code = ?";
    $stmt = $con->prepare($check_code);
    $stmt->bind_param("s", $otp_code);
    $stmt->execute();
    $code_res = $stmt->get_result();

    if($code_res->num_rows > 0){
        $fetch_data = $code_res->fetch_assoc();
        $email = $fetch_data['email'];
        $code = 0;
        $status = 'verified';
        $user_type = $fetch_data['user_type'];

        // Actualizar el código y el estado en la tabla de usuarios
        $update_otp = "UPDATE usertable SET code = ?, status = ? WHERE code = ?";
        $stmt = $con->prepare($update_otp);
        $stmt->bind_param("iss", $code, $status, $otp_code);
        $update_res = $stmt->execute();

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


if(isset($_POST['signup'])){
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    
    // Verificar si las contraseñas coinciden
    if($password !== $cpassword) {
        $errors['password'] = "Passwords do not match";
    } else {
        // Generar código aleatorio
        $code = generateRandomCode(6); // Generar un código alfanumérico de longitud 6
        
        // Enviar correo electrónico de verificación
      
        $subject = "Email Verification Code";
        $message = "Your verification code is: $code";
        $sender = "From: culturedge69@gmail.com";
        if(mail($email, $subject, $message, $sender)){
            // Guardar datos del usuario en variables de sesión
           
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            $_SESSION['code'] = $code;
            
            // Llamar al procedimiento almacenado _SaveUser
            try {
                // Llamada al procedimiento almacenado
                $encpass = password_hash($password, PASSWORD_BCRYPT);
                $status = "notverified";
                $user_type = 1;
                $error_message = ""; // Variable para almacenar el mensaje de error del procedimiento almacenado

                // Llamada al procedimiento almacenado
                $query = "CALL _SaveUser('$name', '$email', '$encpass', @p_error_message, '$code')";
                mysqli_query($con, $query);

                // Capturar el mensaje de error del procedimiento almacenado
                $result = mysqli_query($con, "SELECT @p_error_message AS p_error_message");
                $row = mysqli_fetch_assoc($result);
                $p_error_message = $row['p_error_message'];

                if($p_error_message !== null){
                    // Hubo un error en el procedimiento almacenado
                    $errors['db-error'] = $p_error_message;
                } else {
                    $info = "We have sent a verification code to your email - $email";
                    // Redirigir a la página de verificación del código
                    header('location: ../RegistroUsers/user-otp.php');
                    exit();
                }
            } catch (mysqli_sql_exception $e) {
                // Manejar la excepción de duplicación de correo electrónico
                $errors['email'] = "The email you have entered already exists!";
            }
        } else {
            $errors['otp-error'] = "Error sending code!";
        }
    }
}



// Función para generar un código alfanumérico aleatorio
function generateRandomCode($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $code = '';
    for ($i = 0; $i < $length; $i++) {
        $code .= $characters[rand(0, $charactersLength - 1)];
    }
    return $code;
    echo $code;
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
