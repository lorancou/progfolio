<?php

  /*
   * CompleteImage.php5
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2011 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

class CompleteImage extends Element
{

    // acts on image elements
    public $code = IMAGE_ELEMENT;

    public $id;
    private $name;
    private $title;
    private $alt;

    public final function __construct($data)
    {
        $this->id = $data[ID];
        $this->name = $data["name"];

        $this->title = $data["title_".Progfolio::instance()->language];
        $this->alt = $data["alt_".Progfolio::instance()->language];
    }

    public final function display()
    {
        $img = new Image(
            "./images/".$this->name,
            $this->alt,
            $this->title,
            "./images/".$this->name);
        $img->display();
    }

    public final function thumbnail()
    {
        $img = new Image(
            "./images/.".$this->name,
            $this->alt,
            $this->title,
            "?page=image&".ID."=".$this->id);
        $img->display();
    }

    public final function add($form)
    {
        $title = new Title(2,"Add image");
        $title->display();

        $form->shortText("Id",ID,$this->id);
        $form->shortText("Title","title_".Progfolio::instance()->language,"");
        $form->shortText("Alt","alt_".Progfolio::instance()->language,"");

        $form->file("image","Image");
    }

    public final function edit($form)
    {
        $title = new Title(2,"Edit image: ".$this->id);
        $title->display();

        $form->shortText("Name","name",$this->name);
        $form->shortText("Title","title_".Progfolio::instance()->language,$this->title);
        $form->shortText("Alt","alt_".Progfolio::instance()->language,$this->alt);
    }

    public final function confirm()
    {

    }

    public final function delete()
    {
        $title = new Title(2,"Delete image: ".$this->id."?");
        $title->display();

        $par = new Paragraph(NULL,"WARNING! This could cause some trouble...");
        $par->display();
    }

}

?>
