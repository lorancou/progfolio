<?php

  /*
   * Block.php5
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2012 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

abstract class Block
{
   public final function display()
   {
       $div = new Division("block");
       $div->begin();
       $this->displayBlock();
       $div->end();
   }

   protected abstract function displayBlock();   
}

?>
