<?php 
namespace app\controllers;

use app\classes\View;

/**
 * ErrorController class
 * 
 * This class is responsible for handling errors
 */
class ErrorController extends BaseController {
  /**
   * Constructor
   * 
   * @return void
   */
  public function __construct() {
    parent::__construct();
  }

  /**
   * Render a 404 error page
   * 
   * @param array $params
   * 
   * @return void
   */
  public function err404($params = null) {
    $response = [
      'title' => 'Error',
      'code' => 404,
    ];

    View::render($this->view_dir_name(), '404', $response);
  }
}
?>
