<?php

  /*
   * AdminBubble.php5
   * ----------
   * 
   * Progfolio
   * Copyright (c) 2005-2010 Laurent Couvidou
   * Contact: lorancou@free.fr
   * 
   * This program is free software - see README for details.
   */

class AdminBubble implements IDisplayableContent
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
            echo "<a href=\"?".$this->beginUrl."mode=".EDIT_MODE."\">[ ed ]</a>\n";
        }
        if (($this->mode&self::PROJECT_MANAGEMENT)!=0)
        {
            echo "<a href=\"?".$this->beginUrl."mode=".PROJECT_MANAGEMENT_MODE."\">[ fi ]</a>\n";
        }
        if (($this->mode&self::DELETE)!=0)
        {
            echo "<a href=\"?".$this->beginUrl."mode=".DELETE_MODE."\">[ × ]</a>\n";
        }
        if (($this->mode&self::BACK)!=0)
        {
            echo "<a href=\"?".$this->beginUrl."mode=".DISPLAY_MODE."\">[ < ]</a>\n";
        }

        $div->end();
    }
		
}

?>
