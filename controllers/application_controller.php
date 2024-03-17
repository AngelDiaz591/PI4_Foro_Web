<?php 
define('ROOT_DIR', __DIR__ . '/../');

/**
 * This function is used to get the home DIRECTORY of the project
 * 
 * @return string
 */
function get_home_dir() {
  return ROOT_DIR;
}

/**
 * This function is used to get the home URL of the project
 * 
 * @return string
 */
function get_home_url() {
  return 'http://localhost/foroweb/';
}

/**
 * This function is used to get the current URL of the project
 * 
 * @return string
 */
function get_current_url() {
  $host = $_SERVER['HTTP_HOST'];
  $uri = $_SERVER['REQUEST_URI'];

  return 'http://' . $host . $uri;
}

/**
 * This function is used to get the last URL of the project
 * 
 * @return string
 */
function get_last_url() {
  if (isset($_SERVER['HTTP_REFERER'])) {
    return $_SERVER['HTTP_REFERER'];
  }
  
  return get_home_url();
}

/**
 * This function is used to get a controller
 * 
 * @param string $controller_name, in plural
 * @return void
 */
function get_controller($controller_name) {
  $controller_path = ROOT_DIR . 'controllers/' . $controller_name . '_controller.php';

  file_exists($controller_path) ? require_once $controller_path : die('Controller not found');
}

/**
 * This function is used to get a model
 * 
 * @param string $model_name, in singular
 * @return void
 */
function get_model($model_name) {
  $model_path = ROOT_DIR . 'models/' . $model_name . '.php';

  file_exists($model_path) ? require_once $model_path : die('Model not found');
}

/**
 * This function is used to render a layout
 * 
 * @param string $template_name
 * @return html, the layout content from the views/layouts directory
 */
function render_layout($template_name) {
  ob_start();

  include ROOT_DIR . 'views/layouts/_' . $template_name . '.php';

  $template_content = ob_get_clean();

  echo $template_content;
}

/**
 * This function is used to redirect to an error view
 * 
 * @param string $error, a number of the error
 * @return void
 */
function redirect_to_error($error) {
  header("Location:" . get_home_url() . "views/errors/$error.php");
  exit;
}

/**
 * This function is used to redirect to a controller and action
 * 
 * @param string $controller, in plural
 * @param string $action, the method from the controller
 * @return string
 */
function redirect_to($controller, $action) {
  return get_home_url() . "views/layouts/application.php?controller=$controller&action=$action";
}

/**
 * This function is used to render a controller and action
 * It creates a new instance of the controller and calls the action method
 * 
 * @param string $action, the method from the controller
 * @param string $controller, in plural
 * @param array $data
 * @return Class::method it calls the method from the controller
 */
function render($action, $controller, $data = []) {
  ob_start();

  get_controller("$controller");
  $controller_name = ucfirst($controller) . 'Controller';
  $controller = new $controller_name($data);
  
  return $controller->$action();
}

/**
 * This function is used to render a link tag
 * 
 * @param string $rel
 * @param string $href
 * @return string link tag
 */
function link_tag($rel, $href, $type = 'text/css') {
  return "<link rel='$rel' href='" . get_home_url() . "resources/$href' type='$type'>";
}

/**
 * This function is used to render a script tag
 * 
 * @param string $src
 * @return string script tag
 */
function script_tag($src) {
  return "<script src='" . get_home_url() . "resources/js/$src.js'></script>";
}

/**
 * This function is used to render a img tag from resources/img directory
 * 
 * @param string $src
 * @param string $alt
 * 
 * @return string img tag
 */
function img_tag($src, $alt, $class = '', $id = '', $style = '') {
  return "<img src='" . get_home_url() . "resources/img/$src' alt='$alt' class='$class' id='$id' style='$style'>";
}
?>
