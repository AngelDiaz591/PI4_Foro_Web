DROP PROCEDURE IF EXISTS GetPasswordByEmail;
DELIMITER $$
CREATE PROCEDURE GetPasswordByEmail(IN p_email VARCHAR(255), OUT p_password VARCHAR(255))
BEGIN
    SELECT password INTO p_password FROM usertable WHERE email = p_email;
END$$

DELIMITER ;

DROP PROCEDURE IF EXISTS UpdatePasswordByEmail;
DELIMITER $$
CREATE PROCEDURE UpdatePasswordByEmail(IN p_email VARCHAR(255), IN p_newPassword VARCHAR(255))
BEGIN
    UPDATE usertable SET password = p_newPassword WHERE email = p_email;
END$$