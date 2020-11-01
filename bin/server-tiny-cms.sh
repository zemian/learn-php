#!/bin/sh
SCRIPT_DIR=$(dirname $0)
php -S localhost:3002 -t $SCRIPT_DIR/../tiny-cms
