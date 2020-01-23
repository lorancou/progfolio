<?php

/*------------------------------------------------------------------------------
page.php

Progfolio
Copyright (c) 2005-2020 Laurent Couvidou
Contact: lorancou@free.fr

This program is free software - see README.md for details.
------------------------------------------------------------------------------*/

// Build nav HTML
$nav_html = "";
foreach ( NAV as $nav ) {
    $nav_html .= "&nbsp;<a href=\"/$nav\">/$nav</a>";
}

// Build page HTML
$file = 'pages/'.$page.'.md';
if ( file_exists( $file ) ) {
    $content = file_get_contents( $file );
    require_once( 'extern/markdown/Parsedown.php' );
    $Parsedown = new Parsedown();
    $markdown = $Parsedown->text( $content );
    $page_html = "\n" . $markdown . "\n";
} else {
    header( 'HTTP/1.1 404 Not Found' );
    $page_html = "<h1>Peugeot 404</h1><p>¯\_(ツ)_/¯ Sorry!</p>";
}

// Build social links HTML
$social_html = "";
foreach ( SOCIAL as $social ) {
    $social = explode( ',', $social );
    if ( count( $social ) >= 3 ) {
        $social_html .= "&nbsp;<a href=\"$social[2]\">"
                     . "<img src=\"/$social[0]\" alt=\"$social[1]\"/></a>";
    }
}

?>
<!DOCTYPE html PUBLIC
    "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Laurent Couvidou</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title><?php echo TITLE; ?></title>
        <meta name="description" content="<?php echo DESCRIPTION; ?>" />
        <meta name="keywords" content="<?php echo KEYWORDS; ?>" />
        <meta name="robots" content="all"/>
        <meta http-equiv="X-UA-Compatible" content="IE=EDGE" />
        <link rel="stylesheet" type="text/css" href="/style/styles.css" />
        <link rel="icon" type="image/png" href="/images/icon.png"/>
        <?php echo EXTRA_HEADER; ?>
    </head>
    <body>
        <header>
            <div id="center">
                <h1>
                    <a href="/"><?php echo TITLE; ?></a>
                </h1>
                <nav>
                    <?php echo $nav_html; ?>
                </nav>
            </div>
        </header>
        <main> 
            <div id="center">
                <?php echo $page_html; ?>
            </div>
        </main>
        <footer>
            <div id="center">
                <div id="copyright">
                    <?php echo COPYRIGHT; ?>
                </div>
                <!--
                Renders too small on Chrome mobile... Off for now
                <div id="social">
                    <?php echo $social_html; ?>
                </div>
                -->
            </div>
        </footer>
    </body>
</html>
