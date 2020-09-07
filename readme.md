https://www.php.net/

PHP is a popular general-purpose scripting language that is especially suited to web development.

If you are stuck with PHP, maybe this [PHP Tips](php-tips.md) might able to help you!

## Setup

You will need the following:

* PHP (PHP 7 is much faster than 5!)
* Database (MySQL or MariaDB)
* WebServer (Apache, Nginx or Lighttpd)

The easier way to get started with all above is using a pre-package installer. See [XAMPP](https://www.apachefriends.org/) See [xampp-setup.md](xampp-setup.md) for more details.

If you are using Mac, then the following can setup the package easily as well:

	brew install services mysql php httpd
	brew services start mysql
	brew services start httpd
	open http://localhost:3000/

## Setup PHP

Run `php -v` to verify you have installed. 

See [php-setup.md](php-setup.md) for more details.

## Setup Database

Setup a new database to do PHP web development.

```sql
CREATE USER 'zemian'@'localhost' IDENTIFIED WITH mysql_native_password BY 'test123';
CREATE DATABASE learnphpdb CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
GRANT ALL PRIVILEGES ON learnphpdb.* TO 'zemian'@'localhost';
FLUSH PRIVILEGES;
```

Now try `http://localhost:3000/php-app/dbtest.php`

See [mysql-setup.md](mysql-setup.md) for more details.

## Setup Web Server

Simply get a web server running and find where the DocumentRoot is located. Then deploy/link/hardcode-path of this `learn-php` repository folder under it.

For example: On Mac with `httpd`, you can simply symbolic link this repository like this:

	ln -s /Users/zedeng/src/zemian/learn-php /usr/local/var/www
	open http://localhost:3000/learn-php/php-web/

You may use any of the web server that supports PHP. See [webserver-setup](webserver-setup.md) for details.

## Commandline PHP Scripts

You can run PHP as command line script when learning without web server. See `php-scripts` folder. 

NOTE: If a file contains only PHP code, it is preferable to omit the PHP closing tag at the end of the file. This prevents accidental whitespace or new lines being added after the PHP closing tag

Ref: https://www.php.net/manual/en/language.basic-syntax.phptags.php
