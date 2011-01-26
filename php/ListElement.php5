<?php

  /*
   * ListElement.php5
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2011 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
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
        echo "<li";
        if ($this->type!=NULL) echo " class=\"$this->type\"";
        echo ">\n";
	}   

    public function end()
    {
        echo "</li>\n";
	}   
	
}

?>
