#!/bin/sh
SCRIPT_DIR=$(dirname $0)
php -S localhost:3000 -t $SCRIPT_DIR/../web
