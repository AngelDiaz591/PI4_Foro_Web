<?php 
require_once "base.php";

class Admin extends Base {

    public function __construct() {
        try {
            $this->conn = $this->db_connection();
            $this->check_connection();
        } catch (PDOException | Exception $e) {
            throw new Exception("Failed to connect to the database: " . $e->getMessage());
        }
    }

    public function all_users() {
        try {
            $this->t = 'users';
    
            $result = $this->select([
                'id',
                'username',
                'ban',
                'rol'
            ])->group_by('id, username', 'ban', 'rol')
            ->order_by([
                ['created_at', 'DESC']
            ])->get();
            return $this->response(status: true, data: $result, message: "Users retrieved successfully.");
        } catch (PDOException | Exception $e) {
            throw new Exception("Failed to get all users: " . $e->getMessage());
        }
    }

    
    public function ban($userId) {
        try {
            $stmt = $this->conn->prepare("CALL BanUser(:id)");
            $stmt->bindparam(":id", $userId, PDO::PARAM_INT);  
            $stmt->execute();

            return ["status" => true, "message" => "User banned successfully"];
        } catch (PDOException | Exception $e) {

            throw new Exception("Failed to ban the user: " . $e->getMessage());
        }
    }
    
    public function unban($userId) {
        try {
            $stmt = $this->conn->prepare("CALL UnbanUser(:id)");
            $stmt->bindparam(":id", $userId, PDO::PARAM_INT);  
            $stmt->execute();

            return ["status" => true, "message" => "User banned successfully"];
        } catch (PDOException | Exception $e) {

            throw new Exception("Failed to ban the user: " . $e->getMessage());
        }
    }

   public function user_info_delete($userId) {
        try {
            $stmt = $this->conn->prepare("CALL DeleteUser(:id)");
            $stmt->bindparam(":id", $userId, PDO::PARAM_INT);  
            $stmt->execute();

            return ["status" => true, "message" => "User banned successfully"];
        } catch (PDOException | Exception $e) {

            throw new Exception("Failed to ban the user: " . $e->getMessage());
        }
    }

    
    
}
?>
