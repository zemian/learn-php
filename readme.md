https://www.php.net/

PHP is a popular general-purpose scripting language that is especially suited to web development.

## Setup

See phpsetup.md and dbsetup.md

## How to run

	lighttpd -D -f lighttpd/lighttpd.conf
	open http://localhost:3000/

## MySQL on Mac

```bash
brew install services mysql
brew services start mysql

mysql -u root
```

### Setup MySQL DB

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

### How to update existing DB user password

	ALTER USER 'zemian'@'localhost' IDENTIFIED WITH mysql_native_password BY 'test123';

## PHP Installation

### Mac Setup

The `/usr/bin/php` that comes with MacOX does not include `php-cgi` ?

We can try to install latest version with `brew install php`

### MAMP pre-package install

* [XAMP](https://www.apachefriends.org/index.html) - XAMPP is a completely free, easy to install Apache distribution containing MariaDB, PHP, and Perl. 
* [MAMP](https://www.mamp.info/en/mamp) - The free web development solution with Apache, Nginx, PHP & MySQL

### Installing php by building from source

You might to preinstall the following first:

	brew install libiconv zlib apxs mysql

1. Download source [`php-7.4.9.tar.gz`](https://www.php.net/downloads)
2. Run `brew install libiconv`
3. Run `./configure --prefix=/usr/local --with-iconv=/usr/local/opt/libiconv --enable-sockets --with-mysqli=mysqlnd --with-zlib=/usr/local/opt/zlib --with-apxs2=/usr/local/bin/apxs`
4. Run `make`
5. Run `sudo make install`

NOTE: PHP 7 uses option `--with-mysqli` instead of `--with-mysql`. The `mysqlnd` is a PHP native driver.

NOTE: The `--with-apxs2=/usr/local/bin/apxs` is only needed if you were to compile mod_php7.so for Apache HTTPD web server.

NOTE: The `--with-zlib` is required for Joomla CMS, but not for WordPress! 

## PHP versions

* 5.6.40 is the last version release before 7 and it has been discontinued since 10 Jan 2019.