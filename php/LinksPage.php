<?php

  /*
   * LinksPage.php
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2016 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

class LinksPage extends Page
{

    public function display()
    {
        Database::instance()->select(
            ITEM_ELEMENT,
            NULL,
            NULL,
            "`item_type` = \"link\"",
            "*",
            "item_order");

        $title = new Title( 2, LINKS );
        $title->display();

        $this->displayItems();
    }

    public final function displayItems()
    {
        while ( $record=Database::instance()->next() )
        {
            $data = Database::instance()->data();

            $div = new Division();
            $div->begin();

            $li = new ListElement("menu");
            $li->begin();

            $item = new Item( $data );
            $item->shortDisplay();

            $li->end();

            $div->end();
        }
    }
}

?>
