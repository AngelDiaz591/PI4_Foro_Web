<?php
ob_start();
get_model('admin');

class AdminsController extends Admin {
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
    if (!isset($_SESSION['user'])) {
      header('Location: /');
    }
    return $this->render('console', $this->params);
  }

  public function reviews() {
    if (!isset($_SESSION['user'])) {
      header('Location: /');
    }
    return $this->render('reviews', $this->params);
  }

  public function topics() {
    if (!isset($_SESSION['user'])) {
      header('Location: /');
    }
    return $this->render('topics', $this->params);
  }

  public function UserManagement() {
    if (!isset($_SESSION['user'])) {
      header('Location: /');
    }
    return $this->render('UserManagement', $this->params);
  }

  protected function render($view, $data = []) {
    $data = $this->to_obj($data);

    include ROOT_DIR . '/views/admins/' . $view . '.php';

    return ob_get_clean();
  }
}
?>
