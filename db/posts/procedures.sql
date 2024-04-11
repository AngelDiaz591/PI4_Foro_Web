-- PROCEDURES IN MYSQL FOR POSTS
DROP PROCEDURE IF EXISTS save_post;
DELIMITER $$
CREATE PROCEDURE save_post(
  p_user_id INT,
  p_title TEXT,
  p_description TEXT,
  OUT inserted_id INT
)
BEGIN
  INSERT INTO posts (title, description, user_id)
  VALUES (p_title, p_description, p_user_id);
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
  DELETE FROM comments
  WHERE post_id = p_id;
  
  DELETE FROM posts
  WHERE id = p_id;
END $$
DELIMITER ;

-- call as: CALL delete_post(1);
DROP PROCEDURE IF EXISTS get_all_posts;
DELIMITER $$
CREATE PROCEDURE get_all_posts()
BEGIN
  SELECT 
    posts.*,
    users.username AS username,
    users.email AS email
  FROM posts
  INNER JOIN users ON posts.user_id = users.id;
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
  SELECT 
    posts.*,
    users.username AS username
    users.email AS email
  FROM posts
  INNER JOIN users ON posts.user_id = users.id
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
--PROCEDURE IN MYSQL FOR COMMENTS
DROP PROCEDURE IF EXISTS create_comment;
DELIMITER $$
CREATE PROCEDURE create_comment(
  p_user_id INT,
  p_post_id INT,
  p_comment TEXT
)
BEGIN
  INSERT INTO comments (comment, post_id, user_id)
  VALUES (p_comment, p_post_id, p_user_id );
END $$
DELIMITER $$
 --call as: CALL create_comment('comment');

DROP PROCEDURE IF EXISTS get_comments_by_post_id;
DELIMITER $$
CREATE PROCEDURE get_comments_by_post_id(
    p_id INT
)
BEGIN
    SELECT 
        comments.*,
        users.username AS username
    FROM comments
    INNER JOIN users ON comments.user_id = users.id
    WHERE comments.post_id = p_id
    ORDER BY comments.created_at DESC;
END $$
DELIMITER ;
--call as: CALL get_comments_by_post_id;