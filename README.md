Progfolio
================================================================================

The programmer's portfolio
--------------------------------------------------------------------------------

Copyright (c) 2006-2016 Laurent Couvidou  
Contact: <lorancou@free.fr>

Setup
--------------------------------------------------------------------------------

Prerequisites:
- Web server with PHP support
- Database server (compatible with PHP PDO)

Copy all the files to the webserver, and rename the following ones:
- php/config.inc.php.template -> php/config.inc.php
- php/config-en.inc.php.template -> php/config-en.inc.php
- php/config-fr.inc.php.template -> php/config-fr.inc.php

Make sure you set proper permissions on these so that nobody can read password.

Enter the connection info for your database in the first one. Then import
db/structure.sql in it (using phpmyadmin for instance). It's ready! Just open
index.php in a browser. Contact me fortroubleshooting.

Known issues
---------------------------------------------------------------------------------

This code relies on magic_quotes_gpc set to "On" in php.ini. It's now deprecated
with PHP 5.3.0 and set to "Off" by default ; if your PHP version is that recent,
make sure you set it back to "On" or you'll get trouble with single quotes,
backslashes and others.

License
---------------------------------------------------------------------------------

This program is free software: you can redistribute it and/or modify it under the
terms of the GNU General Public License as published by the Free Software
Foundation, either version 3 of the License, or (at your option) any later
version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY
WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this
program (LICENSE file). If not, see <http://www.gnu.org/licenses/>.

External
--------------------------------------------------------------------------------

Open Sans
- extern/font
- Apache License, version 2.0
- Copyright (c) 2011 Steve Matteson, Ascender Corp
- <https://www.google.com/fonts/specimen/Open+Sans>

Full Operating system language detection
- extern/lang
- GNU GPL v3
- Copyright (c) 2008 Techpatterns.com
- <http://techpatterns.com/downloads/php_language_detection.php>

Parsedown
- extern/markdown
- MIT License
- Copyright (c) 2013 Emanuil Rusev, erusev.com
- <https://github.com/erusev/parsedown>