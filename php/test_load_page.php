<?php

/*------------------------------------------------------------------------------
index.php

Progfolio
Copyright (c) 2005-2017 Laurent Couvidou
Contact: lorancou@free.fr

This program is free software - see README.md for details.
------------------------------------------------------------------------------*/

require_once( 'extern/markdown/Parsedown.php' );

$Parsedown = new Parsedown();

$hostname = gethostname();
$path = 'README.md';
$content = file_get_contents( "http://".$hostname."/".$path );
$page = $Parsedown->text($content);

?>
