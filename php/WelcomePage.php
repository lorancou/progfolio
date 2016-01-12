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
    public function hasBodyOnLoad()
    {
        return (file_exists('addon/addon_body_on_load.php'));
    }

    public function echoBodyOnLoad()
    {
        require 'addon/addon_body_on_load.php';
    }

	public function display()
	{
		$block = new SimpleBlock(ARTICLE_ELEMENT,'welcome',DISPLAY_MODE);
		$block->display();

        if (file_exists('addon/addon.php'))
        {
            $div = new Division("addon");
            $div->begin();
            require 'addon/addon.php';
            $div->end();
        }
	}

}

?>
