https://www.php.net/

PHP is a popular general-purpose scripting language that is especially suited to web development.

## Setup

## How to run

	lighttpd -D -f lighttpd/lighttpd.conf
	open http://localhost:3000/

## MySQL Setup

```bash
brew install services mysql
brew services start mysql

mysql -u root

CREATE USER 'zemian'@'localhost' IDENTIFIED WITH mysql_native_password BY 'test123';
CREATE DATABASE learnphpdb CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
GRANT ALL PRIVILEGES ON learnphpdb.* TO 'zemian'@'localhost';
FLUSH PRIVILEGES;
```

## Pre-package setup for Apache, Mysql and PHP (XAMP)

* [XAMP](https://www.apachefriends.org/index.html) - XAMPP is a completely free, easy to install Apache distribution containing MariaDB, PHP, and Perl. 
* MAMP](https://www.mamp.info/en/mamp) - The free web development solution with Apache, Nginx, PHP & MySQL
* [AMPPS](https://ampps.com/) - AMPPS is an easy to install software stack of Apache, Mysql, PHP, Perl, Python

## PHP Scripts

You can run PHP as command line script when learning without web server. See `php-scripts`. 
