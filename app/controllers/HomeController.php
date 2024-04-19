<?php 
namespace app\controllers;

use app\classes\View;

/**
 * HomeController class
 * 
 * This class is responsible for handling the home page
 */
class HomeController extends BaseController {
  public function __construct() {
    parent::__construct();
  }

  /**
   * Render the home page
   * 
   * @param array $params
   * 
   * @return void
   */
  public function index($params = null) {
    $response = [
      'title' => 'Home',
      'code' => 200,
    ];

    View::render($this->view_dir_name(), 'home', $response);
  }
}

?>
