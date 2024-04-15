<?php
namespace app\classes;

use Mysqli;

/**
 * DataBase class
 * 
 * This class is responsible for handling database
 * connections
 */
class DataBase {
  private $db_host;
  private $db_user;
  private $db_pass;
  private $db_name;
  
  private $conn;
  
  private $table;

  public $select = ' * ';
  public $where = ' 1 ';

  /**
   * Constructor, set the database connection
   * 
   * @return void
   */
  public function __construct($host = DB_HOST, $user = DB_USER, $pass = DB_PASS, $name = DB_NAME) {
    $this->db_host = $host;
    $this->db_user = $user;
    $this->db_pass = $pass;
    $this->db_name = $name;

    $this->connect();
  }

  /**
   * Connect to the database
   * 
   * @return Mysqli $conn
   */
  private function connect() {
    $this->conn = new Mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);

    if ($this->conn->connect_error) {
      die('Connection failed: ' . $this->conn->connect_error);
    }
    
    $this->conn->set_charset('utf8');
    $this->table = lcfirst(str_replace('app\\models\\', '', get_class($this)));

    return $this->conn;
  }

  public function fetch() {
    $sql = "SELECT $this->select FROM $this->table WHERE $this->where";
    $result = $this->conn->query($sql);

    if ($result->num_rows > 0) {
      return $result->fetch_all(MYSQLI_ASSOC);
    }

    return [];
  }
  
  public function insert($data) {
    $fields = implode(', ', array_keys($data));
    $values = implode("', '", array_values($data));

    $sql = "INSERT INTO $this->table ($fields) VALUES ('$values')";
    $result = $this->conn->query($sql);

    if ($result) {
      return $this->conn->insert_id;
    }

    return false;
  }

  public function update($data) {
    $fields = '';
    foreach ($data as $key => $value) {
      $fields .= "$key = '$value', ";
    }
    $fields = rtrim($fields, ', ');

    $sql = "UPDATE $this->table SET $fields WHERE $this->where";
    $result = $this->conn->query($sql);

    if ($result) {
      return true;
    }

    return false;
  }

  public function delete() {
    $sql = "DELETE FROM $this->table WHERE $this->where";
    $result = $this->conn->query($sql);

    if ($result) {
      return true;
    }

    return false;
  }

  public function select($data = ['*']) {
    $this->select = implode(', ', $data);

    return $this;
  }

  public function where($data = ['1' => '1']) {
    $fields = '';

    foreach ($data as $key => $value) {
      $fields .= "$key = '$value' AND ";
    }
    $this->where = rtrim($fields, ' AND ');

    return $this;
  }
}
?>
