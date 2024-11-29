CREATE DATABASE user_auth;

use user_auth;

CREATE TABLE users (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  username varchar(50) NOT NULL UNIQUE,
  password varchar(255) NOT NULL,
  created_at timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DESC users;
SELECT * FROM users;


INSERT INTO users (username, password) 
VALUES 
('Jhon', SHA2('j', 256)),
('Carlos', SHA2('c', 256)),
('Mario', SHA2('m', 256)),
('Veronica', SHA2('v', 256));

SELECT * FROM users;