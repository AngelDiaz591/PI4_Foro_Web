DROP PROCEDURE IF EXISTS code_update;
DELIMITER $$

CREATE PROCEDURE code_update(
    IN p_email VARCHAR(255),
    IN p_code VARCHAR(50)
)
BEGIN
    UPDATE usertable SET code = p_code WHERE email = p_email;
END $$

DELIMITER ;
