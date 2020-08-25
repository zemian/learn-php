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
CREATE DATABASE learnphpdb CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
GRANT ALL PRIVILEGES ON learnphpdb.* TO 'zemian'@'localhost';
FLUSH PRIVILEGES;

mysql -u zemian -p learnphpdb

CREATE TABLE config(id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(200), value VARCHAR(1000));
INSERT INTO config(name, value) values('foo', 'bar'), ('num', '123');
```

NOTE: If you are using PHP 7.4 with `mysqli`, then you need to use `mysql_native_password`.
See https://stackoverflow.com/questions/50026939/php-mysqli-connect-authentication-method-unknown-to-the-client-caching-sha2-pa

## How to update existing DB user password

	ALTER USER 'zemian'@'localhost' IDENTIFIED WITH mysql_native_password BY 'test123';

## PHP 5.6 and MySQL Error - character-set

```
Warning: mysql_connect(): Server sent charset (255) unknown to the client. Please, report to the developers in /Users/zedeng/src/zemian/learn-php/php/dbtest-old.php on line 18
```

To fix this, change your database encoding from `utf8mb4` to `utf8` ON the server `my.cnf` config file!

```	
# For PHP 5.6 support, we will default character-set to utf8 insetad of utf8mb4

[client]
default-character-set=utf8
 
[mysql]
default-character-set=utf8
 
[mysqld]
collation-server = utf8_unicode_ci
character-set-server = utf8
```

NOTE: Run `mysql --help` to see where `my.cnf` is loaded.

Ref: https://thisinterestsme.com/charset-255-unknown-mysql/

## PHP 5.6 and MySQL Error - password

```
Warning: mysql_connect(): The server requested authentication method unknown to the client [caching_sha2_password] in /Users/zedeng/src/zemian/learn-php/php/dbtest-old.php on line 18`
```

In the DB server `my.cnf` config file, add the following:

```
# For PHP 5.6 support, we will default older user password auth method
default-authentication-plugin=mysql_native_password
```