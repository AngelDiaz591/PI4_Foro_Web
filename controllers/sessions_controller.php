<?php
ob_start();
get_model('session');

class SessionsController extends Session  {
    private $params;
    
    public function __construct($params) {
      #var_dump($params);
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
              $email = $user['email']; // Obtener el email del usuario desde los datos devueltos por la función login
  
              // Redirigir al usuario a una página de éxito o a donde sea necesario
              header("Location:" . redirect_to('posts', 'index') . "&email=" . urlencode($email));

              exit();
          } else {
              throw new Exception("Failed login");
          }
      } catch (Exception $e) {
          // Manejar la excepción
          error_log($e->getMessage());
          // Redirigir al usuario a registro.php con un mensaje de error
          header("Location: ../login/login.php?error=" . urlencode("User login failed. Please try again."));
          exit();
      }
  }
  
    


}


?>