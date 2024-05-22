<?php
ob_start();
get_model('user');

class AdminsController extends User {
  private $params;

  public function __construct($params) {
    try {
      parent::__construct();
      $this->params = $params['method'];

      if (!isset($_SESSION['user']) || $_SESSION['user']['rol'] !== 0) {
        return $this->error('403');
        exit();
      }
    } catch (Exception $e) {
      return $this->error('500');
    }
  }

  public function console() {
    return $this->render('console', $this->params);
  }

  protected function render($view, $data = []) {
    $data = $this->to_obj($data);

    include ROOT_DIR . '/views/admins/' . $view . '.php';

    return ob_get_clean();
  }
}
?>
