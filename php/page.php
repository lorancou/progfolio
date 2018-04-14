<?php

/*------------------------------------------------------------------------------
page.php

Progfolio
Copyright (c) 2005-2018 Laurent Couvidou
Contact: lorancou@free.fr

This program is free software - see README.md for details.
------------------------------------------------------------------------------*/

// Build nav HTML
$nav_html = "";
foreach ( NAV_INTERN as $nav_intern ) {
    $nav_html .= "&nbsp;<a href=\"/$nav_intern\">/$nav_intern</a>";
}
foreach ( NAV_EXTERN as $nav_extern ) {
    $nav_extern = explode( ',', $nav_extern );
    if ( count( $nav_extern ) >= 3 ) {
        $nav_html .= "&nbsp;<a href=\"$nav_extern[2]\">"
                   . "<img src=\"/$nav_extern[0]\" alt=\"$nav_extern[1]\"/></a>";
    }
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
        <link rel="stylesheet" type="text/css" href="/style/reset.css" />
        <link rel="stylesheet" type="text/css" href="/style/fonts.css" />
        <link rel="stylesheet" type="text/css" href="/style/layout.css" />
        <link rel="stylesheet" type="text/css" href="/style/styles.css" />
        <link rel="icon" type="image/png" href="/images/icon.png"/>
        <?php echo EXTRA_HEADER; ?>
    </head>
    <body>
        <div id="wrap">
            <header>
                &nbsp;
                <div id="title">
                    <img src="/symbols/icon.png" alt=""/> <a href="/"><?php echo TITLE; ?></a>
                </div>
                <nav>
                    <?php echo $nav_html; ?>
                </nav>
                &nbsp;
            </header>
            <main><?php echo $page_html; ?>
            </main>
            <footer>
                <?php echo COPYRIGHT; ?>
                &nbsp;
            </footer>
        </div>
    </body>
</html> 