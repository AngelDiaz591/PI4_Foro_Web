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

            SET message = 'Verificación exitosa';
        ELSE
            SET message = 'Código de verificación incorrecto';
        END IF;
    ELSEIF user_status = 'verified' THEN
        SET message = 'Usuario ya verificado';
    ELSE
        SET message = 'Usuario no encontrado';
    END IF;

    SELECT message;
END$$
DELIMITER ;