<?php 
namespace app\classes;

/**
 * Autoloader class
 * 
 * This class is responsible for loading
 * classes automatically
 */
class Autoloader {
  /**
   * Register the autoloader method as a
   * PHP autoloader
   * 
   * @return void
   */
  public static function register() {
    spl_autoload_register([__CLASS__, 'autoload']);
  }

  /**
   * It is called by PHP whenever an attempt
   * is made to instantiate a class that has
   * not been loaded yet
   * 
   * @param string $class
   * @return void
   */
  public static function autoload($class) {
    $classname = PARENT_ROOT . str_replace('\\', DS, $class) . '.php';

    if (file_exists($classname)) {
      require_once $classname;
    } else {
      die('Class ' . $class . ' not found');
    }

    return;
  }
}
?>
