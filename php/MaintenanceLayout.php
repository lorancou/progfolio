<?php

  /*
   * MaintenanceLayout.php
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2016 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README.md for details.
   */

class MaintenanceLayout implements ILayout
{

    public function display()
    {
        // begin XHTML code
        $xhtml = new XhtmlCode();
        $xhtml->begin();
        
        // languages
        $languages = new LanguagesBubble;
        $languages->display();

        // header
        $div = new UniqueDivision("none", "header");
        $div->begin();
        $title1 = new Title(1, HEADER);
        $title1->display();
        $title2 = new Title(2, DESCRIPTION);
        $title2->display();
        $div->end();

        // warn about maintenance
        MessageStack::instance()->add(
            Message::warning, NULL,
            MAINTENANCE_IN_PROGRESS);

        // messages
        MessageStack::instance()->display();

        // footer
        $div = new UniqueDivision("none", "footer");
        $div->begin();
        $par = new Paragraph(1, FOOTER);
        $par->display();
        $div->end();

        // end XHTML code
        $xhtml->end();	
    }

}

?>
