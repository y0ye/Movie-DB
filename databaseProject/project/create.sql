CREATE DATABASE movies_db;

CREATE TABLE movies (
  movie_id INTEGER NOT NULL,
  title VARCHAR(255),
  release_year INTEGER,
  director_id INTEGER,
  genre VARCHAR(255),
  description TEXT,
  avg_votes DECIMAL,
  votes INTEGER

  CONSTRAINT moviesPK
            PRIMARY KEY(movie_id)
);

CREATE TABLE actors (
  actor_id INTEGER NOT NULL,
  first_name VARCHAR(255),
  last_name VARCHAR(255)

  CONSTRAINT actorsPK
            PRIMARY KEY(actor_id)
);

CREATE TABLE directors (
  director_id INTEGER NOT NULL,
  first_name VARCHAR(255),
  last_name VARCHAR(255)

  CONSTRAINT directorsPK
            PRIMARY KEY(director_id)
);

CREATE TABLE movie_cast (
  movie_id INTEGER,
  actor_id INTEGER,

    CONSTRAINT movie_cast_movieFK
              FOREIGN KEY (movie_id) REFERENCES movies(movie_id)
                        ON DELETE CASCADE ON UPDATE CASCADE,

    CONSTRAINT movie_cast_actorFK
              FOREIGN KEY (actor_id) REFERENCES actors(actor_id)
                        ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE users (
  id INTEGER NOT NULL,
  username VARCHAR(255),
  role VARCHAR(255)

    CONSTRAINT usersPK
              PRIMARY KEY(id)
);

CREATE TABLE user_reviews (
  review_id INTEGER NOT NULL,
  user_id INTEGER,
  movie_id INTEGER,
  rating DECIMAL,
  review_text TEXT,
  created_at TIMESTAMP,

    CONSTRAINT user_reviews_userFK
              FOREIGN KEY (user_id) REFERENCES users(id)
                        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT user_reviews_movieFK
              FOREIGN KEY (movie_id) REFERENCES movies(movie_id)
                        ON DELETE CASCADE ON UPDATE CASCADE,

    CONSTRAINT user_reviewsPK
              PRIMARY KEY(review_id)
);