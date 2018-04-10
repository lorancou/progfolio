<?php

/*------------------------------------------------------------------------------
index.php

Progfolio
Copyright (c) 2005-2018 Laurent Couvidou
Contact: lorancou@free.fr

This program is free software - see README.md for details.
------------------------------------------------------------------------------*/

require_once( 'php/config.php' );

$path = ltrim( $_SERVER[ 'REQUEST_URI' ], '/' );
$elements = explode( '/', $path );
if ( empty( $elements[ 0 ] ) ) {
    $page = 'index';
    require( 'php/page.php' );
} else if ( $elements[ 0 ] == 'ping' ) {
    $ping = end( $elements );
    require( 'php/ping.php' );
} else {
    $page = end( $elements );
    require( 'php/page.php' );
}

?>