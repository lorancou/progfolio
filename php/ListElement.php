<?php

  /*
   * ListElement.php
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2016 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README.md for details.
   */

class ListElement implements IDisplayableContainer
{

	private $type;

	public function __construct($type=NULL)
	{
		$this->type=$type;
	}

    public function begin()
    {
        if ($this->type!=NULL)
        {
            echoOpen('<li class="'.$this->type.'">');
        }
        else
        {
            echoOpen('<li>');
        }
	}   

    public function end()
    {
        echoClose('</li>');
	}   
	
}

?>
