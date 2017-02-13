<?php

/*------------------------------------------------------------------------------
load_nav.php

Progfolio
Copyright (c) 2005-2017 Laurent Couvidou
Contact: lorancou@free.fr

This program is free software - see README.md for details.
------------------------------------------------------------------------------*/

$nav = explode( ',', NAV );

$nav_html = "";

foreach ( $nav as $page ) {
    $nav_html = $nav_html.'<a href="'.$page.'">'.$page.'</a>&nbsp;';
}

$nav_html = $nav_html.'<a href="'.TWITTER.'"><img src="images/twitter.png" /></a>&nbsp;';
$nav_html = $nav_html.'<a href="'.LINKEDIN.'"><img src="images/linkedin.png" /></a>&nbsp;';
$nav_html = $nav_html.'<a href="'.EMAIL.'"><img src="images/email.png" /></a>';

?>