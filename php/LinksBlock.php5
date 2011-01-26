<?php

  /*
   * LinksBlock.php5
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2011 Laurent Couvidou
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
           $par = new ContainerParagraph(NULL);
           $par->begin();
           $logo = new Logo(Logo::INFO,"?page=link&id-unix=".$data["id-unix"]);
           $logo->display();
           $link = new Link($data["name"],$data["url"]);
           $link->display();
           $par->end();
       }
   }
   
}

?>
