<?php
ob_start();
get_model('user');

class UsersController extends User  {
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
                header("Location:" . redirect_to('users', 'createUsers'));
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
