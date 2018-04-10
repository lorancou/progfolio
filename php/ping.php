<?php

/*------------------------------------------------------------------------------
ping.php

Progfolio
Copyright (c) 2005-2018 Laurent Couvidou
Contact: lorancou@free.fr

This program is free software - see README.md for details.
------------------------------------------------------------------------------*/

$im = imagecreatefrompng( "symbols/icon.png" );

header( 'Content-Type: image/png' );

imagepng( $im );
imagedestroy( $im );


?>