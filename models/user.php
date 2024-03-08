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
        if ($data['password'] !== $data['cpassword']) {
            throw new Exception("Passwords do not match");
        }
        $encryptedPassword = password_hash($data["password"], PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("CALL save_user(:name, :email, :password)");
        $stmt->bindParam(":name", $data["name"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $data["email"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $encryptedPassword, PDO::PARAM_STR);
        if (!$stmt->execute()) {
            throw new Exception("Failed to save user: Database error");
        }
        return true;
    } // En tu modelo
    catch (PDOException $e) {
        session_start();
        $errorMessage = $e->getCode() == 23000 && strpos($e->getMessage(), '1062') !== false
            ? (strpos($e->getMessage(), 'name') !== false
                ? "Username already exists."
                : "Email already exists.")
            : $e->getMessage();
        $_SESSION['error'] = $errorMessage;
        header("Location: ../RegistroUsers/registro.php");
        exit();
    } catch (Exception $e) {
        session_start();
        $_SESSION['error'] = $e->getMessage();
        header("Location: ../RegistroUsers/registro.php");
        exit();
    }
}
}
?>
