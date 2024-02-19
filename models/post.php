<?php 
require_once "database.php";

/*
 * This class is used to connect to the database and execute the post procedures
 * 
 * @return associative array
 * array( "status" => boolean, "data" => associative array, "message" => string )
 * 
 * The model do not have to be called in other file than the controller
 * Check the controllers/posts_controller.php file to see how to use the model and more details
 * Info: The model file name must be in singular and be in snake case, the class name must be
 * in camel case with the first letter in uppercase and extends the database
 */
class Post extends Database {
  public function __construct() {
    try {
      $this->conn = $this->db_connection();
    } catch (Exception $e) {
      throw new Exception("Failed to connect to the database: " . $e->getMessage());
    }
  }

  public function get_all() {
    try {
      $this->check_connection();
      $stmt = $this->conn->prepare("SELECT * FROM get_all() ORDER BY created_at DESC");
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      return [ "status" => true, "data" => $result ];
    } catch (PDOException $e) {
      throw new Exception("Failed to get all posts: " . $e->getMessage());
    }
  }

  public function get_by_id($id) {
    try {
      $this->check_connection();
      $stmt = $this->conn->prepare("SELECT * FROM get_by_id(:id)");
      $stmt->bindParam(":id", $id, PDO::PARAM_INT);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      return [ "status" => true, "data" => $result ];
    } catch (PDOException $e) {
      throw new Exception("Failed to get the post: " . $e->getMessage());
    }
  }

  public function save($data) {
    try {
      $this->check_connection();
      $stmt = $this->conn->prepare("CALL _save(:title, :description)");
      $stmt->bindParam(":title", $data["title"], PDO::PARAM_STR);
      $stmt->bindParam(":description", $data["description"], PDO::PARAM_STR);
      $stmt->execute();

      return [ "status" => true, "message" => "Post created successfully." ];
    } catch (PDOException $e) {
      throw new Exception("Failed to save the post: " . $e->getMessage());
    }
  }

  public function update($data) {
    try {
      $this->check_connection();
      $stmt = $this->conn->prepare("CALL _update(:id, :title, :description)");
      $stmt->bindParam(":id", $data["id"], PDO::PARAM_INT);
      $stmt->bindParam(":title", $data["title"], PDO::PARAM_STR);
      $stmt->bindParam(":description", $data["description"], PDO::PARAM_STR);
      $stmt->execute();

      return [ "status" => true, "message" => "Post updated successfully." ];
    } catch (PDOException $e) {
      throw new Exception("Failed to update the post: " . $e->getMessage());
    }
  }

  public function destroy($id) {
    try {
      $this->check_connection();
      $stmt = $this->conn->prepare("CALL _delete(:id)");
      $stmt->bindParam(":id", $id, PDO::PARAM_INT);
      $stmt->execute();

      return [ "status" => true, "message" => "Post deleted successfully." ];
    } catch (PDOException $e) {
      throw new Exception("Failed to delete the post: " . $e->getMessage());
    }
  }

  private function check_connection() {
    if ($this->conn === null) {
      throw new Exception("Failed to connect to the database.");
    }
  }
}

?>
