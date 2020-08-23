
## Mac Setup

The `/usr/bin/php` that comes with MacOX does not include `php-cgi` ?

We can try to install latest version with `brew install php`

## MAMP pre-package install

* [XAMP](https://www.apachefriends.org/index.html) - XAMPP is a completely free, easy to install Apache distribution containing MariaDB, PHP, and Perl. 
* [MAMP](https://www.mamp.info/en/mamp) - The free web development solution with Apache, Nginx, PHP & MySQL

## Installing php by building from source

1. Download source [`php-7.4.9.tar.gz`](https://www.php.net/downloads)
2. Run `brew install libiconv`
3. Run `./configure --prefix=/usr/local --with-iconv=/usr/local/opt/libiconv --enable-sockets --with-mysqli=mysqlnd --with-zlib`
4. Run `make`
5. Run `sudo make install`

NOTE: PHP 7 uses option `--with-mysqli` instead of `--with-mysql`. The `mysqlnd` is a PHP native driver.
