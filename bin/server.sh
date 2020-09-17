#!/usr/bin/env sh
echo "http://localhost:3001"
lighttpd -D -f lighttpd/lighttpd-php-web.conf
