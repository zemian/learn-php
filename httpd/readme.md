## Install on Mac

	brew install httpd

## Setup for a web server

Make a backup or git source control the `/usr/local/etc/httpd` folder first.

1. Copy and override file `httpd-php.conf` into `/usr/local/etc/httpd/httpd.conf`.

2. Re/start server: `brew services start httpd`

3. Open http://localhost:3000/


Troubleshooting:

* To debug server errors: `tail -f /usr/local/var/log/httpd/error_log`
* To check config syntax: `apachectl configtest`
