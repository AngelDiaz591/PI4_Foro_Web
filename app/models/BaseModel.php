<?php
namespace app\models;

use app\classes\DataBase;

/**
 * BaseModel class
 * 
 * This class is the base model class
 */
class BaseModel extends DataBase {
  public function __construct() {
    parent::__construct();
  }
}
?>
