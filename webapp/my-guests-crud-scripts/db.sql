-- // https://www.w3schools.com/php/php_mysql_select.asp

-- drop table MyGuests
CREATE TABLE MyGuests (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  firstname VARCHAR(30) NOT NULL,
  lastname VARCHAR(30) NOT NULL,
  email VARCHAR(50),
  reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO MyGuests (firstname, lastname, email) VALUES ('John', 'Smith', 'john.smith@localhost.com');
INSERT INTO MyGuests (firstname, lastname, email) VALUES ('Mary', 'Smith', 'mary.smith@localhost.com');

select * from MyGuests;