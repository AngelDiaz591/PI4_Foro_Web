<?php 
class Database {
  private $host = "localhost";
  private $dbname = "foroweb";
  private $dbuser = "root";
  private $dbpass = "1234";

  public $conn;

  public function db_connection() {
    $this->conn = null;

    try {
      $this->conn = new PDO("pgsql:host=" . $this->host . ";dbname=" . $this->dbname, $this->dbuser, $this->dbpass);
    } catch(PDOException $e) {
      throw new Exception('Connection error: ' . $e->getMessage());
    }

    return $this->conn;
  }
}
?>
