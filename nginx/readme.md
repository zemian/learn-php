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

	brew install services
	brew services start nginx


```
brew info nginx

Docroot is: /usr/local/var/www

The default port has been set in /usr/local/etc/nginx/nginx.conf to 8080 so that
nginx can run without sudo.

nginx will load all files in /usr/local/etc/nginx/servers/.
```

To enable PHP:

1. Edit `/usr/local/etc/nginx/nginx.conf` and enable the following section:

	# Add root under server, adn remove "root" in each location setup
	# This shoud be default anyway
    root         /usr/local/var/www;

    location / {
        index 	index.html index.php;
    }

	# pass the PHP scripts to FastCGI server listening on 127.0.0.1:9000
    location ~ \.php$ {
        fastcgi_pass   127.0.0.1:9000;
        fastcgi_index  index.php;
        fastcgi_param  SCRIPT_FILENAME  /scripts$fastcgi_script_name;
        include        fastcgi_params;
    }

2. Start up `php-fpm`:

	/usr/local/php-5.6.40/sbin/php-fpm -D


