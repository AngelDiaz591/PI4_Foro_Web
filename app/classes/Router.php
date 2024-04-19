<?php 
namespace app\classes;

use app\controllers\HomeController;
use app\controllers\ErrorController;
use app\controllers\PostController;

/**
 * Router class
 * 
 * This class is responsible for routing
 * requests to the appropriate controller
 */
class Router {
  private $uri = '';

  public function __construct() {
  }

  /**
   * Dispatch the request to the appropriate controller
   * 
   * @return void
   */
  public function dispatch() {
    $this->filter_request();

    $controller = $this->get_controller();
    $action = $this->get_action();
    $params = $this->get_params();

    switch($controller) {
      case 'HomeController':
        $controller = new HomeController();
        break;
      case 'PostController':
        $controller = new PostController();
        break;
      default:
        $controller = new ErrorController();
        $action = 'err404';
        break;
    }
    $controller->$action($params);

    return;
  }

  /**
   * Get the request URI, remove end slashes, sanitize
   * and explode it into an array 
   * 
   * @return void
   */
  private function filter_request() {
    $request = filter_input_array(INPUT_GET);
    if (isset($request['uri'])) {
      $this->uri = $request['uri'];
      $this->uri = rtrim($this->uri, '/');
      $this->uri = filter_var($this->uri, FILTER_SANITIZE_URL);
      $this->uri = explode('/', ucfirst(strtolower($this->uri)));
      
      return;
    }
  }

  /**
   * Check if a controller is specified in the URI
   * and return it if it is, otherwise return the
   * home controller
   * 
   * @return string
   */
  private function get_controller() {
    if (isset($this->uri[0])) {
      $controller = $this->uri[0];
      unset($this->uri[0]);
    } else {
      $controller = 'Home';
    }
    $controller = ucfirst($controller) . 'Controller';

    return $controller;
  }

  /**
   * Check if an action is specified in the URI
   * and return it if it is, otherwise return the
   * index action
   * 
   * @return string
   */
  private function get_action() {
    if (isset($this->uri[1])) {
      $action = $this->uri[1];
      unset($this->uri[1]);
    } else {
      $action = 'index';
    }

    return $action;
  }

  /**
   * Get the parameters from the URI if exist
   * 
   * @return array
   */
  private function get_params() {
    $params = [];

    if (!empty($this->uri)) {
      $params = $this->uri;
    }

    return $params;
  }
}
?>
