<?php
ob_start();
get_model('post');

class User extends ControllUserData  {
    private $params;
    
    public function __construct($params) {
      try {
        parent::__construct();
        $this->params = $params;
      } catch (Exception $e) {
        error_log($e->getMessage());
        redirect_to_error('500');
      }
    }

    public function createUsers() {
        try {
            $response = $this->saveUsers($this->params);
            if ($response === true) {
                header('Location: user-otp.php');
                exit();
            } else {
                throw new Exception("Failed to create user: " . $response);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return $this->new(["error" => "User registration failed. Please try again."]);
        }
    }
    


}


?>
