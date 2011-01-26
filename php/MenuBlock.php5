<?php

  /*
   * MenuBlock.php5
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2011 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

class MenuBlock extends Block
{
    public final function displayBlock()
    {
        DatabaseConnection::instance()->select(
            ITEM_ELEMENT,
            NULL,
            NULL,
            "`item_type` != \"link\"",
            "*",
            "item_order");

        $title = new Title( 2, MENU );
        //$title->display();

        $this->displayItems();
    }

    public final function displayItems()
    {
        while ( $record=DatabaseConnection::instance()->next() )
        {
            $data = DatabaseConnection::instance()->data();

            $par = new ContainerParagraph(NULL);
            $par->begin();

            $li = new ListElement("menu");
            $li->begin();

            $item = new Item( $data );
            $item->shortDisplay();

            $li->end();

            $par->end();
        }
    }
}

?>
