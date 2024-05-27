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

    public function all_topics() {
        try {
            $this->t = 'unesco';
    
            $result = $this->select([
                'id',
                'theme',
                'icon',
                'created_at'
            ])->group_by('id, theme', 'created_at', 'icon')
            ->order_by([
                ['created_at', 'DESC']
            ])->get();
            return $this->response(status: true, data: $result, message: "Themes retrieved successfully.");
        } catch (PDOException | Exception $e) {
            throw new Exception("Failed to get all themes: " . $e->getMessage());
        }
    }
    
    public function rejected_post($id, $reason) {
        try {
            $this->t = 'posts';
            $this->pp = ['reason', 'permission'];
            $whereConditions = [
                ['id', '=', $id]
            ];
            $values = [
                'reason' => $reason,
                'permission' => "2"
            ];
            $result = $this->where($whereConditions)->update($values);
            return $result;
        } catch (PDOException | Exception $e) {
            throw new Exception("Failed to update reason: " . $e->getMessage());
        }
    }
    
    public function accepted_post($id) {
        try {
            $this->t = 'posts';
            $this->pp = ['permission'];
            $whereConditions = [
                ['id', '=', $id]
            ];
            $values = [
                'permission' => "3"
            ];
            $result = $this->where($whereConditions)->update($values);
            return $result;
        } catch (PDOException | Exception $e) {
            throw new Exception("Failed to update reason: " . $e->getMessage());
        }
    }
    
    
      
    
}
?>
