<?php

  /*
   * MarkdownDiv.php
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2016 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README.md for details.
   */

class MarkdownDiv implements IDisplayable
{
    protected $text;

    public function __construct($text)
    {
        $this->text = $text;
    }

    public function display()
    {
        echoOpen('<div class="wiki">');
        $Parsedown = new Parsedown();
        echoFlat($Parsedown->text($this->text));
        echoClose('</div>');
    }   

}

?>
