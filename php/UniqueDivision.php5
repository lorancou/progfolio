<?php

  /*
   * UniqueDivision.php5
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2010 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

class UniqueDivision extends Division
{

	protected $id;
	
	public function __construct($type,$id)
    {
        parent::__construct($type);
        $this->id = $id;
    }

	public function begin()
	{
        echo "<div id=\"$this->id\" class=\"$this->type\">\n";
	}
	
}

?>
