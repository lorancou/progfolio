<?php

  /*
   * Article.php
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2012 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

class Article extends Element
{

    // acts on article elements
    public $code = ARTICLE_ELEMENT;

    private $id = "";
    private $name = "";
    private $body = "";

    public final function __construct($data)
    {
        $this->id = $data[ID];
        $this->name = $data["name_".Progfolio::instance()->language];
        $this->body = $data["body_".Progfolio::instance()->language];
    }

    public final function display()
    {
        $title = new Title(2,$this->name);
        $title->display();

        $body = new WikiDiv($this->body);
        $body->display();
    }

    public final function add($form)
    {
        $title = new Title(2,"Add article");
        $title->display();

        $form->shortText("Id",ID,$this->id);
        $form->shortText("Name","name_".Progfolio::instance()->language,"");
        $form->longText("Body","body_".Progfolio::instance()->language,"");
    }

    public final function edit($form)
    {
        $title = new Title(2,"Edit article: ".$this->id);
        $title->display();

        $form->shortText("Name","name_".Progfolio::instance()->language,$this->name);
        $form->longText("Body","body_".Progfolio::instance()->language,$this->body);
    }

    public final function confirm()
    {
    }

    public final function delete()
    {
        $title = new Title(2,"Delete article: ".$this->id."?");
        $title->display();
    }

}

?>
