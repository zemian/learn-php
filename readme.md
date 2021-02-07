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

## PHP Setup

If you are using Mac, then the following can setup the packages using Homebrew just as easily:

	brew install services mysql php
	brew services start mysql

See [php-setup.md](docs/php-setup.md) for more details.

## Setup Database

Setup a new MySQL database to do PHP web development.

```sql
CREATE USER 'zemian'@'localhost' IDENTIFIED BY 'test123';
CREATE DATABASE testdb CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
GRANT ALL PRIVILEGES ON testdb.* TO 'zemian'@'localhost';
```

Now try `http://localhost:3000/dbtest.php`

See [mysql-setup.md](docs/mysql-setup.md) for more details.

## Setup Web Server

Just run

    php -S localhost:3000

See [webserver-setup](docs/webserver-setup.md) for details.
