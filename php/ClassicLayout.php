<?php

  /*
   * ClassicLayout.php
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2016 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README.md for details.
   */

class ClassicLayout implements ILayout
{

    public function display()
    {      
        $page = PageFactory::instance()->createPage($_GET["page"]); // TODO: check if this is safe

        // begin XHTML code
        $xhtml = new XhtmlCode($page);
        $xhtml->begin();
        {
            echoOpen('<div class="bg">');
            echoOpen('<div class="container">');
            {
                echoOpen('<header>');
                {
                    $par= new Paragraph( "header", HEADER );
                    $par->display();
                }
                echoClose('</header>');

                $div = new UniqueDivision("none", "navbar");
                $div->begin();
                {
                    $par= new Paragraph( "description", DESCRIPTION );
                    $par->display();
                }
                $div->end();

                // languages
                //$languages = new LanguagesBubble;
                //$languages->display();
            }
            echoClose('</div>');
            echoFlat( "<hr/>" );
            echoClose('</div>');

            // open container div
            echoOpen('<div class="container">');
            {
                // current page
                $div = new UniqueDivision("none", "content");
                $div->begin();
                {
                    $page->display();
                }
                $div->end();

                // nav
                echoOpen( "<nav>" );
                {
                    $bloc = new MenuBlock();
                    $bloc->display();
                }
                echoClose('</nav>');
            }
            // close container div
            echoClose('</div>');

            // messages
            MessageStack::instance()->display();

            // open container div
            echoOpen('<div class="bg">');
            echoFlat( "<hr/>" );
            echoOpen('<div class="container">');
            {
                // footer
                echoOpen( "<footer>" );
                {
                    $par = new Paragraph(1, FOOTER);
                    $par->display();
                }
                echoClose( "</footer>" );
            }
            // close container div
            echoClose('</div>');
            echoClose('</div>');
        }

        // end XHTML code
        $xhtml->end();
    }

}

?>
