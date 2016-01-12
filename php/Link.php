<?php

  /*
   * Link.php
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2016 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README.md for details.
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
		if ($this->title!=NULL)
        {
            echoFlat('<a href="'.$this->url.'" title="'.$this->title.'">'.$this->label.'</a>');
        }
        else
        {
            echoFlat('<a href="'.$this->url.'">'.$this->label.'</a>');
        }
	}
	
}

?>
