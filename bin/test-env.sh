#!/bin/sh
# Author: Zemian Deng 2020-11-14
SCRIPT_DIR=$(dirname $0)
source $SCRIPT_DIR/.env

# Print important env vars
echo "Using $ENV_NAME env vars"
echo "DB_NAME=$DB_NAME"
echo "DB_USER=$DB_USER"
echo "DB_SUPER_USER=$DB_SUPER_USER"

# Run a query
echo "SELECT VERSION() as mysql_version" | mysql $DB_OPTS_USER
