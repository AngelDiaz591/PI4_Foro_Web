-- TABLES IN MYSQL
-- USE foroweb;

DROP TABLE IF EXISTS notifications;
DROP TABLE IF EXISTS followers;
DROP TABLE IF EXISTS user_data;
DROP TABLE IF EXISTS likes;
DROP TABLE IF EXISTS post_reactions;
DROP TABLE IF EXISTS images;
DROP TABLE IF EXISTS dms;
DROP TABLE IF EXISTS comments;
DROP TABLE IF EXISTS posts;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS unesco;

CREATE TABLE users (
	id INT AUTO_INCREMENT,
	username VARCHAR(255) NOT NULL UNIQUE,
	email VARCHAR(255) NOT NULL UNIQUE,
	password VARCHAR(255) NOT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP,
  confirmation_code VARCHAR(50),
  confirmation_token VARCHAR(255),
  confirmation_sent_at TIMESTAMP,
  confirmed_at TIMESTAMP,
  reset_password_token VARCHAR(255),
  reset_password_sent_at TIMESTAMP,
  rol TINYINT DEFAULT 1,
  PRIMARY KEY (id)
);

-- ADD COLUMN BAN
ALTER TABLE users
ADD COLUMN ban ENUM('0', '1') NOT NULL DEFAULT '0';


CREATE TABLE followers (
	user_id INT,
	follower_id INT,
  key `user_id` (`user_id`),
  key `follower_id` (`follower_id`),
  CONSTRAINT `fk_followers_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `fk_followers_follower_id` FOREIGN KEY (`follower_id`) REFERENCES `users` (`id`),
	PRIMARY KEY (user_id, follower_id)
);

CREATE TABLE user_data (
	id INT AUTO_INCREMENT,
	user_id INT,
	profile_picture VARCHAR(255),
  gender VARCHAR(255),
  birthdate DATE,
  phone VARCHAR(255),
  updated_at TIMESTAMP,
  PRIMARY KEY (id),
  key `user_id` (`user_id`),
  CONSTRAINT `fk_user-data_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
);

CREATE TABLE unesco (
  id INT AUTO_INCREMENT,
  theme VARCHAR(255),
  icon VARCHAR(255), 
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP,
  PRIMARY KEY (id)
);

CREATE TABLE posts (
  id INT AUTO_INCREMENT,
  user_id INT,
  title VARCHAR(255),
  description TEXT,
  theme INT,
  eliminated TINYINT DEFAULT 0,
  permission TINYINT DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP,
  PRIMARY KEY (id),
  key `user_id` (`user_id`),
  key `theme` (`theme`),
  CONSTRAINT `fk_posts_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `fk_posts_theme` FOREIGN KEY (`theme`) REFERENCES `unesco` (`id`)
);

ALTER TABLE posts
MODIFY COLUMN permission INT DEFAULT 1 CHECK (permission IN (1, 2));


CREATE TABLE post_reactions (
  id SERIAL PRIMARY KEY,
  user_id int NOT NULL,
  post_id int NOT NULL,
  reaction_type ENUM('thumb', 'love', 'haha', 'wow', 'sad', 'angry') NOT NULL,
  CONSTRAINT fk_user FOREIGN KEY (user_id) REFERENCES users(id),
  CONSTRAINT fk_post FOREIGN KEY (post_id) REFERENCES posts(id)
);

CREATE TABLE comments (
  id INT AUTO_INCREMENT,
  user_id INT,
  post_id INT,
  parent_comment_id INT,
  comment TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP,
  PRIMARY KEY (id),
  key `user_id` (`user_id`),
  key `post_id` (`post_id`),
  key `parent_comment_id` (`parent_comment_id`),
  CONSTRAINT `fk_comments_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `fk_comments_post_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  CONSTRAINT `fk_comments_parent_comment_id` FOREIGN KEY (`parent_comment_id`) REFERENCES `comments` (`id`)
);

CREATE TABLE dms (
  id INT AUTO_INCREMENT,
  user_id INT,
  receiver_id INT,
  message TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP,
  PRIMARY KEY (id),
  key `user_id` (`user_id`),
  key `receiver_id` (`receiver_id`),
  CONSTRAINT `fk_dms_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `fk_dms_receiver_id` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`)
);

CREATE TABLE images (
  id INT AUTO_INCREMENT,
  post_id INT,
  comment_id INT,
  dms_id INT,
  image VARCHAR(255),
  PRIMARY KEY (id),
  key `post_id` (`post_id`),
  key `comment_id` (`comment_id`),
  key `dms_id` (`dms_id`),
  CONSTRAINT `fk_images_post_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_images_comment_id` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_images_dms_id` FOREIGN KEY (`dms_id`) REFERENCES `dms` (`id`) ON DELETE CASCADE
);

CREATE TABLE notifications (
  id INT AUTO_INCREMENT,
  user_id INT,
  type ENUM('post', 'follow', 'like', 'comment', 'post_rejected', 'reply') NOT NULL,
  type_id INT,
  causer_id INT,
  seen TINYINT DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP,
  PRIMARY KEY (id),
  key `user_id` (`user_id`),
  key `causer_id` (`causer_id`),
  CONSTRAINT `fk_notifications_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_notifications_causer_id` FOREIGN KEY (`causer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
);

INSERT INTO unesco (theme, icon) VALUES
  ('End of Poverty', 'bx bx-male-female'),
  ('Zero Hunger', 'bx bxs-bowl-hot'),
  ('Health and Wellness', 'bx bxs-donate-heart'),
  ('Quality Education', 'bx bxs-book-bookmark'),
  ('Gender Equality', 'bx bx-street-view'),
  ('Clean Water and Sanitation', 'bx bxs-donate-blood'),
  ('Affordable and Clean Energy', 'bx bxs-sun'),
  ('Decent Work and Economic Growth', 'bx bx-bar-chart'),
  ('Industry, Innovation and Infrastructure', 'bx bxs-cube-alt'),
  ('Reduced Inequality', 'bx bx-collapse-alt'),
  ('Sustainable Cities and Communities', 'bx bxs-buildings'),
  ('Responsible Consumption and Production', 'bx bx-loader-alt'),
  ('Climate Action', 'bx bx-world'),
  ('Life Below Water', 'bx bx-water'),
  ('Life on Land', 'bx bxs-tree'),
  ('Peace, Justice and Strong Institutions', 'bx bxs-spa'),
  ('Partnerships for the Goals', 'bx bx-color');
;
