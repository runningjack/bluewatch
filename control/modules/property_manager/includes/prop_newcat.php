<?php
if(isset($_POST['submit']))
{	

$errstring = "";
$validate = new Validation();
$rtnvalidate = $validate -> validate($_POST); //TEST IF ANY FIELD IS EMPTY

$formarr = array('catig' => "");

foreach($rtnvalidate as $k => $v)
		{
			if($v == 1)
			{
			$errstring = "Please Complete All Fields";
			$formarr[$k] .= "* Field is Empty<br />";
			}
		}

// IF NO ERROR FOUND TRY INSERTION TO DATABASE

	if($errstring=="")
	{	
		// CREATE OBJECT OF CLASS CONNECTION
		$configData = new ConfigData;
		$conn = $configData -> connectDB();
		
		// GET CATEGORY NAME
		$catigname = filter_var($_POST['catig'], FILTER_SANITIZE_STRING);
		
		// BUILD QUERY
		$data = array("propcat_name" => $catigname,
					  "propcat_belongs" => "prop_maincat"
					  );
		
		// CREATE NEW QUERY OBJECT
		$insertquery = new InsertQuery();
		
		$result = $insertquery -> insertTable("prop_categories")
							  -> insertData($data)
							  -> buildInsertQuery()
							  -> queryDB($conn);
							  
							  
		if($result)
		{	
			$configData -> destroy();
			$configData = null;
			unset($configData);
			
			$insertQuery = null;
			unset($insertQuery);
			
			header("Location: .?BQ=Control Panel&INC=Property&CMD=View_Exist_Cat&STA=confirm");
		}else
		{ 
		$errstring = "Error in Connection, Please Try Again";}
		}
}
?>


<div>
<h2>ADD A NEW CATEGORY</h2>

<?php 
// IF ERROR DISPLAY
if( $errstring != ""){ echo "<div class='prop_error'><img src='modules/property_manager/images/error.png' /> $errstring </div>";}


?>

<fieldset>
<legend align="right">Create New Category</legend>
<form name="" method="post" action="">
<table width="830">
<tr>
    <td width="116"><label>Category Name:</label></td>
    <td width="249"><input type="text" name="catig" size="40" /></td>
    <td width="449"><span class="prop_formerror"><?php echo $formarr['catig']; ?></span></td>
</tr>

<tr>
<td></td>
<td><input type="submit" name="submit" value="Create Category"/></td>
<td></td>
</tr>
</table>
</form>
</fieldset>
</div>
