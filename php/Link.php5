<?php

  /*
   * Link.php5
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2011 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

class Link implements IDisplayableContent
{

	private $label;
	private $url;
   
   public final function __construct($label,$url,$title=NULL)
   {
   	$this->label = $label;
   	$this->url = $url;
   	$this->title = $title;
   }
   
   public final function display()
   {
		echo "<a href=\"$this->url\"";
		if ($this->title!=NULL) echo " title=\"$this->title\"";
		echo ">$this->label</a>\n";
	}
	
}

?>
