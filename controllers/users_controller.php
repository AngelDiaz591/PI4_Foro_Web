<?php
ob_start();
get_model('user');

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
              // Redirigir al usuario a una página de éxito o a donde sea necesario
              #header("Location: registro_exitoso.php");
              #exit();
          } else {
              throw new Exception("Failed to create user: " . $response);
          }
      } catch (Exception $e) {
          // Manejar la excepción
          error_log($e->getMessage());
          // Redirigir al usuario a registro.php con un mensaje de error
          header("Location: ../views/RegistroUsers/registro.php?error=" . urlencode("User registration failed. Please try again."));
          exit();
      }
  }
  
    


}


?>
