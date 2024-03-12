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
    public function update() {
        session_start();
        try {
            $code = $_POST['code'];
            $email = $_SESSION['email'];
            $response = $this->verifyCode($email, $code);
            if ($response === 'Verificación exitosa') {
                unset($_SESSION['email']);
                header("Location: " . redirect_to('posts', 'index'));
                exit();
            } else {
                $_SESSION['error'] = $response;
                header("Location: ../Verify/code.php");
                exit();
            }
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header("Location: ../Verify/code.php");
            exit();
        }
    }
    
}
?>
