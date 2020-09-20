## Install on Mac

  brew install lighttpd

## Setup for a web server on MacOS

The config file here assumes `/usr/local/var/www` is your DocumentRoot and port is 3001.

1. Copy and override `lighttpd/lighttpd-php.conf` into `/usr/local/etc/lighttpd/lighttpd.conf`.

2. Link this resitory to DocumentRoot: `ln -s /Users/zedeng/src/zemian/learn-php /usr/local/var/www`

3. Re/start web server `brew services start lighttpd`

3. Open http://localhost:3001/learn-php/php-web/

## Run as simple application process

You can run lightty as quick server with a specific config file:

  lighttpd -D -f lighttpd/lighttpd-php.conf
  open http://localhost:3001

Press CTRL+C to stop the server

## Using php-cgi vs php-fpm

The `php-cgi` is easier to setup and you can simply use `/tmp/php.socket` in the configuration without starting a daemon service. Note the `/tmp/php.socket` doesn't need to be exists to work!


The `php-fpm` usually is used for production uses and run as a daemon service with a port. We can also configure it to use a unix socket file if needed.
