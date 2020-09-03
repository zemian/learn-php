## How to run web server

    nginx -p . -c nginx/nginx-www.conf
    nginx -s stop
    nginx -s reload

## Setup for PHP development
    
    php-cgi -b 127.0.0.1:9000
    nginx -c nginx/nginx-php.conf

Or you may use the `php-fpm`:

    cp /usr/local/php-5.6.40/etc/php-fpm.conf.default /usr/local/php-5.6.40/etc/php-fpm.conf
    /usr/local/php-5.6.40/sbin/php-fpm -F

    # To in daemon background:
    /usr/local/php-5.6.40/sbin/php-fpm -D

By default it will listen on `127.0.0.1:9000`

## Debugging nginx server

    tail -f /usr/local/var/log/nginx/error.log

## To run it as service (MacOSX)

```
brew info nginx

Docroot is: /usr/local/var/www

The default port has been set in /usr/local/etc/nginx/nginx.conf to 8080 so that
nginx can run without sudo.

nginx will load all files in /usr/local/etc/nginx/servers/.
```

1. Edit `/usr/local/etc/nginx/nginx.conf` and enable the following section:

    # Add root under server, adn remove "root" in each location setup
    # Setup document root into this project "www" directory.
    root          /Users/zedeng/src/zemian/learn-php/www;

    # Add index.php to index under root location
    location / {
        index           index.html index.php;
    }

    # pass the PHP scripts to FastCGI server listening on 127.0.0.1:9000
    location ~ \.php$ {
        include         /usr/local/etc/nginx/fastcgi.conf;
        include         /usr/local/etc/nginx/fastcgi_params;
        fastcgi_pass    127.0.0.1:9000;
    }

2. Start up `php-fpm`:

    /usr/local/php-5.6.40/sbin/php-fpm -D

3. Start web server

    brew install services
    brew services start nginx

## Setup generic cgi-bin scripts

```
# Enable cgi-gin scripts
# NOTE: You may restrict the location path if needed
# NOTE: The scripts inside the "cgi-bin" must be executable mode.
# NOTE: You will need run "fcgiwrap -s unix:/usr/local/var/run/nginx/fcgiwrap.socket" command to run in background first
location .*/cgi-bin/.* {
    include        /usr/local/etc/nginx/fastcgi.conf;
    include        /usr/local/etc/nginx/fastcgi_params;
    fastcgi_pass   unix:/usr/local/var/run/nginx/fcgiwrap.socket;
}
```

## How to configure WordPress in nginx

https://www.nginx.com/resources/wiki/start/topics/recipes/wordpress/

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

## What does try_files means?

The following `try_files` means if the requested URI exists as file in system, continue processing, else sends 404.
this is good way to ensure such as `.php` should execute only if exists, else sends 404.

```
location ~ \.php$ {
    try_files $uri $uri/ =404;
}
```