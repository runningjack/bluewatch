<?php
ini_set('include_path', '~/pear/lib' . PATH_SEPARATOR
        . ini_get('include_path'));

// From PHP 4.3.0 onward, you can use the following,
// which especially useful on shared hosts:
set_include_path('~/pear/lib' . PATH_SEPARATOR
                 . get_include_path());

/** This software is a product of Apus Systems & Technology Solutions
* Code must not be use if not in accordance with the licence provided
*
*
@author: Iginla Omotayo
@copyright: February 2012
@licence: GNU Licenced
*
*Enjoy your software Application
*www.apustechng.com
*/

class MyFilter{

// Private variables and fields to enter the database
private $mycounter = 10;
protected $cont = 0;
public function validateData($input)
{
$badwords = array("where","or 1","'","like","%admin%","hehe","grant","revoke","%","=");
$rtvalue = $input;

		for($k=0;$k<count($badwords);$k++)
		{
			
			if(strstr($rtvalue, $badwords[$k]) != FALSE)
			{
			$cont = 1;
			}else{
			$cont = 0;
			break;
			}
				
		}
		
		
$rtvalue = trim($rtvalue);
$rtvalue = strip_tags($rtvalue);
$rtvalue = htmlspecialchars($rtvalue, ENT_QUOTES);

if(get_magic_quotes_gpc())
{
$rtvalue = stripslashes($rtvalue);
}

$rtvalue = mysql_real_escape_string($rtvalue);

for($i=0;$i<count($badwords);$i++)
{
$rtvalue = str_replace($badwords[$i],"",$rtvalue);
}

if($cont == 1)
{
MyFilter::validateData($rtvalue);
}else
{
return $rtvalue;
}

} //end function

}// end Class