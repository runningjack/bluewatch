<?php

/** This software is a product of Upperlink Limited
* Code must not be use if not in accordance with the licence provided
*
*
@author: Iginla Omotayo
@copyright: 14th March 2012
@licence: GNU Licenced
*
*Enjoy your software Application
*www.upperlink.com.ng
*
* USING METHOD CHAINING PHP 5...SEE HOW TO USE BELOW
*
*   $q = new InsertQueryGenerator();
*
*	$mydata = array("name"=>"afif","pass"=>md5("hello world"));
*
*	$q->insertTable('users')
*	  ->insertData($mydata)
*	  ->buildInsertQuery()
*	  ->getQuery();
* 
*/
class InsertQuery
{
private $table;
private $values;
private $fields;
private $query;
private $conn;

function __autoload(){}

public function insertData($data)
{
	$this -> fields = join(array_keys($data),",");
	$this -> values = "'".join(array_values($data),"','")."'";
	return $this;
}

public function insertTable($table)
{
	$this->table = $table;
	return $this;
}

public function buildInsertQuery()
{
	$this->query = "INSERT INTO {$this->table}({$this->fields}) VALUES ({$this->values})";
	
	return $this;
}

public function getQuery()
{
return $this->query;	
}

public function queryDB($conn)
{
//QUERY THE DB
$this->conn = $conn;

$rtnbool = $this->conn -> query($this->query);

return ($rtnbool==TRUE ? TRUE:FALSE);
}

public function getLastId()
{
	return $this->conn -> insert_id;
}

function __destruct(){}



}


		
?>