<?php

if(isset($_POST['cancel']))
{
header("Location: .?linkCMS=Control Panel&INC=Property");	
}

if(isset($_POST['confirm']))
{
	$pg = $_GET['CAS'];
	$pid = $_GET['PID'];
	
	switch($pg)
	{
		case 0:
		$fk = "prop_maincat";
		$cmd = "View_Exist_Cat";
		break;
		
		case 1:
		$fk = "prop_leasetype";
		$cmd = "View_Lease_Type";
		break;
		
		case 2:
		$fk = "prop_proptype";
		$cmd = "View_Prop_Type";
		break;
		
		default:
		$fk = "NULL";
		$cmd = "";
		break;
	}
	
	
	// CREATE OBJECT OF CLASS CONNECTION
		$configData = new ConfigData;
		$conn = $configData -> connectDB();
		
		$deleteQuery = new DeleteQuery();
		
		// DELETE SUBCHILDREN
		$result = $deleteQuery->from("prop_property")
					->where("{$fk}='{$pid}'")
					->buildQuery()
					->execute($conn);
					
		// DELETE PARENT CATEGORY
		if($result)
		{
			$deleteQuery2 = new DeleteQuery();
			$result2 = $deleteQuery2 ->from("prop_categories")
									 ->where("propcat_id='{$pid}'")
									 ->buildQuery()
									 ->execute($conn);
									 
				if($result2)
				{
					header("Location: .?BQ=Control Panel&INC=Property&CMD={$cmd}&STA=delete");
				}
		}
}
?>

<div>
<h2>DELETE CATEGORY</h2>

<div style="background: url(modules/property_manager/images/clear2.png) repeat; ">
<h3 style="color: red"><img src="modules/property_manager/images/error.png" /> IMPORTANT INFORMATION</h3>
Please note that deleting a category will simultaneous cause all the properties added underneath the category to delete as well. If you wish to continue, click the continue button or cancel to go back.<br /><br />

<form method="post" action="">
<input type="submit" name="cancel" value="CANCEL" />
<input type="submit" name="confirm" value="CONFIRM" />
</form>
</div>
</div>