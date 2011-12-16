<?php

  /*
   * WelcomePage.php5
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2011 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

class WelcomePage extends Page
{
    public function hasExtraHeaders()
    {
        return (file_exists('addon/addon_extra_headers.php5'));
    }

    public function echoExtraHeaders()
    {
        require 'addon/addon_extra_headers.php5';
    }

    public function hasBodyOnLoad()
    {
        return (file_exists('addon/addon_body_on_load.php5'));
    }

    public function echoBodyOnLoad()
    {
        require 'addon/addon_body_on_load.php5';
    }

	public function display()
	{
		$block = new SimpleBlock(ARTICLE_ELEMENT,'welcome',DISPLAY_MODE);
		$block->display();

        if (file_exists('addon/addon.php5'))
        {
            $div = new Division("addon");
            $div->begin();
            require 'addon/addon.php5';
            $div->end();
        }
	}

}

?>
