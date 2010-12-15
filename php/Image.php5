<?php

  /*
   * Image.php5
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2010 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

class Image implements IDisplayableContent
{

	private $url;
	private $alt;
	private $title;
	private $link;
	
	public final function __construct($url,$alt,$title=NULL,$link=NULL)
	{
		$this->url = $url;
		$this->alt = $alt;
		$this->title = $title;
		$this->link = $link;
	}
	
	public final function display()
	{
		if ($this->link!=NULL) echo "<a href=\"$this->link\">";
		echo "<img src=\"$this->url\" alt=\"$this->alt\"";
		if ($this->title!=NULL) echo " title=\"$this->title\"";
		echo " />";
		if ($this->link!=NULL) echo "</a>";
	}

}

?>
