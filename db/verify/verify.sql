DROP PROCEDURE IF EXISTS verifyUserCode;
DELIMITER $$

CREATE PROCEDURE verifyUserCode(IN p_email VARCHAR(255), IN p_code CHAR(6))
BEGIN
    DECLARE user_status VARCHAR(20);
    DECLARE user_code CHAR(6);
    DECLARE message TEXT;

    -- Obtener el estado y el código del usuario
    SELECT status, code INTO user_status, user_code
    FROM usertable
    WHERE email = p_email;

    -- Verificar el estado del usuario
    IF user_status = 'notverified' THEN
        -- Verificar si el código de verificación es correcto
        IF user_code = p_code THEN
            -- Actualizar el estado del usuario a 'verified' y el código a '0'
            UPDATE usertable
            SET status = 'verified', code = '0'
            WHERE email = p_email;

            -- Establecer un mensaje de verificación exitosa
            SET message = 'Verification successful';
        ELSE
            -- Establecer un mensaje de código de verificación incorrecto
            SET message = 'Incorrect verification code';
        END IF;
    ELSEIF user_status = 'verified' THEN
        -- Verificar si el código de verificación es correcto
        IF user_code = p_code THEN
            -- Establecer un mensaje para redirigir al cambio de contraseña
            SET message = 'changepassword';
            -- Actualizar el código a '0'
            UPDATE usertable
            SET code = '0'
            WHERE email = p_email;
        ELSE
            -- Establecer un mensaje de usuario no encontrado
            SET message = 'User not found';
        END IF;
    END IF;

    -- Devolver el mensaje
    SELECT message;
END$$

DELIMITER ;
