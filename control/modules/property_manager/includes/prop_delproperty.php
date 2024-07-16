<?php

if(isset($_POST['cancel']))
{
header("Location: .?BQ=Control Panel&INC=Property&CMD=View_Exist_Prop");	
}

if(isset($_POST['confirm']))
{
	$pid = $_GET['PID'];
	
	
	
	// CREATE OBJECT OF CLASS CONNECTION
		$configData = new ConfigData;
		$conn = $configData -> connectDB();
		
		// DELETE CONTACT
		
			// BUILD QUERY
$selectQuery = new SelectQuery();

$imgdef = $selectQuery -> returnValue("property_imgdefault","prop_property","property_id",$pid,$conn);
$thumb = $selectQuery -> returnValue("property_thumb","prop_property","property_id", $pid,$conn);

			if($imgdef != "default.png")
			{
				unlink("modules/property_manager/images/property/$imgdef");
				unlink("modules/property_manager/images/property/thumbs/$imgdef");
			}
			
			if($thumb != "default.png")
			{
				unlink("modules/property_manager/images/property/homethumbs/$thumb");
			}
			
			$deleteQuery2 = new DeleteQuery();
			$result2 = $deleteQuery2 ->from("prop_imagemgr")
									 ->where("imagemgr_propid='{$pid}'")
									 ->buildQuery()
									 ->execute($conn);
			
			$deleteQuery = new DeleteQuery();
			$result = $deleteQuery ->from("prop_property")
									 ->where("property_id='{$pid}'")
									 ->buildQuery()
									 ->execute($conn);
									 
									 
				if($result)
				{
					header("Location: .?BQ=Control Panel&INC=Property&CMD=View_Exist_Prop&STA=delete");
				}

}
?>

<div>
<h2>DELETE CATEGORY</h2>

<div style="background: url(modules/property_manager/images/clear2.png) repeat; ">
<h3 style="color: red"><img src="modules/property_manager/images/error.png" /> IMPORTANT INFORMATION</h3>
Are you sure you want to delete this property? If you wish to continue, click the continue button or cancel to go back.<br /><br />

<form method="post" action="">
<input type="submit" name="cancel" value="CANCEL" />
<input type="submit" name="confirm" value="CONFIRM" />
</form>
</div>
</div>