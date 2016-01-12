<?php

  /*
   * Database.php
   * ----------------------------------------------------------------------------
   *
   * Progfolio
   * Copyright (c) 2005-2016 Laurent Couvidou
   * Contact: lorancou@free.fr
   *
   * This program is free software - see README.md for details.
   */

class Database
{

    private $request;
    private $table;
    private $line;

    private $pdo;
    private $statement;

    // singleton
    private static $instance;
    public static function instance() 
    { 
        if (!isset(self::$instance))
            self::$instance = new Database(NULL); 
        return self::$instance; 
    }

    private function __construct() // one connection only
    {
        if ( !$this->pdo = new PDO( 'mysql:host='.DBHOST.';dbname='.DBNAME, DBUSER, DBPASSWD ) ) {
            MessageStack::instance()->add( Message.error, get_class(), "Can't connect to database host ".DBHOST );
        } else {
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // TODO if dev mode + don't log in the middle of HTML
        }
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

        $res = $this->pdo->query('SELECT COUNT(*) FROM '.$table);
        return $res->fetchColumn();
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
        // When query() fails, it does not return a PDOStatement object. It simply returns false.
        if ( !$this->statement = $this->pdo->query($sql) ) {
            MessageStack::instance()->add( Message.error, get_class(), "SQL query failed" );
        }
    }

    // progress in selection
    public function next()
    {
        if ( $this->statement ) {
            $this->line = $this->statement->fetch(PDO::FETCH_ASSOC);
            return $this->line;
        }
        return null;
    }

    public function request()
    {
        return $this->request;
    }
   
    // count results of a selection
    public function count()
    {
        return $this->count;
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
