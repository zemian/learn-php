## PHP on Mac

The easiest way is to use `brew install php`.

NOTE: If you have multiple versions of PHP installed, ensure you setup your PATH correctly to pickup the correct version.

## Where is php.ini?

On MacOS that installed with Homebrew, it is under `/usr/local/etc/php/<version>`.

## PHP 5.6 on MacOS 10.15.16 and Homebrew 2.4.16

NOTE: If you reqlly need PHP 5.6, it's recommended you compile this on your own and leave Homebrew to keep latest PHP is more cleaner env setup.

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

```
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
```

Fix summary:

```
ln -snf /usr/local/Cellar/openssl/1.0.2t /usr/local/opt/openssl
ln -snf /usr/local/Cellar/icu4c/64.2 /usr/local/opt/icu4c
```

This Homebrew installed package is located at `/usr/local/opt/php@5.6` or linked to `/usr/local/Cellar/php@5.6/5.6.40`

  /usr/local/opt/php@5.6/bin/php -v
  /usr/local/opt/php@5.6/sbin/php-fpm -v
  # /usr/local/etc/php/5.6/php-fpm.conf

## Switching back to latest PHP with Homebrew from PHP 5.6

```
ln -snf /usr/local/Cellar/icu4c/67.1 /usr/local/opt/icu4c
ln -snf /usr/local/Cellar/openssl@1.1/1.1.1g /usr/local/opt/openssl
brew uninstall --ignore-dependencies php
brew install php
brew link --overwrite php
```

To verify, run `/usr/local/bin/php -v` and this should be your default `php`

## Compiling PHP from Source

1. Download source [`php-7.4.9.tar.gz`](https://www.php.net/downloads)
2. Run `brew install libiconv`

Basic:

```
./configure --prefix=/usr/local --with-iconv=/usr/local/opt/libiconv --enable-sockets --with-mysqli=mysqlnd
make
sudo make install
```

Extra:

```
./configure --prefix=/usr/local/php-7.4.9 --with-iconv=/usr/local/opt/libiconv --enable-sockets --with-mysqli=mysqlnd --with-pdo-mysql --with-zlib=/usr/local/opt/zlib --with-apxs2=/usr/local/bin/apxs --enable-fpm
```

### Compiling PHP with MySQL

NOTE: PHP 7 uses option `--with-mysqli` instead of `--with-mysql`. The `mysqlnd` is a PHP native driver.

If you need the MySQL POD, add `--with-pdo-mysql`. This allows you to connect to many DB with same interface API.

### Compiling PHP with Apache HTTPD

Add the `--with-apxs2=/usr/local/bin/apxs` is only needed if you were to compile mod_php7.so for Apache HTTPD web server.


## Compiling PHP 5.6.40 on MacOS 10.15.16

Basic:

```
./configure --prefix=/usr/local/php-5.6.40 --with-iconv=/usr/local/opt/libiconv --enable-sockets --with-mysqli=mysqlnd --with-mysql=mysqlnd --with-pdo-mysql --with-zlib=/usr/local/opt/zlib --with-apxs2=/usr/local/bin/apxs -enable-fpm --enable-bcmath --enable-calendar --enable-exif

perl -p -i -e 's/#define HAVE_OLD_READDIR_R 1/#define HAVE_POSIX_READDIR_R 1/' main/php_config.h
perl -p -i -e 's#EXTRA_LIBS = -lresolv -liconv -liconv#EXTRA_LIBS = -lresolv /usr/local/opt/libiconv/lib/libiconv.dylib#' Makefile
make
sudo make install
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

Fix by commandline:
  
  perl -p -i -e 's/#define HAVE_OLD_READDIR_R 1/#define HAVE_POSIX_READDIR_R 1/' main/php_config.h
  grep READDIR_R main/php_config.h

* Fix2: Got `_libiconv` error:

```
Undefined symbols for architecture x86_64:
  "_libiconv", referenced from:
```

To fix: find `EXTRA_LIBS` variable in `MakeFile`, then change `-liconv` to 

	/usr/local/opt/libiconv/lib/libiconv.dylib

NOTE: If you see two `-liconv`, replace both.

Ref: https://stackoverflow.com/questions/40167324/php-compile-fails-with-undefined-symbols-for-architecture-x86-64-libiconv-on-ma

  
Fix by commandline:
  
  perl -p -i -e 's#EXTRA_LIBS = -lresolv -liconv -liconv#EXTRA_LIBS = -lresolv /usr/local/opt/libiconv/lib/libiconv.dylib#' Makefile
  grep 'EXTRA_LIBS = ' Makefile

NOTE: The binary for `php-fpm` is under `/usr/local/php-5.6.40/sbin/php-fpm`.

### Compiling PHP 5.6.40 on MacOS 10.15.16 with extra options

```
download https://ftp.gnu.org/pub/gnu/libiconv/libiconv-1.16.tar.gz

cd libiconv
./configure --prefix=/usr/local
make 
sudo make install

ln -snf /usr/local/Cellar/openssl/1.0.2t /usr/local/opt/openssl
ln -snf /usr/local/Cellar/icu4c/64.2 /usr/local/opt/icu4c

perl -p -i -e 's/buffio.h/tidybuffio.h/'' ext/tidy/*.c

'./configure' '--prefix=/usr/local/php-5.6.40' '--enable-bcmath' '--enable-calendar' '--enable-dba' '--enable-exif' '--enable-ftp' '--enable-fpm' '--enable-mysqlnd' '--enable-pcntl' '--enable-phpdbg' '--enable-shmop' '--enable-soap' '--enable-sockets' '--enable-sysvmsg' '--enable-sysvsem' '--enable-sysvshm' '--enable-wddx' '--enable-zip' '--with-apxs2=/usr/local/opt/httpd/bin/apxs' '--with-bz2=/Library/Developer/CommandLineTools/SDKs/MacOSX10.14.sdk/usr' '--with-curl=/usr/local/opt/curl-openssl' '--with-freetype-dir=/usr/local/opt/freetype' '--with-gd' '--with-gettext=/usr/local/opt/gettext' '--with-gmp=/usr/local/opt/gmp' '--with-iconv-dir=/usr/local/iconv-1.16' '--with-zlib=/Library/Developer/CommandLineTools/SDKs/MacOSX10.14.sdk/usr' '--with-icu-dir=/usr/local/opt/icu4c' '--with-jpeg-dir=/usr/local/opt/jpeg' '--with-kerberos=/Library/Developer/CommandLineTools/SDKs/MacOSX10.14.sdk/usr' '--with-layout=GNU' '--with-ldap=/usr/local/opt/openldap' '--with-ldap-sasl=/Library/Developer/CommandLineTools/SDKs/MacOSX10.14.sdk/usr' '--with-libedit=/Library/Developer/CommandLineTools/SDKs/MacOSX10.14.sdk/usr' '--with-libxml-dir=/Library/Developer/CommandLineTools/SDKs/MacOSX10.14.sdk/usr' '--with-libzip' '--with-mcrypt=/usr/local/opt/mcrypt' '--with-mhash=/Library/Developer/CommandLineTools/SDKs/MacOSX10.14.sdk/usr' '--with-mysql-sock=/tmp/mysql.sock' '--with-mysqli=mysqlnd' '--with-mysql=mysqlnd' '--with-ndbm=/Library/Developer/CommandLineTools/SDKs/MacOSX10.14.sdk/usr' '--with-openssl=/usr/local/opt/openssl' '--with-pdo-dblib=/usr/local/opt/freetds' '--with-pdo-mysql=mysqlnd' '--with-pdo-odbc=unixODBC,/usr/local/opt/unixodbc' '--with-pdo-pgsql=/usr/local/opt/libpq' '--with-pdo-sqlite=/usr/local/opt/sqlite' '--with-pgsql=/usr/local/opt/libpq' '--with-pic' '--with-png-dir=/usr/local/opt/libpng' '--with-pspell=/usr/local/opt/aspell' '--with-sqlite3=/usr/local/opt/sqlite' '--with-tidy=/usr/local/opt/tidy-html5' '--with-unixODBC=/usr/local/opt/unixodbc' '--with-xmlrpc' '--with-xsl=/Library/Developer/CommandLineTools/SDKs/MacOSX10.14.sdk/usr' 'CC=clang' 'CPPFLAGS=-DU_USING_ICU_NAMESPACE=1'

perl -p -i -e 's/#define HAVE_OLD_READDIR_R 1/#define HAVE_POSIX_READDIR_R 1/' main/php_config.h

make clean
make
sudo make install
```

Stuck on this error :(

```
  "_sk_value", referenced from:
      _zif_openssl_x509_parse in openssl.o
      _zif_openssl_csr_new in openssl.o
      _zif_openssl_pkcs7_verify in openssl.o
      _php_openssl_parse_config in openssl.o
      _php_openssl_sockop_set_option in xp_ssl.o
      _capture_peer_certs in xp_ssl.o
ld: symbol(s) not found for architecture x86_64
clang: error: linker command failed with exit code 1 (use -v to see invocation)
make: *** [libs/libphp5.bundle] Error 1
```

## PHP Error with "mysql_connect()" not defined

* 5.6.40 is the last version release before 7 and it has been discontinued since 10 Jan 2019.
* The `mysql_connect()` is only avaible in PHP 5 or below!

## PHP FastCGI

The `php` package should also comes with `php-cgi` or `php-fpm`. This allow webserver to spawn PHP process much more efficiently. The NGINX web server requires you to manually start it, while other such as Apache manages it automatically.

To start it manually:

  ```brew services start php```

NOTE: Starting from release 5.3.3 in early 2010, PHP has merged the php-fpm fastCGI process manager into its codebase, and it is now (as of 5.4.1) quite stable. See https://cwiki.apache.org/confluence/display/HTTPD/PHP-FPM
