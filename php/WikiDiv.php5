<?php

  /*
   * WikiDiv.php5
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2011 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

class WikiDiv implements IDisplayableContent
{
	protected $text;
	
	public function __construct($text)
    {
        $this->text = $text;
    }
   
    public function display()
    {
        echoOpen('<div class="wiki">');
        echoFlat(WikiParser::instance()->parse($this->text)); // TODO find a way to format this nicely
        echoClose('</div>');
	}   
	
}

?>
