<?php

  /*
   * CompositeBlock.php5
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2010 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

class CompositeBlock extends Block
{

    protected $elementCode;
    protected $begin;
    protected $noLines;
    protected $mode;
    protected $type;
    protected $sort;
    protected $order;

    public function __construct(
        $elementCode,
        $begin,
        $noLines,
        $mode=SUMMARY_MODE,
        $type=NULL,
        $sort=NULL,
        $order=NULL)
    {
        $this->elementCode = $elementCode;
        $this->begin = $begin;
        $this->noLines = $noLines;
        $this->mode = $mode;
        $this->type = $type;
        $this->sort = $sort;
        $this->order = $order;
    }

    protected final function displayBlock()
    {
        $i = 0;
        $connection = DatabaseConnection::instance();
        $connection->select(
            $this->elementCode,
            $this->begin,
            $this->noLines,
            $this->type?$this->conditionString():NULL,
            "*",
            $this->sort?$this->sortString():NULL,
            $this->order?$this->orderString():NULL);
        $request = $connection->request(); // croisements
        //$continue = TRUE;
        while($line=mysql_fetch_assoc($request))
        {
            if ( $i > 0 ) 
            {
                echo "<div class=\"hr\"><hr /></div>\n";
            }

            //$continue = $connection->next();
            //if ($continue==TRUE)
            //  echo "TRUE";
            //else
            //  echo "FALSE";
            //$data = $connection->data();
            $data = array();
            $length = 1+strlen($this->elementCode);
            foreach ($line as $key => $value)
                $data[substr($key,$length)] = $value;
            $div = new Division("record",NULL);
            $div->begin();
            $element = ElementFactory::instance()->createElement($this->elementCode,$data);
            $mode = $this->mode;
            if (Progfolio::instance()->mode==Progfolio::ADMIN)
            {
                $bulle = new AdminBubble(
                    $element->adminFlags($mode),
                    $this->elementCode,
                    $element->id);
                $bulle->display();
            }
            $element->$mode();
            $div->end();

            ++$i;
        }
    }

    private function sortString()
    {
        switch ($this->sort)
        {
        case "alpha":
            $sort = $this->elementCode."_name";
            break;
        case "date":
            // can't really do that everywhere... need to normalize somehow?
            $sort = $this->elementCode."_date_end";
            break;
        case "weight":
            // TODO
            $sort = $this->elementCode."_weight";
            break;
        default:
            MessageStack::instance()->add(
                Message::warning,get_class(),
                "Unspecified sort type, using alphabetical");
            $sort = "`".$this->elementCode."_name` ";
        }
        return $sort;
    }

    private function orderString()
    {
        switch ($this->order)
        {
        case "ascending": $order = "ASC "; break;
        case "descending": $order = "DESC "; break;
        default:
            MessageStack::instance()->add(
                Message::warning,get_class(),
                "Unspecified sort order, using ascending");
            $order = "ASC";
        }
        return $order;
    }

    private function conditionString()
    {
        $idBase = ProjectType::getDatabaseId($this->type);
        return "`".$this->elementCode."_type`=$idBase";
    }

}

?>
