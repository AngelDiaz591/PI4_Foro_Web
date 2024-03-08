<?php
ob_start();
get_model('session');

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
            $response = $this->login($this->params);
            if ($response === true) {
                // Obtener el nombre de usuario del parámetro
                $username = $this->params["email"]; // Aquí puedes cambiar "email" por el campo que contiene el nombre de usuario en los parámetros
    
                // Redirigir al usuario a una página de éxito o a donde sea necesario
                #header("Location: registro_exitoso.php?username=" . urlencode($username));
                #exit();
            } else {
                throw new Exception("Failed to create user: " . $response);
            }
        } catch (Exception $e) {
            // Manejar la excepción
            error_log($e->getMessage());
            // Redirigir al usuario a registro.php con un mensaje de error
            header("Location: ../views/login/login.php?error=" . urlencode("User registration failed. Please try again."));
            exit();
        }
    }
  
    


}


?>