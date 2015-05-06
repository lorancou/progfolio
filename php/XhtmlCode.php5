<?php

  /*
   * XhtmlCode.php5
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2012 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

class XhtmlCode implements IDisplayableContainer
{
	protected $page;
   
	public function __construct($page=NULL)
    {
        $this->page = $page;
    }

	public function begin()
	{
        // XHTML doctype
        echoFlat('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">');
        
        // hello world, I'm the first HTML element
        echoOpen('<html xmlns="http://www.w3.org/1999/xhtml">');

        // let's start with the headers
        echoOpen('<head>');

        // static XHTML headers
        echoFlat('<meta http-equiv="content-type" content="text/html; charset=utf-8" />');
        echoFlat('<title>'.HEADER.'</title>');
        echoFlat('<meta name="description" content="'.DESCRIPTION.'" />');
        echoFlat('<meta name="keywords" content="'.KEYWORDS.'" />');
        echoFlat('<meta name="robots" content="all"/>');
        echoFlat('<meta http-equiv="X-UA-Compatible" content="IE=EDGE" />');
        echoFlat('<link rel="stylesheet" type="text/css" href="style/reset.css" media="screen" />');
        echoFlat('<link rel="stylesheet" type="text/css" href="style/styles.css" media="screen" />');
        echoFlat('<link rel="icon" type="image/png" href="images/icon.png"/>');

        // some more header stuff on page demand
        if ($this->page && $this->page->hasExtraHeaders())
        {
            $this->page->echoExtraHeaders();
        }

        // that's it for the headers
        echoClose('</head>');
        
        // open body
        if ($this->page && $this->page->hasBodyOnLoad())
        {
            $this->page->echoBodyOnLoad();
        }
        else
        {
            echoOpen('<body>');
        }

        // open container div
        echoOpen('<div id="container">');
	}

	public function end()
	{
        // close everything
        echoClose('</div>');
        echoClose('</body>');
        echoClose('</html>');
	}

} // XhtmlCode

?>
