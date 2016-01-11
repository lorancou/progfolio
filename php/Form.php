<?php

  /*
   * Form.php
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2016 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

class Form implements IDisplayableContainer
{

	private $code;
	private $action;

	public function __construct($code,$action=NULL)
	{
		$this->code = $code;
        $this->action = @$action or '?page='.$code; // TODO: find out if this is still useful
	}
	
	public function begin()
	{
        echoOpen('<form enctype="multipart/form-data" name="form" method="POST" action="'.$this->action.'">');
		echoFlat('<input type="hidden" name="'.ELEMENT.'" value="'.$this->code.'" />');
	}
	
	public function hidden($name,$value)
	{
		echoFlat('<input type="hidden" name="'.$name.'" value="'.$value.'" />');
	}
	
	public function shortText($label,$field,$value="")
	{
		$div = new Division("entree");
		$div->begin();
		echoFlat('<label for="'.$field.'">'.$label.'</label>');
		echoFlat('<input type="text" name="'.$field.'" id="'.$field.'" value="'.$value.'" />');
		$div->end();
	}
	
	public function longText($label,$field,$value)
	{
		$div = new Division("entree");
		$div->begin();
		echoFlat('<label for="'.$field.'">'.$label.'</label>');
		echoFlat('<textarea name="'.$field.'" id="'.$field.'">'.$value.'</textarea>');
		$div->end();
	}
	
	public function selection($label,$name,$list,$autosubmit=false) // liste : $value => $label
	{
		echoFlat('<label for="'.$name.'">'.$label.'</label>');
        if ($autosubmit)
        {
            echoOpen('<select name="'.$name.'" onchange="this.form.submit()">'); 
        }
        else
        {
            echoOpen('<select name="$name">');
        }
		foreach ($list as $value => $label)
        {
			echoFlat('<option value="'.$value.'">'.$label.'</option>');
        }
		echoClose("</select>");
	}

	public function password($label,$field,$value="")
	{
		$div = new Division("entree");
		$div->begin();
		echoFlat('<label for="'.$field.'">'.$label.'</label>');
		echoFlat('<input type="password" name="'.$field.'" id="'.$field.'" value="'.$value.'" />');
		$div->end();
	}
	
    // TODO label first
	public function confirm($action,$label)
	{
		$div = new Division("confirm");
		$div->begin();
		echoFlat('<input name="'.$action.'" type="submit" value="'.$label.'" />');
		$div->end();
	}
	
    // TODO label first
	public function noScriptSubmit($action,$label)
	{
		echoFlat('<noscript><input name="'.$action.'" type="submit" value="'.$label.'" /></noscript>');
	}

    // TODO label first
	public function file($type,$label)
	{
		$div = new Division("file");
		$div->begin();
		echoFlat('<input name="file" type="hidden" value="'.$type.'" />');
		echoFlat('<label for="'.$type.'">'.$label.'</label>');
		echoFlat('<input name="'.$type.'" type="file" />');
		$div->end();
    }
	
	public function end()
	{
		echoClose("</form>");
	}

}

?>
