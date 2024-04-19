<?php 
namespace app\controllers;

class BaseController {
  public $p; // params
  public $pp; // permitted params

  public function __construct() {
    $method = $_SERVER['REQUEST_METHOD'];

    switch ($method) {
      case 'GET':
        $this->p = $_GET;
        break;
      case 'POST':
        $this->p = $_POST;
        break;
      case 'PATCH':
      case 'PUT':
      case 'DELETE':
        $this->p = $this->get_request_body();
        break;
      default:
        $this->flash_error(405, 'Method Not Allowed');
        break;
    }
  }

  public function view_dir_name() {
    $controller = strtolower(str_replace('app\\controllers\\', '', get_class($this)));

    return str_replace('controller', '', $controller) . DS;
  }

  public function params() {
    return $this;
  }

  public function permit($data) {
    $arr = [];

    foreach ($this->p as $key => $value) {
      if (in_array($key, $data)) {
        $arr[$key] = $value;
      }
    }

    if (count($arr) === 0) {
      $this->flash_error(400, 'Bad Request');
    }

    $arr = $this->sort_params($data);

    return $arr;
  }

  private function sort_params($orden) {
    $arr_sorted = [];

    foreach ($orden as $key) {
      if (array_key_exists($key, $this->p)) {
        $arr_sorted[$key] = $this->p[$key];
      }
    }

    return $arr_sorted;
  }

  private function get_request_body() {
    $body = file_get_contents('php://input');
    $content_type = $_SERVER['CONTENT_TYPE'] ?? '';

    if (strpos($content_type, 'application/json') !== false) {
      return json_decode($body, true) ?: [];
    } elseif (strpos($content_type, 'application/x-www-form-urlencoded') !== false) {
      parse_str($body, $data);
      return $data ?: [];
    }

    return [];
  }

  protected function flash_error($code, $message) {
    http_response_code($code);
    $err = [
      'error' => $code . ' ' . $message,
      'status' => $code,
      'message' => $message
    ];
    echo json_encode($err);
    exit();
  }
}
?>
