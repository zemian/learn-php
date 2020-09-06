NOTE: You need to install PHP with fastcgi enabled in order to work with any of the webserver below.

## Using lighttpd

See `lighttd` folder

This *lighty* is a the most light weight and easiset to setup a web server and configured with PHP.

## Using nginx

See `nginx` folder

The `nginx` web server configuration file is the cleanest and easy to setup. The only draw back is that you must start PHP fastcgi server (or php-fpm) as separate process.

## Using Apahce httpd

See `httpd` folder

The Apache is a well known and production ready webserver used everywhere. Configuration files is difficult to setup.
