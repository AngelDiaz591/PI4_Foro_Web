<?php 
namespace app\controllers;

use app\classes\View;
use app\models\posts;

class PostController extends BaseController {
  public function __construct() {
    parent::__construct();
  }

  public function get_all() {
    $post = new Posts();
    $response = $post->all();

    echo json_encode($response);
  }

  public function get_by_id($data) {
    $id = (int)array_shift($data);

    $post = new Posts();
    $response = $post->find(['id' => $id]);

    if (empty($response)) {
      $this->flash_error(404, 'Not Found');
    }

    echo json_encode($response[0]);
  }

  public function create() {
    $post = new Posts();
    $result = $post->save($this->post_params());

    echo json_encode($result);
  }

  public function update() {
    $post = new Posts();
    $result = $post->patch($this->post_params());

    echo json_encode($result);
  }

  public function destroy() {
    $post = new Posts();
    $result = $post->destroy($this->post_params());

    echo json_encode($result);
  }

  public function new() {
    $response = [
      'title' => 'New Post',
      'code' => 200,
    ];

    View::render($this->view_dir_name(), 'new', $response);
  }

  public function show($data) {
    $id = (int)array_shift($data);

    $response = [
      'title' => 'Show Post',
      'code' => 200,
      'id' => $id,
    ];

    View::render($this->view_dir_name(), 'show', $response);
  }

  public function edit($data) {
    $id = (int)array_shift($data);

    $response = [
      'title' => 'Edit Post',
      'code' => 200,
      'id' => $id,
    ];

    View::render($this->view_dir_name(), 'edit', $response);
  }

  private function post_params() {
    return $this->params()->permit(['id', 'title', 'body']);
  }
}
?>
