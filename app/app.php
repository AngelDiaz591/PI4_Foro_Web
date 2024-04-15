<?php 
namespace app;

use app\classes\Autoloader;
use app\classes\Router;

error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
 * Culturedge class
 * 
 * This class is the entry point of the application
 */
class App {
  /**
   * Constructor initializes the application
   * 
   * @return void
   */
  public function __construct() {
    $this->init();
  }

  /**
   * Create a new instance of the application
   * which will trigger the constructor
   * 
   * @return void
   */
  public static function run() {
    $culturedge = new self();
    
    return;
  }

  /**
   * Load and initialize the necessary components
   * 
   * @return void
   */
  private function init() {
    $this->load_config();
    $this->load_helpers();
    $this->load_autoloader();
    $this->load_routes();
  }

  /**
   * Load the configuration file
   * 
   * @return void
   */
  private function load_config() {
    if (!file_exists(__DIR__ . '/config.php')) {
      die('Configuration file not found');
    }

    require_once __DIR__ . '/config.php';
  }

  /**
   * Load the helper functions
   * 
   * @return void
   */
  private function load_helpers() {
    if (!file_exists(__DIR__ . '/resources/helpers/application_helper.php')) {
      die('Helpers file not found');
    }

    require_once __DIR__ . '/resources/helpers/application_helper.php';
  }

  /**
   * Load the autoloader and call the register method
   * 
   * @return void
   */
  private function load_autoloader() {
    if (!file_exists(CLASSES . 'Autoloader.php')) {
      die('Autoloader file not found');
    }

    require_once CLASSES . 'Autoloader.php';
    Autoloader::register();
    return;
  }

  /**
   * Load the router and dispatch the request
   * 
   * @return void
   */
  private function load_routes() {
    if (!file_exists(CLASSES . 'Router.php')) {
      die('Router file not found');
    }

    require_once CLASSES . 'Router.php';
    $router = new Router();
    $router->dispatch();
  }
}
?>
