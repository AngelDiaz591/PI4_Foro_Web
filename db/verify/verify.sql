DROP PROCEDURE IF EXISTS verifyUserCode;
DELIMITER $$
CREATE PROCEDURE verifyUserCode(IN p_email VARCHAR(255), IN p_code CHAR(6))
BEGIN
    DECLARE user_status VARCHAR(20);
    DECLARE user_code CHAR(6);
    DECLARE message TEXT;

    SELECT status, code INTO user_status, user_code
    FROM usertable
    WHERE email = p_email;

    IF user_status = 'notverified' THEN
        IF user_code = p_code THEN
            UPDATE usertable
            SET status = 'verified', code = '0'
            WHERE email = p_email;

            SET message = 'Verification successful';
        ELSE
            SET message = 'Incorrect verification code';
        END IF;
    ELSEIF user_status = 'verified' THEN
        SET message = 'User already verified';
    ELSE
        SET message = 'user not found';
    END IF;

    SELECT message;
END$$
DELIMITER ;
