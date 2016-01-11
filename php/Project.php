<?php

  /*
   * Project.php
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2016 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

class Project extends Element
{

    // acts on project elements
    public $code = PROJECT_ELEMENT;

    public $id;
    private $name;
    private $uv;
    private $title;
    private $type;
    private $date_begin;
    private $date_end;
    private $semester; // destiné à la delete ?
    private $year; // destiné à la delete ?
    private $url;
    private $description;
    private $body;

    public final function __construct($data)
    {
        $this->id = $data[ID];
        $this->name = $data["name_".Progfolio::instance()->language];
        $this->uv = $data["uv"];
        $this->title = $data["title_".Progfolio::instance()->language];
        $this->type = $data["type"];
        $this->date_begin = $data["date_begin"];
        $this->date_end = $data["date_end"];
        $this->semester = $data["semester"];
        $this->year = $data["year"];
        $this->url = $data["url"];
        $this->description = $data["description_".Progfolio::instance()->language];
        $this->body = $data["body_".Progfolio::instance()->language];
    }

    // redef.
    public function adminFlags($mode)
    {
        switch ($mode)
        {
        case DISPLAY_MODE:
            return AdminBubble::EDIT|AdminBubble::PROJECT_MANAGEMENT|AdminBubble::DELETE;

        case ADD_MODE:
            return AdminBubble::BACK;

        case EDIT_MODE:
            return AdminBubble::PROJECT_MANAGEMENT|AdminBubble::BACK;

        case PROJECT_MANAGEMENT_MODE:
            return AdminBubble::EDIT|AdminBubble::BACK;

        case DELETE_MODE:
            return AdminBubble::BACK;

        case SUMMARY_MODE:
            return AdminBubble::EDIT|AdminBubble::PROJECT_MANAGEMENT|AdminBubble::DELETE;

        default:
            return 0;
        }
    }

    private function getDatabaseId()
    {
        $connection = Database::instance();
        $connection->select("project",0,1,"`project_".ID."`='".$this->id."'","project_id");
        $connection->next();
        $data = $connection->data();
        return $data["id"];
    }

    private function retrieveImages()
    {
        $images = array();
        $idBase = $this->getDatabaseId();
        $connection = Database::instance();
        $connection->select("project-image",NULL,NULL,"`project-image_id-project`='$idBase'","project-image_id-image","project-image_id-image");
        $idsImage = array();
        while ($connection->next())
        {
            $data = $connection->data();
            $idsImage[] = $data["id-image"];
        }
        foreach($idsImage as $idImage)
        {
            $connection->select("image",0,1,"`image_id`='$idImage'");
            $connection->next();
            $data = $connection->data();
            $idUnixImage = $data[ID];
            $images[] = ElementFactory::instance()->createElement(
                IMAGE_ELEMENT,$data);
        }
        return $images;
    }

    private function retrieveFiles()
    {
        $files = array();
        $idBase = $this->getDatabaseId();
        $connection = Database::instance();
        $connection->select("project-file",NULL,NULL,"`project-file_id-project`='$idBase'","project-file_id-file","project-file_id-file");
        $idsFile = array();
        while ($connection->next())
        {
            $data = $connection->data();
            $idsFile[] = $data["id-file"];
        }
        foreach($idsFile as $idFile)
        {
            $connection->select("file",0,1,"`file_id`='$idFile'");
            $connection->next();
            $data = $connection->data();
            $idUnixFile = $data[ID];
            $files[] = ElementFactory::instance()->createElement(
                FILE_ELEMENT,$data);
        }
        return $files;
    }

    private $name_monthes = array(
        JANUARY, FEBRUARY, MARCH,
        APRIL, MAY, JUNE,
        JULY, AUGUST, SEPTEMBER,
        OCTOBER, NOVEMBER, DECEMBER
        );

    private function formatDate($datetemps)
    {
        list($date,$temps) = explode(" ",$datetemps);
        list($year,$month,$jour) = explode("-",$date);
        if ($year == "0000") return NOW;
        //list($heure,$minute,$seconde) = explode("-",temps);
        return $this->name_monthes[$month-1]." $year";
    }

    public final function display()
    {
        $title = new Title(2,$this->name.($this->uv?" ($this->uv : $this->title)":""));
        $title->display();

        $dateBegin = $this->formatDate($this->date_begin);
        $dateEnd = $this->formatDate($this->date_end);
        if (0 != strcmp($dateBegin, $dateEnd))
        {
            $par = new Paragraph(NULL, $dateBegin . " - " . $dateEnd);
        }
        else
        {
            $par = new Paragraph(NULL, $dateBegin);
        }
        $par->display();

        if ($this->url)
        {
            $div = new Division();
            $div->begin();
            $link = new Link($this->url,$this->url);
            $link->display();
            $div->end();
        }

        $desc = new WikiDiv($this->description);
        $desc->display();

        $body = new WikiDiv($this->body);
        $body->display();


        $images = $this->retrieveImages();
        if (count($images) != 0)
        {
            $title = new Title(4,"Images");
            $title->display();
            $div = new Division("images");
            $div->begin();
            foreach ($images as $image)
                $image->thumbnail();
            $div->end();
        }

        $files = $this->retrieveFiles();
        if (count($files) != 0)
        {
            $title = new Title(4,"Files");
            $title->display();
            $div = new Division("files");
            $div->begin();
            foreach ($files as $file)
                $file->thumbnail();
            $div->end();
        }
    }

    public final function summary()
    {
        $div = new Division("section");
        $div->begin();

        $title = new Title(3,$this->name.($this->uv?" ($this->uv : $this->title)":""));
        $title->display();

        $dateBegin = $this->formatDate($this->date_begin);
        $dateEnd = $this->formatDate($this->date_end);
        if (0 != strcmp($dateBegin, $dateEnd))
        {
            $par = new Paragraph(NULL, $dateBegin . " - " . $dateEnd);
        }
        else
        {
            $par = new Paragraph(NULL, $dateBegin);
        }
        $par->display();

        if ($this->url)
        {
            $urlDiv = new Division();
            $urlDiv->begin();
            $link = new Link($this->url,$this->url);
            $link->display();
            $urlDiv->end();
        }

        $desc = new WikiDiv($this->description);
        $desc->display();

        $images = $this->retrieveImages();
        if (count($images) != 0)
        {
            $imagesDiv = new Division("images");
            $imagesDiv->begin();
            foreach ($images as $image)
                $image->thumbnail();
            $imagesDiv->end();
        }

        $files = $this->retrieveFiles();
        if (count($files) != 0)
        {
            $filesDiv = new Division("files");
            $filesDiv->begin();
            foreach ($files as $file)
                $file->thumbnail();
            $filesDiv->end();
        }

        if ($this->body)
        {
            $knowMoreDiv = new Division();
            $knowMoreDiv->begin();
            $logo = new Logo(Logo::INFO,"?page=project&id-unix=$this->id");
            $logo->display();
            $link = new Link( KNOW_MORE, "?page=project&id-unix=$this->id" );
            $link->display();
            $knowMoreDiv->end();
        }

        $div->end();
    }

    public final function add($form)
    {
        $title = new Title(2,"Add project");
        $title->display();

        $form->shortText("Id",ID,$this->id);

        $form->shortText("Name","name_".Progfolio::instance()->language,"");
        $form->shortText("Type","type","");

        $form->shortText("UV","uv","");
        $form->shortText("Title","title_".Progfolio::instance()->language,"");
        $form->shortText("Begin","date_begin","YYYY-MM-DD");
        $form->shortText("End","date_end","YYYY-MM-DD");
        $form->shortText("Year","year","");
        $form->shortText("Semester","semester","");
        $form->shortText("Year","year","");
        $form->shortText("URL","url","");

        $form->longText("Description","description_".Progfolio::instance()->language,"");
        $form->longText("Body","body_".Progfolio::instance()->language,"");
    }

    public final function edit($form)
    {
        $title = new Title(2,"Edit project: ".$this->id);
        $title->display();

        $form->shortText("Name","name_".Progfolio::instance()->language,$this->name);
        $form->shortText("Type","type",$this->type);

        $form->shortText("UV","uv",$this->uv);
        $form->shortText("Title","title_".Progfolio::instance()->language,$this->title);
        $form->shortText("Begin","date_begin",$this->date_begin);
        $form->shortText("End","date_end",$this->date_end);
        $form->shortText("Semester","semester",$this->semester);
        $form->shortText("Year","year",$this->year);
        $form->shortText("URL","url",$this->url);

        $form->longText("Description","description_".Progfolio::instance()->language,$this->description);
        $form->longText("Body","body_".Progfolio::instance()->language,$this->body);
    }

    public final function projectManagement()
    {
        $title = new Title(2,"Manage project: ".$this->id);
        $title->display();

        $connection = Database::instance();

        $title = new Title(3,"Images");
        $title->display();

        // add
        $connection->select(IMAGE_ELEMENT,0,10,NULL,IMAGE_ELEMENT."_".ID,IMAGE_ELEMENT."_".ID);
        $liste = array();
        while ($connection->next())
        {
            $data = $connection->data();
            $liste[$data[ID]] = $data[ID];
        }
        $aimage = new Form("aimage","?page=project&mode=proj-man&id-unix=".$this->id);
        $aimage->begin();
        $aimage->hidden(ACTION,ADD_IMAGE_ACTION);
        $aimage->hidden("project_".ID,$this->id);
        $aimage->selection("Image","image_".ID,$liste,$liste);
        $aimage->confirm("confirm","Add");
        $aimage->end();

        // delete
        $images = $this->retrieveImages();
        foreach ($images as $image)
        {
            $image->thumbnail();
            $simage = new Form("simage-".$image->id,"?page=project&mode=proj-man&id-unix=".$this->id);
            $simage->begin();
            $simage->hidden(ACTION,DELETE_ACTION);
            $aimage->hidden("project_".ID,$this->id);
            $aimage->confirm("confirm","Delete");
            $aimage->end();
        }

        $title = new Title(3,"Files");
        $title->display();

        // add
        $connection->select(FILE_ELEMENT,0,10,NULL,FILE_ELEMENT."_".ID,FILE_ELEMENT."_".ID);
        $liste = array();
        while ($connection->next())
        {
            $data = $connection->data();
            $liste[$data[ID]] = $data[ID];
        }
        $afile = new Form("afile","?page=project&mode=proj-man&id-unix=".$this->id);
        $afile->begin();
        $afile->hidden(ACTION,ADD_FILE_ACTION);
        $afile->hidden("project_".ID,$this->id);
        $afile->selection("File","file_".ID,$liste,$liste);
        $afile->confirm("confirm","Add");
        $afile->end();

        // delete
        $files = $this->retrieveFiles();
        foreach ($files as $file)
        {
            $file->thumbnail();
            $sfile = new Form("sfile-".$file->id,"?page=project&mode=proj-man&id-unix=".$this->id);
            $sfile->begin();
            $sfile->hidden(ACTION,DELETE_ACTION);
            $afile->hidden("project_".ID,$this->id);
            $afile->confirm("confirm","Delete");
            $afile->end();
        }
    }

    public final function confirm()
    {

    }

    public final function delete()
    {
        $title = new Title(2,"Delete project: ".$this->id."?");
        $title->display();
    }

}

?>
