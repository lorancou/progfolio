<?php

  /*
   * Image.php
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2016 Laurent Couvidou
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
        $str = NULL;
		
        if ($this->link!=NULL)
        {
            $str .= '<a href="'.$this->link.'">';
        }
		
        $str .= '<img src="'.$this->url.'" alt="'.$this->alt.'"';

		if ($this->title!=NULL)
        {
            $str .= ' title="'.$this->title.'"';
        }
		
        $str .= ' />';

		if ($this->link!=NULL)
        {
            $str .= '</a>';
        }
        
        echoFlat($str);
	}

}

?>
