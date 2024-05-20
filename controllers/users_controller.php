<?php
ob_start();
get_model('user');
get_model('notification');

class UsersController extends User {
  private $params;
  
  public function __construct($params) {
    try {
      parent::__construct();
      $this->params = $params['method'];
    } catch (Exception $e) {
      return $this->error('500');
    }
  }

  public function show() {
    try {
      $response = $this->find_by_id($this->params['id']);

      $follower = ['follower' => false];
      if (isset($_SESSION['user'])) {
        $follower['follower'] = $this->is_following($this->params['id'], $_SESSION['user']['id']);
      }

      $response['data'] = array_merge($response['data'], $follower);

      if ($response['status']) {
        return $this->render('show', $response['data']);
      } else {
        throw new Exception('Failed to get the user with id ' . $this->params['id'] . ': ' . $response['message']);
      }
    } catch (Exception $e) {
      error_log($e->getMessage());
      return $this->error('404');
    }
  }


  public function follow() {
    try {
      $response = $this->create_follow($this->params);
      $response = json_decode($response);

      if ($response->status) {
        echo json_encode($response);
      } else {
        throw new Exception(json_encode($response));
      }
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  public function unfollow() {
    try {
      $response = $this->destroy_follow($this->params);
      $response = json_decode($response);

      if ($response->status) {
        echo json_encode($response);
      } else {
        throw new Exception(json_encode($response));
      }
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  public function followers() {
    try {
      $response = $this->get_followers($this->params['id']);
      $response = json_decode($response);

      if ($response->status) {
        echo json_encode($response);
      } else {
        throw new Exception(json_encode($response));
      }
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  public function following() {
    try {
      $response = $this->get_following($this->params['id']);
      $response = json_decode($response, true);

      if ($response->status) {
        echo json_encode($response);
      } else {
        throw new Exception(json_encode($response));
      }
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  public function is_following($user, $follower) {
    try {
      $db = new self(['method' => $this->params]);

      $db->t = 'followers';
      $db->pp = ['user_id', 'follower_id'];

      $response = $db->where([
        ['user_id', '=', $user],
        ['follower_id', '=', $follower]
      ])->first();

      if (!empty($response)) {
        return true;
      } else {
        throw new Exception('Is not following');
      }
    } catch (Exception $e) {
      return false;
    }
  }

  public function notifications_count() {
    try {
      $notifications = new Notification();

      $response = $notifications->get_unseen_notifications_count($this->params['id']);
      $response = json_decode($response);

      if ($response->status) {
        echo json_encode($response);
      } else {
        throw new Exception(json_encode($response));
      }
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  public function notifications() {
    try {
      $notifications = new Notification();

      $response = $notifications->get_unseen_notifications($this->params['id']);
      $response = json_decode($response);

      if ($response->status) {
        echo json_encode($response);
      } else {
        throw new Exception(json_encode($response));
      }
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  public function all_notifications() {
    try {
      $notifications = new Notification();

      $response = $notifications->get_notifications($this->params['id']);
      $response = json_decode($response);

      if ($response->status) {
        echo json_encode($response);
      } else {
        throw new Exception(json_encode($response));
      }
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  public function mark_notifications_as_read() {
    try {
      $notifications = new Notification();

      $response = $notifications->mark_as_read($this->params['ids']);
      $response = json_decode($response);

      if ($response->status) {
        echo json_encode($response);
      } else {
        throw new Exception(json_encode($response));
      }
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  protected function render($view, $data = []) {
    $data = $this->to_obj($data);

    include ROOT_DIR . 'views/users/' . $view . '.php';

    return ob_get_clean();
  }
}
?>
