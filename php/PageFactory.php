<?php

  /*
   * PageFactory.php
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2016 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README.md for details.
   */

class PageFactory
{

    private $pages = array(
        "welcome"            => "WelcomePage",
        "login"              => "LoginPage",
        "projects"           => "ProjectsPage",
        "links"              => "LinksPage",
        ARTICLE_ELEMENT      => array ("SimplePage",ARTICLE_ELEMENT,"welcome"),
        FILE_ELEMENT         => array ("SimplePage",FILE_ELEMENT,""),
        IMAGE_ELEMENT        => array ("SimplePage",IMAGE_ELEMENT,""),
        ITEM_ELEMENT         => array ("SimplePage",ITEM_ELEMENT,""),
        LINK_ELEMENT         => array ("SimplePage",LINK_ELEMENT,""),
        PROJECT_ELEMENT      => array ("SimplePage",PROJECT_ELEMENT,""),
        PROJECT_TYPE_ELEMENT => array ("SimplePage",PROJECT_TYPE_ELEMENT,"")
        );

    // singleton
    private static $instance;
    private function __construct(){}
    public static function instance()
    {
        if (!isset(self::$instance))
        {
            self::$instance = new PageFactory();
        }
        return self::$instance;
    }

    function createPage($code)
    {
        if (!isset($this->pages[$code]))
        {
            if (!empty($code))
            {
                MessageStack::instance()->add(
                    Message::warning,get_class(),
                    "The page ".$code." doesn't exist");
            }
            $code = DEFAULT_PAGE;
        }        

        $page = $this->pages[$code];

        if (is_array($page)) // page with one element of given id
        {
            return new $page[0]($page[1],$page[2]);
        }
        else
        {
            return new $page;
        }
    }
}

?>
