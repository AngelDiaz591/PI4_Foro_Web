<?php
require_once "database.php";

/*
 * This class inherits from the database class and contains the base methods
 * 
 * The model do not have to be called in other file than the controllers
 * This model contains the base methods to be used in the other models
 */
Class Base extends Database {
  private $imagesPath = __DIR__ . "/../assets/imgs/";

/**
 * Check if the connection is null, meaning that it failed to connect to the database
 * 
 * @param void
 * @throws Exception if it fails to connect to the database
 * @return void
 */
  public function check_connection() {
    if ($this->conn === null) {
      throw new Exception("Failed to connect to the database.");
    }
  }

/**
 * Helper method to return a response, use this method to return a response in the other methods
 * It has a default value for the data and message, but both can't be empty
 * 
 * @param bool $status
 * @param array $data
 * @param string $message
 * @throws Exception if the message and the data are empty
 * @return array
 */
  public function response($status, $data = [], $message = '') {
    try {
      if (empty($message) && empty($data)) {
        throw new Exception("The message and the data cannot be empty.");
      }

      return [ "status" => $status, "data" => $data, "message" => $message ];
    } catch (PDOException | Exception $e) {
      throw new Exception("Failed to get the response: " . $e->getMessage());
    }
  }
  
/**
 * Save an image in the database
 * 
 * @param string $from_table, the table name has to be in singular
 * @param int $id, the id where the image will be associated with(e.g. post_id, dm_id, comment_id)
 * @param string $image, the image name
 * @throws PDOException if it fails to execute the query
 * @throws Exception if it fails to save the image
 * @return array
 */
  public function save_image($from_table, $id, $image) {
    try {
      $stmt = $this->conn->prepare("CALL save_image(:table, :id, :image)");
      $stmt->bindParam(":table", $from_table, PDO::PARAM_STR);
      $stmt->bindParam(":id", $id, PDO::PARAM_INT);
      $stmt->bindParam(":image", $image, PDO::PARAM_STR);
      $stmt->execute();

      return $this->response(status: true, message: "Image saved successfully.");
    } catch (PDOException | Exception $e) {
      throw new Exception("Failed to save the image: " . $e->getMessage());
    }
  }

/**
 * Delete an image from the database and get rid of the image from the server
 *  1. initiate a transaction
 *  2. delete the image from the database
 *  3. remove the image from the server
 *  4. if not fails commit the transaction
 *  5. if fails rollback the transaction
 * 
 * @param array $data
 * @throws PDOException if it fails to execute the query
 * @throws Exception if it fails to delete the image or it fails to get rid of the image
 * @return array
 */
  public function delete_image($data) {
    try {

      $this->conn->beginTransaction();

      $stmt = $this->conn->prepare("CALL delete_image(:id)");
      $stmt->bindParam(":id", $data["id"], PDO::PARAM_INT);
      $stmt->execute();

      $response = $this->rid_image($data["image"]);

      if (!$response["status"]) {
        throw new Exception($response["message"]);
      }

      $this->conn->commit();

      return $this->response(status: true, message: "Image deleted successfully.");
    } catch (PDOException | Exception $e) {
      $this->conn->rollBack();

      throw new Exception("Failed to delete the image: " . $e->getMessage());
    }
  }

/**
 * Upload an image to the server
 * 
 * @param array $image
 * @throws Exception if it fails to move the image to the server
 * @return array
 */
  public function upload_image($image) {
    try {
      if (!move_uploaded_file($image['tmp_name'], $this->imagesPath . $image['name'])) {
        throw new Exception("Could not move the image to the server.");
      }

      return $this->response(status: true, data: $image['name'], message: "Image uploaded successfully.");
    } catch (PDOException | Exception $e) {
      throw new Exception("Failed to upload the image: " . $e->getMessage());
    }
  }

/**
 * Get rid of an image from the server
 * 
 * @param string $image
 * @throws Exception if it fails to get rid of the image from the server
 * @return array
 */
  public function rid_image($image) {
    try {
      if (!unlink($this->imagesPath . $image)) {
        throw new Exception("Could not unlink the image from the server.");
      }

      return $this->response(status: true, message: "Image removed successfully.");
    } catch (PDOException | Exception $e) {
      throw new Exception("Failed to get rid of the image: " . $e->getMessage());
    }
  }

/**
 * redirect to an error page. method to be used in the controllers to handle the catched exceptions
 * 
 * @param Exception $e
 * @param string $error
 * @return void
 * 
 * @example
 * handle_exception_redirect_error($e, '404');
 */
  public function handle_exception_redirect_error($e, $error) {
    error_log($e->getMessage());
    redirect_to_error($error);
  }

/**
 * redirect to a controller and action. method to be used in the controllers to handle the catched exceptions
 * 
 * @param Exception $e
 * @param string $controller
 * @param string $action
 * @param array $params
 * @return void
 * 
 * @example
 * handle_exception_redirect_to($e, 'posts', 'new');
 * handle_exception_redirect_to($e, 'posts', 'edit', ['id' => 1]);
 */
  public function handle_exception_redirect_to($e, $controller, $action, $params = []) {
    error_log($e->getMessage());
    $redirection = redirect_to($controller, $action);

    if (!empty($params)) {
      $redirection .= "&" . http_build_query($params);
    }

    header("Location:" . $redirection);
  }
}
?>
