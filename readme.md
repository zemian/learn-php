This repopository contains various notes and scripts that helped me learn PHP
programming language.

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

## PHP Setup on MacOS

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

Create a new MySQL DB and user

```
CREATE DATABASE mydb CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
CREATE USER zemian@localhost IDENTIFIED BY 'secret123';
GRANT ALL PRIVILEGES ON mydb.* TO zemian@localhost;
```

For more, see [mysql-setup.md](docs/mysql-setup.md)

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
