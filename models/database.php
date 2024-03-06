<?php

/*
 * This class is used to connect to the database
 */
class Database {
  private $host = "localhost";
  private $dbname = "foroweb";
  private $dbuser = "root";
  private $dbpass = '';

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
      $this->conn = new PDO("pgsql:host=" . $this->host . ";dbname=" . $this->dbname, $this->dbuser, $this->dbpass);
    } catch(PDOException $e) {
      throw new Exception('Connection error: ' . $e->getMessage());
    }

    return $this->conn;
  }
}
?>
