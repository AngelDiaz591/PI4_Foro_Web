<?php

/*
 * This class is used to connect to the database
 */
class Database {
  private $host = "localhost";
  private $dbname = "foroweb";
  private $dbuser = "angel";
  private $dbpass = 'angel2004';

  public $conn;

/**
 * The constructor is used to connect to the database
 * 
 * @param void
 * @throws Exception if it fails to connect to the database
 * @return PDO object
 */
  public function db_connection() {
    $this->conn = null;

    try {
      $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->dbuser, $this->dbpass);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->conn->exec("SET time_zone = '+00:00'");
    } catch(PDOException | Exception $e) {
      throw new Exception('Connection error: ' . $e->getMessage());
    }

    return $this->conn;
  }
}
?>
