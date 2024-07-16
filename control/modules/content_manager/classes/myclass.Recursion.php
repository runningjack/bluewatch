<?php
/** This software is a product of Upperlink Limited
* Code must not be use if not in accordance with the licence provided
*
*
@author: Iginla Omotayo
@copyright: 15th June 2012
@licence: GNU Licenced
*
*Enjoy your software Application
*www.upperlink.com.ng
*/

class Recursion{

	private $conObj = NULL;
	private $selectObj = NULL;
	private $c_limit = 3;
	private $rtn_array = array();
	
	
function __construct()
{
}

public function setConn($con)
{
	$this->conObj = $con;
}

public function setSelectObj($selectQuery)
{
	$this->selectObj = $selectQuery;
}

public function testChild($cid)
{
// BUILD QUERY

	$childresult = $this->selectObj
					-> from("web_pages_content")
					->select("page_ref_id")
					->where("page_ref_index='$cid'")
					->buildQuery()
					->getResult($this->conObj);
							  
// DOES IT HAS A CHILD?
	$num_of_child = $this -> selectObj -> getAffectedRows();
	
		if($num_of_child == NULL || $num_of_child == "" || $num_of_child == 0)
		{
			return 0;	
		}else
		{
			return $num_of_child;
		}
}

public function getChildren($child_id)
{
	$childrenresult =  $this->selectObj
						    -> from("web_pages_content")
						    ->select("page_ref_id","page_ref_title")
							->where("page_ref_index='$child_id' AND page_published ='Yes'")
							->buildQuery()
							->getResult($this->conObj);
							
	while ($childrenrow = $childrenresult->fetch_assoc())
		{
			$this->rtn_array[ $childrenrow['page_ref_id'] ] = $childrenrow['page_ref_title'];
		}
		
		return $this->rtn_array;
}

public function clearArr()
{
$this->rtn_array = array();	
}
}// END RECURSION
?>