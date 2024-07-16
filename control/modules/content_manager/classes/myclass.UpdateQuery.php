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
*	$c = new UpdateQueryGenerator();
*	$data = array("name"=>"tayo", "age"=>18, "country"=>"nigeria");
*	echo $c	->updateTable("users")
*	->dataToUpdate($data)
*	->where("name='tayo'")
*	->limit(5)
*	->buildUpdateQuery();
*/

class UpdateQuery
{
private $table;
private $updateData;
private $whereClause;
private $query;
private $limit;
private $conn;


public function dataToUpdate($data)
{
	$this->updateData = $data;
	return $this;
}

public function updateTable($table)
{
	$this->table = $table;
	return $this;
}

public function where($clause)
{
	$this->whereClause = $clause;
	return $this;
}

public function limit($limit)
{
	$this->limit = $limit;
	return $this;
}

public function buildQuery()
{
	
	foreach ($this->updateData as $key => $value)
	{
	$queryparts[] = "{$key} = '{$value}'";
	}

	$this->query = "UPDATE {$this->table} SET ".join($queryparts,", ");
	
	
	if (!empty($this->whereClause))
	{
		$this->query .= " WHERE {$this->whereClause}";
	}
	
	if (!empty($this->limit))
	{
		$this->query .= " LIMIT {$this->limit}";
	}
	
return $this;
}

public function updateContent($conn)
{
	$this->conn = $conn;
	
/* Select queries return a resultset */
if ($result = $this->conn -> query($this->query)){  return true; }else{ return false; }

}

}



?>