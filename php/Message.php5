<?php

  /*
   * Message.php5
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2010 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

class Message
{

	const system = "system";
    const error = "error";
    const warning = "warning";
    const info = "info";
   
    private $type;
    private $class;
    private $texte;

    public function __construct($type,$class,$texte)
    {
        $this->type = $type;
        $this->class = $class;
        $this->texte = $texte;
    }
   
    public function display()
    {
        echo "<p class=\"$this->type\">\n";
        echo "$this->class: $this->texte\n";
        echo "</p>\n";
    }   

}

?>
