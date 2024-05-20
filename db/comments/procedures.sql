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
CREATE PROCEDURE delete_comment_id(
    p_id INT
)
BEGIN
    SELECT 
        users.username,
        comments.comment,
        comments.id,
        comments.user_id,
        comments.created_at,
        comments.parent_comment_id
    FROM comments
    WHERE comments.post_id = p_id
    ORDER BY comments.created_at DESC;
END $$
DELIMITER ;
--call as: CALL get_comments_by_post_id;
DROP PROCEDURE IF EXISTS delete_comment_by_id;
DELIMITER $$
CREATE PROCEDURE delete_comment_by_id(IN commentId INT)
BEGIN
    DECLARE childCommentId INT;
    DELETE FROM comments WHERE parent_comment_id = commentId;
    SELECT id INTO childCommentId FROM comments WHERE parent_comment_id = commentId;
    WHILE childCommentId IS NOT NULL DO
        CALL delete_comment_by_id(childCommentId);
        SELECT id INTO childCommentId FROM comments WHERE parent_comment_id = commentId;
    END WHILE;
    DELETE FROM comments WHERE id = commentId;
END$$

DELIMITER ;

DROP PROCEDURE IF EXISTS update_comment_by_id;
DELIMITER $$

CREATE PROCEDURE update_comment_by_id(IN commentId INT, IN commentText TEXT)
BEGIN
    UPDATE comments SET comment = commentText WHERE id = commentId;
    IF ROW_COUNT() > 0 THEN
        SELECT "Comment Updated Successfully" AS message;
    ELSE
        SELECT "Comment with ID " + CAST(commentId AS CHAR) + " does not exist." AS message;
    END IF;
END$$

DELIMITER ;

DROP PROCEDURE IF EXISTS create_son_comment;
DELIMITER //
CREATE PROCEDURE create_son_comment(
    IN parentCommentId INT,
    IN comment TEXT,
    IN postId INT,
    IN userId INT
)
BEGIN
    DECLARE errorMessage VARCHAR(255);
    INSERT INTO comments (user_id, post_id, parent_comment_id, comment)
    VALUES (userId, postId, parentCommentId, comment);

    IF ROW_COUNT() = 1 THEN
        SELECT 'Comentario creado exitosamente' AS message;
    ELSE
        SET errorMessage = CONCAT('Error al insertar comentario: ', comment);
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = errorMessage;
    END IF;
END //
DELIMITER ;



