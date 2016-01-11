<?php

  /*
   * LanguagesBubble.php
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2014 Laurent Couvidou
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
        // build list, default to the current language
        $languages = array();
        if (Progfolio::instance()->language == Progfolio::FRENCH)
        {
            $languages[Progfolio::FRENCH] = "Français";
            $languages[Progfolio::ENGLISH] = "English";
            $languages[Progfolio::AUTO] = "Auto";
        }
        else
        {
            $languages[Progfolio::ENGLISH] = "English";
            $languages[Progfolio::FRENCH] = "Français";
            $languages[Progfolio::AUTO] = "Auto";
        }

        $div = new Division("languages");
        $div->begin();
		{
			// selection form
			$form = new Form("langform", " ");
			$form->begin();
			{
				$label = '<img src="res/lang.png" alt="'.CHANGE_LANGUAGE.'"/>';
				$form->selection($label, LANGUAGE, $languages, true);
				$form->noScriptSubmit("apply", APPLY);
			}
			$form->end();
		}
        $div->end();
    }
		
}

?>
