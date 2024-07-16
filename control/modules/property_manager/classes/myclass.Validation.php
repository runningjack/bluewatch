<?php
/** This software is a product of Upperlink Limited
* Code must not be use if not in accordance with the licence provided
*
*
*@author: Iginla Omotayo
*@copyright: 9th March 2012
*@licence: GNU Licenced
*
*Enjoy your software Application
*www.upperlink.com.ng
*/

class Validation{

private $errorcode = 0;
private $rtnarray = array();

function __construct()
{
}


	public function validate(& $myarray)
	{
		foreach($myarray as $var => $val)
		{
			$this->rtnarray[$var] = 0;
			
			if(trim($val) == "")
			{
				$this->rtnarray[$var] = 1;
			}
		}
		
		return $this->rtnarray;
	}
	
	public function validateEmail($email)
	{
		
		$email_val = true;
		
		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
		$email_val = false; 
		}	
		
		return $email_val;
	}
}