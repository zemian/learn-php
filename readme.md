## About PHP

[PHP](https://www.php.net/) is a popular general-purpose scripting language that is especially 
suited to web development.

Getting started:

```
# Interactive Shell
php -a

# Web Server
php -S localhost:3000
open http://localhost:3000/

# Using startup script
bin/server.sh
open http://localhost:3000

# Run php scripts
php hello.php
```

## Learning Notes

See `docs` folder for more.

## PHP Setup

If you are using Mac, then the following can setup the packages using Homebrew just as easily:

	brew install services mysql php
	brew services start mysql

See [php-setup.md](docs/php-setup.md) for more details.

## Setup Database

Setup a new MySQL database to do PHP web development.

```
bin/createdb.sh
```

Now try `http://localhost:3000/dbinfo.php`

See [mysql-setup.md](docs/mysql-setup.md) for more details.

## Setup Web Server

See [webserver-setup](docs/webserver-setup.md) for details.
