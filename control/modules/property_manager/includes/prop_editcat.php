<?php

//IF PAGE ID IS NOT SET OR PAGE INDEX IS NOT DETERMINED
if( (!isset($_GET['PID'])) || (!isset($_GET['CAS'])) )
{
header('Location: .?BQ=Control Panel&INC=Property');
}else
{

// GET CODE TO DETERMINE WHICH INDEX TO PICK
if(isset($_GET['CAS'])){$pg = (int) $_GET['CAS'];}

// GET PAGE ID
if(isset($_GET['PID'])){$pid = (int) $_GET['PID'];}


// DETERMINE THE PAGE TO DISPLAY
$pageusers = array("CATEGORY","LEASING","PROPERTY");

// CREATE OBJECT OF CLASS CONNECTION
$configData = new ConfigData;
$conn = $configData -> connectDB();
		
// BUILD QUERY
$selectQuery = new SelectQuery();

switch($pg)
{
case 0:
$belongs = "prop_maincat";
$cmd = "View_Exist_Cat";
break;

case 1:
$belongs = "prop_leasetype";
$cmd = "View_Lease_Type";
break;

case 2:
$belongs = "prop_proptype";
$cmd = "View_Prop_Type";
break;

default:
$belongs = "NULL";
$cmd = "";
break;
}

$result = $selectQuery   ->from("prop_categories")
						 ->select("propcat_name")
						 ->where("propcat_id = '{$pid}'")
						 ->buildQuery()
						 ->getResult($conn);

while ($row = $result->fetch_assoc())
{
	$catig_retrieve = $row['propcat_name'];
}


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
		
		// GET CATEGORY NAME
		$catigname = filter_var($_POST['catig'], FILTER_SANITIZE_STRING);
		
		// BUILD QUERY
		$data = array();
		$data["propcat_name"] = $catigname;
		
		
		// CREATE NEW QUERY OBJECT
		$updatequery = new UpdateQuery();
		
		$result = $updatequery -> updateTable("prop_categories")
							   -> dataToUpdate($data)
							   -> where("propcat_id='{$pid}'")
							   -> buildQuery()
							   -> updateContent($conn);
							  
		if($result)
		{	
			$configData -> destroy();
			$configData = null;
			unset($configData);
			
			$updateQuery = null;
			unset($updateQuery);
			
			header("Location: .?BQ=Control Panel&INC=Property&CMD={$cmd}&STA=update");
		}else
		{ 
		$errstring = "Error in Connection, Please Try Again";
		}
		
}
}// edn issubmit
?>


<div>
<h2>EDIT <?php echo $pageusers[$pg]; ?></h2>

<?php 
// IF ERROR DISPLAY
if( $errstring != "")
{
	echo "<div class='prop_error'><img src='modules/property_manager/images/error.png' /> $errstring </div>";
}


?>

<fieldset>
<legend align="right">Edit  <?php echo $pageusers[$pg]; ?></legend>
<form name="" method="post" action="">
<table width="830">
<tr>
    <td width="116"><label><?php echo ucfirst(strtolower($pageusers[$pg])); ?> Name:</label></td>
    <td width="249"><input type="text" name="catig" size="40" value="<?php echo $catig_retrieve; ?>" /></td>
    <td width="449"><span class="prop_formerror"><?php echo $formarr['catig']; ?></span></td>
</tr>

<tr>
<td></td>
<td><input type="submit" name="submit" value="Update <?php echo ucfirst(strtolower($pageusers[$pg])); ?>"/></td>
<td></td>
</tr>
</table>
</form>
</fieldset>
</div>
<?php
}
?>