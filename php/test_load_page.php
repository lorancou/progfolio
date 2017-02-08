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

$path = ltrim($_SERVER['REQUEST_URI'], '/');    // Trim leading slash(es)
$elements = explode('/', $path);                // Split path on slashes
if(empty($elements[0])) {                       // No path elements means home
    $file='README.md';
} else //switch(array_shift($elements))             // Pop off first item and switch
{
	// TODO check if exists
	$file='pages/'.$elements[0].'.md';
    /*case 'Some-text-goes-here':
        ShowPicture($elements); // passes rest of parameters to internal function
        break;
    case 'more':
        ...
    default:
        header('HTTP/1.1 404 Not Found');
        Show404Error();*/
}


$content = file_get_contents( $file );
$page = $Parsedown->text($content);

$files = glob('pages/*.md');
$nav = implode("|",$files);

?>
