<?php 
require_once "base.php";

/*
 * This class inherits from the base class and contains the calls to the posts procedures
 * 
 * The model do not have to be called in other file than the posts_controller
 * Info: The model file name must be in singular and be in snake case, the class name must be
 *       in camel case with the first letter in uppercase and inherits the base class
 */
class Session extends Base {
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
            // Prepare the query to find the user by their email
            $stmt = $this->conn->prepare("SELECT * FROM usertable WHERE email = :email");
            $stmt->bindParam(":email", $data["email"], PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            // Check if a user was found with the given email
            if (!$user) {
                throw new Exception("User not found");
            }
            // Check if the provided password matches the stored password
            if (!password_verify($data["password"], $user["password"])) {
                throw new Exception("Incorrect password");
            }
            // Check the status of the user
            if ($user['status'] === 'notverified') {
                // If the user is not verified, store the email in the session and redirect to the verification page
                session_start();
                $_SESSION['error'] = "Please verify your email address to proceed.";
                $_SESSION['email'] = $user['email']; // Almacena el email en la sesión
                header("Location: ../Verify/code.php");
                exit();
            }
            // Password matches and user is verified, successfully log in
            // Start the session and store the user's email in a session variable
            session_start();
            $_SESSION['email'] = $user['email'];
            return $user; // Return all the information of the found user
        } catch (Exception $e) {
            session_start();
            $_SESSION['error'] = $e->getMessage();
            // Redirect the user to the login page with the error message as a GET parameter
            header("Location: ../login/login.php");
            exit();
        }
    }
    
}
?>
