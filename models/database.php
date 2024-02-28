<?php 
class Database {
  private $host = "localhost";
  private $dbname = "foroweb";
  private $dbuser = "root";
  private $dbpass = '';

  public $conn;

  public function db_connection() {
    $this->conn = null;

    try {
      // $this->conn = new PDO("pgsql:host=" . $this->host . ";dbname=" . $this->dbname, $this->dbuser, $this->dbpass); // For PostgreSQL
      $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->dbuser, $this->dbpass); // For MySQL
    } catch(PDOException | Exception $e) {
      throw new Exception('Connection error: ' . $e->getMessage());
    }

    return $this->conn;
  }
}
?>
