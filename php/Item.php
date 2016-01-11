<?php

  /*
   * Item.php
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2012 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

class Item extends Element
{

    public $code = ITEM_ELEMENT;

    private $id = "";
    private $order = -1;
    private $name = "";
    private $url = "";
    private $desc = "";
    private $type = "";

    public final function __construct($data)
    {
        $this->id = $data[ID];
        $this->order = $data["order"];
        $this->name = $data["name_".Progfolio::instance()->language];
        $this->url = $data["url"];
        $this->description = $data["description_".Progfolio::instance()->language];
        $this->type = $data["type"];
    }

    public final function display()
    {
        $title = new Title(2,$this->name);
        $title->display();

        $desc = new WikiDiv($this->description);
        $desc->display();

        $link = new Link( $this->url, $this->url );
        $link->display();
    }

    public final function shortDisplay()
    {
        if ( $_SERVER['QUERY_STRING'] == "" && $this->id == DEFAULT_PAGE
             || 0 == strncmp( '?'.$_SERVER['QUERY_STRING'], $this->url, strlen( $this->url ) ) )
        {
            $actif = true;
        }
        else
        {
            $actif = false;
        }

        if ( $this->type == "link" )
        {
            $logo = new Logo( Logo::INFO,"?page=item&id-unix=" . $this->id );
        }
        else if ( $this->type == "page-prj" )
        {
            if ( Progfolio::instance()->mode == Progfolio::ADMIN )
            {
                $logo = new Logo( Logo::INFO,"?page=item&id-unix=" . $this->id );
                $logo->display();
            }

            if ( $actif )
            {
                $logo = new Logo( Logo::PAGE_PRJ_HOVER, $this->url );
            }
            else
            {
                $logo = new Logo( Logo::PAGE_PRJ, $this->url );
            }
        }
        else
        {
            if ( Progfolio::instance()->mode == Progfolio::ADMIN )
            {
                $logo = new Logo( Logo::INFO,"?page=item&id-unix=" . $this->id );
                $logo->display();
            }

            if ( $actif )
            {
                $logo = new Logo( Logo::PAGE_ANY_HOVER, $this->url );
            }
            else
            {
                $logo = new Logo( Logo::PAGE_ANY, $this->url );
            }
        }
        $logo->display();

        $link = new Link( $this->name, $this->url );
        $link->display();
    }


    public final function add($form)
    {
        $title = new Title(2,"Add item");
        $title->display();

        $form->shortText("Id",ID,$this->id);
        $form->shortText("Name","name_".Progfolio::instance()->language,"");
        $form->shortText("URL","url","");
        $form->longText("Description","description_".Progfolio::instance()->language,"");
        $form->shortText("Type","type","");
        $form->shortText("Order","order","");
    }

    public final function edit($form)
    {
        $title = new Title(2,"Edit item: ".$this->id);
        $title->display();

        $form->shortText("Name","name_".Progfolio::instance()->language,$this->name);
        $form->shortText("URL","url",$this->url);
        $form->longText("Description","description_".Progfolio::instance()->language,$this->description);
        $form->shortText("Type","type",$this->type);
        $form->shortText("Order","order",$this->order);
    }

    public final function confirm()
    {

    }

    public final function delete()
    {
        $title = new Title(2,"Delete item: ".$this->id."?");
        $title->display();
    }

}

?>
