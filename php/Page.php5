<?php

  /*
   * Page.php5
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2011 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

abstract class Page
{

	abstract public function display();
    
    public function hasExtraHeaders() { return FALSE; }
    public function echoExtraHeaders() {}
    public function hasBodyOnLoad() { return FALSE; }
    public function echoBodyOnLoad() {}

}

?>
