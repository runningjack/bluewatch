<?php
$pid = $_GET['PID'];
$errstring = "";

// CREATE OBJECT OF CLASS CONNECTION
$configData = new ConfigData;
$conn = $configData -> connectDB();
		
// BUILD QUERY
$selectQuery = new SelectQuery();

$email = $selectQuery -> returnValue("request_email","prop_request","request_id",$pid,$conn);
						
if(isset($_POST['submit']))
{
$email = $_POST['email'];
$message = $_POST['message'];

$validate = new Validation();
$isvalid_email = $validate -> validateEmail($email);

if( $isvalid_email && $_POST['message'] != "")
{
$message = filter_var($message, FILTER_SANITIZE_STRING);	

$ourmail = "info@lekansanusiandco.com";
$headers = 'From: Lekan Sanusi Properties <'.$ourmail.'>'. "\r\n" .
					'Reply-To: ' . $email . "\r\n" .
					'X-Mailer: PHP/' . phpversion();
					
mail($email,"WEBSITE ENQUIRY",$message,$headers);

$data = array();
$data["request_status"] = 0;
		
		// CREATE NEW QUERY OBJECT
		$updatequery = new UpdateQuery();
		
		$result = $updatequery -> updateTable("prop_request")
							   -> dataToUpdate($data)
							   -> where("request_id='{$pid}'")
							   -> buildQuery()
							   -> updateContent($conn);
		
		if($result)
		{
			header("Location: .?BQ=Control Panel&INC=Property&CMD=Manage_Request&STA=update");
		}
}else{$errstring = "Please fill in all fields correctly";}

}// end issubmit


?>
<div>
<h2>REPLY CUSTOMERS REQUEST:</h2>
<?php 
// IF ERROR DISPLAY
if( $errstring != ""){ echo "<div class='prop_error'><img src='modules/property_manager/images/error.png' /> $errstring </div>";}
?>

<form name="" method="post" action="">

<fieldset>
<legend align="right">Reply Message</legend>
<table>
<tr>
<td width="57">TO:</td>
<td width="544"><input type="text" name="email" value="<?php echo $email; ?>" readonly="readonly" /></td>
</tr>
<tr>
<td>Message:</td>
<td><textarea name="message" rows="8" cols="50"></textarea></td>
</tr>

<tr><td></td>
<td><input type="submit" name="submit" value="Reply message" /></td>

</tr>
</table>

</fieldset>
</form>