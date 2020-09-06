## Install on Mac

  brew install lighttpd

## Setup for a web server

1. Copy and override `lighttpd/lighttpd-php.conf` into `/usr/local/etc/lighttpd/lighttpd.conf`.

2. Re/start web server `brew services start lighttpd`

3. Open http://localhost:3001/

## Run as simle application process

You can run lightty as quick server with a specific config file:

  lighttpd -D -f lighttpd/lighttpd-php.conf
  open http://localhost:3001

Press CTRL+C to stop the server
