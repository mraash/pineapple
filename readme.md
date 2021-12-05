## 3rd task url path?

/admin/subscribers


## How to run localy

I assume that you already have

1. Apache (or another server)
2. PHP 7.3+
3. MySql
4. This magic folder where you can put the site code and it starts working

So...

1. In magic foler clone this repository
2. In your MySql server create new database and in it run sql commands from /database/init.sql
3. In /config.php change database connection constants (they're named with DB_ prefix)
4. Make your server forward all requests to /index.php (if you are using apache, just make sure that apache has mod_rewrite enabled and it reads the settings from the /.htpaccess file, otherwise I don’t know what you need to do (do you?))

Probably that's it
