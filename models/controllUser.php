<?php 
require_once "database.php";

class ControllUserData extends Database {
    public function __construct() {
        try {
            $this->conn = $this->db_connection();
        } catch (Exception $e) {
            throw new Exception("Failed to connect to the database: " . $e->getMessage());
        }
    }

    public function saveUser($con, $name, $email, $password, $cpassword, $code) {
        try {
            // Verificar si las contraseñas coinciden
            if ($password !== $cpassword) {
                return "Passwords do not match";
            }
    
            // Envío de correo electrónico de verificación
            $subject = "Email Verification Code";
            $message = "Your verification code is: $code";
            $sender = "From: culturedge69@gmail.com";
            if (!mail($email, $subject, $message, $sender)) {
                return "Error sending verification code";
            }
    
            $encpass = mysqli_real_escape_string($con, password_hash($password, PASSWORD_BCRYPT));
            $status = "notverified";
            $user_type = 1;
    
            $query = "CALL _SaveUser('$name', '$email', '$encpass', @p_error_message, '$code')";
            mysqli_query($con, $query);
    
            $result = mysqli_query($con, "SELECT @p_error_message AS p_error_message");
            $row = mysqli_fetch_assoc($result);
            $p_error_message = $row['p_error_message'];
    
            if ($p_error_message !== null) {
                return $p_error_message; 
            } else {
                return true; 
            }
        } catch (mysqli_sql_exception $e) {
            throw $e;
        }
    }
    
  
  private function check_connection() {
    if ($this->conn === null) {
      throw new Exception("Failed to connect to the database.");
    }
  }
}
?>
