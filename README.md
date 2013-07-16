Infogate - A forum based on Laravel 3 - A PHP Framework
=================

Requires:
- Apache or Nginx
- PHP 5.4.10 with mcrypt
- SQL database

In order for this to work on your web server, clone this repository to a folder and create a symbolic link from application/public to your web server

For example:

    ln -s $CLONED_FOLDER/application/public $WEBSERVER/htdocs

Remember to set up application/config to randomise your secret key!
