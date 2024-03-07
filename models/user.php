<?php 
require_once "database.php";

class User extends Database {
    public function __construct() {
        try {
            $this->conn = $this->db_connection();
        } catch (Exception $e) {
            throw new Exception("Failed to connect to the database: " . $e->getMessage());
        }
    }

    public function saveUser($data) {
      try {
          // Encriptar la contraseña
          $encryptedPassword = password_hash($data["password"], PASSWORD_DEFAULT);
          
          // Preparar la consulta para guardar el usuario
          $stmt = $this->conn->prepare("CALL save_user(:name, :email, :password)");
          $stmt->bindParam(":name", $data["name"], PDO::PARAM_STR);
          $stmt->bindParam(":email", $data["email"], PDO::PARAM_STR);
          $stmt->bindParam(":password", $encryptedPassword, PDO::PARAM_STR);
          
          // Ejecutar la consulta
          if ($stmt->execute()) {
              // La consulta se ejecutó correctamente
              return true;
          } else {
              // La consulta falló
              throw new Exception("Failed to save user: Database error");
          }
      } catch (Exception $e) {
          // Manejar cualquier excepción que se produzca
          error_log("Error saving user: " . $e->getMessage());
          return false;
      }
  }
  
    
  
  private function check_connection() {
    if ($this->conn === null) {
      throw new Exception("Failed to connect to the database.");
    }
  }
}
?>
