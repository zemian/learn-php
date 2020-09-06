## MySQL 8 on Mac

```bash
brew install services mysql
brew services start mysql

# Or you may start it manually:
mysql.server start

mysql -u root
```

## Setup MySQL DB 8

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

## PHP 5.6 and MySQL 8 Error - character-set

```
Warning: mysql_connect(): Server sent charset (255) unknown to the client. Please, report to the developers in /Users/zedeng/src/zemian/learn-php/www/php-app/dbtest-old.php on line 18
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

## Setup MySQL 5.7 on Mac

ref: https://gist.github.com/operatino/392614486ce4421063b9dece4dfe6c21

```
brew install mysql@5.7
brew link --force mysql@5.7

# Add the following to path
echo 'export PATH="/usr/local/opt/mysql@5.7/bin:$PATH"' >> ~/.zshrc

# Verify
mysql -V # => mysql  Ver 14.14 Distrib 5.7.31, for osx10.15 (x86_64) using  EditLine wrapper


# NOTE: If you have previous database already created `/usr/local/var/mysql` data directory, 
# you need to remove it and then reinitialize database first.
# Note and record the root password
mysqld --initialize

brew services start mysql@5.7

# Or you may start it manually:
mysql.server start

# To change the root password, or NOT set password
mysqladmin -u root -p password ''
```
