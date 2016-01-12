<?php

  /*
   * Message.php
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2016 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README.md for details.
   */

class Message
{

	const system = "system";
    const error = "error";
    const warning = "warning";
    const info = "info";
   
    private $type;
    private $class;
    private $text;

    public function __construct($type,$class,$text)
    {
        $this->type = $type;
        $this->class = $class;
        $this->text = $text;
    }
   
    public function display()
    {
        if (empty($this->class))
        {
            $par = new Paragraph($this->type, $this->text);
            $par->display();
        }
        else
        {
            $par = new Paragraph($this->type, '['.$this->class.'] '.$this->text);
            $par->display();
        }
    }   

}

?>
