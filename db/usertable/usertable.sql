DROP TABLE IF EXISTS usertable;
CREATE TABLE usertable (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) UNIQUE,
    email VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    code VARCHAR(50),
    status VARCHAR(255),
    user_type INT(1)
);