<?php
ob_start();
get_model('user');

/*
 * This class inherits from the base class and contains the calls to the posts procedures
 */
class UsersController extends User  {
    private $params;
    
    public function __construct($params) {
        var_dump($params);
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
            $response = $this->save($this->params);
            if ($response === true) {
                header("Location: ../Verify/user-otp.php");
                exit();
            } else {
                throw new Exception("Failed to create user: " . $response);
            }
        } catch (Exception $e) {
            session_start();
            $_SESSION['error'] = $e->getMessage();
            header("Location: ../views/RegistroUsers/registro.php");
            exit();
        }
    }
}
?>
