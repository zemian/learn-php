## Install

	brew install lighttpd

## Setup for plain HTML web server

	lighttpd -D -f lighttpd/lighttpd-www.conf

## Setup for PHP development

	lighttpd -D -f lighttpd/lighttpd-php.conf

## To run it as service (MacOSX)

```
brew info lighttpd

Docroot is: /usr/local/var/www

The default port has been set in /usr/local/etc/lighttpd/lighttpd.conf to 8080 so that
lighttpd can run without sudo.
```

We should version control these two folder!

1. Enable `include "conf.d/fastcgi.conf"` in `/usr/local/etc/lighttpd/modules.conf`

2. Enable PHP config in `/usr/local/etc/lighttpd/conf.d/fastcgi.conf`

  ```
  fastcgi.server = (
    ".php" =>
    (
      ( 
        "socket" => "/tmp/php.socket",
        "bin-path" => "/usr/local/php-5.6.40/bin/php-cgi",
        "bin-environment" => (
        "PHP_FCGI_CHILDREN" => "16",
        "PHP_FCGI_MAX_REQUESTS" => "10000"
      ),
      "min-procs" => 1,
      "max-procs" => 1,
      "idle-timeout" => 20
    ))
  )
  ```

3. Start web server

  brew install services
  brew services start lighttpd