<?php
ob_start();
get_model('post');


/*
 * This class is used to manage the posts views and actions
 * If the action found a post and it is not found, it will redirect to the error page
 * Use the render method to render a view, it will return the view content
 * Note: To create a similar controller, you must change the model name and the render method
 * create the function and procedures in the db, the model with the methods and the views
 * Note: If have to create new methods, you must create the procedures in the db,
 * create the method in the model and the views to render the new method, follow the same pattern
 * Warning: The parent::__construct() method must be called in the constructor
 * Info: the controller file name must have the model name in plural and be in snake case, 
 * the class name must be in camel case with the first letter in uppercase and extends the modelpath
 * 
 * @return html
 *
 * @example
 * $postsController = new PostsController($_POST || $_GET || []);
 * <?= $postsController->index(); ?>
 */
class PostsController extends Post {
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

  public function index() {
    try {
      $response = $this->get_all();

      if ($response["status"]) {
        return $this->render('index', $response["data"]);
      } else {
        throw new Exception("Failed to get all posts: " . $response["message"]);
      }
    } catch (Exception $e) {
      error_log($e->getMessage());
      return $this->render('index');
    }
  }

  public function show() {
    try {
      $response = $this->get_by_id($this->params['id']);

      if ($response["status"]) {
        return $this->render('show', $response["data"]);
      } else {
        throw new Exception("Failed to get the post with id " . $this->params['id'] . ": " . $response["message"]);
      }
    } catch (Exception $e) {
      error_log($e->getMessage());
      redirect_to_error('404');
    }
  }

  public function new() {
    return $this->render('new', $this->params);
  }

  public function create() {
    try {
      $response = $this->save($this->params);

      if ($response["status"]) {
        header("Location:" . redirect_to('posts', 'index'));
      } else {
        throw new Exception("Failed to create the post: " . $response["message"]);
      }
    } catch (Exception $e) {
      error_log($e->getMessage());
      return $this->new();
    }
  }

  public function edit() {
    try {
      $response = $this->get_by_id($this->params['id']);

      if ($response["status"]) {
        return $this->render('edit', $response["data"]);
      } else {
        throw new Exception("Failed to get the post with id " . $this->params['id'] . ": " . $response["message"]);
      }
    } catch (Exception $e) {
      error_log($e->getMessage());
      redirect_to_error('404');
    }
  }

  public function patch() {
    try {
      $response = $this->update($this->params);

      if ($response["status"]) {
        header("Location:" . redirect_to('posts', 'index'));
      } else {
        throw new Exception("Failed to update the post with id " . $this->params['id'] . ": " . $response["message"]);
      }
    } catch (Exception $e) {
      error_log($e->getMessage());
      return $this->edit();
    }
  }

  public function delete() {
    try {
      $response = $this->destroy($this->params['id']);

      if ($response["status"]) {
        header("Location:" . redirect_to('posts', 'index'));
      } else {
        throw new Exception("Failed to delete the post with id " . $this->params['id'] . ": " . $response["message"]);
      }
    } catch (Exception $e) {
      error_log($e->getMessage());
      redirect_to_error('404');
    }
  }
  
  protected function render($view, $data = []) {
    $params = $data;

    include ROOT_DIR . 'views/posts/' . $view . '.php';

    return ob_get_clean();
  }
}
?>
