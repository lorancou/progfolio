<?php

  /*
   * CompleteLink.php5
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2011 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

class CompleteLink extends Element
{

    // acts on link elements
    public $code = LINK_ELEMENT;
   
	private $id = "";
    private $name = "";
	private $url = "";
    private $desc = "";
   
    public final function __construct($data)
    {
        $this->id = $data[ID];
        $this->name = $data["name"];
        $this->url = $data["url"];
        $this->description = $data["description"];
    }
   
    public final function display()
    {
		$title = new Title(2,$this->name);
		$title->display();
		
		$desc = new Paragraph(NULL,$this->description);
		$desc->display();
		
		$link = new Link($this->url,$this->url);
		$link->display();
	}
	
	public final function add($form)
	{		
		$title = new Title(2,"Add link");
		$title->display();
						
		$form->shortText("Id",ID,$this->id);
		$form->shortText("Name","name","");
		$form->shortText("URL","url","");
		$form->longText("Description","description","");
	}
				
	public final function edit($form)
	{
		$title = new Title(2,"Edit link: ".$this->id);
		$title->display();
				
		$form->shortText("Name","name",$this->name);
		$form->shortText("URL","url",$this->url);
		$form->longText("Description","description",$this->description);
	}
	
	public final function confirm()
	{
		
	}

	public final function delete()
	{
		$title = new Title(2,"Delete link: ".$this->id."?");
		$title->display();
	}

}

?>
