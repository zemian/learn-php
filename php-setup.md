## Where is php.ini and what to set there?

Run `phpinfo.php` and you will see where the `.ini` file is located.

For example, PHP 5.6 is at `/usr/local/etc/php/5.6/php.ini`

You should set default timezone in `php.ini` file:

```
date.timezone = 'UTC'
```

## PHP on Mac

The easiest way is to use `brew install php`.

The package should also install `php-fpm`, and that allow you to run a background service like this:

  brew services start php

This is needed for web server suce as `nginx`.

NOTE: If you have multiple versions of PHP installed, ensure you setup your PATH correctly to pickup the correct version.

## PHP 5.6 on MacOS 10.15.16 and Homebrew 2.4.16

Current Homebrew 2.4.16 on MacOS 10.15.16 will install default php 7. If you want older PH 5.6, Run:

  brew tap exolnet/homebrew-deprecated
  brew install php@5.6

Then ensure to update PATH where it's installed.

### Error: `dyld: Library not loaded:`

You might see this error:

```
zedeng@zedeng-mac httpd % php -v
dyld: Library not loaded: /usr/local/opt/icu4c/lib/libicui18n.64.dylib
  Referenced from: /usr/local/opt/php@5.6/bin/php
  Reason: image not found
zsh: abort      php -v

# Or this:
zedeng@zedeng-mac httpd % php -v
dyld: Library not loaded: /usr/local/opt/openssl/lib/libcrypto.1.0.0.dylib
  Referenced from: /usr/local/opt/php@5.6/bin/php
  Reason: image not found
zsh: abort      php -v
```

PHP 5.6 requires `openssl@1.0` and `icu4c`. 

Ref: https://github.com/kelaberetiv/TagUI/issues/86

> This error is happening because macOS decided to drop OpenSSL and switched to LibreSSL. Furthermore, macOS Homebrew switched from OpenSSL v.1.0 to v1.1, breaking many other apps that are dependent on OpenSSL v1.0.

So we can try to reinstall these:

  brew uninstall --ignore-dependencies openssl icu4c

  # installing openssl version 1.0
  brew install https://github.com/tebelorg/Tump/releases/download/v1.0.0/openssl.rb
  ln -snf /usr/local/Cellar/openssl/1.0.2t /usr/local/opt/openssl

  # installing icu4c version 64
  brew install https://raw.githubusercontent.com/Homebrew/homebrew-core/a806a621ed3722fb580a58000fb274a2f2d86a6d/Formula/icu4c.rb
  ln -snf /usr/local/Cellar/icu4c/64.2 /usr/local/opt/icu4c

  # You might need to reinstall php@5.6 again
  brew uninstall php@5.6
  brew install php@5.6

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


## Compiling PHP 5.6.40 on MacOS 10.15.16

```
./configure --prefix=/usr/local/php-5.6.40 --with-iconv=/usr/local/opt/libiconv --enable-sockets --with-mysqli=mysqlnd --with-mysql --with-zlib=/usr/local/opt/zlib --enable-fpm
```

* Fix1: Got `readdir_r` error:

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

* Fix2: Got `_libiconv` error:

```
Undefined symbols for architecture x86_64:
  "_libiconv", referenced from:
```

To fix: find `EXTRA_LIBS` variable in `MakeFile`, then change `-liconv` to 

	/usr/local/opt/libiconv/lib/libiconv.dylib

NOTE: If you see two `-liconv`, replace both.

Ref: https://stackoverflow.com/questions/40167324/php-compile-fails-with-undefined-symbols-for-architecture-x86-64-libiconv-on-ma

NOTE: The binary for `php-fpm` is under `/usr/local/php-5.6.40/sbin/php-fpm`.

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

## PHP Error with "mysql_connect()" not defined

* 5.6.40 is the last version release before 7 and it has been discontinued since 10 Jan 2019.
* The `mysql_connect()` is only avaible in PHP 5 or below!
