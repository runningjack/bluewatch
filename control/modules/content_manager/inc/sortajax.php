<?php
$errmsg="Initial Message";
include("../classes/myclass.ConfigData.php");


$configData = new ConfigData;
$conn = $configData -> connectDB();

parse_str($_POST['pages'], $pageOrder);

foreach ($pageOrder['page'] as $key => $value) 
{	
	$query = "UPDATE `pages_content` SET `order_column` = '$key' WHERE `content_id` = '$value'";
	$saresult = $conn->query($query) or error_log($conn->error);
}

?>