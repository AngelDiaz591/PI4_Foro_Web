<?php 
require_once "base.php";
/*
 * This class inherits from the base class and contains the calls to the posts procedures
 * 
 * The model do not have to be called in other file than the posts_controller
 * Info: The model file name must be in singular and be in snake case, the class name must be
 *       in camel case with the first letter in uppercase and inherits the base class
 * 
 */
class User extends Base {
/**
 * The constructor is used to connect to the database
 * 
 * @param void
 * @throws Exception if it fails to connect to the database
 * @return void
 */
    public function __construct() {
        try {
            $this->conn = $this->db_connection();
        } catch (Exception $e) {
            throw new Exception("Failed to connect to the database: " . $e->getMessage());
        }
    }

/**
 * Get all the posts in the database and each image by post
 * 
 * @param void
 * @throws PDOException if it fails to execute the query
 * @throws Exception if it fails to get all posts
 * @return array
 */
public function save($data) {
    try {
        // Verificar si las contraseñas coinciden
        if ($data['password'] !== $data['cpassword']) {
            throw new Exception("Passwords do not match");
        }

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
        // Redirigir al usuario a registro.php con el mensaje de error como parámetro GET
        header("Location: ../RegistroUsers/registro.php?error=" . urlencode($e->getMessage()));
        exit();
    }
}


}
?>
