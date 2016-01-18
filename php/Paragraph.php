<?php

  /*
   * Paragraph.php
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2016 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README.md for details.
   */

class Paragraph implements IDisplayable
{
	protected $type;
	protected $text;
	
	public function __construct($type, $text)
    {
        if (empty($type))
        {
            $this->type = "default";
        }
        else
        {
            $this->type = $type;
        }
        $this->text = $text;
    }
   
    public function display()
    {
        echoFlat('<p class="'.$this->type.'">'.$this->text.'</p>');
	}   
	
}

?>
