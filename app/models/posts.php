<?php 
namespace app\models;

use app\models\BaseModel;

class Posts extends BaseModel {
  public $values;

  public function __construct() {
    parent::__construct();
  }

  public function all() {
    $result = $this->select()->where()->fetch();

    return $result;
  }

  public function find($params) {
    $this->values = $params;
    $result = $this->select()->where($this->values)->fetch();

    return $result;
  }

  public function save($params) {
    $this->values = $params;
    $result = $this->insert($this->values);

    return $result;
  }

  public function patch($params) {
    $this->values = $params;
    $id = $this->pop_key('id');
    $result = $this->where(['id' => $id])->update($this->values);

    return $result;
  }

  public function destroy($params) {
    $this->values = $params;
    $id = $this->pop_key('id');
    $result = $this->where(['id' => $id])->delete();

    return $result;
  }

  public function pop_key($key) {
    $id = $this->values[$key];
    unset($this->values[$key]);

    return $id;
  }
}
?>
