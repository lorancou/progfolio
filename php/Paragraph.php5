<?php

  /*
   * Paragraph.php5
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2011 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

class Paragraph implements IDisplayableContent
{
	protected $type;
	protected $texte;
	
	public function __construct($type,$texte)
    {
        if (is_string($type) && $type!="")
            $this->type = $type;
        else
            $this->type = "default";
        $this->texte = $texte;
    }
   
    public function display()
    {
        echo "<p class=\"$this->type\">\n";
        echo WikiParser::instance()->parse($this->texte);
        echo "</p>\n";
	}   
	
}

?>
