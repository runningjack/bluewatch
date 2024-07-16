<?php
/** This software is a product of Upperlink Limited
* Code must not be use if not in accordance with the licence provided
*
*
@author: Iginla Omotayo
@copyright: 9th March 2012
@licence: GNU Licenced
*
*Enjoy your software Application
*www.upperlink.com.ng
*/



function __autoload($class)
{
include_once("modules/property_manager/classes/myclass.{$class}.php");
}

?>