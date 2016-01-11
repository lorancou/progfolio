<?php

  /*
   * File.php
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2012 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

class File extends Element
{

    // acts on file elements
    public $code = FILE_ELEMENT;

    public $id;
    private $name;
    private $title;

    public final function __construct($data)
    {
        $this->id = $data[ID];
        $this->name = $data["name"];
        $this->title = $data["title_".Progfolio::instance()->language];
    }

    public final function display()
    {
        $title = new Title(2,"File ".$this->id);
        $title->display();

        $link = new Link($this->name,"files/".$this->name,$this->title);
        $link->display();
    }

    public final function thumbnail()
    {
        $link = new Link($this->name,"files/".$this->name,$this->title);
        $link->display();
    }

    public final function add($form)
    {
        $title = new Title(2,"Add file");
        $title->display();

        $form->shortText("Id",ID,$this->id);
        $form->shortText("Title","title_".Progfolio::instance()->language,"");

        $form->file("file","File");
    }

    public final function edit($form)
    {
        $title = new Title(2,"Edit file: ".$this->id);
        $title->display();

        $form->shortText("Title","title_".Progfolio::instance()->language,$this->title);
    }

    public final function confirm()
    {

    }

    public final function delete()
    {
        $title = new Title(2,"Delete file: ".$this->id."?");
        $title->display();

        $par = new Paragraph(NULL,"WARNING! This could cause some trouble...");
        $par->display();
    }

}

?>
