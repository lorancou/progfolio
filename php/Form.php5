<?php

  /*
   * Form.php5
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2010 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

class Form implements IDisplayableContainer
{

	private $code;
	private $action;
	//private $fields = array();

	public function __construct($code,$action=NULL)
	{
		//$this->action = $action;
		$this->code = $code;
		$this->action = $action;
	}
	
	public function begin()
	{
		echo "<form ";
		echo "enctype=\"multipart/form-data\" ";
		echo "name=\"form\" ";
		echo "method=\"POST\" ";
		if ($this->action == NULL)
			echo "action=\"?page=$this->code\">\n";
		else
			echo "action=\"$this->action\">\n";		
		echo "<input type=\"hidden\" name=\"".ELEMENT."\" value=\"$this->code\" />\n";
	}
	
	public function hidden($name,$value)
	{
		echo "<input type=\"hidden\" name=\"$name\" value=\"$value\" />\n";
	}
	
	public function shortText($label,$field,$value="")
	{
		$par = new ContainerParagraph("entree");
		$par->begin();
		echo "<label for=\"$field\">$label&nbsp;:&nbsp;</label>\n";
		echo "<input type=\"text\" name=\"$field\" id=\"$field\" value=\"$value\" />\n";
		$par->end();
	}
	
	public function longText($label,$field,$value)
	{
		$par = new ContainerParagraph("entree");
		$par->begin();
		echo "<label for=\"$field\">$label&nbsp;:&nbsp;</label>\n";
		echo "<textarea name=\"$field\" id=\"$field\">$value</textarea>\n";
		$par->end();
	}
	
	public function selection($name,$liste,$autosubmit=false) // liste : $value => $label
	{
        if ($autosubmit)
        {
            echo "<select name=\"$name\" onchange=\"this.form.submit()\">\n"; 
        }
        else
        {
            echo "<select name=\"$name\">\n";
        }
		foreach ($liste as $value => $label)
			echo "<option value=\"$value\">$label</option>\n";	
		echo "</select>\n";
	}

	public function password($label,$field,$value="")
	{
		$par = new ContainerParagraph("entree");
		$par->begin();
		echo "<label for=\"$field\">$label&nbsp;:&nbsp;</label>\n";
		echo "<input type=\"password\" name=\"$field\" id=\"$field\" value=\"$value\" />\n";
		$par->end();
	}
	
	public function confirm($action,$label)
	{
		//echo "<input type=\"hidden\" name=\"".ACTION."\" value=\"$action\" />\n";
		$par = new ContainerParagraph("confirm");
		$par->begin();
		echo "<input name=\"$action\" type=\"submit\" value=\"$label\" />\n";
		$par->end();
	}
	
	public function noScriptSubmit($action,$label)
	{
		echo "<noscript><input name=\"$action\" type=\"submit\" value=\"$label\" /></noscript>\n";
	}

	public function file($type,$label)
	{
		$par = new ContainerParagraph("file");
		$par->begin();
		echo "<input name=\"file\" type=\"hidden\" value=\"$type\" />\n";
		echo "<label for=\"$type\">$label&nbsp;:&nbsp;</label>\n";
		echo "<input name=\"$type\" type=\"file\" />\n";
		$par->end();
	}
	
	public function end()
	{
		echo "</form>\n";
	}

}

?>
