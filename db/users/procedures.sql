/*Procedures of session*/
DROP PROCEDURE IF EXISTS save_user;
DELIMITER $$
CREATE PROCEDURE save_user(
    IN p_name VARCHAR(255),
    IN p_email VARCHAR(255),
    IN p_password VARCHAR(255),
    IN p_code VARCHAR(50)
)
BEGIN
    DECLARE status VARCHAR(255);
    DECLARE user_type INT;


    SET status = 'notverified'; 
    SET user_type = 1;

    INSERT INTO usertable (name, email, code, password, status, user_type)
    VALUES (p_name, p_email, p_code,  p_password, status, user_type);
END $$
DELIMITER ;
