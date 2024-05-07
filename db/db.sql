-- TABLES IN MYSQL
-- USE foroweb;

DROP TABLE IF EXISTS followers;
DROP TABLE IF EXISTS user_data;
DROP TABLE IF EXISTS likes;
DROP TABLE IF EXISTS images;
DROP TABLE IF EXISTS dms;
DROP TABLE IF EXISTS comments;
DROP TABLE IF EXISTS posts;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS unesco;

CREATE TABLE users (
	id INT(20) AUTO_INCREMENT,
	username VARCHAR(255) NOT NULL UNIQUE,
	email VARCHAR(255) NOT NULL UNIQUE,
	password VARCHAR(255) NOT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  confirmation_code VARCHAR(50),
  confirmation_token VARCHAR(255),
  confirmation_sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  confirmed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  reset_password_token VARCHAR(255),
  reset_password_sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);

CREATE TABLE followers (
	user_id INT(20),
	follower_id INT(20),
  key `user_id` (`user_id`),
  key `follower_id` (`follower_id`),
  CONSTRAINT `fk_followers_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `fk_followers_follower_id` FOREIGN KEY (`follower_id`) REFERENCES `users` (`id`),
	PRIMARY KEY (user_id, follower_id)
);

CREATE TABLE user_data (
	id INT(20) AUTO_INCREMENT,
	user_id INT(20),
	profile_picture VARCHAR(255),
  gender VARCHAR(255),
  birthdate DATE,
  phone VARCHAR(255),
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  key `user_id` (`user_id`),
  CONSTRAINT `fk_user-data_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
);

CREATE TABLE unesco (
  id INT(20) AUTO_INCREMENT,
  theme VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);

CREATE TABLE posts (
  id INT(20) AUTO_INCREMENT,
  user_id INT(20),
  title VARCHAR(255),
  description TEXT,
  theme INT(20),
  eliminated TINYINT(1) DEFAULT 0,
  permission TINYINT(1) DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  key `user_id` (`user_id`),
  key `theme` (`theme`),
  CONSTRAINT `fk_posts_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `fk_posts_theme` FOREIGN KEY (`theme`) REFERENCES `unesco` (`id`)
);

CREATE TABLE likes (
  user_id INT(20),
  post_id INT(20),
  key `user_id` (`user_id`),
  key `post_id` (`post_id`),
  CONSTRAINT `fk_likes_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `fk_likes_post_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  PRIMARY KEY (user_id, post_id)
);

CREATE TABLE comments (
  id INT(20) AUTO_INCREMENT,
  user_id INT(20),
  post_id INT(20),
  parent_comment_id INT(20),
  comment TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  key `user_id` (`user_id`),
  key `post_id` (`post_id`),
  key `parent_comment_id` (`parent_comment_id`),
  CONSTRAINT `fk_comments_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `fk_comments_post_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  CONSTRAINT `fk_comments_parent_comment_id` FOREIGN KEY (`parent_comment_id`) REFERENCES `comments` (`id`)
);

CREATE TABLE dms (
  id INT(20) AUTO_INCREMENT,
  user_id INT(20),
  receiver_id INT(20),
  message TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  key `user_id` (`user_id`),
  key `receiver_id` (`receiver_id`),
  CONSTRAINT `fk_dms_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `fk_dms_receiver_id` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`)
);

CREATE TABLE images (
  id INT(20) AUTO_INCREMENT,
  post_id INT(20),
  comment_id INT(20),
  dms_id INT(20),
  image VARCHAR(255),
  PRIMARY KEY (id),
  key `post_id` (`post_id`),
  key `comment_id` (`comment_id`),
  key `dms_id` (`dms_id`),
  CONSTRAINT `fk_images_post_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_images_comment_id` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_images_dms_id` FOREIGN KEY (`dms_id`) REFERENCES `dms` (`id`) ON DELETE CASCADE
);

INSERT INTO unesco (theme) VALUES
  ('End of Poverty'),
  ('Zero Hunger'),
  ('Health and Wellness'),
  ('Quality Education'),
  ('Gender Equality')
;
