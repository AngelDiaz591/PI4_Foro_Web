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
  public function all() {
    try {
      $stmt = $this->conn->prepare("CALL get_all_posts()");
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      foreach($result as &$post) {
        $stmt = $this->conn->prepare("CALL get_images_by_post_id(:id)");
        $stmt->bindParam(":id", $post["id"], PDO::PARAM_INT);
        $stmt->execute();
        $post["images"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
      }

      return $this->response(status: true, data: $result, message: "Posts retrieved successfully.");
    } catch (PDOException | Exception $e) {
      throw new Exception("Failed to get all posts: " . $e->getMessage());
    }
  }

/**
 * Get a post by id and each image
 * 
 * @param int $id
 * @throws PDOException if it fails to execute the query
 * @throws Exception if it fails to get the post
 * @return array
 */
  public function find_by_id($id) {
        try {
      $stmt = $this->conn->prepare("CALL get_post_by_id(:id)");
      $stmt->bindParam(":id", $id, PDO::PARAM_INT);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      $stmt = $this->conn->prepare("CALL get_images_by_post_id(:id)");
      $stmt->bindParam(":id", $id, PDO::PARAM_INT);
      $stmt->execute();
      $result["images"] = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $stmt = $this->conn->prepare("CALL get_comments_by_post_id(:id)");
      $stmt->bindParam(":id", $id, PDO::PARAM_INT);
      $stmt->execute();
      $result["comments"] = $stmt->fetchAll(PDO::FETCH_ASSOC);

      return $this->response(status: true, data: $result);
    } catch (PDOException | Exception $e) {
      throw new Exception("Failed to get the post: " . $e->getMessage());
    }
  }

/**
 * Save a post and each image
 *  1. upload the images to the server and get the names
 *  2. initialize a transaction to save the post and each image to the database
 *  3. save the post and get the id
 *  4. save each image with the post id
 *  5. if not fails commit the transaction
 *  6. if fails rollback the transaction and get rid of each image from the server
 * 
 * @param array $data
 * @throws PDOException if it fails to execute the query
 * @throws Exception if it fails to save the post, it fails to save the image or it fails to upload the image
 * @return array
 */
  public function save($data) {
    try {

      $uploadedImages = [];
      foreach($data['images'] as $image) {
        $response = $this->upload_image($image);
        $uploadedImages[] = $response['data'];
      }

      $this->conn->beginTransaction();

      $stmt = $this->conn->prepare("CALL save_post(:title, :description, @inserted_id)");
      $stmt->bindParam(":title", $data["title"], PDO::PARAM_STR);
      $stmt->bindParam(":description", $data["description"], PDO::PARAM_STR);
      $stmt->execute();
      $stmt = $this->conn->prepare("SELECT @inserted_id");
      $stmt->execute();
      $post_id = $stmt->fetch(PDO::FETCH_ASSOC)['@inserted_id'];

      foreach($uploadedImages as $image) {
        $this->save_image('post', $post_id, $image);
      }

      $this->conn->commit();

      return $this->response(status: true, message: "Post saved successfully.");
    } catch (PDOException | Exception $e) {
      $this->conn->rollBack();

      foreach($uploadedImages as $image) {
        $this->rid_image($image);
      }

      throw new Exception("Failed to save the post: " . $e->getMessage());
    }
  }

/**
 * Update a post or add new images to the post
 *  1. upload the images to the server and get the names
 *  2. initialize a transaction
 *  3. update the post
 *  4. save each image with the post id
 *  5. if not fails commit the transaction
 *  6. if fails rollback the transaction and get rid of each image from the server
 * 
 * @param array $data
 * @throws PDOException if it fails to execute the query
 * @throws Exception if it fails to update the post, it fails to upload the image or it fails to save the image
 * @return array
 */
  public function update($data) {
    try {

      $uploadedImages = [];
      foreach($data['images'] as $image) {
        $response = $this->upload_image($image);
        $uploadedImages[] = $response['data'];
      }

      $this->conn->beginTransaction();

      $stmt = $this->conn->prepare("CALL update_post(:id, :title, :description)");
      $stmt->bindParam(":id", $data["id"], PDO::PARAM_INT);
      $stmt->bindParam(":title", $data["title"], PDO::PARAM_STR);
      $stmt->bindParam(":description", $data["description"], PDO::PARAM_STR);
      $stmt->execute();

      foreach($uploadedImages as $image) {
        $this->save_image('post', $data["id"], $image);
      }

      $this->conn->commit();

      return $this->response(status: true, message: "Post updated successfully.");
    } catch (PDOException | Exception $e) {
      $this->conn->rollBack();

      foreach($uploadedImages as $image) {
        $this->rid_image($image);
      }

      throw new Exception("Failed to update the post: " . $e->getMessage());
    }
  }

/**
 * Delete a post and each image
 *  1. initialize a transaction
 *  2. get the images by post id
 *  3. delete the post
 *  4. get rid of each image from the server
 *  5. if not fails commit the transaction
 *  6. if fails rollback the transaction
 * 
 * @param int $id
 * @throws PDOException if it fails to execute the query
 * @throws Exception if it fails to delete the post or it fails to get rid of each image
 * @return array
 */
  public function destroy($id) {
    try {

      $this->conn->beginTransaction();
      
      $stmt = $this->conn->prepare("CALL get_images_by_post_id(:id)");
      $stmt->bindParam(":id", $id, PDO::PARAM_INT);
      $stmt->execute();
      $images = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $stmt = $this->conn->prepare("CALL delete_post(:id)");
      $stmt->bindParam(":id", $id, PDO::PARAM_INT);
      $stmt->execute();


      foreach($images as $image) {
        $this->rid_image($image["image"]);
      }

      $this->conn->commit();

      return $this->response(status: true, message: "Post deleted successfully.");
    } catch (PDOException | Exception $e) {
      $this->conn->rollBack();

      throw new Exception("Failed to delete the post: " . $e->getMessage());
    }
  }
  /**
 * Create comment father for the post
 * @param array $data
 * @throws PDOException if it fails to execute the query
 * @throws Exception if it fails to delete the post or it fails to get rid of each image
 * @return array
 * :user_id, :post_id
 */
  public function comment_father($data){
    #error_log(json_encode($data));
    try{
      $stmt = $this->conn->prepare("CALL create_comment(:user_id, :post_id, :comment)");
      $stmt->bindparam(":user_id", $data["user_id"], PDO::PARAM_INT);      
      $stmt->bindparam(":post_id", $data["post_id"], PDO::PARAM_INT);  
      $stmt->bindparam(":comment", $data["comment"], PDO::PARAM_STR);  
      $stmt->execute();
    }catch (PDOException | Exception $e) {
      throw new Exception("Failed to save the comment " . $e->getMessage());
    }
  }
}
?>
