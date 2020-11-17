#!/bin/sh
# Author: Zemian Deng 2020-11-14
SCRIPT_DIR=$(dirname $0)
source $SCRIPT_DIR/.env

echo "Creating DB $DB_NAME and user $DB_USER"
echo $DB_CREATE_DB_SQL | mysql -f $DB_OPTS_USER
echo "CREATE USER IF NOT EXISTS '$DB_USER'@'localhost' IDENTIFIED BY '$DB_PASSWORD';" | mysql -f $DB_OPTS_USER
echo "GRANT ALL PRIVILEGES ON $DB_NAME.* TO '$DB_USER'@'localhost';" | mysql -f $DB_OPTS_USER
