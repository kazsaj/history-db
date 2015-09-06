# history-db

## About

History DB is very similar to the [joshuacronemeyer/shellsink](https://github.com/joshuacronemeyer/shellsink) project, but with the goal of being as easy to install, and as portable, as possible.

This particular fork has (hopefully) a few improvements over the original implementation by [fredsmith/history-db](https://github.com/fredsmith/history-db):

 - Taking a bit different approach to the storage - most notably uses a hash field for the primary key, to (again hopefully) improve DB insert performance (`INSER INTO ... ON DUPLICATE KEY UPDATE`)
 - Doesn't require remote server usage, which makes the tool a bit less useful in general, but at the same time still provides any tools to work with the data that mysql would provide and makes sure that the entries in your history remain unique (at least after executing a `get_history`).
 - Some code refactoring, while still trying to retain the minimal form.

It consists of 2 parts

 - A server component built on a very simple mysql database and php installation
 - A pair of bash functions that can be included in a bashrc file to automatically post commands run to the web server, and to download and sync the local bash history file with the server.

## Configuration

 - Create the MySQL database on your central server using `db/schema.sql` and grant your web server appropriate access to that database.
 - Make the `web` directory accessible on a web server with php and php-mysql.
 - Modify 'php/db.php` to include your MySQL connection parameters
 - Modify `php/password.php` to include a download password (for `web/download.php`)
 - Include `bash/bashrc-funcs` in your bashrc somehow, either with a `source` statement, or copy+paste, remember to update the password for download.php
 - Create a symlink to one of the `bash/.sh` files in `/etc/profile.d` (if you want it to run for all users) or in `/home/$USER/.profile` (if for a single user) to make sure it is executed on login.

## Usage

 - Login and use bash as usual
 - After setting this up on a new server you can run `get_history` in shell, to load the history from DB

## Issues

 - Loading history reads it for all users, no matter which one you're logged as
 - Remote setup not tested yet