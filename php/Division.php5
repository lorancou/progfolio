<?php

  /*
   * Division.php5
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2011 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

class Division implements IDisplayableContainer
{

    protected $type;

    public function __construct($type = NULL)
    {
        if (empty($type))
        {
            $this->type = "default";
        }
        else
        {
            $this->type = $type;
        }
    }

    public function begin()
    {
        echoOpen('<div class="'.$this->type.'">');
    }

    public function end()
    {
        echoClose('</div>');
    }

}

?>
