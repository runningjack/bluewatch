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

class ConfigData{
	
const HOST = "localhost";
private static $dbname = "BQ";               // The Name of the Database
private static $dbuser = "root";             // The username to connect to the database
private static $dbpass = "";   // The Password to connect to the database
private $mysqli_conn;

function __construct()
{
}

// SETTING PROPERTIES
public static function setdbName($name)
{
self::$dbname = $name;
}

public static function setdbUser($user)
{
self::$dbuser = $user;
}

public static function setdbPass($pass)
{
self::$dbpass = $pass;
}

// GET METHODS FOR CLASS PROPERTIES
public static function getdbName()
{
return self::$dbname;
}

public static function getdbUser()
{
return self::$dbuser;
}

public static function getdbPass()
{
return self::$dbpass;
}
	
	// CONNECT TO THE DATABASE
public function connectDB()
{
	// host, user, pass, dbname
	$this->mysqli_conn = new mysqli(self::HOST, self::getdbUser(), self::getdbPass(), self::getdbName());
	
	
	if (mysqli_connect_errno())
	{
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
	}

	return $this->mysqli_conn;
}

public function destroy()
{
	$this->mysqli_conn -> close();
}

function __destruct()
{
}



}// end class

?>