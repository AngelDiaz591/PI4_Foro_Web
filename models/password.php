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

     public function changepasswordcode($data) {
        $Code_and_email1 = new Code_and_email();
        try {
            // Prepare the query to find the user by their email
            $stmt = $this->conn->prepare("SELECT * FROM usertable WHERE email = :email");
            $stmt->bindParam(":email", $data["email"], PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            // Check if a user was found with the given email
            if ($user === null) {
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
            session_start();
             $_SESSION['email'] = $email;
             header("Location: ../Verify/code.php");
             execute();
        } catch (Exception $e) {
            session_start();
            $_SESSION['error'] = $e->getMessage();
            header("Location: ../ForgotPassword/email.php");
            exit();
        }
    }
    
    public function changepassword($data) {
        try {
            // Verify if the passwords match
            if ($data['newpassword'] !== $data['cpassword']) {
                throw new Exception("Passwords do not match");
            }
    
            // Call the stored procedure to get the current password
            $stmt = $this->conn->prepare("CALL GetPasswordByEmail(:email, @currentPassword)");
            $stmt->bindParam(':email', $data['email'], PDO::PARAM_STR);
            $stmt->execute();
    
            // Get the current password from the output variable of the stored procedure
            $stmt = $this->conn->prepare("SELECT @currentPassword AS current_password");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $currentPassword = $result['current_password'];
    
            // Verify if the current password was retrieved correctly
            if (empty($currentPassword)) {
                throw new Exception("Failed to retrieve current password");
            }
    
            // Hash the new password before comparing
            $newPasswordHashed = password_hash($data['newpassword'], PASSWORD_DEFAULT);
    
            // Check if the new password is the same as the current password
            if (password_verify($data['newpassword'], $currentPassword)) {
                session_start();
                $_SESSION['error_message'] = "The new password you entered is the same as your current password";
                header("Location: ../login/login.php");
                exit();
            }
    
            // If the new password is different from the current password, hash it and update
            $encryptedPassword = password_hash($data["newpassword"], PASSWORD_DEFAULT);
    
            // Call the stored procedure to update the password
            $stmt = $this->conn->prepare("CALL UpdatePasswordByEmail(:email, :newPassword)");
            $stmt->bindParam(':email', $data['email'], PDO::PARAM_STR);
            $stmt->bindParam(':newPassword', $encryptedPassword, PDO::PARAM_STR);
            $stmt->execute();
    
            // Success message and redirection
            session_start();
            $_SESSION['success'] = "Password changed successfully";
            echo "<script>alert('Password changed successfully');</script>";
            header("Location: ../login/login.php");
            exit();
        } catch (Exception $e) {
            session_start();
            $_SESSION['error'] = $e->getMessage();
            $_SESSION['redirect_to_code'] = true; // Set the flag
            $_SESSION['page_status'] = 'error'; // Add this line
            header("Location: ../ForgotPassword/changepassword.php");
            exit();
        }
    }
}

?>
