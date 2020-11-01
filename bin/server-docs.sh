#!/bin/sh
SCRIPT_DIR=$(dirname $0)
php -S localhost:3001 -t $SCRIPT_DIR/../docs
