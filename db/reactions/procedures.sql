DELIMITER //

CREATE PROCEDURE UserReaction (IN p_userId INT, IN p_postId INT, IN p_reactType VARCHAR(255), OUT p_reactionCount INT)
BEGIN
    DECLARE react_count INT;
    SELECT COUNT(*) INTO react_count FROM post_like WHERE userid = p_userId AND post_id = p_postId;

    IF react_count > 0 THEN
        UPDATE post_like SET reactType = p_reactType WHERE post_id = p_postId AND userid = p_userId;
    ELSE
        INSERT INTO post_like (userid, post_id, reactType) VALUES (p_userId, p_postId, p_reactType);
    END IF;

    SELECT COUNT(*) INTO p_reactionCount FROM post_like WHERE post_id = p_postId;
END //

DELIMITER ;
