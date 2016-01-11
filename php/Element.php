<?php

  /*
   * Element.php
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2016 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

abstract class Element
{

	public abstract function __construct($data);

	public function adminFlags($mode)
	{
		switch ($mode)
		{
			case DISPLAY_MODE:
			return AdminBubble::EDIT|AdminBubble::DELETE;

			case ADD_MODE:
			return AdminBubble::BACK;

			case EDIT_MODE:
			return AdminBubble::BACK;

			case DELETE_MODE:
			return AdminBubble::BACK;
		
			default:
			return 0;
		}
	}

   public abstract function display();  
   public abstract function add($form);  
   public abstract function edit($form);  
   //public function preview($form);  
	public abstract function confirm();
   public abstract function delete();  
   
}

?>
