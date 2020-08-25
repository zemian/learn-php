## Compiling from Source

1. Download source [`php-7.4.9.tar.gz`](https://www.php.net/downloads)
2. Run `brew install libiconv`

Basic:

```
./configure --prefix=/usr/local --with-iconv=/usr/local/opt/libiconv --enable-sockets --with-mysqli=mysqlnd
make
sudo make install
```

Add more options:

```
./configure --prefix=/usr/local --with-iconv=/usr/local/opt/libiconv --enable-sockets --with-mysqli=mysqlnd --with-pdo-mysql --with-zlib=/usr/local/opt/zlib --with-apxs2=/usr/local/bin/apxs
```

### Compiling PHP with MySQL

NOTE: PHP 7 uses option `--with-mysqli` instead of `--with-mysql`. The `mysqlnd` is a PHP native driver.

If you need the MySQL POD, add `--with-pdo-mysql`. This allows you to connect to many DB with same interface API.

### Compiling PHP with Apache HTTPD

Add the `--with-apxs2=/usr/local/bin/apxs` is only needed if you were to compile mod_php7.so for Apache HTTPD web server.


## Compiling PHP 5.6.40 on MacOSX

```
./configure --prefix=/usr/local/php-5.6.40 --with-iconv=/usr/local/opt/libiconv --enable-sockets --with-mysqli=mysqlnd --with-mysql --with-zlib=/usr/local/opt/zlib
```

* Got this error:

```
...
/Users/zedeng/src/zemian/php-5.6.40/main/reentrancy.c:139:23: error: too few arguments to function call, expected 3,
      have 2
        readdir_r(dirp, entry);
        ~~~~~~~~~            ^
/Library/Developer/CommandLineTools/SDKs/MacOSX10.15.sdk/usr/include/dirent.h:110:1: note: 'readdir_r' declared here
int readdir_r(DIR *, struct dirent *, struct dirent **) __DARWIN_INODE64(readdir_r);
^
```

To fix this, edit `main/php_config.h` file and replace 

	#define HAVE_OLD_READDIR_R 1

To

	#define HAVE_POSIX_READDIR_R 1

NOTE you need to fix this after you ran `./configure` script.

Ref: https://board.phpbuilder.com/d/7109292-reentrancyc130-too-few-arguments-to-f

* Another error:

```
Undefined symbols for architecture x86_64:
  "_libiconv", referenced from:
```

To fix: find `EXTRA_LIBS` variable in `MakeFile`, then change `-liconv` to 

	/usr/local/opt/libiconv/lib/libiconv.dylib

NOTE: If you see two `-liconv`, replace both.

Ref: https://stackoverflow.com/questions/40167324/php-compile-fails-with-undefined-symbols-for-architecture-x86-64-libiconv-on-ma

## Compiling PHP 7.0.33 on MacOSX

```
./configure --prefix=/usr/local/php-7.0.33 --with-iconv=/usr/local/opt/libiconv --enable-sockets --with-mysqli=mysqlnd --with-zlib=/usr/local/opt/zlib
```

* Got still the same error. Same solution as in php 5.6 can be apply?

```
/Users/zedeng/src/zemian/php-7.0.33/main/reentrancy.c:139:23: error: too few arguments to function call, expected 3,
      have 2
        readdir_r(dirp, entry);
        ~~~~~~~~~            ^
/Library/Developer/CommandLineTools/SDKs/MacOSX10.15.sdk/usr/include/dirent.h:110:1: note: 'readdir_r' declared here
int readdir_r(DIR *, struct dirent *, struct dirent **) __DARWIN_INODE64(readdir_r);
^
1 error generated.l
```
