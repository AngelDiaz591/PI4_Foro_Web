<?php
ob_start();
get_model('post');


/*
 * This class is used to manage the posts views and actions
 * Use the render method to render a view, it will return the view content
 * Note: If it is necessary to create a new method in the model and the views to render the new method,
 *       follow the same pattern
 * Important: the controller file name must have the model name in plural and be in snake case, 
 *            the class name must be in camel case with the first letter in uppercase and inherits from the model
 */
class PostsController extends Post {
  private $params;
  private $files;

/**
 * The constructor is used to get the params($_GET or $_POST) and the files($_FILES)
 * 
 * @param array $params
 * @throws Exception if it fails to connect to the database and redirect to error 500
 * @return void
 */
  public function __construct($params) {
    try {
      parent::__construct();
      $this->params = $params["method"];
      $this->files = $params["files"];
    } catch (Exception $e) {
      $this->handle_exception_redirect_error($e, '500');
    }
  }

/**
 * Get all the posts and render the index view
 * 
 * @param void
 * @throws Exception if it fails to get all posts(e.g. database error)
 * @return html views/posts/index.php
 */
  public function index() {
    try {
      $response = $this->all();

      if ($response["status"]) {
        return $this->render('index', $response["data"]);
      } else {
        throw new Exception("Failed to get all posts: " . $response["message"]);
      }
    } catch (Exception $e) {
      $this->handle_exception_redirect_error($e, '500');
    }
  }

/**
 * Get a post by id and render the show view
 * 
 * @param void
 * @throws Exception if it fails to get the post redirect to error 404
 * @return html views/posts/show.php
 */
  public function show() {
    try {
      $response = $this->find_by_id($this->params['id']);

      if ($response["status"]) {
        return $this->render('show', $response["data"]);
      } else {
        throw new Exception("Failed to get the post with id " . $this->params['id'] . ": " . $response["message"]);
      }
    } catch (Exception $e) {
      $this->handle_exception_redirect_error($e, '404');
    }
  }

/**
 * Render the new view
 * 
 * @param void
 * @return html views/posts/new.php
 */
  public function new() {
    return $this->render('new', $this->params);
  }

/**
 * Create a new post and redirect to the index view
 * 
 * @param void
 * @throws Exception if it fails to create the post
 * @return void
 */
  public function create() {
    try {
      $images = $this->check_images($this->files['images']);
      
      $this->params = array_merge($this->params, [ "images" => $images["data"] ]);
      $response = $this->save($this->params);

      if ($response["status"]) {
        header("Location:" . redirect_to('posts', 'index'));
      } else {
        throw new Exception("Failed to create the post: " . $response["message"]);
      }
    } catch (Exception $e) {
      $this->handle_exception_redirect_to($e, 'posts', 'new');
    }
  }

/**
 * Get a post by id and render the edit view
 * 
 * @param void
 * @throws Exception if it fails to get the post redirect to error 404
 * @return html views/posts/edit.php
 */
  public function edit() {
    try {
      $response = $this->find_by_id($this->params['id']);

      if ($response["status"]) {
        return $this->render('edit', $response["data"]);
      } else {
        throw new Exception("Failed to get the post with id " . $this->params['id'] . ": " . $response["message"]);
      }
    } catch (Exception $e) {
      $this->handle_exception_redirect_error($e, '404');
    }
  }

/**
 * Update a post and redirect to the index view
 * 
 * @param void
 * @throws Exception if it fails to update the post redirect to the edit view
 * @return void
 */
  public function patch() {
    try {
      $images = $this->check_images($this->files['images']);

      $this->params = array_merge($this->params, [ "images" => $images["data"] ]);
      $response = $this->update($this->params);

      if ($response["status"]) {
        header("Location:" . redirect_to('posts', 'show') . '&id=' . $this->params['id']);
      } else {
        throw new Exception("Failed to update the post with id " . $this->params['id'] . ": " . $response["message"]);
      }
    } catch (Exception $e) {
      $this->handle_exception_redirect_to($e, 'posts', 'edit', ['id' => $this->params['id']]);
    }
  }

/**
 * Delete an image from a post and redirect to the edit view
 * 
 * @param void
 * @throws Exception if it fails to delete the image redirect to the edit view
 * @return void
 */
  public function purge_image() {
    try {
      $response = $this->delete_image($this->params);

      if ($response["status"]) {
        header("Location:" . redirect_to('posts', 'edit') . '&id=' . $this->params['post_id']);
      } else {
        throw new Exception("Failed to delete the image from the post with id " . $this->params['post_id'] . ": " . $response["message"]);
      }
    } catch (Exception $e) {
      $this->handle_exception_redirect_to($e, 'posts', 'edit', ['id' => $this->params['post_id']]);
    }
  }

/**
 * Delete a post and redirect to the index view
 * 
 * @param void
 * @throws Exception if it fails to delete the post redirect to error 404
 * @return void
 */
  public function delete() {
    try {
      $response = $this->destroy($this->params['id']);

      if ($response["status"]) {
        header("Location:" . redirect_to('posts', 'index'));
      } else {
        throw new Exception("Failed to delete the post with id " . $this->params['id'] . ": " . $response["message"]);
      }
    } catch (Exception $e) {
      $this->handle_exception_redirect_error($e, '404');
    }
  }

/**
 * Render a view
 * 
 * @param string $view
 * @param array $data
 * @return html
 */
  protected function render($view, $data = []) {
    $params = $data;

    include ROOT_DIR . 'views/posts/' . $view . '.php';

    return ob_get_clean();
  }

/**
 * Check the images and return an array with the images data such as name and tmp_name
 * 
 * @param array $images, $_FILES['images']
 * @return array
 */
  private function check_images($images) {
    try {
      $images_array = [];
      
      foreach ($images["name"] as $key => $name) {
        $image_error = $images["error"][$key];

        if ($image_error === 4) {
          continue;
        }

        $image_name = $this->rename_image($name);
        $image_tmp_name = $images["tmp_name"][$key];
        $image_size = $images["size"][$key];
        $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
        $image_allowed_extensions = ["jpg", "jpeg", "png", "gif"];

        if ($image_error !== 0) {
          throw new Exception("The image " . $image_name . ", has an error. Error code: " . $image_error);
        }

        if ($image_size > 1000000) {
          throw new Exception("The image " . $image_name . ", exceeds the maximum size allowed of 1MB.");
        }

        if (!in_array($image_extension, $image_allowed_extensions)) {
          throw new Exception("The image " . $image_name . ", has an invalid extension, only jpg, jpeg, png and gif are allowed.");
        }

        $images_array[] = [ "name" => $image_name, "tmp_name" => $image_tmp_name];
      }

      return [ "status" => true, "data" => $images_array ];
    } catch (Exception $e) {
      error_log($e->getMessage());
      throw new Exception("Failed to check the images: " . $e->getMessage());
    }
  }

/**
 * Rename the image
 *  1. Resize the name to 30 characters
 *  2. Lowercase the name
 *  3. Replace the invalid characters with an underscore, use a regex
 *  4. Remove underscores or hyphens from the end of the name
 *  5. Add the date and time to the name
 * 
 * @param string $image
 * @return string
 */
  private function rename_image($image) {
    $pattern = "/[^a-zA-Z0-9\_\-\.]/";
    $replacement = '_';
    $extension = pathinfo($image, PATHINFO_EXTENSION);
    $name = pathinfo($image, PATHINFO_FILENAME);

    $name_resize = substr($name, 0, 30);
    $name_lower = strtolower($name_resize);
    $name_filtered = preg_replace($pattern, $replacement, $name_lower);
    $new_name = rtrim($name_filtered, "_-");


    return date("Y-m-d_H-i-s") . "_" . $new_name . "." . $extension;
  }
}
?>
