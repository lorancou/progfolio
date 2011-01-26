<?php

  /*
   * MessageStack.php5
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2011 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

class MessageStack
{

    private $stack = array();

    // singleton
    private static $instance;
    private function __construct(){}
    public static function instance() 
    { 
        if (!isset(self::$instance))
            self::$instance = new MessageStack(NULL); 
        return self::$instance; 
    }   

    public function add($type,$class,$texte)
    {
        $this->stack[] = new Message($type,$class,$texte);
    }
   
    public function display()
    {
        foreach($this->stack as $msg) $msg->display();
    }
   
}

?>
