https://www.php.net/

PHP is a popular general-purpose scripting language that is especially suited to web development.

## How to run

	lighttpd -D -f lighttpd/lighttpd.conf
	open http://localhost:3000/

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

## Compile PHP Source php-7.4.9 on MacOSX

```
./configure --prefix=/usr/local --with-iconv=/usr/local/opt/libiconv --enable-sockets --with-mysqli=mysqlnd --with-zlib
make
sudo make install
```

## MAMP pre-package install

* [XAMP](https://www.apachefriends.org/index.html) - XAMPP is a completely free, easy to install Apache distribution containing MariaDB, PHP, and Perl. 
* [MAMP](https://www.mamp.info/en/mamp) - The free web development solution with Apache, Nginx, PHP & MySQL