<?php

  /*
   * ClassicLayout.php5
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2011 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

class ClassicLayout implements ILayout
{

    public function display()
    {      
        $code = PageFactory::instance()->getCode($_GET["page"]);
        $page = PageFactory::instance()->createPage($code);

        // begin XHTML code
        $xhtml = new XhtmlCode($page);
        $xhtml->begin();

        // languages
        $languages = new LanguagesBubble;
        $languages->display();

        // header
        $div = new UniqueDivision("none", "header");
        $div->begin();
        $title1 = new Title(1, HEADER);
        $title1->display();
        $title2 = new Title(2, DESCRIPTION);
        $title2->display();
        $div->end();

        // current page
        $div = new UniqueDivision("none", "content");
        $div->begin();
        $page->display();
        $div->end();

        // menu
        $div = new UniqueDivision("none", "navi");
        $div->begin();
        $bloc = new MenuBlock();
        $bloc->display();
        $div->end();

        // messages
        MessageStack::instance()->display();

        // footer
        $div = new UniqueDivision("none", "footer");
        $div->begin();
        $par = new Paragraph(1, FOOTER);
        $par->display();
        $iconsDiv = new Division();
        $iconsDiv->begin();
        $linkedin = new Image(
            "images/icon_linkedin.png",
            "LinkedIn", "LinkedIn",
            "http://www.linkedin.com/in/lorancou");
        $linkedin->display();
        $twitter = new Image(
            "images/icon_twitter.png",
            "Twitter", "Twitter",
            "http://www.twitter.com/lorancou");
        $twitter->display();
        $email = new Image(
            "images/icon_email.png",
            "E-Mail Me", "E-Mail Me",
            "mailto:lorancou@free.fr");
        $email->display();
        $langicon = new Image(
            "images/icon_language.png",
            "Language Icon", "Language Icon",
            "http://www.languageicon.org");
        $langicon->display();
        $servericon = new ServerIcon();
        $servericon->display();
        $iconsDiv->end();
        $div->end();

        // end XHTML code
        $xhtml->end();
    }

}

?>
