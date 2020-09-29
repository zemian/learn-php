See [MySQL Setup](https://github.com/zemian/learn-mysql) for details on general setup of the database.

## PHP 5.6 and MySQL 8 Error - character-set

```
Warning: mysql_connect(): Server sent charset (255) unknown to the client. Please, report to the developers in /Users/zedeng/src/zemian/learn-php/www/php-app/dbtest-old.php on line 18
```

To fix this, change your database encoding from `utf8mb4` to `utf8` ON the server `my.cnf` config file!

```	
# For PHP 5.6 support, we will default character-set to utf8 insetad of utf8mb4

[client]
default-character-set=utf8
 
[mysql]
default-character-set=utf8
 
[mysqld]
collation-server = utf8_unicode_ci
character-set-server = utf8
```

NOTE: Run `mysql --help` to see where `my.cnf` is loaded.

Ref: https://thisinterestsme.com/charset-255-unknown-mysql/

## PHP 5.6 and MySQL Error - password

```
Warning: mysql_connect(): The server requested authentication method unknown to the client [caching_sha2_password] in /Users/zedeng/src/zemian/learn-php/php/dbtest-old.php on line 18`
```

In the DB server `my.cnf` config file, add the following:

```
# For PHP 5.6 support, we will default older user password auth method
default-authentication-plugin=mysql_native_password
```

## Backup and Restore `learnphpdb`

```
# Backup
mysqldump --single-transaction --quick --no-autocommit --extended-insert=false -u root learnphpdb > learnphpdb-`date +%s`-dump.sql

# Restore
mysql -f -u root learnphpdb < learnphpdb-<date>-dump.sql
```
