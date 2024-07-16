<?php
// CREATE OBJECT OF CLASS CONNECTION
		$configData = new ConfigData;
		$conn = $configData -> connectDB();


$act = "";


if(isset($_POST['edit']))
{
$pid = $_GET['PID'];
$act = "edit";

$errstring = "";
$validate = new Validation();
$rtnvalidate = $validate -> validate($_POST); //TEST IF ANY FIELD IS EMPTY

$formarr = array('fullname' => "",
				 'address' => "",
				 'email' => "",
				 'phoneno' => "",
				 'phone2' => "",
				 );

foreach($rtnvalidate as $k => $v)
		{
			if($v == 1)
			{
				if($k == 'phone2'){continue;}
			$errstring = "Please Complete All Fields";
			$formarr[$k] .= "* Field is Empty<br />";
			}
		}

// IF NO ERROR FOUND TRY INSERTION TO DATABASE

	if($errstring=="")
	{			
		// VALIDATE EMAIL
		if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
		{
		// GET CATEGORY NAME
		$fullname = filter_var($_POST['fullname'], FILTER_SANITIZE_STRING);
		$address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
		$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
		$phoneno = filter_var($_POST['phoneno'], FILTER_SANITIZE_NUMBER_INT);
		$phone2 = filter_var($_POST['phone2'], FILTER_SANITIZE_NUMBER_INT);
		
		//CREATE  FILTER OBJECT
		$filter = new MyFilter();
		$address = $filter->validateData($address);

		// BUILD QUERY
		$data = array();
		$data["propcontact_name"] = $fullname;
		$data["propcontact_address"] = $address;
		$data["propcontact_email"] = $email;
		$data["propcontact_phone1"] = $phoneno;
		$data["propcontact_phone2"] = $phone2;
		
		// CREATE NEW QUERY OBJECT
		$updatequery = new UpdateQuery();
		
		$result = $updatequery -> updateTable("prop_contact")
							   -> dataToUpdate($data)
							   -> where("propcontact_id='{$pid}'")
							   -> buildQuery()
							   -> updateContent($conn);
							  
							  
		if($result)
		{	
			$configData -> destroy();
			$configData = null;
			unset($configData);
			
			$insertQuery = null;
			unset($insertQuery);
			
			header("Location: .?BQ=Control Panel&INC=Property&CMD=View_Prop_Contact&STA=update");
		}else
		{ 
		$errstring = "Error in Connection, Please Try Again";
		}
	}else{$errstring = "E-mail is Invalid, Try again";}// END VALIDATE EMAIL
	}// END TEST ERRSTRING
}

if( isset($_GET['ACT']) && $_GET['ACT']=='Edit' )
{
$pid = $_GET['PID'];
$act = "edit";
$selectQuery = new SelectQuery();
		
$result = $selectQuery -> from("prop_contact")
								 ->select("*")
								 ->where("propcontact_id = '{$pid}'")
								 ->buildQuery()
								 ->getResult($conn);

while ($row = $result->fetch_assoc())
{
$efullname = $row['propcontact_name'];
$eaddress = $row['propcontact_address'];
$eemail = 	$row['propcontact_email'];
$ephone1 = 	$row['propcontact_phone1'];
$ephone2 =	$row['propcontact_phone2'];
}

}//end isset edit


if(isset($_POST['submit']))
{	

$errstring = "";
$validate = new Validation();
$rtnvalidate = $validate -> validate($_POST); //TEST IF ANY FIELD IS EMPTY

$formarr = array('fullname' => "",
				 'address' => "",
				 'email' => "",
				 'phoneno' => "",
				 'phone2' => ""
				 );

foreach($rtnvalidate as $k => $v)
		{
			if($v == 1)
			{
				if($k == 'phone2'){continue;}
			$errstring = "Please Complete All Fields";
			$formarr[$k] .= "* Field is Empty<br />";
			}
		}

// IF NO ERROR FOUND TRY INSERTION TO DATABASE

	if($errstring=="")
	{			
		// VALIDATE EMAIL
		if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
		{
		// GET CATEGORY NAME
		$fullname = filter_var($_POST['fullname'], FILTER_SANITIZE_STRING);
		$address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
		$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
		$phoneno = filter_var($_POST['phoneno'], FILTER_SANITIZE_NUMBER_INT);
		$phone2 = filter_var($_POST['phone2'], FILTER_SANITIZE_NUMBER_INT);
		
		//CREATE  FILTER OBJECT
		$filter = new MyFilter();
		$address = $filter->validateData($address);

		// BUILD QUERY
		$data = array("propcontact_name" => $fullname,
					  "propcontact_email" => $email,
					  "propcontact_phone1" => $phoneno,
					  "propcontact_phone2" => $phone2,
					  "propcontact_address" => $address
					  );
		
		// CREATE NEW QUERY OBJECT
		$insertquery = new InsertQuery();
		
		$result = $insertquery -> insertTable("prop_contact")
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
			
			header("Location: .?BQ=Control Panel&INC=Property&CMD=View_Prop_Contact&STA=confirm");
		}else
		{ 
		$errstring = "Error in Connection, Please Try Again";
		}
	}else{$errstring = "E-mail is Invalid, Try again";}// END VALIDATE EMAIL
	}// END TEST ERRSTRING
}//END ISSSUBMIT
?>

<div>
<h2><?php if(isset($_GET['ACT'])){echo "EDIT CONTACT";}else{echo "ADD NEW CONTACT";} ?></h2>

<?php 
// IF ERROR DISPLAY
if( $errstring != ""){ echo "<div class='prop_error'><img src='modules/property_manager/images/error.png' /> $errstring </div>";}


?>

<form method="post" action="">
<table width="540">
<tr>
<td width="171">Full Name</td>
<td width="252"><input type="text" name="fullname" size="35" value="<?php if($act == "edit"){echo $efullname;} ?>" /></td>
<td width="101"><span class="prop_formerror"><?php echo $formarr['fullname']; ?></span></td>
</tr>

<tr>
<td>Address</td>
<td><textarea name="address" rows="3" cols="28"><?php if($act == "edit"){echo $eaddress;} ?></textarea></td>
<td><span class="prop_formerror"><?php echo $formarr['address']; ?></span></td>
</tr>

<tr>
<td>E-mail</td>
<td><input type="text" name="email" size="35"  value="<?php if($act == "edit"){echo $eemail;} ?>" /></td>
<td><span class="prop_formerror"><?php echo $formarr['email']; ?></span></td>
</tr>

<tr>
<td>Phone Number</td>
<td><input type="text" name="phoneno" size="35"  value="<?php if($act == "edit"){echo $ephone1;} ?>" /></td>
<td><span class="prop_formerror"><?php echo $formarr['phoneno']; ?></span></td>
</tr>

<tr>
<td>Phone Number2 (<em>optional</em>)</td>
<td><input type="text" name="phone2" size="35"  value="<?php if($act == "edit"){echo $ephone2;} ?>" /></td>
<td><span class="prop_formerror"><?php echo $formarr['phone2']; ?></span></td>
</tr>

<tr>
<td></td>
<td><input type="submit" name="<?php if($act == "edit"){echo 'edit';}else{echo 'submit';} ?>" value="<?php if($act == "edit"){echo 'UPDATE CONTACT LIST';}else{echo 'CREATE CONTACT';} ?>" /></td>
<td></td>
</tr>

</table>

</form>
</div>