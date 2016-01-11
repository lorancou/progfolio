<?php

  /*
   * ElementFactory.php5
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2012 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

class ElementFactory
{

    private $elements = array(
        ARTICLE_ELEMENT      => "Article",
        FILE_ELEMENT         => "File",
        IMAGE_ELEMENT        => "CompleteImage",
        ITEM_ELEMENT         => "Item",
        LINK_ELEMENT         => "CompleteLink",
        NEWS_ELEMENT         => "News",
        PROJECT_ELEMENT      => "Project",
        PROJECT_TYPE_ELEMENT => "ProjectType"
        );

    // singleton
    private static $instance;
    private function __construct(){}
    public static function instance() 
    {
        if (!isset(self::$instance))
            self::$instance = new ElementFactory(); 
        return self::$instance; 
    }  

    function createElement($code,$data)
    {
        if(!isset($this->elements[$code]))
        {
            if ($code!="")
                MessageStack::instance()->add(
                    Message::warning,get_class(),
                    "The element ".$code." doesn't exist");
            $code = DEFAULT_ELEMENT;
        }
        return new $this->elements[$code]($data);
    }

    // multi-purpose anti-pattern ugly function
    public function manage($infos)
    {
        switch($infos[ACTION])
        {
        case ADD_ACTION:
            $fields = array();
            $add = TRUE;
            foreach($infos as $key => $value)
            {
                //echo "key:".$key." value".$value;
                //echo "image:".$_FILES['image']['name'];
                if ($key==ACTION || $key==ELEMENT || $key==CONFIRM_MODE)
                {
                    //echo "continue<br/>";
                }
                else if ($key=="file")
                {
                    $type = $value;
                    $file_tmp=$_FILES[$type]["tmp_name"];
                    $file=$_FILES[$type]["name"];
                    $fields["name"] = $file;
                    $path=$type."s/$file";
                    if (!move_uploaded_file($file_tmp,$path))
                    {
                        MessageStack::instance()->add(
                            Message::error,get_class(),
                            "Can't upload file ".$file);
                        $add = FALSE;		
                    }
                    else
                    {
                        MessageStack::instance()->add(
                            Message::info,get_class(),
                            "File ".$file." added");
                        if ($type=="image")
                            createThumbnail("images",$file);
                    }
                }
                else
                {
                    //echo "enr<br/>";
                    $fields[$key] = $value;
                }
            }
            if ($add)
                DatabaseConnection::instance()->add($infos[ELEMENT],$fields);
            break;
			
        case ADD_IMAGE_ACTION:
            $fields = array();
            $connection = DatabaseConnection::instance();
            $connection->select("image",0,1,"`image_".ID."`='".$infos["image_".ID]."'","image_id");
            $connection->next();
            $data = $connection->data();
            $fields["id-image"] = $data["id"];
            $connection->select("project",0,1,"`project_".ID."`='".$infos["project_".ID]."'","project_id");
            $connection->next();
            $data = $connection->data();
            $fields["id-project"] = $data["id"];
            DatabaseConnection::instance()->add("project-image",$fields);			
            break;  	

        case ADD_FILE_ACTION:
            $fields = array();
            $connection = DatabaseConnection::instance();
            $connection->select("file",0,1,"`file_".ID."`='".$infos["file_".ID]."'","file_id");
            $connection->next();
            $data = $connection->data();
            $fields["id-file"] = $data["id"];
            $connection->select("project",0,1,"`project_".ID."`='".$infos["project_".ID]."'","project_id");
            $connection->next();
            $data = $connection->data();
            $fields["id-project"] = $data["id"];
            DatabaseConnection::instance()->add("project-file",$fields);			
            break;  	
   	
        case EDIT_ACTION:
            $fields = array();
            foreach($infos as $key => $value)
                if ($key!=ACTION && $key!=ELEMENT && $key!=ID && $key!=CONFIRM_MODE)
                    $fields[$key] = $value;
            DatabaseConnection::instance()->update($infos[ELEMENT],$infos[ID],$fields);
            break;
   		
        case ACTION_PREVISUALISER:
            // nothing to do
            break;
   		
        case DELETE_ACTION:
            // TODO: fix file deletion
            DatabaseConnection::instance()->delete($infos[ELEMENT],$infos[ID]);
            break;
   		
        default:
            MessageStack::instance()->add(
                Message::error,get_class(),
                "Action unknown:  ".$infos[ACTION]);   		
        }
    }

}

?>
