## Setup for plain HTML web server

	nginx -p . -c nginx/config-html.conf
	nginx -s stop

## Setup for PHP development
	
	php-cgi -b 127.0.0.1:9000
	nginx -c $(pwd)/nginx/config-php.conf
