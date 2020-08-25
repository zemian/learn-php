https://www.php.net/

PHP is a popular general-purpose scripting language that is especially suited to web development.

## Setup

## How to run

	lighttpd -D -f lighttpd/lighttpd.conf
	open http://localhost:3000/

## MySQL on Mac

```bash
brew install services mysql
brew services start mysql

mysql -u root

CREATE USER 'zemian'@'localhost' IDENTIFIED WITH mysql_native_password BY 'test123';
CREATE DATABASE learnphpdb CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
GRANT ALL PRIVILEGES ON learnphpdb.* TO 'zemian'@'localhost';
FLUSH PRIVILEGES;
```
## PHP on Mac

The `/usr/bin/php` that comes with MacOX does not include `php-cgi` ?

We can try to install latest version with `brew install php`


## MAMP pre-package install

* [XAMP](https://www.apachefriends.org/index.html) - XAMPP is a completely free, easy to install Apache distribution containing MariaDB, PHP, and Perl. 
* [MAMP](https://www.mamp.info/en/mamp) - The free web development solution with Apache, Nginx, PHP & MySQL

## PHP versions

* 5.6.40 is the last version release before 7 and it has been discontinued since 10 Jan 2019.
* The `mysql_connect()` is only avaible in PHP 5 or below!

## Joomla and PHP debugging

Try setting the following in `configuration.php`

```
public $error_reporting = 'simple';
```

NOTE: PHP Warning is not just warnings, it actually stop application working!
