<?php 
require_once "base.php";
require_once "../../class/users/class_php.php";

/*
 * This class inherits from the base class and contains the calls to the posts procedures
 * 
 * The model do not have to be called in other file than the posts_controller
 * Info: The model file name must be in singular and be in snake case, the class name must be
 *       in camel case with the first letter in uppercase and inherits the base class
 */
class Password extends Base {
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

    public function changepassword($data) {
        $Code_and_email1 = new Code_and_email();
        try {
            // Prepare the query to find the user by their email
            $stmt = $this->conn->prepare("SELECT * FROM usertable WHERE email = :email");
            $stmt->bindParam(":email", $data["email"], PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Check if a user was found with the given email
            if (!$user) {
                throw new Exception("User not found");
            }
            
            // Generate a random code
            $coderandom = $Code_and_email1->Generate_Code(6);
            $data["code"] = $coderandom;
    
            // Call the stored procedure to update the code
            $stmt = $this->conn->prepare("CALL code_update(:email, :code)");
            $stmt->bindParam(":email", $data["email"], PDO::PARAM_STR);
            $stmt->bindParam(":code", $data["code"], PDO::PARAM_STR);
            $stmt->execute();
            
            $email = $data["email"];
            $success = $Code_and_email1->send_code_password($email, $coderandom);
    
            // Start the session and store the user's email in a session variable
            session_start();
            $_SESSION['email'] = $user['email'];
            return $user; // Return all the information of the found user
        } catch (Exception $e) {
            session_start();
            $_SESSION['error'] = $e->getMessage();
            // Redirect the user to the login page with the error message as a GET parameter
            header("Location: ../ForgotPassword/email.php");
            exit();
        }
    }
    
    
    
}
?>
