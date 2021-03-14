## Install on Mac

  brew install lighttpd

## Override conf Setup for a web server on MacOS

The config file here assumes `/usr/local/var/www` is your DocumentRoot and port is 3001.

1. Copy and override `lighttpd/lighttpd-php.conf` into `/usr/local/etc/lighttpd/lighttpd.conf`.

2. Link this resitory to DocumentRoot: `ln -s /Users/zedeng/src/zemian/learn-php /usr/local/var/www`

3. Re/start web server `brew services start lighttpd`

3. Open http://localhost:3001/learn-php/php-web/

## Run as simple application process

You can run lightty as quick server with a specific config file:

  lighttpd -D -f lighttpd/lighttpd-php.conf
  open http://localhost:3001

Press CTRL+C to stop the server

## Using php-cgi vs php-fpm

The `php-cgi` is easier to setup and you can simply use `/tmp/php.socket` in the configuration without starting a daemon service. Note the `/tmp/php.socket` doesn't need to be exists to work!


The `php-fpm` usually is used for production uses and run as a daemon service with a port. We can also configure it to use a unix socket file if needed.

## Modify exisitng conf web server

1. Edit `/usr/local/etc/lighttpd/modules.conf` and enable `include "conf.d/fastcgi.conf"`.

2. Edit `/usr/local/etc/lighttpd/conf.d/fastcgi.conf` and enable `fastcgi.server` section with only `php-local` entry. Change `socket`, `bin-path` and `mx-procs`.
	
	```
	# Example
	fastcgi.server = ( ".php" =>
                   ( "php-local" =>
                     (
                       "socket" => "/tmp/php-fastcgi-1.socket",
                       "bin-path" => "/usr/local/bin/php-cgi",
                       "max-procs" => 4,
                       "broken-scriptfilename" => "enable",
                     ),
                   ),
                 )
	```

3. Edit `/usr/local/etc/lighttpd/lighttpd.conf` and change the following:

	* Set `var.server_root = "/usr/local/var/www"`
	* Set `server.port = 80`

4. Now `/usr/local/var/www` is ready to run any PHP application.

Should you need debug, see log file at `/usr/local/var/log/lighttpd/error.log`.

For more details on `fastcgi.server` config, see https://redmine.lighttpd.net/projects/lighttpd/wiki/Docs_ModFastCGI

## Setup Virtual Host


## Setup Apache - Add Virtual Host

https://www.digitalocean.com/community/tutorials/how-to-set-up-apache-virtual-hosts-on-centos-7


This example setup is for CentOS7.

NOTE: the `$USER` is non root user

```
sudo mkdir -p /var/www/example.com/public_html
sudo chown -R $USER:$USER /var/www/example.com/public_html
sudo chmod -R 755 /var/www

echo 'HELLO' > /var/www/example.com/public_html/index.html

sudo mkdir /etc/httpd/sites-available
# To enable, create symbolic links
sudo mkdir /etc/httpd/sites-enabled

sudo vim /etc/httpd/conf/httpd.conf

# If domain name is not ready, we must set ServerName to the IP globally
    #ServerName example.com
    
# Security Safty - Disable global DocumentRoot and Directory
    #
    #DocumentRoot "/var/www/html"
    #
    #<Directory "/var/www">
    #    AllowOverride None
    #    # Allow open access:
    #    Require all granted
    #</Directory>
    #
    #<Directory "/var/www/html">
    # ...
    #</Directory>
    #
    
# Append 
    # Extra sites
    IncludeOptional sites-enabled/*.conf
    
sudo vim /etc/httpd/sites-available/example.com.conf

# Add - Named based Virtual Host
#
# If your domain name is not ready yet, remove ServerName and ServerAlias
#
<VirtualHost *:80>
    ServerName www.example.com
    ServerAlias example.com
    DocumentRoot /var/www/example.com/public_html
    ErrorLog /var/www/example.com/error.log
    CustomLog /var/www/example.com/requests.log combined
    
    <Directory "/var/www/example.com/public_html">
        Options Indexes FollowSymLinks
        AllowOverride None
        Require all granted
    </Directory>
</VirtualHost>
        
sudo ln -s /etc/httpd/sites-available/example.com.conf /etc/httpd/sites-enabled/example.com.conf

sudo apachectl configtest
sudo apachectl restart

open http://example.com
```

## Setup Apache with SSL

Setting up a Self-Signed SSL certificates on Apache for Testing:

https://www.digitalocean.com/community/tutorials/how-to-create-an-ssl-certificate-on-apache-for-centos-7

Creating a self signed cert at /etc/ssl/private
(Expires in 1 year, Mar/2022)
```
sudo yum install -y mod_ssl
sudo mkdir /etc/ssl/private
sudo chmod 700 /etc/ssl/private
sudo openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /etc/ssl/private/apache-selfsigned.key -out /etc/ssl/certs/apache-selfsigned.crt
sudo openssl dhparam -out /etc/ssl/certs/dhparam.pem 2048
cat /etc/ssl/certs/dhparam.pem | sudo tee -a /etc/ssl/certs/apache-selfsigned.crt

sudo cp /etc/httpd/conf.d/ssl.conf /etc/httpd/conf.d/ssl.conf.clean.bak

```

IMPORTANT:
To redirect all non-ssl traffic to https, we need to comment out VirtualHost in 
"/etc/httpd/sites-available/example.com.conf" and move them in this
"/etc/httpd/conf.d/ssl.conf"!

Edit `sudo vi /etc/httpd/conf.d/ssl.conf`

```
# Edit Inside <VirtualHost _default_:443> ONLY!
#
    ServerName www.example.com
    ServerAlias example.com
    DocumentRoot /var/www/example.com/public_html
    ErrorLog /var/www/example.com/error.log
    CustomLog /var/www/example.com/requests.log combined
    
    <Directory "/var/www/example.com/public_html">
        Options Indexes FollowSymLinks
        AllowOverride None
        Require all granted
    </Directory>
       
# Disable 
    #SSLProtocol
    #SSLCipherSuite

# Update
    SSLCertificateFile /etc/ssl/certs/apache-selfsigned.crt
    SSLCertificateKeyFile /etc/ssl/private/apache-selfsigned.key

# After </VirtualHost> Above, Add

    <VirtualHost *:80>
        Redirect permanent "/" "https://50.62.80.119/"
    </VirtualHost>
 

# Append follow for more secured SSL parameters (at the end of file, after "</VirtualHost>")

    # Begin copied text
    # from https://cipherli.st/
    # and https://raymii.org/s/tutorials/Strong_SSL_Security_On_Apache2.html
    
    SSLCipherSuite EECDH+AESGCM:EDH+AESGCM:AES256+EECDH:AES256+EDH
    SSLProtocol All -SSLv2 -SSLv3
    SSLHonorCipherOrder On
    # Disable preloading HSTS for now.  You can use the commented out header line that includes
    # the "preload" directive if you understand the implications.
    #Header always set Strict-Transport-Security "max-age=63072000; includeSubdomains; preload"
    Header always set Strict-Transport-Security "max-age=63072000; includeSubdomains"
    Header always set X-Frame-Options DENY
    Header always set X-Content-Type-Options nosniff
    # Requires Apache >= 2.4
    SSLCompression off
    SSLUseStapling on
    SSLStaplingCache "shmcb:logs/stapling-cache(150000)"
    # Requires Apache >= 2.4.11
    # SSLSessionTickets Off
       
sudo apachectl configtest
sudo apachectl restart
```
