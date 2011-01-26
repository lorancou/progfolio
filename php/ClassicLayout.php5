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

        // begin XHTML code
        $xhtml = new XhtmlCode( $code == "welcome" ? true : false );
        $xhtml->begin();

        // languages
        $languages = new LanguagesBubble;
        $languages->display();

        // header
        $div = new UniqueDivision("test","header");
        $div->begin();
        $title1 = new Title(1,HEADER);
        $title1->display();
        $title2 = new Title(2,DESCRIPTION);
        $title2->display();
        $div->end();

        // current page
        $div = new UniqueDivision("test","content");
        $div->begin();
        $page = PageFactory::instance()->createPage($code);
        $page->display();
        $div->end();

        // menu
        $div = new UniqueDivision("test","navi");
        $div->begin();
        $bloc = new MenuBlock();
        $bloc->display();
        $div->end();

        // footer
        $div = new UniqueDivision('test','footer');
        $div->begin();
        $par = new Paragraph(1,FOOTER);
        $par->display();
        $par = new ContainerParagraph(NULL);
        $par->begin();
        $linkedin = new Image(
            "images/icon_linkedin.png",
            "LinkedIn", "LinkedIn",
            "http://www.linkedin.com/in/lorancou");
        $linkedin->display();
        echo "&nbsp";
        $twitter = new Image(
            "images/icon_twitter.png",
            "Twitter", "Twitter",
            "http://www.twitter.com/lorancou");
        $twitter->display();
        echo "&nbsp";
        $email = new Image(
            "images/icon_email.png",
            "E-Mail Me", "E-Mail Me",
            "mailto:lorancou@free.fr");
        $email->display();
        echo "&nbsp";
        $langicon = new Image(
            "images/icon_language.png",
            "Language Icon", "Language Icon",
            "http://www.languageicon.org");
        $langicon->display();
        echo "&nbsp";
        $servericon = new ServerIcon();
        $servericon->display();
        $par->end();
        $div->end();

        // messages
        MessageStack::instance()->display();

        // end XHTML code
        $xhtml->end();
    }

}

?>
