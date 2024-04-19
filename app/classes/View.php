<?php
namespace app\classes;

/**
 * View class
 * 
 * This class is responsible for rendering
 * views
 */
class View {
  /**
   * Render a view
   * 
   * @param string $view
   * @param array $response
   * 
   * @return void
   */
  public static function render($controller, $view, $response) {
    $data = as_object($response);

    require_once VIEWS . $controller . $view . '.view.php';
    exit;
  }
}
?>
