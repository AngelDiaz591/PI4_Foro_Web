<?php
ob_start();
get_model('admin');
get_model('post');

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
    try {
      $post = new Post;
      $response = $post->all();
      if ($response["status"]) {
          return $this->render('reviews', ['data' => $response["data"]]);
      } else {
          throw new Exception("Failed to get all posts: " . $response["message"]);
      }
    } catch (Exception $e) {
        return $this->error('500');
    }
  }

  public function topics() {
    try {
      $post = new Post;
      $response = $post->all();
      if ($response["status"]) {
          return $this->render('topics', ['data' => $response["data"]]);
      } else {
          throw new Exception("Failed to get all posts: " . $response["message"]);
      }
    } catch (Exception $e) {
        return $this->error('500');
    }
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

        $userId = $this->params['id'];

        $response = $this->ban($userId);
        
        if ($response["status"]) {
            header('Location: /admins/UserManagement');
        } else {
            throw new Exception("Failed to ban user: " . $response["message"]);
        }
    } catch (Exception $e) {
        return $this->error('500');
    }
  }

  public function user_unban() {
    try {
  
        $userId = $this->params['id'];
  
        $response = $this->unban($userId);
        
        if ($response["status"]) {
            header('Location: /admins/UserManagement');
        } else {
            throw new Exception("Failed to ban user: " . $response["message"]);
        }
    } catch (Exception $e) {
        return $this->error('500');
    }
  }

public function user_delete() {
  try {

      $userId = $this->params['id'];

      $response = $this->user_info_delete($userId);
      
      if ($response["status"]) {
          header('Location: /admins/UserManagement');
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
