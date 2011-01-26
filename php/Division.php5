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
    //protected $title;

    public function __construct($type)
    {
        $this->type = $type;
        //if (is_string($title) && $title!="")
        //   $this->title = new Title(3,$title);
    }

    public function begin()
    {
        echo "<div class=\"$this->type\">\n";
        //echo $this->title?$this->title->display():"";
    }

    public function end()
    {
        echo "</div>\n";
    }

}

?>
