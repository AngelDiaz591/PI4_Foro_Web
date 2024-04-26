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
 * Check the images and return an array with the images data such as name and tmp_name
 * 
 * @param array $images, $_FILES['images']
 * @return array
 */
  public function check_images($images) {
    try {
      $images_array = [];
      
      foreach ($images["name"] as $key => $name) {
        $image_error = $images["error"][$key];

        if ($image_error === 4) {
          continue;
        }

        $image_name = $this->rename_image($name);
        $image_tmp_name = $images["tmp_name"][$key];
        $image_size = $images["size"][$key];
        $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
        $image_allowed_extensions = ["jpg", "jpeg", "png", "gif"];

        if ($image_error !== 0) {
          throw new Exception("The image " . $image_name . ", has an error. Error code: " . $image_error);
        }

        if ($image_size > 2000000) {
          throw new Exception("The image " . $image_name . ", exceeds the maximum size allowed of 1MB.");
        }

        if (!in_array($image_extension, $image_allowed_extensions)) {
          throw new Exception("The image " . $image_name . ", has an invalid extension, only jpg, jpeg, png and gif are allowed.");
        }

        $images_array[] = [ "name" => $image_name, "tmp_name" => $image_tmp_name];
      }

      return [ "status" => true, "data" => $images_array ];
    } catch (Exception $e) {
      error_log($e->getMessage());
      throw new Exception("Failed to check the images: " . $e->getMessage());
    }
  }

/**
 * Rename the image
 *  1. Add a random 8 characters token to the name
 *  2. Resize the name to 30 characters
 *  3. Lowercase the name
 *  4. Replace the invalid characters with an underscore, use a regex
 *  5. Remove underscores or hyphens from the end of the name
 *  6. Add the date and time to the name
 * 
 * @param string $image
 * @return string
 */
  public function rename_image($image) {
    $pattern = "/[^a-zA-Z0-9\_\-\.]/";
    $replacement = '_';

    $token = $this->generate_token(8);

    $extension = pathinfo($image, PATHINFO_EXTENSION);
    $name = $token . pathinfo($image, PATHINFO_FILENAME);

    $name_resize = substr($name, 0, 30);
    $name_lower = strtolower($name_resize);
    $name_filtered = preg_replace($pattern, $replacement, $name_lower);
    $new_name = rtrim($name_filtered, "_-");


    return date("Y-m-d_H-i-s") . "_" . $new_name . "." . $extension;
  }


/**
 * Generate a random token
 * 
 * @param int $longitud
 * @return string
 * 
 * By Ismael March 12th, 2024 9:19 PM
 * Modified by Alejandro March 16th, 2024 00:38 AM
 */
  public function generate_token($longitud = 16) {
    return bin2hex(random_bytes($longitud));
  }

/**
 * Render a error view
 * 
 * @param string $view
 * @return html
 */
  protected function error($view) {
    include ROOT_DIR . 'views/errors/' . $view . '.php';

    return ob_get_clean();
  }
}
?>
