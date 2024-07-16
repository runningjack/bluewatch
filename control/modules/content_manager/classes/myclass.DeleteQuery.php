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

* $g = new DeleteQueryGenerator();
* echo $g->from("users")
*	->where("name='tayo'")
*	->limit(5)
*	->buildQuery();
*/

class DeleteQuery
{
private $table;
private $whereClause;
private $limit;
private $conn;



	public function from($table)
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
		$this->query = "DELETE FROM {$this->table} WHERE {$this->whereClause}";
		
			if (!empty($this->limit))
			{
			$this->query .= " LIMIT {$this->limit}";
			}
			
		return $this;
	}

	public function execute($conn)
	{
			$this->conn = $conn;
			
			/* Select queries return a resultset */
	$result = $this->conn -> query($this->query);
	$no_rows = $this->conn -> affected_rows;
	
	return $no_rows;
	}
}
?>