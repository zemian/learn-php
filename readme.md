## About PHP

[PHP](https://www.php.net/) is a popular general-purpose scripting language that is especially suited to web development.

Getting started:

```
# Interactive Shell
php -a

# Web Server
cd php-web
php -S localhost:3000
open http://localhost:3000

# Using startup script
bin/server.sh
open http://localhost:3000

# Run php scripts
php php-scripts/hello.php
```

## Learning Notes

See `docs` folder for more.

## Typical PHP Development Setup

You will need the following:

* PHP (PHP 7 is much faster than 5!)
* Database (MySQL or MariaDB)
* WebServer (Apache, Nginx, Lighttpd or just PHP web server)

If you are using Mac, then the following can setup the packages using Homebrew just as easily:

	brew install services mysql php
	brew services start mysql

Then fires up your web server. PHP comes with a simple development server! Just run:

	php -S localhost:3000

Another way to get these software is to use a pre-package installer. See [php-pakcage-installer.md](docs/php-pakcage-installer.md) for more details.

Now we will go over each software setup in more details below.

## Setup PHP

Run `php -v` to verify you have installed. 

See [php-setup.md](docs/php-setup.md) for more details.

## Setup Database

Setup a new database to do PHP web development.

```sql
CREATE USER 'zemian'@'localhost' IDENTIFIED BY 'test123';
CREATE DATABASE testdb CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
GRANT ALL PRIVILEGES ON testdb.* TO 'zemian'@'localhost';
```

Now try `http://localhost:3000/dbtest.php`

See [mysql-setup.md](docs/mysql-setup.md) for more details.

## Setup Web Server

### General Web Server Setup

You may use any of the web server that supports PHP. See [webserver-setup](docs/webserver-setup.md) for details.

You can setup PHP either changing the server DocumentRoot folder directly pointing at the application folder, or have a general DocumentRoot folder, then copy or link the application folder under it.

For example: On Mac with `httpd`, you can simply symbolic link this repository like this:

	ln -s /Users/zedeng/src/zemian/learn-php /usr/local/var/www
	open http://localhost:3001/learn-php/php-web/phpinfo.php

## Project Folders

### PHP Web Folder

The `php-web` folder is a PHP enabled application where we can learn about web development with PHP code.

### PHP Scripts Folder

The `php-scripts` folder contains PHP script fiels that can be run as commandline with `php` executable without the need of a web server.

NOTE: If a file contains only PHP code, it is preferable to omit the PHP closing tag at the end of the file. This prevents accidental whitespace or new lines being added after the PHP closing tag

Ref: https://www.php.net/manual/en/language.basic-syntax.phptags.php

### Plain HTML `web` Folder

The `web` folder is a plain HTML/JavaScript/CSS files that demonstrate static web content.
