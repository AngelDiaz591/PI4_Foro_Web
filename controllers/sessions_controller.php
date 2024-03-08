<?php
ob_start();
get_model('session');

class SessionsController extends Session  {
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

    public function create() {
        try {
            $user = $this->login($this->params);
            if ($user !== null) {
                $email = $user['email']; // Get the user's email from the data returned by the login function
                // Redirect the user to a success page or wherever necessary
                header("Location:" . redirect_to('posts', 'index'));
                exit();
            } else {
                throw new Exception("Failed login");
            }
        } catch (Exception $e) {
            session_start();
            $_SESSION['error'] = $e->getMessage();
            header("Location: ../login/login.php?error=");
            exit();
        }
    }
}
?>
