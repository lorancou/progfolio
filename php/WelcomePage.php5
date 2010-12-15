<?php

  /*
   * WelcomePage.php5
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2010 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

class WelcomePage extends Page
{

	public function display()
	{
		$bloc = new SimpleBlock(ARTICLE_ELEMENT,'welcome',DISPLAY_MODE);
		$bloc->display();

        $bloc = new MinusBlock();
        $bloc->display();
	}

}

?>
