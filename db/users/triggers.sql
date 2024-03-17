-- TRIGGERS FOR USERS

/* 
  TRIGGER TO UPDATE THE UPDATED_AT ATTRIBUTE
  This trigger will update the updated_at attribute with the current date and time,
  only if the confirmed_at is not being updated or is already confirmed
*/
DROP TRIGGER IF EXISTS before_update_user;
DELIMITER $$
CREATE TRIGGER before_update_user
BEFORE UPDATE ON users
FOR EACH ROW
BEGIN
  IF OLD.confirmed_at IS NOT NULL AND NEW.confirmed_at IS NOT NULL THEN
    SIGNAL SQLSTATE '45001'
    SET MESSAGE_TEXT = 'User is already confirmed';
  END IF;
  IF NEW.confirmed_at == OLD.confirmed_at THEN
    SET NEW.updated_at = NOW();
  END IF;
END $$
DELIMITER ;
