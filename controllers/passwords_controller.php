<?php
ob_start();
get_model('password');

class PasswordsController extends password  {
    private $params;
    
    public function __construct($params) {
        // var_dump($params);
        try {
            parent::__construct();
            $this->params = $params['method'];
        } catch (Exception $e) {
            error_log($e->getMessage());
            redirect_to_error('500');
        }
    }

    public function update() {
        try {
            $response = $this->changepasswordcode($this->params);
            if ($response === true) {
                header("Location: ../Verify/code.php");
            } 
        } catch (Exception $e) {
            session_start();
            $_SESSION['error'] = $e->getMessage();
            header("Location: ../ForgotPassword/email.php");
            exit();
        }
       
    }
    public function create() {
        try {
            $user = $this->changepassword($this->params);
            if ($user !== null) {
                $email = $user['email']; // Get the user's email from the data returned by the login function
                // Redirect the user to a success page or wherever necessary
                header("Location: ../Verify/code.php");
                unset($_SESSION['error']);
                exit();
            } else {
                throw new Exception("Failed login");
            }
        } catch (Exception $e) {
            session_start();
            $_SESSION['error'] = $e->getMessage();
            header("Location: ../ForgotPassword/email.php?error=");
            exit();
        }
    }
}
?>
