CREATE TABLE users (
  id SERIAL PRIMARY KEY,
  created_ts TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  username VARCHAR(200) NOT NULL UNIQUE,
  password VARCHAR(1000) NOT NULL
);

-- Sample of test data, password=test123
INSERT INTO users (username, password) VALUES ('test', '$2y$10$8CSdr7TRICObtLYtHVfxTuYJUO4UzdenJUkoDtGsgqutOhIYFReVq');
INSERT INTO users (username, password) VALUES ('test2', '$2y$10$I/ulrhMdgqbDHNT.9NNol.tbMickL2vwmUHkSrEI6o2IwiTp5.fkq');
INSERT INTO users (username, password) VALUES ('test3', '$2y$10$8HgKTIzzWbbVsnj7565uwuWa0rn4NFUTsgAGHxgLPxTLmjlfqV7z2');

-- Queries
select * from users;
