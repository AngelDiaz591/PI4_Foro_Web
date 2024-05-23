<?php 
require_once "base.php";

/*
 * This class inherits from the base class and contains the calls to the posts procedures
 * 
 * The model do not have to be called in other file than the posts_controller
 * Info: The model file name must be in singular and be in snake case, the class name must be
 *       in camel case with the first letter in uppercase and inherits the base class
 */
class Admin extends Base {

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

    
    
    
}
?>
