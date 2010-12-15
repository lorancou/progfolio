<?php

  /*
   * Paragraph.php5
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2010 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

class Paragraph implements IDisplayableContent
{

	// TODO: add a parser in this class

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
        echo $this->texte; // parser here
        echo "</p>\n";
	}   
	
}

?>
