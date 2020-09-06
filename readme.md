https://www.php.net/

PHP is a popular general-purpose scripting language that is especially suited to web development.

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

Choose one of the server to setup. See [webserver-setup](webserver-setup.md)

It's recommended to use Apache HTTPD, even for local development.

## Commandline PHP Scripts

You can run PHP as command line script when learning without web server. See `php-scripts` folder. 

NOTE: If a file contains only PHP code, it is preferable to omit the PHP closing tag at the end of the file. This prevents accidental whitespace or new lines being added after the PHP closing tag

Ref: https://www.php.net/manual/en/language.basic-syntax.phptags.php

## Common PHP debugging

### Ensure `display_errors` flag is On. You can do this in three ways:

1. Try to add this directly in `.php` file for debugging:

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL | E_STRICT);

2. Or add the same in `php.ini` globally. It would require web server (Apache) restart!

3. Or your application might have a configuration file that overrides these. (eg: Joomla's `configuration.php` file.)

### Monitor the web server error log

For example with Apahce, run `tail -f /usr/local/var/log/httpd/error_log`

### Ensure your `php.ini` is clean and consistent

If you setting up multiple PHP env, ensure you used the same setting files. Check `phpinfo` page and verify if needed. Setting such as `short_open_tag` would have different values based on env, and if application is hardcoded to depend on this feature, you likely will get blank screen!

### Where is php.ini?

Run `phpinfo.php` and you will see where the `.ini` file is located.

For example, PHP 5.6 is at `/usr/local/etc/php/5.6/php.ini`

### Ensure `date.timezone` is set.

This value can be set in `php.ini` file globally. For example:

```
date.timezone = 'UTC'
```
