[XAMPP](https://www.apachefriends.org/) Setup

## Error: "TempDir is not accessible" on Mac

> The `$cfg['TempDir'] (./tmp/)` is not accessible. phpMyAdmin is not able to cache templates and will be slow because of this

The default installation comes with `phpmyadmin` that show this error. To fix it:

	cd /Applications/XAMPP/xamppfiles/phpmyadmin
	mkdir tmp
	chmod 777 tmp

