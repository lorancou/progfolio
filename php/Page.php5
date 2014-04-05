<?php

  /*
   * Page.php5
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2012 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

abstract class Page
{

	abstract public function display();
    
    public function hasExtraHeaders()
    {
        return (file_exists('addon/addon_extra_headers.php5'));
    }

    public function echoExtraHeaders()
    {
        require 'addon/addon_extra_headers.php5';
    }

    public function hasBodyOnLoad() { return FALSE; }
    public function echoBodyOnLoad() {}

}

?>
