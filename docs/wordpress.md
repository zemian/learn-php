WordPress is easy to setup and can be used to verify your PHP env setup.

## Installing WordPress

1. Download WordPress from https://wordpress.org/download/
2. Unzip it under $HOME/my-php/wordpress
4. Create link to apache server:
    ln -s $HOME/my-php/wordpress /usr/local/var/www/wordpress
5. Create database:
    CREATE DATABASE wordpress;
    GRANT ALL PRIVILEDGES ON wordpress.* TO zemian@localhost;
6. Open http://localhost/wordpress
7. Follow instructions to complete the install

## Importing WordPress TestData

1. Download a copy from https://raw.githubusercontent.com/WPTT/theme-unit-test/master/themeunittestdata.wordpress.xml
2. Import test data into your WordPress install by going to Tools => Import => WordPress
3. Select the XML file from your computer
4. Click on "Upload file and import".
5. Under "Import Attachments," check the "Download and import file attachments" box and click submit.

## Import WordPress Sample Site

Install Astra Theme and then add one of the free Theme that has sample data.
