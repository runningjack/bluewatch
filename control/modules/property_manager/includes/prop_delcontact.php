<?php

if(isset($_POST['cancel']))
{
header("Location: .?BQ=Control Panel&INC=Property");	
}

if(isset($_POST['confirm']))
{
	$pid = $_GET['PID'];
	
	
	
	// CREATE OBJECT OF CLASS CONNECTION
		$configData = new ConfigData;
		$conn = $configData -> connectDB();
		
		// DELETE CONTACT
		
			$deleteQuery = new DeleteQuery();
			$result = $deleteQuery ->from("prop_contact")
									 ->where("propcontact_id='{$pid}'")
									 ->buildQuery()
									 ->execute($conn);
									 
				if($result)
				{
					header("Location: .?BQ=Control Panel&INC=Property&CMD=View_Prop_Contact&STA=delete");
				}

}
?>

<div>
<h2>DELETE CATEGORY</h2>

<div style="background: url(modules/property_manager/images/clear2.png) repeat; ">
<h3 style="color: red"><img src="modules/property_manager/images/error.png" /> IMPORTANT INFORMATION</h3>
Are you sure you want to delete this contact account? If you wish to continue, click the continue button or cancel to go back.<br /><br />

<form method="post" action="">
<input type="submit" name="cancel" value="CANCEL" />
<input type="submit" name="confirm" value="CONFIRM" />
</form>
</div>
</div>