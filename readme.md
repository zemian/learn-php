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
brew install mysql php composer httpd
brew services start mysql
brew services start httpd
```

See [php-setup.md](docs/php-setup.md) for more details.

## Setup Database

Create a new MySQL DB and user

```
CREATE DATABASE mydb CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
CREATE USER zemian@localhost IDENTIFIED BY 'secret123';
GRANT ALL PRIVILEGES ON mydb.* TO zemian@localhost;
```

See [mysql-setup.md](docs/mysql-setup.md) for more details.

## Setup Web Server

See [webserver-setup](docs/webserver-setup.md) for details.
