-- PROCEDURES IN MYSQL
DROP PROCEDURE IF EXISTS _save;
DELIMITER $$
CREATE PROCEDURE _save(
  p_title TEXT,
  p_description TEXT
)
BEGIN
  INSERT INTO posts (title, description)
  VALUES (p_title, p_description);
END $$
DELIMITER ;
-- call as: CALL _save('title', 'description');

DROP PROCEDURE IF EXISTS _update;
DELIMITER $$
CREATE PROCEDURE _update(
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
-- call as: CALL _update(1, 'title', 'description');

DROP PROCEDURE IF EXISTS _delete;
DELIMITER $$
CREATE PROCEDURE _delete(
  p_id INT
)
BEGIN
  DELETE FROM posts
  WHERE posts.id = p_id;
END $$
DELIMITER ;
-- call as: CALL _delete(1);

DROP PROCEDURE IF EXISTS save_image;
DELIMITER $$
CREATE PROCEDURE save_image(
  p_table TEXT,
  p_id INT,
  p_image TEXT
)
BEGIN
  CASE p_table
    WHEN 'post' THEN
      INSERT INTO images (post_id, image) VALUES (p_id, p_image);
    WHEN 'comment' THEN
      INSERT INTO images (comment_id, image) VALUES (p_id, p_image);
    WHEN 'dm' THEN
      INSERT INTO images (dms_id, image) VALUES (p_id, p_image);
    ELSE
      SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Invalid table';
  END CASE;
END
$$
DELIMITER ;
-- call as: CALL save_image('post', 1, 'image');

DROP FUNCTION IF EXISTS get_all;
DELIMITER $$
CREATE FUNCTION get_all()
BEGIN
  SELECT * FROM posts;
END
$$
DELIMITER ;
-- call as: SELECT * FROM get_all();

DROP FUNCTION IF EXISTS get_by_id;
DELIMITER $$
CREATE FUNCTION get_by_id(
  p_id INT
)
BEGIN
  SELECT * FROM posts
  WHERE posts.id = p_id;
END
$$
DELIMITER ;
-- call as: SELECT * FROM get_by_id(1);
