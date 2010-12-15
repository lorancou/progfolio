<?php

  /*
   * LanguagesBubble.php5
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2010 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

class LanguagesBubble implements IDisplayableContent
{

    public function __construct()
    {
    }

    // TODO: ease use of other languages
    public function display()
    {
        $div = new Division( "languages" );
        $div->begin();

        $languages = array();
        if (Progfolio::instance()->language == Progfolio::FRENCH)
        {
            $languages["fr"] = "Français";
            $languages["en"] = "English";
            $languages["auto"] = "Auto";
        }
        else
        {
            $languages["en"] = "English";
            $languages["fr"] = "Français";
            $languages["auto"] = "Auto";
        }

        $form = new Form("langform", " ");
        $form->begin();
        if (Progfolio::instance()->language == Progfolio::FRENCH)
        {
?>
<label for="lang"><img src="images/languageicon.png" alt="Changer la langue"/></label>
<?
        }
        else
        {
?>
<label for="lang"><img src="images/languageicon.png" alt="Change language"/></label>
<?
        }
        $form->selection(LANG,$languages, true);
        $form->noScriptSubmit("apply",APPLY);
        $form->end();

        $div->end();
    }
		
}

?>
