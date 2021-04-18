#!/bin/sh
SCRIPT_DIR=$(dirname $0)
DB_DIR=$SCRIPT_DIR/../db
mysql --verbose -u root < $DB_DIR/create.sql
mysql --verbose -u root mycmsdb < $DB_DIR/schema.sql
mysql --verbose -u root mycmsdb < $DB_DIR/data.sql
