<?php
	// Define Server & Database connection here
	mysql_connect("localhost", "root", "") or die(mysql_error());
	mysql_select_db("kano_cms") or die(mysql_error());
?>