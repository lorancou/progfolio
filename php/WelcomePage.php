<?php

  /*
   * WelcomePage.php
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2016 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README.md for details.
   */

class WelcomePage extends Page
{

    public function display()
    {
        if ( WELCOME_README )
        {
            $block = new FileContentBlock( "/README.md" );
        }
        else
        {
            $block = new SimpleBlock( ARTICLE_ELEMENT, "welcome", DISPLAY_MODE );
        }
        $block->display();
    }

}

?>
