<?php

  /*
   * AdminBubble.php
   * ----------
   * 
   * Progfolio
   * Copyright (c) 2005-2016 Laurent Couvidou
   * Contact: lorancou@free.fr
   * 
   * This program is free software - see README.md for details.
   */

class AdminBubble implements IDisplayable
{

    // mode
    const EDIT =                0x01;
    const PROJECT_MANAGEMENT =  0x02;
    const DELETE =              0x04;
    const BACK =                0x08;
    private $mode, $element, $id, $beginUrl;
	
    public function __construct($mode,$element,$id,$beginUrl=NULL)
    {
        if ($beginUrl==NULL)
            $this->beginUrl = "page=$element&".ID."=$id&";
        else
            $this->beginUrl = $beginUrl;	
        $this->mode = $mode;
        $this->element = $element;
        $this->id = $id;
    }

    public function display()
    {
        $div = new Division("admin");
        $div->begin();

        if (($this->mode&self::EDIT)!=0)
        {
            $link = new Link("[ ed ]", "?" . $this->beginUrl . "mode=" . EDIT_MODE);
            $link->display();
        }
        if (($this->mode&self::PROJECT_MANAGEMENT)!=0)
        {
            $link = new Link("[ fi ]", "?" . $this->beginUrl . "mode=" . PROJECT_MANAGEMENT_MODE);
            $link->display();
        }
        if (($this->mode&self::DELETE)!=0)
        {
            $link = new Link("[ x ]", "?" . $this->beginUrl . "mode=" . DELETE_MODE);
            $link->display();
        }
        if (($this->mode&self::BACK)!=0)
        {
            $link = new Link("[ < ]", "?" . $this->beginUrl . "mode=" . DISPLAY_MODE);
            $link->display();
        }

        $div->end();
    }
		
}

?>
