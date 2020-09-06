## Install on Mac

```
brew info httpd

DocumentRoot is /usr/local/var/www.

The default ports have been set in /usr/local/etc/httpd/httpd.conf to 8080 and in
/usr/local/etc/httpd/extra/httpd-ssl.conf to 8443 so that httpd can run without sudo.

To have launchd start httpd now and restart at login:
  brew services start httpd
Or, if you don't want/need a background service you can just run:
  apachectl start
```

## Setup for a web server

Make a backup or git source control the `/usr/local/etc/httpd` folder first.

1. Copy and override file `httpd-php.conf` into `/usr/local/etc/httpd/httpd.conf`.

1. Restart server: `brew services start httpd`

2. Open `http://localhost:3000/`


Troubleshooting:

* To debug server errors: `tail -f /usr/local/var/log/httpd/error_log`
* To check config syntax: `apachectl configtest`

## Setup for PHP development

1. Edit `httpd.conf` and set "DocumentRoot" and "Directory" to /Users/zedeng/src/zemian/learn-php/php

	Add add `DirectoryIndex index.html index.php`

	And appens the following:

	```
	# PHP Setup
	LoadModule php7_module /usr/local/Cellar/httpd/2.4.46/lib/httpd/modules/libphp7.so
	<FilesMatch \.php$>
	    SetHandler application/x-httpd-php
	</FilesMatch>
	```

2. Restart server: `brew services restart httpd`

3. Open `http://localhost:8080/`

