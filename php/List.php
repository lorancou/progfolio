<?php

  /*
   * List.php
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2016 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README.md for details.
   */

class List implements IDisplayableContainer
{

	const SORTED    = 0;
	const UNSORTED  = 1;

	private $order;
	private $type;
	
	public function __construct($order=self::UNSORTED,$type=NULL)
    {
     	$this->order = $order; // verify?
     	$this->type = $type;
    }
   
    public function begin()
    {
        if ($this->order == self::SORTED)
        {
            echo "<ol";
            if ($this->type!=NULL) echo " class=\"$this->type\"";
			echo ">\n";
		}
		else // unsorted by default
        {
            echo "<ul";
            if ($this->type!=NULL) echo " class=\"$this->type\"";
			echo ">\n";
        }	   	
	}
	
	public function end()
	{
        if ($this->order == self::SORTED)
            echo "</ol>\n";
        else // unsorted by default
            echo "</ul>\n";	   	
	}   
	
}

?>
