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
    try {
        $response = $this->all_users();
        if ($response["status"]) {
            return $this->render('UserManagement', ['data' => $response["data"]]);
        } else {
            throw new Exception("Failed to get all users: " . $response["message"]);
        }
    } catch (Exception $e) {
        return $this->error('500');
    }
  }

  public function user_ban() {
    try {

        $userId = $_GET['id'];

        $response = $this->ban($userId);
        
        if ($response["status"]) {
            return header('Location: /admins/UserManagement');
        } else {
            throw new Exception("Failed to ban user: " . $response["message"]);
        }
    } catch (Exception $e) {
        return $this->error('500');
    }
  }

public function user_unban() {
  try {

      $userId = $_GET['id'];

      $response = $this->unban($userId);
      
      if ($response["status"]) {
          return header('Location: /admins/UserManagement');
      } else {
          throw new Exception("Failed to ban user: " . $response["message"]);
      }
  } catch (Exception $e) {
      return $this->error('500');
  }
}

public function user_delete() {
  try {

      $userId = $_GET['id'];

      $response = $this->user_info_delete($userId);
      
      if ($response["status"]) {
          return header('Location: /admins/UserManagement');
      } else {
          throw new Exception("Failed to ban user: " . $response["message"]);
      }
  } catch (Exception $e) {
      return $this->error('500');
  }
}

protected function render($view, $data = []) {
    
    $data = $this->to_obj($data);

    include ROOT_DIR . '/views/admins/' . $view . '.php';
    
    return ob_get_clean();
  }
}
?>
