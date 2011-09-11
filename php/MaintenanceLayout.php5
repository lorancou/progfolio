<?php

  /*
   * MaintenanceLayout.php5
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2011 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

class MaintenanceLayout implements ILayout
{

    public function display() {

        // begin XHTML code
        $xhtml = new XhtmlCode(false);
        $xhtml->begin();
        
        // header
        $div = new UniqueDivision("test","header");
        $div->begin();
        $title = new Title(1,HEADER);
        $title->display();
        $div->end();

        // little message
        $div = new Division("default");
        $div->begin();
        $par = new Paragraph(1,MAINTENANCE_IN_PROGRESS);
        $par->display();
        $div->end();

        // footer
        $div = new UniqueDivision('test','footer');
        $div->begin();
        $par = new Paragraph(1,FOOTER);
        $par->display();
        $div->end();

        // end XHTML code
        $xhtml->end();	
    }

}

?>
