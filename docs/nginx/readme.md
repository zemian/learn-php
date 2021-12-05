## Install on Mac

  brew install nginx

## Setup for a web server on MacOS

The config file here assumes `/usr/local/var/www` is your DocumentRoot and port is 3002.

The `nginx` web server requires separate process of `php-fpm` running in order to work.

You can start it using:
    
    brew services start php

Now you may configure and start the web server:

1. Copy and override `nginx/nginx-php.conf` into `/usr/local/etc/nginx/nginx.conf`.

2. Link this resitory to DocumentRoot: `ln -s /Users/zedeng/src/zemian/learn-php /usr/local/var/www`

3. Re/start web server `brew services start nginx`

4. Open http://localhost:3002/learn-php/php-web/

## Run php-fpm or php-cgi manually

Run `php-cgi` process manually (in the foreground):
    
    php-cgi -b 127.0.0.1:9000

Or run `php-fpm` process manually (it will starts in background. Use `ps -ef |grep php` to see it):

    php-fpm

NOTE: The `php-fpm` has a config file of it's own where you can specify the listen port. eg: See `/usr/local/php-7.4.9/etc/php-fpm.conf`

NOTE: Both `php-fpm` and `php-cgi` supports Unix socket instead of TCP port listener. In this
case, you would use `unix:/path/to/php.socket` string in the `nginx.conf` instead.

## Debugging nginx server

    tail -f /usr/local/var/log/nginx/error.log

## Setup generic cgi-bin scripts

    brew install fastcgi
    fastcgi -s unix:/usr/local/var/run/nginx/fcgiwrap.socket   
    nginx -c nginx/nginx-cgi-bin.conf

## Example of how to setup pretty URL with php scripts

Example from https://docs.modx.com/3.x/en/getting-started/friendly-urls/nginx
```
location / {
    if (!-e $request_filename) {
        rewrite ^/(.*)$ /index.php?q=$1 last;
    }
}
```

More example here:

- https://www.nginx.com/blog/creating-nginx-rewrite-rules/
- https://www.nginx.com/resources/wiki/start/topics/recipes/osticket/

## What does try_files means in conf file?

The following `try_files` means if the requested URI exists as file in system, continue processing, else sends 404.
this is good way to ensure such as `.php` should execute only if exists, else sends 404.

```
location ~ \.php$ {
    try_files $uri $uri/ =404;
}
```
