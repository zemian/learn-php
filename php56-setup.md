## Installing PHP 5.6 on Mac with Homebrew

WARNINGS: The instructions does not work on MacOSX 10.15!

```
	brew tap exolnet/homebrew-deprecated
	brew install php@5.6

==> php@5.6
To enable PHP in Apache add the following to httpd.conf and restart Apache:
    LoadModule php5_module /usr/local/opt/php@5.6/lib/httpd/modules/libphp5.so

    <FilesMatch \.php$>
        SetHandler application/x-httpd-php
    </FilesMatch>

Finally, check DirectoryIndex includes index.php
    DirectoryIndex index.php index.html

The php.ini and php-fpm.ini file can be found in:
    /usr/local/etc/php/5.6/

php@5.6 is keg-only, which means it was not symlinked into /usr/local,
because this is an alternate version of another formula.

If you need to have php@5.6 first in your PATH run:
  echo 'export PATH="/usr/local/opt/php@5.6/bin:$PATH"' >> ~/.zshrc
  echo 'export PATH="/usr/local/opt/php@5.6/sbin:$PATH"' >> ~/.zshrc

For compilers to find php@5.6 you may need to set:
  export LDFLAGS="-L/usr/local/opt/php@5.6/lib"
  export CPPFLAGS="-I/usr/local/opt/php@5.6/include"


To have launchd start exolnet/deprecated/php@5.6 now and restart at login:
  brew services start exolnet/deprecated/php@5.6
Or, if you don't want/need a background service you can just run:
  php-fpm

```

But php is not working yet!

```
zedeng@zedeng-mac learn-php % /usr/local/opt/php@5.6/bin/php --version
dyld: Library not loaded: /usr/local/opt/icu4c/lib/libicui18n.64.dylib
  Referenced from: /usr/local/opt/php@5.6/bin/php
  Reason: image not found
zsh: abort      /usr/local/opt/php@5.6/bin/php --version
```

Found solutions here: https://www.sminrana.com/php/install-php-5-6-on-macos-catalina/
and here: https://gist.github.com/hgrimelid/703691ab48c4a4d0537cfe835b4d55a6

```
brew install https://github.com/tebelorg/Tump/releases/download/v1.0.0/openssl.rb
brew switch openssl 1.0.2t
brew reinstall https://raw.githubusercontent.com/Homebrew/homebrew-core/a806a621ed3722fb580a58000fb274a2f2d86a6d/Formula/icu4c.rb
brew link php@5.6
```

BUT THESE ARE STILL NOT WORKING!
