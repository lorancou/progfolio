<?php

  /*
   * ContainerParagraph.php5
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2011 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

class ContainerParagraph implements IDisplayableContainer
{

	protected $type;
	
	public function __construct($type)
    {
        if (is_string($type) && $type!="")
            $this->type = $type;
        else
            $this->type = "default";
    }
   
    public function begin()
    {
        echo "<p class=\"$this->type\">\n";
	}
	
	public function end()
	{
        echo "</p>\n";
	}   
	
}

?>
