<?php 
require_once "base.php";

/*
 * This class inherits from the base class and contains the calls to the posts procedures
 * 
 * The model do not have to be called in other file than the posts_controller
 * Info: The model file name must be in singular and be in snake case, the class name must be
 *       in camel case with the first letter in uppercase and inherits the base class
 */
class Post extends Base {

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
      $this->check_connection();
    } catch (PDOException | Exception $e) {
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
public function login($data) {
    try {
        // Preparar la consulta para buscar al usuario por su correo electrónico
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(":email", $data["email"], PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si se encontró un usuario con el correo electrónico dado
        if ($user) {
            // Verificar si la contraseña proporcionada coincide con la contraseña almacenada
            if (password_verify($data["password"], $user["password"])) {
                // La contraseña coincide, iniciar sesión correctamente
                return true;
            } else {
                // La contraseña no coincide, redirigir con un mensaje de error
                throw new Exception("Incorrect password");
            }
        } else {
            // No se encontró ningún usuario con el correo electrónico dado, redirigir con un mensaje de error
            throw new Exception("User not found");
        }
    } catch (Exception $e) {
        // Redirigir al usuario a la página de inicio de sesión con el mensaje de error como parámetro GET
        header("Location: ../login/login.php?error=" . urlencode($e->getMessage()));
        exit();
    }
}

}