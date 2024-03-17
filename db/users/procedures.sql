-- PROCEDURES IN MYSQL FOR USERS

DROP PROCEDURE IF EXISTS save_user;
DELIMITER $$
CREATE PROCEDURE save_user(
    IN p_username VARCHAR(255),
    IN p_email VARCHAR(255),
    IN p_password VARCHAR(255),
    IN p_code VARCHAR(50),
    IN p_token VARCHAR(255)
)
BEGIN
    INSERT INTO users (username, email, password, confirmation_code, confirmation_token, confirmation_sent_at)
    VALUES (p_username, p_email, p_password, p_code, p_token, NOW());
END $$
DELIMITER ;
-- call as: CALL save_user('XxjuanitoxX', 'juanito@gmail.com', 'password_hashed', 'A1B2C3');


DROP PROCEDURE IF EXISTS update_user_password;
DELIMITER $$
CREATE PROCEDURE update_user_password(
    IN p_token VARCHAR(255),
    IN p_password VARCHAR(255)
)
BEGIN
    UPDATE users 
    SET password = p_password
    WHERE reset_password_token = p_token;
END $$
DELIMITER ;
-- call as: CALL update_user_password('juanito@gmail.com', 'password_hashed');


DROP PROCEDURE IF EXISTS update_user_confirmation_code;
DELIMITER $$
CREATE PROCEDURE update_user_confirmation_code(
    IN p_old_token VARCHAR(255),
    IN p_code VARCHAR(50),
    IN p_token VARCHAR(255)
)
BEGIN
    UPDATE users
    SET confirmation_code = p_code, confirmation_token = p_token, confirmation_sent_at = NOW()
    WHERE confirmation_token = p_old_token;
END $$
DELIMITER ;
-- call as: CALL update_user_confirmation_code('A1B2C3', 'D4E5F6', 'G7H8I9');


DROP PROCEDURE IF EXISTS update_user_reset_password_token;
DELIMITER $$
CREATE PROCEDURE update_user_reset_password_token(
    IN p_email VARCHAR(255),
    IN p_token VARCHAR(255)
)
BEGIN
    UPDATE users
    SET reset_password_token = p_token, reset_password_sent_at = NOW()
    WHERE email = p_email;
END $$
DELIMITER ;
-- call as: CALL update_user_reset_password_token('juanito@gmail.com', 'A1B2C3');


/* 
    PROCEDURE TO CONFIRM USER
    This procedure will update the confirmed_at attribute with the current date and time
    this means that the user has been confirmed and can now log in
*/
DROP PROCEDURE IF EXISTS confirm_user;
DELIMITER $$
CREATE PROCEDURE confirm_user(
    IN p_code VARCHAR(50),
    IN p_token VARCHAR(255)
)
BEGIN
    UPDATE users
    SET confirmed_at = NOW()
    WHERE confirmation_code = p_code AND confirmation_token = p_token;
END $$
DELIMITER ;
-- call as: CALL confirm_user('juanito@gmail.com');


DROP PROCEDURE IF EXISTS get_user_by_email;
DELIMITER $$
CREATE PROCEDURE get_user_by_email(
    IN p_email VARCHAR(255)
)
BEGIN
    SELECT * FROM users WHERE email = p_email;
END
$$
DELIMITER ;
-- call as: CALL get_user_by_email('juanito@gmail.com');


/* 
    the possible conbinations of the token are:
    10,363,194,502,115
    so the token is almost unique and the probability of collision is very low
    if the database increases the number of users, the token can be increased to 17 characters LMFAO
*/
DROP PROCEDURE IF EXISTS get_user_by_confirmation_token;
DELIMITER $$
CREATE PROCEDURE get_user_by_confirmation_token(
    IN p_token VARCHAR(255)
)
BEGIN
    SELECT * FROM users WHERE confirmation_token = p_token;
END
$$
DELIMITER ;
-- call as: CALL get_user_by_confirmation_token('A1B2C3');


DROP PROCEDURE IF EXISTS get_user_by_reset_password_token;
DELIMITER $$
CREATE PROCEDURE get_user_by_reset_password_token(
    IN p_token VARCHAR(255)
)
BEGIN
    SELECT * FROM users WHERE reset_password_token = p_token;
END
$$
DELIMITER ;
-- call as: CALL get_user_by_reset_password_token('A1B2C3');
