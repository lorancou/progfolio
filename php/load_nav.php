<?php

/*------------------------------------------------------------------------------
load_nav.php

Progfolio
Copyright (c) 2005-2017 Laurent Couvidou
Contact: lorancou@free.fr

This program is free software - see README.md for details.
------------------------------------------------------------------------------*/

$nav_html = "";

foreach ( NAV_INTERN as $nav_intern ) {
    $nav_html .= "&nbsp;<a href=\"$nav_intern\">$nav_intern</a>";
}

foreach ( NAV_EXTERN as $nav_extern ) {
    $nav_extern = explode( ',', $nav_extern );
    if ( count( $nav_extern ) >= 3 ) {
        $nav_html .= "&nbsp;<a href=\"$nav_extern[2]\">"
                   . "<img src=\"$nav_extern[0]\" alt=\"$nav_extern[1]\"/></a>";
    }
}

?>