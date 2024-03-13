<?php 
require_once "base.php";

/*
 * This class inherits from the base class and contains the calls to the posts procedures
 * 
 * The model do not have to be called in other file than the posts_controller
 * Info: The model file name must be in singular and be in snake case, the class name must be
 *       in camel case with the first letter in uppercase and inherits the base class
 */
class Code extends Base {
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
    public function verifyCode($email, $code) {
        try {
            $stmt = $this->conn->prepare("CALL verifyUserCode(:email, :code)");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':code', $code, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['message'];
        } catch (Exception $e) {
            session_start();
            $_SESSION['error'] = $e->getMessage();
            $_SESSION['redirect_to_code'] = true; // Establecer la bandera
            $_SESSION['page_status'] = 'error'; // Agregar esta línea
            header("Location: ../Verify/code.php");
            exit();
        }
    }
    
    

}
?>
