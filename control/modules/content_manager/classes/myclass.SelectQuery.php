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
* $db= new SelectQuery();
* $db->from("users")->select("id","name")->limit(1)->where("id = '1'")->result();
*/

class SelectQuery
{
private $selectables = array();
private $table;
private $whereClause;
private $limit;
private $conn;
private $query;
private $affected;
private $orderColumns;
private $sortby;
private $lastID;

public function select()
{
$this->selectables=func_get_args();
return $this;
}

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

public function orderBy($cols,$desc_asc)
{
$this -> sortby = $desc_asc;
$this -> orderColumns = $cols;
return $this;
}

public function buildQuery()
{
$this->query = "SELECT ".join(",",$this->selectables)." FROM
{$this->table}";

	if (!empty($this->whereClause))
	{
		$this->query .= " WHERE {$this->whereClause}";
	}
	
	
	if( (!empty($this->orderColumns)) && (!empty($this->sortby)) )
	{
		$this->query .=  " ORDER BY {$this->orderColumns} $this->sortby";
	}
	
	
	if (!empty($this->limit))
	{
		$this->query .= " LIMIT {$this->limit}";
	}
	
return $this;
}

public function getResult($conn)
{
	$this->conn = $conn;
	
/* Select queries return a resultset */
$result = $this->conn -> query($this->query);

$this->affected = $conn->affected_rows;

if($result){  return $result; }else{ return false; }
}

public function getAffectedRows()
{
return $this->affected;	
}

public function returnValue($column,$table,$wherecolumn,$wherevalue,$dconn)
{
	$rtnvalue = NULL;
	$sql = "SELECT $column FROM $table WHERE $wherecolumn = '$wherevalue' LIMIT 1";
	$sresult = $dconn -> query($sql);
	while ($row = $sresult->fetch_assoc())
		 {
			 $rtnvalue = $row[$column];
		 }
	return $rtnvalue;
}

public function destroy()
{
}

}