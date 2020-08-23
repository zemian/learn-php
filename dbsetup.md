## MySQL on Mac

```bash
brew install services mysql
brew services start mysql

mysql -u root
```

## Setup MySQL DB

```
mysql -u root

CREATE USER 'zemian'@'localhost' IDENTIFIED WITH mysql_native_password BY 'test123';
CREATE DATABASE learnphp CHARACTER SET utf8 COLLATE utf8_general_ci;
GRANT ALL PRIVILEGES ON learnphp.* TO 'zemian'@'localhost';
FLUSH PRIVILEGES;

mysql -u zemian -p learnphp

CREATE TABLE config(id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(200), value VARCHAR(1000));
INSERT INTO config(name, value) values('foo', 'bar'), ('num', '123');
```

NOTE: If you are using PHP 7.4 with `mysqli`, then you need to use `mysql_native_password`.
See https://stackoverflow.com/questions/50026939/php-mysqli-connect-authentication-method-unknown-to-the-client-caching-sha2-pa