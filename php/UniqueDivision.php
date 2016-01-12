<?php

  /*
   * UniqueDivision.php
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2016 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README.md for details.
   */

class UniqueDivision extends Division
{

	protected $id;
	
	public function __construct($type, $id)
    {
        parent::__construct($type);
        $this->id = $id;
    }

	public function begin()
	{
        echoOpen('<div id="'.$this->id.'" class="'.$this->type.'">');
	}
	
}

?>
