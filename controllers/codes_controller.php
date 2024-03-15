<?php
ob_start();
get_model('code');
/*
 * This class inherits from the base class and contains the calls to the posts procedures
 */
class CodesController extends Code   {
    private $params;
    
    public function __construct($params) {
        try {
            parent::__construct();
            $this->params = $params['method'];
        } catch (Exception $e) {
            error_log($e->getMessage());
            redirect_to_error('500');
        }
    }
    public function update()
{
    session_start();
    try {
        $code = $_POST['code'];
        $email = $_SESSION['email'];
        // Verificar si el parámetro $email está vacío
        if (empty($email)) {
            $_SESSION['error_message'] = "Sorry, your verification has expired. Please press OK to redirect to the login page.";
            header("Location: ../Verify/code.php");
            exit();
        }
        $response = $this->verifyCode($email, $code);
        if ($response === 'Verification successful') {
            unset($_SESSION['error']); // Eliminar el último error
            unset($_SESSION['page_status']); // Eliminar la bandera de estado de la página
            unset($_SESSION['code_verification_errors']); // Eliminar los errores de verificación de código
            $_SESSION['form_submitted'] = true; // Establecer la bandera de formulario enviado
            header("Location: " . redirect_to('posts', 'index')); // Redirigir al índice
            exit();
        }elseif ($response === "changepassword") {
            unset($_SESSION['error']); // Eliminar el último error
            unset($_SESSION['page_status']); // Eliminar la bandera de estado de la página
            unset($_SESSION['code_verification_errors']); // Eliminar los errores de verificación de código
            $_SESSION['form_submitted'] = true; // Establecer la bandera de formulario enviado
            $_SESSION['user_email'] = $email; // Almacenar el correo electrónico del usuario
            header("Location: ../ForgotPassword/changepassword.php"); // Redirigir al índice
            exit();
        }
        else {
            $_SESSION['error'] = $response; // Almacenar el último error
            $_SESSION['page_status'] = 'error'; // Agregar esta línea
            header("Location: ../Verify/code.php"); // Redirigir a code.php sin eliminar el email
            exit();
        }
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage(); // Almacenar el último error
        $_SESSION['page_status'] = 'error'; // Agregar esta línea
        header("Location: ../Verify/code.php"); // Redirigir a code.php sin eliminar el email
        exit();
    }
}
    
    
}
?>
