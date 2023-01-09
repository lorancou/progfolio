<?php

/*------------------------------------------------------------------------------
index.php

Progfolio
Copyright (c) 2005-2023 Laurent Couvidou
Contact: hello@lorancou.net

This program is free software - see README.md for details.
------------------------------------------------------------------------------*/

require_once( 'php/config.php' );

$path = ltrim( $_SERVER[ 'REQUEST_URI' ], '/' );
$elements = explode( '/', $path );
if ( empty( $elements[ 0 ] ) ) {
    $page = 'index';
} else {
    $page = end( $elements );
}
require_once( 'php/page.php' );

// Could send something else than HTML here

?>