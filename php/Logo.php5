<?php

  /*
   * Logo.php5
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2011 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

class Logo implements IDisplayableContent
{

    // TODO: "un-hardcode" that
	const INFO           = "./images/logo-info.png";
	const PAGE_ANY       = "./images/logo-page-quelconque.png";
	const PAGE_ANY_HOVER = "./images/logo-page-quelconque-actif.png";
	const PAGE_PRJ       = "./images/logo-page-project.png";
	const PAGE_PRJ_HOVER = "./images/logo-page-project-actif.png";
	
	private $image;
	private $link;	
	
	public function __construct($image,$link=NULL)
	{
		$this->image = $image;
		$this->link = $link;
	}
	
	public function display()
	{
		if ($this->link != NULL)
			echo "<a href=$this->link>"; 
		echo "<img src=$this->image alt=\"\" class=\"logo\" />";
		if ($this->link != NULL)
			echo "</a>";
		echo "\n";
	}

}

?>
