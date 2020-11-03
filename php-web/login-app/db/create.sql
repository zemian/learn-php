CREATE TABLE users (
  id SERIAL PRIMARY KEY,
  username VARCHAR(200) UNIQUE,
  password VARCHAR(1000)
);

-- Sample of test data, password=test123
INSERT INTO users VALUES (NULL, 'test', '$2y$10$8CSdr7TRICObtLYtHVfxTuYJUO4UzdenJUkoDtGsgqutOhIYFReVq');
INSERT INTO users VALUES (NULL, 'test2', '$2y$10$I/ulrhMdgqbDHNT.9NNol.tbMickL2vwmUHkSrEI6o2IwiTp5.fkq');
INSERT INTO users VALUES (NULL, 'test3', '$2y$10$8HgKTIzzWbbVsnj7565uwuWa0rn4NFUTsgAGHxgLPxTLmjlfqV7z2');

-- Queries
select * from users;
