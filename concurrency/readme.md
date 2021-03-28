* How PHP handle concurrent requests in web server

PHP is a single process. In server environment, multiple concurrent requests are handle by web server (internally)
  or FastCGI (separate process or pool of processes).

- https://stackoverflow.com/questions/33624684/how-are-concurrent-requests-handled-in-php-using-threads-thread-pool-or-chil
- https://httpd.apache.org/docs/2.4/mod/worker.html
- https://anturis.com/blog/nginx-vs-apache/

* What is PHP FastCGI?

https://www.php.net/manual/en/install.fpm.php

* Thread safe PHP binary?

https://stackoverflow.com/questions/1623914/what-is-thread-safe-or-non-thread-safe-in-php

The mod_php is an Apache module extension to server. PHP itself is compiled in the module, so there is no complicated
setup is need other than load the module. 

The Apache can use Worker MPM (thread) or PreFork MPM (process) to process the PHP requests. In the httpd.conf
you will normally see these two lines, and only one will be used:

    LoadModule mpm_prefork_module lib/httpd/modules/mod_mpm_prefork.so
    #LoadModule mpm_worker_module lib/httpd/modules/mod_mpm_worker.so

To use Apache MWorker MPM (thread), the mod_php needs to be thread safe!

Use Apache PreFork MPM (process), then you don't need a thread safe PHP compiled binary.
(NOTE: This is the recommended way to configure Apache + PHP for low traffic site, or use
FastCGI for high traffic site)

In case of FastCGI with other servers, you do not need thread-safe php either.

* How do you verify is your PHP is setup in webserver?

In the `<?php phpinfo(); ?>` output, look for `Server API` entry. This could say something like `CGI/FastCGI` or 
`Apache 2.0 Handler`.

* How to verify Apache PreFork or Worker MPM?

https://serverfault.com/questions/88000/how-do-i-tell-if-apache-is-running-as-prefork-or-worker/488402
  
  Enable Apache mod_info
  Query the mod_info url, typically curl localhost/server-info
  The "Server Settings" section will show "MPM Name: Worker"

You can also use `phpinfo()` page to check the "Loaded Modules" section for `prefork` module name.
  
* PHP parallel - Lightweight thread in PHP 7.2 ?

https://www.php.net/manual/en/intro.parallel.php

* PHP functions

- https://www.php.net/manual/en/function.popen.php
- https://www.php.net/manual/en/function.pcntl-fork.php

* PHP default session file lock

This could block server requests! To prevent this, try to start and close a session as soon as possible. Or use DB
session store. Or avoid PHP session all together. (Consider using cookies as alternative).

* PHP built-in webserver is a Single Threaded Server

https://www.php.net/manual/en/features.commandline.webserver.php

* How to design a logger file appender

You need to use write file lock to prevent concurrent writes by multiple requests! 
See https://www.php.net/manual/en/function.flock.php
