https://www.php.net/

PHP is a popular general-purpose scripting language that is especially suited to web development.

## Setup

You will need the following:

* PHP (PHP 7 is much faster than 5!)
* Database (MySQL or MariaDB)
* WebServer (Apache/Nginx/Lighttpd)

The easier way to get started with all above is using a pre-package installer. See [XAMPP](https://www.apachefriends.org/)

If you are using Mac, then the following can setup the package easily as well:

	brew install services mysql php lighttd 
	brew services start mysql
	brew services list

## How to run webserver

	lighttpd -D -f lighttpd/lighttpd.conf
	open http://localhost:3000/

## MySQL Setup

```sql
CREATE USER 'zemian'@'localhost' IDENTIFIED WITH mysql_native_password BY 'test123';
CREATE DATABASE learnphpdb CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
GRANT ALL PRIVILEGES ON learnphpdb.* TO 'zemian'@'localhost';
FLUSH PRIVILEGES;
```

## PHP Scripts

You can run PHP as command line script when learning without web server. See `php-scripts`. 

NOTE: If a file contains only PHP code, it is preferable to omit the PHP closing tag at the end of the file. This prevents accidental whitespace or new lines being added after the PHP closing tag

Ref: https://www.php.net/manual/en/language.basic-syntax.phptags.php
