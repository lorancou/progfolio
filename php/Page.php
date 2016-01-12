<?php

  /*
   * Page.php
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2016 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README.md for details.
   */

abstract class Page
{

	abstract public function display();
    
    public function hasExtraHeaders()
    {
        return (file_exists('addon/addon_extra_headers.php'));
    }

    public function echoExtraHeaders()
    {
        require 'addon/addon_extra_headers.php';
    }

    public function hasBodyOnLoad() { return FALSE; }
    public function echoBodyOnLoad() {}

}

?>
