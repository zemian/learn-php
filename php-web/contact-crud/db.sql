-- drop table contacts;
CREATE TABLE contacts (
  id SERIAL,
  create_ts TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(200) NULL,
  message VARCHAR(2000) NOT NULL
);

INSERT INTO contacts (name, email, message) VALUES ('test', 'test@test.com', 'just a test');
INSERT INTO contacts (name, email, message) VALUES ('test2', 'test@test.com', 'just a test');

select * from contacts;