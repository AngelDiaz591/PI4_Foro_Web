-- PROCEDURES IN MYSQL FOR POSTS
DROP PROCEDURE IF EXISTS save_post;
DELIMITER $$
CREATE PROCEDURE save_post(
  p_title TEXT,
  p_description TEXT,
  OUT inserted_id INT
)
BEGIN
  INSERT INTO posts (title, description)
  VALUES (p_title, p_description);
  SET inserted_id = LAST_INSERT_ID();
END $$
DELIMITER ;
-- call as: CALL save_post('title', 'description');

DROP PROCEDURE IF EXISTS update_post;
DELIMITER $$
CREATE PROCEDURE update_post(
  p_id INT,
  p_title TEXT,
  p_description TEXT
)
BEGIN
  UPDATE posts
  SET title = p_title, description = p_description
  WHERE posts.id = p_id;
END $$
DELIMITER ;
-- call as: CALL update_post(1, 'title', 'description');

DROP PROCEDURE IF EXISTS delete_post;
DELIMITER $$
CREATE PROCEDURE delete_post(
  p_id INT
)
BEGIN
  DELETE FROM posts
  WHERE posts.id = p_id;
END $$
DELIMITER ;
-- call as: CALL delete_post(1);

DROP PROCEDURE IF EXISTS get_all_posts;
DELIMITER $$
CREATE PROCEDURE get_all_posts()
BEGIN
  SELECT * FROM posts;
END
$$
DELIMITER ;
-- call as: CALL get_all_posts();

DROP PROCEDURE IF EXISTS get_post_by_id;
DELIMITER $$
CREATE PROCEDURE get_post_by_id(
  p_id INT
)
BEGIN
  SELECT * FROM posts
  WHERE posts.id = p_id;
END
$$
DELIMITER ;
-- call as: CALL get_post_by_id(1);

DROP PROCEDURE IF EXISTS get_images_by_post_id;
DELIMITER $$
CREATE PROCEDURE get_images_by_post_id(
  p_id INT
)
BEGIN
  SELECT * FROM images
  WHERE images.post_id = p_id;
END
$$
DELIMITER ;
-- call as: CALL get_images_by_post_id(1);

