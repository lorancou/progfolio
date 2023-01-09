<?php

/*------------------------------------------------------------------------------
page.php

Progfolio
Copyright (c) 2005-2023 Laurent Couvidou
Contact: hello@lorancou.net

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
        $social_html .= "\n&nbsp;$social[2]"
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
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=EDGE" />
        <link rel="stylesheet" type="text/css" href="/style/styles.css" />
        <link rel="icon" type="image/png" href="/symbols/icon.png"/>
        <?php echo EXTRA_HEADER."\n"; ?>
    </head>
    <body>
        <header>
            <div id="center">
                <div id="flexor">
                    <div id="title">
                        <h2><a href="/"><?php echo TITLE; ?></a></h2>
                    </div>
                    <div id="social">
                        <?php echo $social_html."\n"; ?>
                    </div>
                </div>
            </div>
        </header>
        <nav>
            <div id="center">
                <?php echo $nav_html."\n"; ?>
            </div>
        </nav>
        <main> 
            <div id="center">
                <?php echo $page_html; ?>
            </div>
        </main>
        <footer>
            <div id="center">
                <div id="copyright">
                    <?php echo COPYRIGHT."\n"; ?>
                </div>
            </div>
        </footer>
    </body>
</html>
