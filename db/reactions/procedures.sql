DROP PROCEDURE IF EXISTS UserReaction;
DELIMITER $$

CREATE PROCEDURE UserReaction (
    IN p_userId INT,
    IN p_postId INT,
    IN p_reactType VARCHAR(255),
    OUT total_reactions INT
)
BEGIN
    DECLARE react_count INT;

    -- Get the count of reactions before performing the action
    SELECT COUNT(*) INTO react_count 
    FROM post_reactions 
    WHERE post_id = p_postId AND user_id = p_userId;

    IF react_count > 0 THEN
        -- If the user has previously reacted to the post, update their reaction
        UPDATE post_reactions 
        SET reaction_type = p_reactType 
        WHERE post_id = p_postId AND user_id = p_userId;
    ELSE
        -- If the user has not previously reacted to the post, insert a new reaction
        INSERT INTO post_reactions (user_id, post_id, reaction_type) 
        VALUES (p_userId, p_postId, p_reactType);
    END IF;

    -- Get the new count of reactions after the action
    SELECT COUNT(*) INTO total_reactions 
    FROM post_reactions 
    WHERE post_id = p_postId;

END $$

DELIMITER ;


-- call as: CALL UserReaction( );


DROP PROCEDURE IF EXISTS GetUserReactions;
DELIMITER $$

CREATE PROCEDURE GetUserReactions(IN user_id INT)
BEGIN
    SELECT
        p.post_id,
        ur.reaction_type AS reactType
    FROM
        post_reactions ur
    JOIN (
        SELECT post_id
        FROM post_reactions
        GROUP BY post_id
    ) p ON ur.post_id = p.post_id
    WHERE
        ur.user_id = user_id;
END $$

DELIMITER $$
-- call as: CALL GetUserReactions();
DROP PROCEDURE IF EXISTS DeleteReaction;
DELIMITER //

CREATE PROCEDURE DeleteReaction (
    IN p_userId INT,
    IN p_postId INT,
    OUT total_reactions INT
)
BEGIN
    -- Delete the user's reaction on the given post
    DELETE FROM post_reactions
    WHERE user_id = p_userId AND post_id = p_postId;

    -- Get the new count of reactions after the deletion
    SELECT COUNT(*) INTO total_reactions
    FROM post_reactions
    WHERE post_id = p_postId;

END //

DELIMITER ;

