<?php 
define('ROOT_DIR', __DIR__ . '/../');

/*
 * This function is used to get the home directory of the project
 * 
 * @return string
 * 
 * @example
 * <img src="<?= get_home_dir(); ?>assets/images/logo.png" alt="Logo">
 */
function get_home_dir() {
  return ROOT_DIR;
}

/*
 * This function is used to get the home url of the project
 * 
 * @return string
 * 
 * @example
 * <a href="<?= get_home_url(); ?>">Home</a>
 */
function get_home_url() {
  return 'http://localhost/foroweb/';
}

/*
 * This function is used to get the current url of the project
 * 
 * @return string
 * 
 * @example
 * <a href="<?= get_current_url(); ?>">Current</a>
 */
function get_current_url() {
  $host = $_SERVER['HTTP_HOST'];
  $uri = $_SERVER['REQUEST_URI'];

  return 'http://' . $host . $uri;
}

/*
 * This function is used to get the last url of the project
 * 
 * @return string
 * 
 * @example
 * <a href="<?= get_last_url(); ?>">Last</a>
 */
function get_last_url() {
  if (isset($_SERVER['HTTP_REFERER'])) {
    return $_SERVER['HTTP_REFERER'];
  }
  
  return get_home_url();
}

/*
 * This function is used to get a controller
 * 
 * Note: The controller name must be in plural and previously created
 * 
 * @return void
 * 
 * @example
 * get_controller('posts');
 */
function get_controller($controller_name) {
  $controller_path = ROOT_DIR . 'controllers/' . $controller_name . '_controller.php';

  file_exists($controller_path) ? require_once $controller_path : die('Controller not found');
}

/*
 * This function is used to get a model
 * 
 * Note: The model name must be in singular and previously created
 * 
 * @return void
 * 
 * @example
 * get_model('post');
 */
function get_model($model_name) {
  $model_path = ROOT_DIR . 'models/' . $model_name . '.php';

  file_exists($model_path) ? require_once $model_path : die('Model not found');
}

/*
 * This function is used to get a layout
 * 
 * Note: The layout name must be previously created with the underscore prefix
 * 
 * @return void
 * 
 * @example
 * render_layout('header');
 */
function render_layout($template_name) {
  ob_start();

  include ROOT_DIR . 'views/layouts/_' . $template_name . '.php';

  $template_content = ob_get_clean();

  echo $template_content;
}

/*
 * This function is used to redirect to an error view
 * 
 * Note: The error name must be previously created
 * 
 * @return void
 * 
 * @example
 * redirect_to_error('404');
 */
function redirect_to_error($error) {
  header("Location:" . get_home_url() . "views/errors/$error.php");
  exit;
}

/*
 * This function is used to redirect to a controller and action
 * 
 * Note: The controller name must be in plural and previously created,
 * and the action name must be in singular and previously created
 * 
 * @return string
 * 
 * @example
 * <a href="<?= redirect_to('posts', 'new'); ?>">New Post</a>
 * <a href="<?= redirect_to('posts', 'edit'); ?>&id=1">Edit</a>
 * <form action="<?= redirect_to('posts', 'create'); ?>" method="post">
 */
function redirect_to($controller, $action) {
  return get_home_url() . "views/layouts/application.php?controller=$controller&action=$action";
}

/*
 * This function is used to render a view of a controller
 * 
 * Note: The controller name must be in plural and previously created,
 * and the view name must be in singular and previously created
 * 
 * @return void
 * 
 * @example
 * render('index', 'posts');
 */
function render($action, $controller, $data = []) {
  ob_start();

  get_controller("$controller");
  $controller_name = ucfirst($controller) . 'Controller';
  $controller = new $controller_name($data);
  
  return $controller->$action();
}

/*
 * This function is used to render a link tag
 * 
 * Note: the stylesheet name must be previously created,
 * and the path must be in the resources/stylesheets directory
 * and the file extension must be .css, use the function without the file extension
 * 
 * @return string
 * 
 * @example
 * <?= link_tag('stylesheet', 'main'); ?>
 */
function link_tag($rel, $href) {
  return "<link rel='$rel' href='" . get_home_url() . "resources/stylesheets/$href.css'";
}

/*
 * This function is used to render a script tag
 * 
 * Note: the script name must be previously created,
 * and the path must be in the resources/javascripts directory
 * and the file extension must be .js, use the function without the file extension
 * 
 * @return string
 * 
 * @example
 * <?= script_tag('script'); ?>
 */
function script_tag($src) {
  return "<script src='" . get_home_url() . "resources/js/$src.js'></script>";
}
?>
