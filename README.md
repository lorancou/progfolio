Progfolio
================================================================================

The programmer's portfolio
--------------------------------------------------------------------------------

Copyright (c) 2006-2012 Laurent Couvidou  
<http://lorancou.free.fr/index.php?page=project&id-unix=progfolio>  
Contact: <lorancou@free.fr>  
Formerly named "Page perso" for versions 0.1, 0.2 and 0.3

Wiki parser (wiki.inc.php)  
Copyright (c) Mildred  
<http://louve.dyndns.org/projets/wikiparser/index.html.fr>  
<http://mildred632.free.fr/projets/wikiparser/index.html.fr>

Full Operating system language detection (lang.inc.php)  
Copyright (c) Techpatterns.com  
<http://techpatterns.com/downloads/php_language_detection.php>

Setup
--------------------------------------------------------------------------------

Prerequisites:
- Web server with PHP5 support
- MySQL server (version >= 5.0)

Rename the following files:
- php/config.inc.php.template -> php/config.inc.php
- php/config-en.inc.php.template -> php/config-en.inc.php
- php/config-fr.inc.php.template -> php/config-fr.inc.php

Enter the connection info for your MySQL server in the first one. Make sure you
also set proper permissions on this file so that nobody can read your plain text
password. Then import db/structure.sql in your server's database (using
phpmyadmin for instance). It's ready! Just open index.php in a browser. Contact
me for troubleshooting.

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
