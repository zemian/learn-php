#!/bin/sh
SCRIPT_DIR=$(dirname $0)
php -S localhost:3003 -t $SCRIPT_DIR/../web
