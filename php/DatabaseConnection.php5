<?php

  /*
   * DatabaseConnection.php5
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2011 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README for details.
   */

class DatabaseConnection
{

    private $request;
    private $table;
    private $line;

    // singleton
    private static $instance;
    private function __construct() // one connection only
    {	
        if (!$connection=mysql_connect(SERVER,LOGIN,PASSWORD))
            MessageStack::instance()->add(
                Message.error,get_class(),
                "Can't connect connect to server ".SERVER);
        else if (!$bdd=mysql_select_db(BASE,$connection))
            MessageStack::instance()->add(
                Message.error,get_class(),
                "Can't select base ".BASE);
    }
    public static function instance() 
    { 
        if (!isset(self::$instance))
            self::$instance = new DatabaseConnection(NULL); 
        return self::$instance; 
    }

    // SELECT request
    public function select(
        $table,
        $begin=0,
        $noLines=10,
        $conditions=NULL,
        $fields="*",
        $tri=NULL,
        $order=NULL)
    {
        $this->table = $table;
        if ($fields != "*") $fields = "`".$fields."`";
        $sql="SELECT $fields FROM `$table`";
        if ($conditions!=NULL) $sql.=" WHERE $conditions";
        if ($tri!=NULL) $sql.=" ORDER BY `$tri`";
        if ($order!=NULL) $sql.= " $order";
        if ($begin != NULL && $noLines != NULL)
        {
            $end = $noLines-$begin;
            $sql.=" LIMIT $begin,$end";
        }		
        $sql .= ";";
        //echo $sql.'<br/>';
        $this->execute($sql);
    }

    // INSERT request
    public function add($table,$fields="*")
    {
        $this->table = $table;
        $sql="INSERT INTO `$table` (";
        foreach ($fields as $key => $value)
            $sql .= "`".$table."_".$key."`, ";
        $sql = substr($sql, 0, strlen($sql)-2);   	
        $sql .= ") VALUES (";
        foreach ($fields as $key => $value)
            $sql .= "'".$value."', ";
        $sql = substr($sql, 0, strlen($sql)-2);   	
        $sql .=");";
        //echo $sql;
        $this->execute($sql);
    }

    // UPDATE request
    public function update($element,$id,$fields="*")
    {
        $this->table = $element;
        $sql = "UPDATE `$element` SET ";
        foreach($fields as $key => $value)
            $sql .= "`".$element."_".$key."`='$value', ";
        $sql = substr($sql, 0, strlen($sql)-2);   	
        $sql .= " WHERE `".$element."_".ID."`='$id';";
        $this->execute($sql);
    }

    // DELETE request
    public function delete($element,$id)
    {
        $this->table = $element;
        $sql = "DELETE FROM `$element` WHERE `".$element."_".ID."`='$id' LIMIT 1";
        $this->execute($sql);
    }

    // execute request
    public function execute($sql)
    {
        if (!$this->request=mysql_query($sql))
            MessageStack::instance()->add(
                Message.error,get_class(),
                "Request failed: ".$sql);
    }

    // progress in selection
    public function next()
    {
        $this->line=mysql_fetch_assoc($this->request);
        //echo $this->line['item_name_fr'];
        return $this->line;   	
    }

    public function request()
    {
        return $this->request;
    }
   
    // count results of a selection
    public function count()
    {
        return mysql_num_rows($this->request);
    }

    public function __get($name)
    {
        if (isset($this->line[$name]))
            return $this->line[$name];
        else
            MessageStack::instance()->add(
                Message.warning,get_class(),
                "Field does not exist: ".$name);
    }
   
    public function data()
    {
        $ret = array();
        $length = 1+strlen($this->table);
        foreach ($this->line as $key => $value)
        {
            $ret[substr($key,$length)] = $value;
        }   	
        return $ret;
    }

}

?>
