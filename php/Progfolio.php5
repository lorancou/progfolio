<?php

  /*
   * Progfolio.php5
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2011 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

class Progfolio
{

    // argument type
    const GET     = "GET";
    const POST    = "POST";
    const SESSION = "SESSION";

    // mode
    const USER    = 0;
    const ADMIN   = 1;
    public $mode = self::USER; // default

    // language
    const FRENCH  = "fr";
    const ENGLISH = "en";
    const AUTO    = "auto";
    public $language = self::ENGLISH; // default

    // singleton
    private static $instance;
    protected function __construct()
    {
        if (isset($_POST[ACTION]))
        {
            if ($_POST[ACTION] == LOGIN_ACTION)
            {
                if ($_POST["login"]!=LOGIN)
                {
                    MessageStack::instance()->add(
                        Message::error,get_class(),
                        "Bad login: ".$_POST["login"]);
                }
                else if ($_POST["password"]!=PASSWORD)
                {
                    MessageStack::instance()->add(
                        Message::error,get_class(),
                        "Bad password");
                }
                else
                {
                    $_SESSION['open']=TRUE;
                    MessageStack::instance()->add(
                        Message::info,get_class(),
                        "Login done");
                }
            }
            else if ($_POST[ACTION] == LOGOUT_ACTION)
            {
                if (isset($_COOKIE[session_name()]))
                {
                    setcookie(session_name(), '', time()-42000, '/');
                }
                unset($_SESSION);				
                session_destroy();			
            }
            else
            {
                // delay if preview
                if (!isset($_POST[PREVIEW_MODE]))
                {
                    ElementFactory::instance()->manage($_POST);
                }
            }
        }

        if ( $_SESSION["open"]==TRUE )
        {
            $this->mode = self::ADMIN;
        }

        // set new session language
        if (isset($_POST[LANGUAGE]))
        {
            if ($_POST[LANGUAGE] == AUTO)
            {
                if ( isset( $_SESSION[LANGUAGE] ) )
                {
                    unset($_SESSION[LANGUAGE]);
                }
            }
            else
            {
                $_SESSION[LANGUAGE] = $_POST[LANGUAGE] ;
            }
        }

        // use session language, or default if none set
        if ( isset( $_SESSION[LANGUAGE] ) )
        {
            $language = $_SESSION[LANGUAGE];
        }
        else
        {
            $data = get_language( "data" );
            $language = $data[0][1];
        }

        // make sure we use a supported language
        if ( $language == self::FRENCH || $language == self::ENGLISH )
        {
            $this->language = $language;
        }
    }
    
    public static function instance()
    {
        if (!isset(self::$instance))
        {
            self::$instance = new Progfolio();
        } 
        return self::$instance;
    }
        
    public function display()
    {
        if (isset($_GET[LAYOUT]))
        {
            $layout=LayoutFactory::instance()->createLayout( $_GET[LAYOUT] );
            $layout->display();
        }
        else if (file_exists('maintenance'))
        {
            $arr = new MaintenanceLayout();
            $arr->display();
        }
        else
        {
            $arr = new ClassicLayout();
            $arr->display();
        }
    }  

}

?>
