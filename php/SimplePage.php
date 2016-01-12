<?php

  /*
   * SimplePage.php
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2016 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README.md for details.
   */

class SimplePage extends Page
{

    protected $element;
    protected $id;

    public function __construct($element,$id)
    {
        $this->element = $element;
        $this->id = $id; // id par défaut pour la page
    }

    public function display()
    {
        // page mode
        if (isset($_POST[PREVIEW_BUTTON]))
        {
            $mode = PREVIEW_MODE;
        }
        else if (isset($_POST[CONFIRM_BUTTON]))
        {
            $mode = CONFIRM_MODE;
        }
        else if (isset($_GET[MODE]))
        {
            $mode = $_GET[MODE];
        }
        else if (isset($_POST[MODE]))
        {
            $mode = $_POST[MODE];
        }
        else
        {
            $mode = DISPLAY_MODE;
        }

        // element id
        if (isset($_GET[ID]))
        {
            $id = $_GET[ID];
        }
        else if (isset($_POST[ID]))
        {
            $id = $_POST[ID];
        }
        else
        {
            $id = $this->id;
        }

        $bloc = new SimpleBlock($this->element,$id,$mode);
        $bloc->display();
    }

}

?>
