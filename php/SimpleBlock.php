<?php

  /*
   * SimpleBlock.php
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2016 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

class SimpleBlock extends Block
{

	protected $element;
	protected $mode;
	protected $id;

    public function __construct($elementCode,$idElement,$mode)
    {
        $this->mode = $mode;
        $this->idElement = $idElement;

        if ($mode == ADD_MODE)
			$data[ID] = $idElement;
        else if ($mode == PREVIEW_MODE)
            $data = stripslashes_deep($_POST);
        else // hit the database
        {
            $connection = Database::instance();
			$connection->select($elementCode,0,1,"`".$elementCode."_".ID."`='".$idElement."'");
			if ($connection->count()==0) // no result
			{
				MessageStack::instance()->add(
					Message::error,get_class(),
					'No element with id "'.$this->idElement.'".');
				$data[ID] = $idElement;
				$this->mode = ADD_MODE;
			}
			else
			{
                $connection->next(); // and only
				$data = $connection->data();
            }
		}
		$this->element = ElementFactory::instance()->createElement($elementCode,$data);
    }

    protected final function displayBlock()
    {		
		switch ($this->mode)
		{
        case DISPLAY_MODE:
			if (Progfolio::instance()->mode==Progfolio::ADMIN)
			{
				$bulle = new AdminBubble(
					$this->element->adminFlags(DISPLAY_MODE),
					$this->element->code,
					$this->idElement);
				$bulle->display();
			}
		 	$this->element->display();
		 	break;
		 	
        case THUMBNAIL_MODE:
		 	$this->element->thumbnail();
			break;		 	
		 	
        case ADD_MODE:
			if (!Progfolio::instance()->mode==Progfolio::ADMIN)
			{			
				MessageStack::instance()->add(
					Message::error,get_class(),
					"Cant' add an article as a user");
				break;
			}
			$bulle = new AdminBubble(
				$this->element->adminFlags(ADD_MODE),
				$this->element->code,
				$this->idElement);
			$bulle->display();
			$form = new Form($this->element->code);				
			$form->begin();
			$form->hidden(ACTION,ADD_ACTION);
			$this->element->add($form);
			if ($this->element->code == IMAGE_ELEMENT ||
                $this->element->code == FILE_ELEMENT)
			{
				$form->confirm(CONFIRM_BUTTON,"Add");
			}			
			else
				$form->confirm(PREVIEW_BUTTON,"Preview");
			$form->end();
			break;
			
        case EDIT_MODE:
			if (!Progfolio::instance()->mode==Progfolio::ADMIN)
			{			
				MessageStack::instance()->add(
					Message::error,get_class(),
					"Can't edit an article as a user");
				break;
			}
			$bulle = new AdminBubble(
				$this->element->adminFlags(EDIT_MODE),
				$this->element->code,
				$this->idElement);
			$bulle->display();
			/*echo "code: $this->element->code<br>";*/
			$form = new Form($this->element->code);
			$form->begin();
			$form->hidden(ACTION,EDIT_ACTION);
			$form->hidden(ID,$this->idElement);
			$this->element->edit($form);
			$form->confirm(PREVIEW_BUTTON,"Preview");		
			$form->end();
			break;
			
        case PROJECT_MANAGEMENT_MODE:
			if (!Progfolio::instance()->mode==Progfolio::ADMIN)
			{			
				MessageStack::instance()->add(
					Message::error,get_class(),
					"Can't manage a project as a user");
				break;
			}
			$bulle = new AdminBubble(
				$this->element->adminFlags(PROJECT_MANAGEMENT_MODE),
				$this->element->code,
				$this->idElement);
			$bulle->display();
			$this->element->projectManagement();
			break;
			
        case PREVIEW_MODE:
			//if (isset($_POST[PREVIEW_MODE])) echo "Preview<br/>\n";
			//if (isset($_POST[ADD_MODE])) echo "Add<br/>\n";
			if (!Progfolio::instance()->mode==Progfolio::ADMIN)
			{			
				MessageStack::instance()->add(
					Message::error,get_class(),
					"Can't add an article as a user");
				break;
			}
			//$element->display();
			$form = new Form($this->element->code);				
			$form->begin();
			$form->hidden(ACTION,$_POST[ACTION]);
			$form->hidden(ID,$_POST[ID]);
			$this->element->display($form);
			$this->element->edit($form);
			$form->confirm(PREVIEW_BUTTON,"Preview");
			if ($_POST[ACTION] == ADD_ACTION)
				$form->confirm(CONFIRM_BUTTON,"Add");
			else if ($_POST[ACTION] == EDIT_ACTION)
				$form->confirm(CONFIRM_BUTTON,"Edit");
			else
				MessageStack::instance()->add(
					Message::error,get_class(),
					"Unknown post-preview action");		
			$form->end();
			break;
			
        case CONFIRM_MODE:
			$this->element->confirm();			
			break;
			
        case DELETE_MODE:
			if (!Progfolio::instance()->mode==Progfolio::ADMIN)
			{			
				MessageStack::instance()->add(
					Message::error,get_class(),
					"Can't delete an article as a user");
				break;
			}
			$bulle = new AdminBubble(
				$this->element->adminFlags(DELETE_MODE),
				$this->element->code,
				$this->idElement);
			$bulle->display();
			$form = new Form($this->element->code);				
			$form->begin();
			$form->hidden(ACTION,DELETE_ACTION);
			$form->hidden(ID,$this->idElement);
			$this->element->delete();
			$form->confirm(DELETE_MODE,"Delete");
			$form->end();
			break;
			
        default:
			MessageStack::instance()->add(
				Message::error,get_class(),
				"Mode ".$this->mode." unknown");
		}
    }
      
}

?>
