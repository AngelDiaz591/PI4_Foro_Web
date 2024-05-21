<?php
require_once "base.php";

class Unesco extends Base {
  public function __construct() {
    try {
      $this->conn = $this->db_connection();
      $this->check_connection();
    } catch (PDOException | Exception $e) {
      // throw new Exception("Failed to connect to the database: " . $e->getMessage());
      echo $this->error('500');
      exit;
    }
  }

  public function get_all($limit = 5) {
    try {
      $this->t = 'unesco';
      $response = $this->limit($limit)->get();

      if (empty($response)) {
        throw new Exception("No UNESCO themes found.");
      }

      $r = $this->response(status: true, data: $response, message: "UNESCO themes retrieved successfully.");

      return json_encode($r);
    } catch (PDOException | Exception $e) {
      $r = $this->response(status: false, message: "Failed to retrieve UNESCO themes: " . $e->getMessage());

      throw new Exception(json_encode($r));
    }
  }

  public function get_by_id($id) {
    try {
      $this->t = 'unesco';
      $response = $this->select()->where([['id', '=', $id]])->first();

      if (empty($response)) {
        throw new Exception("UNESCO theme not found.");
      }

      $r = $this->response(status: true, data: $response, message: "UNESCO theme retrieved successfully.");

      return json_encode($r);
    } catch (PDOException | Exception $e) {
      $r = $this->response(status: false, message: "Failed to retrieve the UNESCO theme: " . $e->getMessage());

      throw new Exception(json_encode($r));
    }
  }
}
?>
