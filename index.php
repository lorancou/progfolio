<?php

/*------------------------------------------------------------------------------
index.php

Progfolio
Copyright (c) 2005-2017 Laurent Couvidou
Contact: lorancou@free.fr

This program is free software - see README.md for details.
------------------------------------------------------------------------------*/

require_once( 'php/config.php' );
require_once( 'php/test_load_page.php' );

?>
<!DOCTYPE html PUBLIC
    "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title><?php echo TITLE; ?></title>
        <meta name="description" content="<?php echo DESCRIPTION; ?>" />
        <meta name="keywords" content="<?php echo KEYWORDS; ?>" />
        <meta name="robots" content="all"/>
        <meta http-equiv="X-UA-Compatible" content="IE=EDGE" />
        <!--<link rel="stylesheet" type="text/css" href="/style/reset.css" />-->
        <link rel="stylesheet" type="text/css" href="/style/styles.css" />
        <link rel="icon" type="image/png" href="/images/icon.png"/>
    </head>
    <body>
        <div id="wrap">
            <header><?php echo TITLE; ?></header>
            <hr/>
            <div><?php echo $nav; ?></div>
            <?php echo $page; ?>
            <hr/>
            <footer><?php echo FOOTER; ?></footer>
        </div>
    </body>
</html>
