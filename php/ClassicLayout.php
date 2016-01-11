<?php

  /*
   * ClassicLayout.php
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2016 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
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
			// languages
			$languages = new LanguagesBubble;
			$languages->display();

			// header
			$div = new UniqueDivision("none", "header");
			$div->begin();
			{
				$title1 = new Title(1, HEADER);
				$title1->display();
				$title2 = new Title(2, DESCRIPTION);
				$title2->display();
			}
			$div->end();

			// current page
			$div = new UniqueDivision("none", "content");
			$div->begin();
			{
				$page->display();
			}
			$div->end();

			// menu
			$div = new UniqueDivision("none", "navi");
			$div->begin();
			{
				$bloc = new MenuBlock();
				$bloc->display();
			}
			$div->end();

			// messages
			MessageStack::instance()->display();

			// footer
			$div = new UniqueDivision("none", "footer");
			$div->begin();
			{
				$par = new Paragraph(1, FOOTER);
				$par->display();
			}
			$div->end();
		}
        // end XHTML code
        $xhtml->end();
    }

}

?>
