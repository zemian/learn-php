## How to run web server

    nginx -c nginx/nginx-www.conf
    nginx -s stop
    nginx -s reload

NOTE: The nginx works best if you set web root document folder as asbsolute path.

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

NOTE: We will use our config file, which uses port `3000` instead.

1. Copy and override `nginx/nginx-php.conf` to `/usr/local/etc/nginx/nginx.conf`

2. Start up `php-fpm`:

    /usr/local/php-5.6.40/sbin/php-fpm -D

3. Start web server

    brew install services
    brew services start nginx

4. Open http://localhost:3000

## Setup generic cgi-bin scripts
    
    fastcgi -s unix:/usr/local/var/run/nginx/fcgiwrap.socket
    nginx -c nginx/nginx-cgi-bin.conf

## How to configure WordPress in nginx

You should able to link `wordpress` folder into `www/apps` and then open 

    http://localhost:3000/wordpress/wp-admin

For more custom server config, see https://www.nginx.com/resources/wiki/start/topics/recipes/wordpress/

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
