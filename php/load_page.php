<?php

/*------------------------------------------------------------------------------
load_page.php

Progfolio
Copyright (c) 2005-2018 Laurent Couvidou
Contact: lorancou@free.fr

This program is free software - see README.md for details.
------------------------------------------------------------------------------*/

require_once( 'extern/markdown/Parsedown.php' );

$Parsedown = new Parsedown();

function get_page_file( $name ) {
    return 'pages/'.$name.'.md';
}

$path = ltrim( $_SERVER['REQUEST_URI'], '/' );
$elements = explode( '/', $path );
if ( empty( $elements[0] ) ) {
    $file = get_page_file( 'index' );
} else {
    $file = get_page_file( end( $elements ) );
}

if ( file_exists( $file ) ) {
    $content = file_get_contents( $file );
    $markdown = $Parsedown->text( $content );
    $page_html = "\n" . $markdown . "\n";
} else if ( DEFAULT_README ) {
    $content = file_get_contents( "README.md" );
    $markdown = $Parsedown->text( $content );
    $page_html .= "\n" . $markdown . "\n";
} else {
    header( 'HTTP/1.1 404 Not Found' );
    $page_html = "<h1>Peugeot 404</h1><p>¯\_(ツ)_/¯ Sorry!</p>";
}

?>