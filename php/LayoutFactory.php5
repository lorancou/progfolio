<?php

  /*
   * LayoutFactory.php5
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2012 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

class LayoutFactory
{

    private $layouts = array (
        CLASSIC_LAYOUT => "ClassicLayout",
        MAINTENANCE_LAYOUT => "MaintenanceLayout",
        );

    // singleton
    private static $instance;
    private function __construct(){}
    public static function instance()
    {
        if (!isset(self::$instance))
        {
            self::$instance = new LayoutFactory();
        }
        return self::$instance;
    }  

    function createLayout($code)
    {
        if (!isset($this->layouts[$code]))
        {
            if (!empty($code))
            {
                MessageStack::instance()->add(
                    Message::warning,get_class(),
                    "The layout ".$code." doesn't exist");
            }
            $code = DEFAULT_LAYOUT;
        }
        $layout = $this->layouts[$code];
        return new $layout;
    }

}

?>
