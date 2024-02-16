DROP PROCEDURE IF EXISTS _save;
DROP PROCEDURE IF EXISTS _update;
DROP PROCEDURE IF EXISTS _delete;
DROP FUNCTION IF EXISTS get_all;
DROP FUNCTION IF EXISTS get_by_id;


CREATE OR REPLACE PROCEDURE _save(
  p_title TEXT,
  p_description TEXT
)
LANGUAGE plpgsql
AS $$
BEGIN
  INSERT INTO posts (title, description)
  VALUES (p_title, p_description);
END $$;
-- call as: CALL _save('title', 'description');


CREATE OR REPLACE PROCEDURE _update(
  p_id INT,
  p_title TEXT,
  p_description TEXT
)
LANGUAGE plpgsql
AS $$
BEGIN
  UPDATE posts
  SET title = p_title, description = p_description
  WHERE posts.id = p_id;
END $$;
-- call as: CALL _update(1, 'title', 'description');


CREATE OR REPLACE PROCEDURE _delete(
  p_id INT
)
LANGUAGE plpgsql
AS $$
BEGIN
  DELETE FROM posts
  WHERE posts.id = p_id;
END $$;
-- call as: CALL _delete(1);


CREATE OR REPLACE FUNCTION get_all()
RETURNS TABLE (
  id INT,
  user_id INT,
  title TEXT,
  description TEXT,
  image TEXT,
  theme INT,
  eliminated BOOLEAN,
  permission BOOLEAN,
  created_at TIMESTAMP,
  updated_at TIMESTAMP
)
LANGUAGE plpgsql
AS $$
BEGIN
  RETURN QUERY
  SELECT * FROM posts;
END$$;
-- call as: SELECT * FROM get_all();


CREATE OR REPLACE FUNCTION get_by_id(
  p_id INT
)
RETURNS TABLE (
  id INT,
  user_id INT,
  title TEXT,
  description TEXT,
  image  TEXT,
  theme INT,
  eliminated BOOLEAN,
  permission BOOLEAN,
  created_at TIMESTAMP,
  updated_at TIMESTAMP
)
LANGUAGE plpgsql
AS $$
BEGIN
  RETURN QUERY
  SELECT * FROM posts
  WHERE posts.id = p_id;
END$$;
-- call as: SELECT * FROM get_by_id(1);
