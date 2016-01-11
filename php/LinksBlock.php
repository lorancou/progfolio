<?php

  /*
   * LinksBlock.php
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2016 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

class LinksBlock extends Block
{

   public final function displayBlock()
   {
       $connection = DatabaseConnection::instance();
       $connection->select(LINK_ELEMENT,0,10,NULL,"*","link_order");
       $title = new Title(2,"Links");
       $title->display();
	   while($record=$connection->next())
	   {
           $data = $connection->data();
           $div = new Division();
           $div->begin();
           $logo = new Logo(Logo::INFO,"?page=link&id-unix=".$data["id-unix"]);
           $logo->display();
           $link = new Link($data["name"],$data["url"]);
           $link->display();
           $div->end();
       }
   }
   
}

?>
