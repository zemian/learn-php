## Install on Mac

	brew install httpd

## Setup for a web server on MacOS

The config file here assumes `/usr/local/var/www` is your DocumentRoot and port is 3000.

1. Copy and override file `httpd-php.conf` into `/usr/local/etc/httpd/httpd.conf`.

2. Link this resitory to DocumentRoot: `ln -s /Users/zedeng/src/zemian/learn-php /usr/local/var/www`

3. Re/start server: `brew services start httpd`

4. Open open http://localhost:3000/learn-php/php-web/

Troubleshooting:

* To debug server errors: `tail -f /usr/local/var/log/httpd/error_log`
* To check config syntax: `apachectl configtest`

## How to setup php-fpm in Apache?

Ref: https://cwiki.apache.org/confluence/display/HTTPD/PHP-FPM

1. Start php-fpm: `brew services start php@`

	Run `tail -f /usr/local/var/log/php-fpm.log` to check for activity

	Config is at `/usr/local/etc/php/7.4/php-fpm.conf`

2. Use `httpd-php-fpm.conf`

## How to setup multiple PHP versions in Apache?

NOTE: As of MacOS 10.15.6, we can't run both php-fpm with `php` (7.4) and `php5.6` with brew. If you need both of them, you would need to build your own from source.

1. Locate custom PHP installations:
	
	/usr/local/php-7.4.9/bin/php
	/usr/local/php-7.4.9/sbin/php-fpm

	/usr/local/php-5.6.40/bin/php
	/usr/local/php-5.6.40/sbin/php-fpm

2. Edit `etc/php-fpm.conf` for each installation to have a unique listenign port:

	For `/usr/local/php-5.6.40/etc/php-fpm.conf` let's use 

		listen = 127.0.0.1:9001

	For `/usr/local/php-7.4.9/etc/php-fpm.conf` let's use (it's the default anyway)

		listen = 127.0.0.1:9000

3. Start all the php-fpm for all your PHP versions:

	/usr/local/php-7.4.9/sbin/php-fpm
	/usr/local/php-5.6.40/sbin/php-fpm
	ps -ef |grep php

4. Use `httpd-php-multiple-fpm.conf`

5. Now you should get PHP 5.6 for http://localhost:3000/learn-joomla/joomla, and rest of the url such as http://localhost:3000/learn-php/php-web using PHP 7.4.

NOTE: You would need to shutdown `php-fpm` process manually with `kill` command when not in use.

## What's in the `lib/httpd/modules/libphp7.so` file?

When you building PHP from source, it usually replace file such as `lib/httpd/modules/libphp7.so` in your Apache lib directly. If you are using Hombrew to install PHP, then the httpd modules usually resides where the PHP package is (eg: `/usr/local/opt/php/lib/httpd/modules/libphp7.so`). You can use the `phpinfo.php` page to verify the version.
