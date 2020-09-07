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

1. Start php-fpm: `brew services start php@5.6`

	Run `tail -f /usr/local/var/log/php-fpm.log` to check for activity

	Config is at `/usr/local/etc/php/5.6/php-fpm.conf`

2. 

## How to setup multiple PHP versions in Apache?

NOTE: As of MacOS 10.15.6, we can't run both php-fpm with `php` (7.4) and `php5.6` with brew. If you need both of them, you would need to build your own from source.

Ref: https://oanhnn.com/2015-09-22/running-multiple-php-versions-on-single-apache-instance.html
