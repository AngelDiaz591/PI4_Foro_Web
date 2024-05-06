<?php

/*
 * This class is used to connect to the database
 */
class Database {
  private $host = HOST_DB;
  private $dbname = NAME_DB;
  private $dbuser = USER_DB;
  private $dbpass = PASS_DB;
  
  private $s = ' * ';
  private $j = '';
  private $lj = '';
  private $w = ' 1 ';
  private $g = '';
  private $o = '';
  private $l = '';
  
  public $conn;

  protected $t;
  protected $pp;

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

  public function all(){
    return $this;
  }

  public function select($cc = []) {
    if (count($cc) > 0) {
      $this->s = implode(", ", $cc);
    }

    return $this;
  }

  public function join($jj = '', $on = '') {
    if ($jj != '' && $on != '') {
      $this->j .= " JOIN $jj ON $on";
    }

    return $this;
  }

  public function left_join($jj = '', $on = '') {
    if ($jj != '' && $on != '') {
      $this->lj .= " LEFT JOIN $jj ON $on";
    }

    return $this;
  }

  public function where($ww = []) {
    $this->w = '';

    if (count($ww) > 0) {
      foreach ($ww as $where) {
        $this->w .= "$where[0] $where[1] '$where[2]' AND ";
      }
    }

    $this->w .= ' 1 ';

    $this->w = '(' . $this->w . ')';

    return $this;
  }

  public function group_by($gg = '') {
    $this->g = '';

    if ($gg != '') {
      $this->g = "GROUP BY $gg";
    }

    return $this;
  }

  public function order_by($ob = []) {
    $this->o = '';

    if (count($ob) > 0) {
      foreach ($ob as $order) {
        $this->o .= "$order[0] $order[1],";
      }
      $this->o = 'ORDER BY ' . rtrim($this->o, ','); 
    }

    return $this;
  }

  public function limit($l = '') {
    $this->l = '';

    if ($l != '') {
      $this->l = "LIMIT $l";
    }

    return $this;
  }

  public function first() {
    $table = $this->t;

    if ($this->lj != '' || $this->j != '') {
      $table = "$this->t a";
    }

    $sql = "SELECT $this->s FROM $table $this->j $this->lj WHERE $this->w $this->g $this->o $this->l";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $data;
  }

  public function get() {
    $table = $this->t;

    if ($this->lj != '' || $this->j != '') {
      $table = "$this->t a";
    }

    $sql = "SELECT $this->s FROM $table $this->j $this->lj WHERE $this->w $this->g $this->o $this->l";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $data;
  }

  public function insert($values = [], $returnId = true) {
    $attributes = implode(", ", $this->pp);
    $values = $this->sortValuesWithPp($values);
    $values = $this->AssocToArr($values);
    $valuesBinded = trim(str_replace('&', '?, ', str_pad("", count($values), "&")), ', ');

    $sql = "INSERT INTO $this->t ($attributes) VALUES ($valuesBinded)";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute($values);
    
    if ($returnId) {
      return $this->conn->lastInsertId();
    }

    return $stmt->rowCount();
  }

  public function delete() {
    $sql = "DELETE FROM $this->t WHERE $this->w";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();

    return $stmt->rowCount();
  }

  private function sortValuesWithPp($values = []) {
    $sorted = [];

    foreach ($this->pp as $p) {
      $sorted[$p] = $values[$p];
    }

    return $sorted;
  }

  private function AssocToArr($data) {
    $arr = [];

    foreach ($data as $key => $value) {
      $arr[] = $value;
    }

    return $arr;
  }
}
?>
