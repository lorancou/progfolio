<?php

  /*
   * Title.php5
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2011 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

class Title implements IDisplayableContent
{
    protected $level;
    protected $title;

    public function __construct($level, $title)
    {
        if (is_int($level) && $level>0 && $level<10)
        {
            $this->level = $level;
        }
        else
        {
            $this->level=1;
            MessageStack::instance()->add(
                Message.warning,get_class(),
                "Bad level: ".$level.", using 1");
        }
        $this->title = $title;
    }

    public function display()
    {
        echoFlat('<h'.$this->level.'>'.$this->title.'</h'.$this->level.'>');
    }

}

?>
