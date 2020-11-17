#!/bin/sh
# Author: Zemian Deng 2020-11-14
SCRIPT_DIR=$(dirname $0)
source $SCRIPT_DIR/.env

echo "Backup DB $DB_NAME"
mysqldump --single-transaction \
--quick \
--no-autocommit \
--extended-insert=false \
$DB_OPTS_USER $DB_NAME > $SCRIPT_DIR/$DB_NAME.sql
