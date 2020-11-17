#!/bin/sh
# Author: Zemian Deng 2020-11-14
SCRIPT_DIR=$(dirname $0)
source $SCRIPT_DIR/.env

echo "WARNING!: Dropping and re-creating DB $DB_NAME"
echo "DROP DATABASE IF EXISTS $DB_NAME" | mysql $DB_OPTS_USER
echo $DB_CREATE_DB_SQL | mysql $DB_OPTS_USER
