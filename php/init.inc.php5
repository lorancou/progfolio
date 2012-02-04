<?php
session_start(); // shouldn't move! some web hosts don't like whitespaces before this

  /*
   * init.inc.php5
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2012 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */


// load classes code automatically
function __autoload($class_name) {
    require_once $class_name.'.php5';
}

// the message stack stores all erros
// TODO: would be cool to get php warnings there as well
error_reporting(E_ALL ^ E_NOTICE);
//$ret = set_error_handler('MessageStack::intercepteur');

function stripslashes_deep($value)
{
    $value = is_array($value) ?
        array_map('stripslashes_deep', $value) :
        stripslashes($value);
    return $value;
}

function createThumbnail($dir,$name)
{
    $path = $dir . '/' . $name;
	$info=getimagesize($path);
	$hauteur=100;
	if ($info[2] == 3)
		$src = imagecreatefrompng($path);
	else die( "Bad image extension: " . $info[2] );
	$img = imagecreatetruecolor(round(($hauteur/$info[1])*$info[0]), $hauteur);
	imagecopyresampled($img, $src, 0, 0, 0, 0, round(($hauteur/$info[1])*$info[0]), $hauteur, $info[0], $info[1]);
	imagepng($img, $dir . '/.' . $name);
}

$echoIndent = 0;
function echoOpen($str)
{
    global $echoIndent;
    for ($i = 0; $i<$echoIndent; ++$i)
    {
        echo '    ';
    }
    ++$echoIndent;
    echo $str . PHP_EOL;
}
function echoFlat($str)
{
    global $echoIndent;
    for ($i = 0; $i<$echoIndent; ++$i)
    {
        echo '    ';
    }
    echo $str . PHP_EOL;
}
function echoClose($str)
{
    global $echoIndent;
    --$echoIndent;
    for ($i = 0; $i<$echoIndent; ++$i)
    {
        echo '    ';
    }
    echo $str . PHP_EOL;
}
function echoComment($str)
{
    global $echoIndent;
    for ($i = 0; $i<$echoIndent; ++$i)
    {
        echo '    ';
    }
    echo '<!-- '.$str.' --!>' . PHP_EOL;
}
function echoLine($str)
{
    echo $str . '<br />';
}

?>
