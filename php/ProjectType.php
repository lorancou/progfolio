<?php

  /*
   * ProjectType.php
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2016 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README.md for details.
   */

class ProjectType extends Element
{

    // acts on project type elements
    public $code = PROJECT_TYPE_ELEMENT;

    private $id;
    private $name;
    private $description;

    public final function __construct($data)
    {
        $this->id = $data[ID];
        $this->name = $data["name_".Progfolio::instance()->language];
        $this->description = $data["description_".Progfolio::instance()->language];
    }

    public static function getDatabaseId($id)
    {
        $connection = Database::instance();
        $connection->select(
            "typep",
            0,1,
            "`typep_".ID."`='".$id."'",
            "typep_id");
        $connection->next();
        $data = $connection->data();
        return $data["id"];
    }

    public final function display()
    {
        $title = new Title(2,$this->name);
        $title->display();

        $desc = new MarkdownDiv($this->description);
        $desc->display();
    }

    public final function add($form)
    {
        $title = new Title(2,"Add project type");
        $title->display();

        $form->shortText("Id",ID,$this->id);
        $form->shortText("Name","name_".Progfolio::instance()->language,"");
        $form->longText("Description","description_".Progfolio::instance()->language,"");
    }

    public final function edit($form)
    {
        $title = new Title(2,"Edit project type: ".$this->id);
        $title->display();

        $form->shortText("Name","name_".Progfolio::instance()->language,$this->name);
        $form->longText("Description","description_".Progfolio::instance()->language,$this->description);
    }

    public final function confirm()
    {
    }

    public final function delete()
    {
        $title = new Title(2,"Delete project type: ".$this->id."?");
        $title->display();

        $par = new Paragraph(NULL,"WARNING! This could cause some trouble...");
        $par->display();
    }

}

?>
