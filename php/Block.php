<?php

  /*
   * Block.php
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2016 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README.md for details.
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
