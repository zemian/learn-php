## Install

	brew install lighttpd

## Setup for plain HTML web server

	lighttpd -D -f lighttpd/lighttpd-html.conf

## Setup for PHP development

	lighttpd -D -f lighttpd/lighttpd-php.conf

## To run it as service (MacOSX)

	brew install services
	brew services start lighttpd

```
Docroot is: /usr/local/var/www

The default port has been set in /usr/local/etc/lighttpd/lighttpd.conf to 8080 so that
lighttpd can run without sudo.
```
