This repository contains various notes and scripts that helped me learn PHP
programming language.

## Quick start

```
php -S localhost:3000 -t webroot
```

## Quick macOS PHP dev setup

1. Install `brew` from https://brew.sh

2. Install PHP and dev tools:

```
brew install mysql httpd php
brew services start mysql
brew services start httpd
brew services start php

# Setup Git the first time
brew install git
#   Replace your own name here!
git config --global user.name "Zemian Deng"
git config --global user.email zemiandeng@gmail.com

# Setup MySQL database with a db user:
mysql -u root

    sql> CREATE USER IF NOT EXISTS 'zemian'@'localhost' IDENTIFIED BY 'test123';
    sql> GRANT ALL PRIVILEGES ON *.* TO 'zemian'@'localhost';
```

3. Setup Apache web server `httpd.conf` for PHP

``` 
# 1. Enable PHP in Apache add the following to httpd.conf and restart Apache:
    LoadModule php_module /opt/homebrew/opt/php/lib/httpd/modules/libphp.so

    <FilesMatch \.php$>
        SetHandler application/x-httpd-php
    </FilesMatch>

# 2. Check DirectoryIndex includes index.php
    DirectoryIndex index.php index.html

# 3. Suport Pretty URL rewrite
    LoadModule rewrite_module lib/httpd/modules/mod_rewrite.so

    <Directory "/opt/homebrew/var/www">
      ...
      AllowOverride All
    </Directory>
```

4. Setup a test database

```
mysql -u zemian -p
    sql> CREATE DATABASE test CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
    sql> CREATE TABLE OPTIONS(name VARCHAR(100) PRIMARY KEY, value TEXT);
    sql> INSERT INTO OPTIONS(name, value) VALUES('test', 'Hello World!');
```

## mysql

```
==> Caveats
We've installed your MySQL database without a root password. To secure it run:
    mysql_secure_installation

MySQL is configured to only allow connections from localhost by default

To connect run:
    mysql -uroot

To restart mysql after an upgrade:
  brew services restart mysql
Or, if you don't want/need a background service you can just run:
  /opt/homebrew/opt/mysql/bin/mysqld_safe --datadir=/opt/homebrew/var/mysql
```

## httpd

```
==> Caveats
DocumentRoot is /opt/homebrew/var/www.

The default ports have been set in /opt/homebrew/etc/httpd/httpd.conf to 8080 and in
/opt/homebrew/etc/httpd/extra/httpd-ssl.conf to 8443 so that httpd can run without sudo.

To restart httpd after an upgrade:
  brew services restart httpd
Or, if you don't want/need a background service you can just run:
  /opt/homebrew/opt/httpd/bin/httpd -D FOREGROUND
```

## php

```
==> Caveats
To enable PHP in Apache add the following to httpd.conf and restart Apache:
    LoadModule php_module /opt/homebrew/opt/php/lib/httpd/modules/libphp.so

    <FilesMatch \.php$>
        SetHandler application/x-httpd-php
    </FilesMatch>

Finally, check DirectoryIndex includes index.php
    DirectoryIndex index.php index.html

The php.ini and php-fpm.ini file can be found in:
    /opt/homebrew/etc/php/8.0/

To restart php after an upgrade:
  brew services restart php
Or, if you don't want/need a background service you can just run:
  /opt/homebrew/opt/php/sbin/php-fpm --nodaemonize
```

## Test apache with php

```
cd www
ln -s ~/my-php/learn-php/webroot learn-php
open http://localhost:8080/learn-php/phpinfo.php
open http://localhost:8080/learn-php/dbtest.php
```

## About PHP

[PHP](https://www.php.net/) is a popular general-purpose scripting language 
that is especially suited to web development.

## Getting started with PHP

You can run PHP scripts in command line:

	php my-script.php

Or you can evaluate php code in an interactive prompt:

	php -a

Or in most of the cases you would need a Web Server and CGI to PHP script that
generate web pages from server dynamically. You can get started with PHP 
built-in web server:

	php -S localhost:3000
    open http://localhost:3000

Or you may setup a Aphace httpd web server to serve PHP script. See `docs`
folder for more detials.

## PHP 7.4 Setup on MacOS

Setup Homebrew package manager:

```
xcode-select --install
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
```

Now we can install the typical PHP development packages:

```
brew install mysql@5.7 php@7.4 composer httpd
brew services start mysql@5.7
brew services start httpd
```

See [php-setup.md](docs/php-setup.md) for more details.

## Important Server Info

The MySQL info:

* Data dir: `/usr/local/var/mysql`
* Configuration: `/usr/local/opt/mysql@5.7`

The httpd WebServer info:

* DocumentRoot: `/usr/local/var/www`
* Configuration: `/usr/local/etc/httpd/httpd.conf`
* Logs: `/usr/local/var/log/httpd`

## Setup Database

Create a new MySQL DB and user and a sample of table

```
CREATE USER zemian@localhost IDENTIFIED BY 'test123';

CREATE DATABASE mydb CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
GRANT ALL PRIVILEGES ON mydb.* TO zemian@localhost;

USE mydb;

CREATE TABLE options (
    id INT PRIMARY KEY AUTO_INCREMENT,
    created_dt DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified_dt DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    name VARCHAR(100) NOT NULL,
    value TEXT NULL,
    comment TEXT NULL,
    INDEX (name)
);
INSERT INTO options(name, value, comment) VALUES
    ('hello', 'Hello World!', NULL),
    ('mydata', '{"message": "Hello"}', 'The value contains JSON data.'),
    ('mynum', '999', NULL);
```

For more, see [mysql-setup.md](docs/mysql-setup.md)

### How to setup more user access

```
-- Enable user to connect from any remote hosts
-- NOTE: You must give password again here!
CREATE USER zemian@'%' IDENTIFIED BY 'test123';
GRANT ALL PRIVILEGES ON mydb.* TO zemian@'%';
SELECT * FROM mysql.user WHERE User='zemian' \G;
--

-- Removing Host from user
SELECT * FROM mysql.user WHERE User='zemian' \G;
DELETE FROM mysql.user WHERE User='zemian' AND Host='%';
FLUSH PRIVILEGES;
--
```

## PHP and Apache HTTPD Setup

a. Edit `/usr/local/etc/httpd/httpd.conf` with following:

    # Change httpd port from 8080 to 80 for easy dev
    Listen 80
    #...
    # Comment out default DocumentRoot and <Directory> below it b/c we will use virtual host below
    #...
    # Append bellow <VirtualHost> config at the end of the config file

```
# A virtual host setup for PHP development
<VirtualHost *:80>

    # Enable Modules
    LoadModule php7_module /usr/local/opt/php@7.4/lib/httpd/modules/libphp7.so
    LoadModule rewrite_module lib/httpd/modules/mod_rewrite.so
    
    # Enable PHP in Apache
    <FilesMatch \.php$>
        SetHandler application/x-httpd-php
    </FilesMatch>

    # Server Config
    DocumentRoot "/usr/local/var/www"
    ServerName localhost
    ErrorLog "/usr/local/var/log/httpd/error_log"
    CustomLog "/usr/local/var/log/httpd/access_log" common

    DirectoryIndex index.html index.php

    # Document Root Config
    <Directory "/usr/local/var/www">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted

        <IfModule mod_rewrite.c>
            RewriteEngine on
            RewriteCond %{REQUEST_FILENAME} !-f
            RewriteCond %{REQUEST_FILENAME} !-d
            RewriteRule ^.*$ /index.php [L,QSA]
        </IfModule>
    </Directory>
</VirtualHost>
```

b. Add `favicon.ico` to avoid redirect error

    cp httpd/favicon.ico /usr/local/var/www/favicon.ico

NOTE: If this file is missing, the Apache server will give 
    "AH00124: Request exceeded the limit of 10 internal redirects" error!

c. Restart Apache: `brew services restart httpd`

d. Test PHP

```
echo '<?php phpinfo();' > /usr/local/var/www/phpinfo.php
open http://localhost/phpinfo.php
```

For more, see [webserver-setup](docs/webserver-setup.md)

## Setup `learn-php` Web Application

The `learn-php` can be setup as a web application under Apache server. Some demos requires a DB setup, so for these
you need copy the environment file and change the DB connection info:

    cp env-sample.php env.php

Next, link the folder to the Apache DocumentRoot:

    ln -s $HOME/my-php/learn-php/public /usr/local/var/www/learn-php
    open http://localhost/learn-php

## How to create new Application with Composer

```
mkdir my-composer
cd my-composer
composer init
# Just hit ENTER to accept all default values
```

## How to Install xdebugger for PHP on macOS

See https://www.jetbrains.com/help/phpstorm/php-debugging-session.html

1. Install xdebugger for PHP
   See https://xdebug.org/docs/install#pecl
    ```
    pecl install xdebug
    ```

   Edit `php.ini` (use phpinfo() to find location) and ensure it contains the following:
    ```
    ; Xdebug
    zend_extension="xdebug.so"
    xdebug.mode=debug
    ```    

2. Restart Apache server!

3. Install Xdebug helper for Chrome with extension
   See https://chrome.google.com/webstore/detail/xdebug-helper/eadndfjplgieldjbigjakmdgkmoaaaoc

4. In PhpStorm, start listening for PHP debug

5. Create a `test.php` and set breakpoint

    ```
    //var_dump(php_ini_loaded_file(), php_ini_scanned_files());
    //phpinfo();
    xdebug_info();
    ```
   