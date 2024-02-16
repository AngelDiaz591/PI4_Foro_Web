-- ELIMINATE ALL THE RELATIONS
-- ALTER TABLE followers DROP CONSTRAINT followers_user_id_fkey;
-- ALTER TABLE followers DROP CONSTRAINT followers_follower_id_fkey;
-- ALTER TABLE user_data DROP CONSTRAINT user_data_user_id_fkey;
-- ALTER TABLE posts DROP CONSTRAINT posts_user_id_fkey;
-- ALTER TABLE posts DROP CONSTRAINT posts_theme_fkey;
-- ALTER TABLE likes DROP CONSTRAINT likes_user_id_fkey;
-- ALTER TABLE likes DROP CONSTRAINT likes_post_id_fkey;
-- ALTER TABLE comments DROP CONSTRAINT comments_user_id_fkey;
-- ALTER TABLE comments DROP CONSTRAINT comments_post_id_fkey;
-- ALTER TABLE comments DROP CONSTRAINT comments_parent_comment_id_fkey;
-- ALTER TABLE dms DROP CONSTRAINT dms_user_id_fkey;
-- ALTER TABLE dms DROP CONSTRAINT dms_receiver_id_fkey;

-- CREATE TABLES IN POSTGRES
DROP TABLE IF EXISTS users;
CREATE TABLE users (
	id SERIAL PRIMARY KEY,
	name TEXT NOT NULL,
	lastname TEXT NOT NULL,
	username TEXT NOT NULL,
	email TEXT NOT NULL,
	password TEXT NOT NULL,
	rol TEXT NOT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS followers;
CREATE TABLE followers (
	user_id INT,
	follower_id INT,
	FOREIGN KEY (user_id) REFERENCES users(id),
	FOREIGN KEY (follower_id) REFERENCES users(id),
	PRIMARY KEY (user_id, follower_id)
);

DROP TABLE IF EXISTS user_data;
CREATE TABLE user_data (
	id SERIAL PRIMARY KEY,
	user_id INT,
	FOREIGN KEY (user_id) REFERENCES users(id),
	profile_picture TEXT,
	gender TEXT,
	birthdate DATE,
	phone TEXT,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS unesco;
CREATE TABLE unesco (
	id SERIAL PRIMARY KEY,
	theme TEXT,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS posts;
CREATE TABLE posts (
	id SERIAL PRIMARY KEY,
	user_id INT,
	FOREIGN KEY (user_id) REFERENCES users(id),
	title TEXT,
	description TEXT,
	image TEXT,
	theme INT,
	FOREIGN KEY (theme) REFERENCES unesco(id),
	eliminated BOOLEAN DEFAULT FALSE,
	permission BOOLEAN DEFAULT FALSE,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS likes;
CREATE TABLE likes (
	user_id INT,
	post_id INT,
	FOREIGN KEY (user_id) REFERENCES users(id),
	FOREIGN KEY (post_id) REFERENCES posts(id),
	PRIMARY KEY (user_id, post_id)
);

DROP TABLE IF EXISTS comments;
CREATE TABLE comments (
	id SERIAL PRIMARY KEY,
	user_id INT,
	FOREIGN KEY (user_id) REFERENCES users(id),
	post_id INT,
	FOREIGN KEY (post_id) REFERENCES posts(id),
	parent_comment_id INT,
	FOREIGN KEY (parent_comment_id) REFERENCES comments(id),
	comment TEXT,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS dms;
CREATE TABLE dms (
	id SERIAL PRIMARY KEY,
	user_id INT,
	FOREIGN KEY (user_id) REFERENCES users(id),
	receiver_id INT,
	FOREIGN KEY (receiver_id) REFERENCES users(id),
	message TEXT,
	images TEXT,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- RECREATE THE RELATIONS
-- ALTER TABLE followers ADD FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE;
-- ALTER TABLE followers ADD FOREIGN KEY (follower_id) REFERENCES users(id) ON DELETE CASCADE;
-- ALTER TABLE user_data ADD FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE;
-- ALTER TABLE posts ADD FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE;
-- ALTER TABLE posts ADD FOREIGN KEY (theme) REFERENCES unesco(id) ON DELETE CASCADE;
-- ALTER TABLE likes ADD FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE;
-- ALTER TABLE likes ADD FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE;
-- ALTER TABLE comments ADD FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE;
-- ALTER TABLE comments ADD FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE;
-- ALTER TABLE comments ADD FOREIGN KEY (parent_comment_id) REFERENCES comments(id) ON DELETE CASCADE;
-- ALTER TABLE dms ADD FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE;
-- ALTER TABLE dms ADD FOREIGN KEY (receiver_id) REFERENCES users(id) ON DELETE CASCADE;
