<?php
ob_start();
get_model('user');

class SessionsController extends User  {
  private $params;
  
  public function __construct($params) {
    try {
      parent::__construct();
      $this->params = $params['method'];
    } catch (Exception $e) {
      $this->handle_exception_redirect_error($e, '500');
    }
  }

  public function show() {
    return $this->render('show', $this->params);
  }

  public function new() {
    return $this->render('new', $this->params);
  }

  public function create() {
    try {
      $response = $this->verify_credentials($this->params);
      if ($response["status"]) {
        $_SESSION["user"] = $response["data"];
        header("Location:" . redirect_to('posts', 'index'));
      } else {
        throw new Exception("Failed to login user: " . $response["message"]);
      }
    } catch (Exception $e) {
      $_SESSION['error'] = $e->getMessage();
      $this->handle_exception_redirect_to($e, 'sessions', 'new');
    }
  }

  public function destroy() {
    session_destroy();
    header("Location:" . redirect_to('posts', 'index'));
  }

  protected function render($view, $data = []) {
    $params = $data;

    include ROOT_DIR . 'views/users/sessions/' . $view . '.php';

    return ob_get_clean();
  }
}
?>
