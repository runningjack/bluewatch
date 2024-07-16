<?php
// CREATE OBJECT OF CLASS CONNECTION
		$configData = new ConfigData;
		$conn = $configData -> connectDB();

if(isset($_POST['update']))
{
	$pid = $_GET['PID'];
	
			$errstring = "";
			$validate = new Validation();
			$rtnvalidate = $validate -> validate($_POST); //TEST IF ANY FIELD IS EMPTY
			
			$formarr = array('title' => "",
							 'description' => "",
							 'category' => "",
							 'leasetype' => "",
							 'propertytype' => "",
							 'address' => "",
							 'city' => "",
							 'state' => "",
							 'country' => "",
							 'bedrooms' => "",
							 'pricefig' => "",
							 'pricewords' => "",
							 'negotiate' => "",
							 'contact' => "",
							 'enable' => ""
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
					
					
		if($errstring=="")
		{			

		// GET CATEGORY NAME
		$title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
		$description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
		$category = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
		$leasetype = filter_var($_POST['leasetype'], FILTER_SANITIZE_NUMBER_INT);
		$propertytype = filter_var($_POST['propertytype'], FILTER_SANITIZE_NUMBER_INT);
		$address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
		$city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);
		$state = filter_var($_POST['state'], FILTER_SANITIZE_STRING);
		$country = filter_var($_POST['country'], FILTER_SANITIZE_STRING);
		$bedrooms = filter_var($_POST['bedrooms'], FILTER_SANITIZE_NUMBER_INT);
		$pricefig = filter_var($_POST['pricefig'], FILTER_SANITIZE_NUMBER_INT);
		$pricewords = filter_var($_POST['pricewords'], FILTER_SANITIZE_STRING);
		$negotiate = filter_var($_POST['negotiate'], FILTER_SANITIZE_STRING);
		$contact = filter_var($_POST['contact'], FILTER_SANITIZE_NUMBER_INT);
		$enable = filter_var($_POST['enable'], FILTER_SANITIZE_STRING);
		
		// BUILD QUERY
		$data = array();
		
					  $data["property_title"] = $title;
					  $data["property_description"] = $description;
					  $data["property_address"] = $address;
					  $data["property_city"] = $city;
					  $data["property_state"] = $state;
					  $data["property_country"] = $country;
					  $data["property_contactid"] = $contact;
					  $data["property_maincat"] = $category;
					  $data["property_leasetype"] = $leasetype;
					  $data["property_proptype"] = $propertytype;
					  $data["property_bedno"] = $bedrooms;
					  $data["property_priceword"] = $pricewords;
					  $data["property_pricefigure"] = $pricefig;
					  $data["property_negotiable"] = $negotiate;
					  $data["property_status"] = $enable;
					  
					  // CREATE NEW QUERY OBJECT
						$updatequery = new UpdateQuery();
						
						$result = $updatequery -> updateTable("prop_property")
											   -> dataToUpdate($data)
											   -> where("property_id='{$pid}'")
											   -> buildQuery()
											   -> updateContent($conn);
							  
					if($result)
					{	
						$configData -> destroy();
						$configData = null;
						unset($configData);
						
						$updateQuery = null;
						unset($updateQuery);
						
						header("Location: .?BQ=Control Panel&INC=Property&CMD=View_Exist_Prop&STA=update");
					}else
					{ 
						$errstring = "Error in Connection, Please Try Again";
					}
		}
		

}



if( (isset($_GET['ACT'])) && ($_GET['ACT'] == "Edit") )
{
	$pid = $_GET['PID'];
	$act = "edit";
	
		// BUILD QUERY
		$selectQuery = new SelectQuery();
		
		$result = $selectQuery -> from("prop_property")
		->select("*")
		->where("property_id='{$pid}'")
		->buildQuery()
		->getResult($conn);
		
		while ($row = $result->fetch_assoc())
			{
				$title =	$row['property_title'];
				$description = $row['property_description'];
				$address = $row['property_address'];
				$city = $row['property_city'];
				$state = $row['property_state'];
				$country = $row['property_country'];
				$bedno = $row['property_bedno'];
				$pricewords = $row['property_priceword'];
				$pricefig = $row['property_pricefigure'];
				$negotiate = $row['property_negotiable'];
				$maincat = $row['property_maincat'];
				$leasetype = $row['property_leasetype'];
				$proptype = $row['property_proptype'];
				$contact = $row['property_contactid'];
			}
}








		if(isset($_POST['submit']))
		{
			$errstring = "";
			$validate = new Validation();
			$rtnvalidate = $validate -> validate($_POST); //TEST IF ANY FIELD IS EMPTY
			
			$formarr = array('title' => "",
							 'description' => "",
							 'category' => "",
							 'leasetype' => "",
							 'propertytype' => "",
							 'address' => "",
							 'city' => "",
							 'state' => "",
							 'country' => "",
							 'bedrooms' => "",
							 'pricefig' => "",
							 'pricewords' => "",
							 'negotiate' => "",
							 'contact' => "",
							 'enable' => ""
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
	

	if($errstring=="")
	{			

		// GET CATEGORY NAME
		$title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
		$description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
		$category = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
		$leasetype = filter_var($_POST['leasetype'], FILTER_SANITIZE_NUMBER_INT);
		$propertytype = filter_var($_POST['propertytype'], FILTER_SANITIZE_NUMBER_INT);
		$address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
		$city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);
		$state = filter_var($_POST['state'], FILTER_SANITIZE_STRING);
		$country = filter_var($_POST['country'], FILTER_SANITIZE_STRING);
		$bedrooms = filter_var($_POST['bedrooms'], FILTER_SANITIZE_NUMBER_INT);
		$pricefig = filter_var($_POST['pricefig'], FILTER_SANITIZE_NUMBER_INT);
		$pricewords = filter_var($_POST['pricewords'], FILTER_SANITIZE_STRING);
		$negotiate = filter_var($_POST['negotiate'], FILTER_SANITIZE_STRING);
		$contact = filter_var($_POST['contact'], FILTER_SANITIZE_NUMBER_INT);
		$enable = filter_var($_POST['enable'], FILTER_SANITIZE_STRING);
		$dateadded = time();
		$addedby = $_SESSION['validuser'];
		
		// BUILD QUERY
		$data = array("property_title" => $title,
					  "property_description" => $description,
					  "property_address" => $address,
					  "property_city" => $city,
					  "property_state" => $state,
					  "property_country" => $country,
					  "property_contactid" => $contact,
					  "property_maincat" => $category,
					  "property_leasetype" => $leasetype,
					  "property_proptype" => $propertytype,
					  "property_bedno" => $bedrooms,
					  "property_priceword" => $pricewords,
					  "property_pricefigure" => $pricefig,
					  "property_negotiable" => $negotiate,
					  "property_dateadded" => $dateadded,
					  "property_addedby" => $addedby,
					  "property_status" => $enable,
					  "property_imgdefault" => "default.png",
					  "property_thumb" => "default.png"
					  );
		
		// CREATE NEW QUERY OBJECT
		$insertquery = new InsertQuery();
		
		$result = $insertquery -> insertTable("prop_property")
							   -> insertData($data)
							   -> buildInsertQuery()
							   -> queryDB($conn);
							   
		$pid = $insertquery -> getLastID();
		
			if($result)
			{		
				$insertQuery = null;
				unset($insertQuery);
				header("Location: .?BQ=Control Panel&INC=Property&CMD=Add_Prop_Image&STA=pconfirm&PID=$pid");
			}else
			{ 
			$errstring = "Error in Connection, Please Try Again";
			}
	}// end errstring
	
}//end isset submit

?>

<div>
<h2>ADD A NEW PROPERTY</h2>
<?php
// IF ERROR DISPLAY
if( $errstring != ""){ echo "<div class='prop_error'><img src='modules/property_manager/images/error.png' /> $errstring </div>";}

?>
<form method="post" action="" name="prop">
<fieldset>
<legend align="right">Add New Property</legend>
<table>
<tr>
<td width="153">Title</td>
<td width="221"><input type="text" name="title" size="35" value="<?php if($act == "edit"){echo $title;} ?>" /></td>
<td width="188"><span class="prop_formerror"><?php echo $formarr['title']; ?></span></td>
</tr>

<tr>
<td>Description</td>
<td><textarea name="description" rows="3" cols="35"><?php if($act == "edit"){echo $description;} ?></textarea></td>
<td><span class="prop_formerror"><?php echo $formarr['description']; ?></span></td>
</tr>


<tr>
<td>Category</td>
<td>
<select name="category">
<?
// BUILD QUERY
		$selectQuery2 = new SelectQuery();
		
		$result2 = $selectQuery2 -> from("prop_categories")
								 ->select("propcat_id","propcat_name")
								 ->where("propcat_belongs = 'prop_maincat'")
								 ->buildQuery()
								 ->getResult($conn);
								 
		 while ($rows = $result2->fetch_assoc())
	 		{
			echo "<option value='$rows[propcat_id]'";
			
			if( ($act=="edit") && ($maincat == $rows['propcat_id']) ){echo "selected='selected'";}
			
			echo ">$rows[propcat_name]</option>";
			}
            ?>
</select>
</td>
<td><span class="prop_formerror"><?php echo $formarr['category']; ?></span></td>
</tr>


<tr>
<td>Lease Type</td>
<td>
<select name="leasetype">
<?php
			
		// BUILD QUERY
		$selectQuery = new SelectQuery();
		
		$result = $selectQuery -> from("prop_categories")
								 ->select("propcat_id","propcat_name")
								 ->where("propcat_belongs = 'prop_leasetype'")
								 ->buildQuery()
								 ->getResult($conn);
								 
		 while ($row = $result->fetch_assoc())
	 		{
			echo "<option value='$row[propcat_id]'";
			if( ($act=="edit") && ($leasetype == $row['propcat_id']) ){echo "selected='selected'";}
			echo ">$row[propcat_name]</option>";
			}
			
			
?>
</select>
</td>
<td><span class="prop_formerror"><?php echo $formarr['leasetype']; ?></span></td>
</tr>

<tr>
<td>Property Type</td>
<td>
<select name="propertytype">
<?
// BUILD QUERY
		$selectQuery3 = new SelectQuery();
		
		$result3 = $selectQuery3 ->from("prop_categories")
								 ->select("propcat_id","propcat_name")
								 ->where("propcat_belongs = 'prop_proptype'")
								 ->buildQuery()
								 ->getResult($conn);
								 
		 while ($row3 = $result3->fetch_assoc())
	 		{
			echo "<option value='$row3[propcat_id]'";
			if( ($act=="edit") && ($proptype == $row3['propcat_id']) ){echo "selected='selected'";}
			echo ">$row3[propcat_name]</option>";
			}
            ?>
</select>
</td>
<td><span class="prop_formerror"><?php echo $formarr['propertytype']; ?></span></td>
</tr>


<tr>
<td>Address</td>
<td><textarea name="address" row="3" cols="35"><?php if($act == "edit"){echo $address;} ?></textarea></td>
<td><span class="prop_formerror"><?php echo $formarr['address']; ?></span></td>
</tr>

<tr>
<td>City</td>
<td><input type="text" name="city" value="<?php if($act == "edit"){echo $city;} ?>" /></td>
<td><span class="prop_formerror"><?php echo $formarr['city']; ?></span></td>
</tr>

<tr>
<td>State</td>
<td>
<select name="state">
                <option value='Abia' <?php if(($act == "edit") && ($state=="Abia")){echo "selected='selected'";} ?>>Abia</option>
                <option value='Abuja' <?php if(($act == "edit") && ($state=="Abuja")){echo "selected='selected'";} ?>>Abuja</option>
                <option value='Adamawa' <?php if(($act == "edit") && ($state=="Adamawa")){echo "selected='selected'";} ?>>Adamawa</option>
                <option value='Akwa Ibom' <?php if(($act == "edit") && ($state=="Akwa Ibom")){echo "selected='selected'";} ?>>Akwa Ibom</option>
                <option value='Anambra' <?php if(($act == "edit") && ($state=="Anambra")){echo "selected='selected'";} ?>>Anambra</option>
                <option value='Bauchi' <?php if(($act == "edit") && ($state=="Bauchi")){echo "selected='selected'";} ?>>Bauchi</option>
                <option value='Bayelsa' <?php if(($act == "edit") && ($state=="Bayelsa")){echo "selected='selected'";} ?>>Bayelsa</option>
                <option value='Benue' <?php if(($act == "edit") && ($state=="Benue")){echo "selected='selected'";} ?>>Benue</option>
                <option value='Borno' <?php if(($act == "edit") && ($state=="Borno")){echo "selected='selected'";} ?>>Borno</option>
                <option value='Cross River' <?php if(($act == "edit") && ($state=="Cross River")){echo "selected='selected'";} ?>>Cross River</option>
                <option value='Delta' <?php if(($act == "edit") && ($state=="Delta")){echo "selected='selected'";} ?>>Delta</option>
                <option value='Ebonyi' <?php if(($act == "edit") && ($state=="Ebonyi")){echo "selected='selected'";} ?>>Ebonyi</option>
                <option value='Edo' <?php if(($act == "edit") && ($state=="Edo")){echo "selected='selected'";} ?>>Edo</option>
                <option value='Ekiti' <?php if(($act == "edit") && ($state=="Ekiti")){echo "selected='selected'";} ?>>Ekiti</option>
                <option value='Enugu' <?php if(($act == "edit") && ($state=="Enugu")){echo "selected='selected'";} ?>>Enugu</option>
                <option value='Gombe' <?php if(($act == "edit") && ($state=="Gombe")){echo "selected='selected'";} ?>>Gombe </option>
                <option value='Imo' <?php if(($act == "edit") && ($state=="Imo")){echo "selected='selected'";} ?>>Imo </option>
                <option value='Jigawa' <?php if(($act == "edit") && ($state=="Jigawa")){echo "selected='selected'";} ?>>Jigawa </option>
                <option value='Kaduna' <?php if(($act == "edit") && ($state=="Kaduna")){echo "selected='selected'";} ?>>Kaduna </option>
                <option value='Kano' <?php if(($act == "edit") && ($state=="Kano")){echo "selected='selected'";} ?>>Kano </option>
                <option value='Katsina' <?php if(($act == "edit") && ($state=="Katsina")){echo "selected='selected'";} ?>>Katsina </option>
                <option value='Kebbi' <?php if(($act == "edit") && ($state=="Kebbi")){echo "selected='selected'";} ?>>Kebbi </option>
                <option value='Kogi' <?php if(($act == "edit") && ($state=="Kogi")){echo "selected='selected'";} ?>>Kogi </option>
                <option value='Kwara' <?php if(($act == "edit") && ($state=="Kwara")){echo "selected='selected'";} ?>>Kwara </option>
                <option value='Lagos' <?php if(($act == "edit") && ($state=="Lagos")){echo "selected='selected'";} ?>>Lagos </option>
                <option value='Nassarawa' <?php if(($act == "edit") && ($state=="Nassarawa")){echo "selected='selected'";} ?>>Nassarawa </option>
                <option value='Niger' <?php if(($act == "edit") && ($state=="Niger")){echo "selected='selected'";} ?>>Niger </option>
                <option value='Ogun' <?php if(($act == "edit") && ($state=="Ogun")){echo "selected='selected'";} ?>>Ogun </option>
                <option value='Ondo' <?php if(($act == "edit") && ($state=="Ondo")){echo "selected='selected'";} ?>>Ondo </option>
                <option value='Osun' <?php if(($act == "edit") && ($state=="Osun")){echo "selected='selected'";} ?>>Osun </option>
                <option value='Oyo' <?php if(($act == "edit") && ($state=="Oyo")){echo "selected='selected'";} ?>>Oyo </option>
                <option value='Plateau' <?php if(($act == "edit") && ($state=="Plateau")){echo "selected='selected'";} ?>>Plateau </option>
                <option value='Rivers' <?php if(($act == "edit") && ($state=="Rivers")){echo "selected='selected'";} ?>>Rivers </option>
                <option value='Sokoto' <?php if(($act == "edit") && ($state=="Sokoto")){echo "selected='selected'";} ?>>Sokoto </option>
                <option value='Taraba' <?php if(($act == "edit") && ($state=="Taraba")){echo "selected='selected'";} ?>>Taraba </option>
                <option value='Yobe' <?php if(($act == "edit") && ($state=="Yobe")){echo "selected='selected'";} ?>>Yobe </option>
                <option value='Zamfara' <?php if(($act == "edit") && ($state=="Zamfara")){echo "selected='selected'";} ?>>Zamfara</option>
</select>
</td>
<td><span class="prop_formerror"><?php echo $formarr['state']; ?></span></td>
</tr>

<tr>
<td>Country</td>
<td>
<select name="country">
<option value="Afghanistan">Afghanistan </option>

                        <option value="Albania">Albania </option>

                        <option value="Algeria">Algeria </option>

                        <option value="American Samoa">American Samoa </option>

                        <option value="Andorra">Andorra </option>

                        <option value="Angola">Angola </option>

                        <option value="Anguilla">Anguilla </option>

                        <option value="Antarctica">Antarctica </option>

                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>

                        <option value="Argentina">Argentina </option>

                        <option value="Armenia">Armenia </option>

                        <option value="Aruba">Aruba </option>

                        <option value="Austria">Austria </option>

                        <option value="Australia">Australia </option>

                        <option value="Azerbaijan">Azerbaijan </option>

                        <option value="Bahamas">Bahamas </option>

                        <option value="Bahrain">Bahrain </option>

                        <option value="Bangladesh">Bangladesh </option>

                        <option value="Barbados">Barbados </option>

                        <option value="Belarus">Belarus </option>

                        <option value="Belgium">Belgium </option>

                        <option value="Belize">Belize </option>

                        <option value="Benin">Benin </option>

                        <option value="Bermuda">Bermuda </option>

                        <option value="Bhutan">Bhutan </option>

                        <option value="Bolivia">Bolivia </option>

                        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>

                        <option value="Botswana">Botswana </option>

                        <option value="Bouvet Island">Bouvet Island </option>

                        <option value="Brazil">Brazil </option>

                        <option value="British Indian Ocean Territory">British Indian Ocean Territory </option>

                        <option value="Brunei Darussalam">Brunei Darussalam </option>

                        <option value="Bulgaria">Bulgaria </option>

                        <option value="Burkina Faso">Burkina Faso </option>

                        <option value="Burundi">Burundi </option>

                        <option value="Cambodia">Cambodia </option>

                        <option value="Cameroon">Cameroon </option>

                        <option value="Canada">Canada </option>

                        <option value="Cape Verde">Cape Verde </option>

                        <option value="Cayman Islands">Cayman Islands </option>

                        <option value="Central African Republic">Central African Republic </option>

                        <option value="Chad">Chad </option>

                        <option value="Chile">Chile </option>

                        <option value="China">China </option>

                        <option value="Christmas Island">Christmas Island </option>

                        <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands </option>

                        <option value="Colombia">Colombia </option>

                        <option value="Comoros">Comoros </option>

                        <option value="Congo">Congo </option>

                        <option value="Cook Islands">Cook Islands </option>

                        <option value="Costa Rica">Costa Rica </option>

                        <option value="Croatia (Hrvatska)">Croatia (Hrvatska)</option>

                        <option value="Cuba">Cuba </option>

                        <option value="Cyprus">Cyprus </option>

                        <option value="Czech Republic">Czech Republic </option>

                        <option value="Czechoslovakia (former)">Czechoslovakia (former) </option>

                        <option value="Denmark">Denmark </option>

                        <option value="Djibouti">Djibouti </option>

                        <option value="Dominica">Dominica </option>

                        <option value="Dominican Republic">Dominican Republic</option>

                        <option value="East Timor">East Timor </option>

                        <option value="Ecuador">Ecuador </option>

                        <option value="Egypt">Egypt </option>

                        <option value="El Salvador">El Salvador </option>

                        <option value="Equatorial Guinea">Equatorial Guinea </option>

                        <option value="Eritrea">Eritrea </option>

                        <option value="Estonia">Estonia </option>

                        <option value="Ethiopia">Ethiopia </option>

                        <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas) </option>

                        <option value="Faroe Islands">Faroe Islands </option>

                        <option value="Fiji">Fiji </option>

                        <option value="Finland">Finland </option>

                        <option value="France">France </option>

                        <option value="French Guiana">French Guiana </option>

                        <option value="French Polynesia">French Polynesia </option>

                        <option value="French Southern Territories">French Southern Territories </option>

                        <option value="Gabon">Gabon </option>

                        <option value="Gambia">Gambia </option>

                        <option value="Georgia">Georgia </option>

                        <option value="Germany">Germany </option>

                        <option value="Ghana">Ghana </option>

                        <option value="Gibraltar">Gibraltar </option>

                        <option value="Greece">Greece </option>

                        <option value="Greenland">Greenland </option>

                        <option value="Grenada">Grenada </option>

                        <option value="Guadeloupe">Guadeloupe </option>

                        <option value="Guam">Guam </option>

                        <option value="Guatemala">Guatemala </option>

                        <option value="Guinea">Guinea </option>

                        <option value="Guinea-Bissau">Guinea-Bissau </option>

                        <option value="Guyana">Guyana </option>

                        <option value="Haiti">Haiti </option>

                        <option value="Heard and McDonald Islands">Heard and McDonald Islands </option>

                        <option value="Honduras">Honduras </option>

                        <option value="Hong Kong">Hong Kong </option>

                        <option value="Hungary">Hungary </option>

                        <option value="Iceland">Iceland </option>

                        <option value="India">India </option>

                        <option value="Indonesia">Indonesia </option>

                        <option value="Iran">Iran </option>

                        <option value="Iraq">Iraq </option>

                        <option value="Ireland">Ireland </option>

                        <option value="Israel">Israel </option>

                        <option value="Italy">Italy </option>

                        <option value="Jamaica">Jamaica </option>

                        <option value="Japan">Japan </option>

                        <option value="Jordan">Jordan </option>

                        <option value="Kazakhstan">Kazakhstan </option>

                        <option value="Kenya">Kenya </option>

                        <option value="Kiribati">Kiribati </option>

                        <option value="Korea (North)">Korea (North) </option>

                        <option value="Korea (South)">Korea (South) </option>

                        <option value="Kuwait">Kuwait </option>

                        <option value="Kyrgyzstan">Kyrgyzstan </option>

                        <option value="Laos">Laos </option>

                        <option value="Latvia">Latvia </option>

                        <option value="Lebanon">Lebanon </option>

                        <option value="Lesotho">Lesotho </option>

                        <option value="Liberia">Liberia </option>

                        <option value="Libya">Libya </option>

                        <option value="Liechtenstein">Liechtenstein </option>

                        <option value="Lithuania">Lithuania </option>

                        <option value="Luxembourg">Luxembourg </option>

                        <option value="Macau">Macau </option>

                        <option value="Macedonia">Macedonia </option>

                        <option value="Madagascar">Madagascar </option>

                        <option value="Malawi">Malawi </option>

                        <option value="Malaysia">Malaysia </option>

                        <option value="Maldives">Maldives </option>

                        <option value="Mali">Mali </option>

                        <option value="Malta">Malta </option>

                        <option value="Marshall Islands">Marshall Islands </option>

                        <option value="Martinique">Martinique </option>

                        <option value="Mauritania">Mauritania </option>

                        <option value="Mauritius">Mauritius </option>

                        <option value="Mayotte">Mayotte </option>

                        <option value="Mexico">Mexico </option>

                        <option value="Micronesia">Micronesia </option>

                        <option value="Moldova">Moldova </option>

                        <option value="Monaco">Monaco </option>

                        <option value="Mongolia">Mongolia </option>

                        <option value="Montserrat">Montserrat </option>

                        <option value="Morocco">Morocco </option>

                        <option value="Mozambique">Mozambique </option>

                        <option value="Myanmar">Myanmar </option>

                        <option value="Namibia">Namibia </option>

                        <option value="Nauru">Nauru </option>

                        <option value="Nepal">Nepal </option>

                        <option value="Netherlands">Netherlands </option>

                        <option value="Netherlands Antilles">Netherlands Antilles 

                        </option>

                        <option value="Neutral Zone">Neutral Zone </option>

                        <option value="New Caledonia">New Caledonia </option>

                        <option value="New Zealand (Aotearoa)">New Zealand (Aotearoa) 

                        </option>

                        <option value="Nicaragua">Nicaragua </option>

                        <option value="Niger">Niger </option>

                        <option value="Nigeria" selected="selected">Nigeria </option>

                        <option value="Niue">Niue </option>

                        <option value="Norfolk Island">Norfolk Island </option>

                        <option value="Northern Mariana Islands">Northern Mariana Islands </option>

                        <option value="Norway">Norway </option>

                        <option value="Oman">Oman </option>

                        <option value="Pakistan">Pakistan </option>

                        <option value="Palau">Palau </option>

                        <option value="Panama">Panama </option>

                        <option value="Papua New Guinea">Papua New Guinea </option>

                        <option value="Paraguay">Paraguay </option>

                        <option value="Peru">Peru </option>

                        <option value="Philippines">Philippines </option>

                        <option value="Pitcairn">Pitcairn </option>

                        <option value="Poland">Poland </option>

                        <option value="Portugal">Portugal </option>

                        <option value="Puerto Rico">Puerto Rico </option>

                        <option value="Qatar">Qatar </option>

                        <option value="Reunion">Reunion </option>

                        <option value="Romania">Romania </option>

                        <option value="Russian Federation">Russian Federation</option>

                        <option value="Rwanda">Rwanda </option>

                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis </option>

                        <option value="Saint Lucia">Saint Lucia </option>

                        <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines </option>

                        <option value="Samoa">Samoa </option>

                        <option value="San Marino">San Marino </option>

                        <option value="Sao Tome and Principe">Sao Tome and Principe</option>

                        <option value="Saudi Arabia">Saudi Arabia </option>

                        <option value="Senegal">Senegal </option>

                        <option value="Seychelles">Seychelles </option>

                        <option value="Sierra Leone">Sierra Leone </option>

                        <option value="Singapore">Singapore </option>

                        <option value="Solomon Islands">Solomon Islands </option>

                        <option value="Somalia">Somalia </option>

                        <option value="South Africa">South Africa </option>

                        <option value="South Georgia and South Sandwich Isls.">South Georgia &amp; South Sandwich Isls. </option>

                        <option value="Slovak Republic">Slovak Republic </option>

                        <option value="Slovenia">Slovenia </option>

                        <option value="Spain">Spain </option>

                        <option value="Sri Lanka">Sri Lanka </option>

                        <option value="St. Helena">St. Helena </option>

                        <option value="St. Pierre and Miquelon">St. Pierre and Miquelon </option>

                        <option value="Sudan">Sudan </option>

                        <option value="Suriname">Suriname </option>

                        <option value="Svalbard and Jan Mayen Islands">Svalbard and Jan Mayen Islands </option>

                        <option value="Swaziland">Swaziland </option>

                        <option value="Sweden">Sweden </option>

                        <option value="Switzerland">Switzerland </option>

                        <option value="Syria">Syria </option>

                        <option value="Taiwan">Taiwan </option>

                        <option value="Tajikistan">Tajikistan </option>

                        <option value="Tanzania">Tanzania </option>

                        <option value="Thailand">Thailand </option>

                        <option value="Togo">Togo </option>

                        <option value="Trinidad and Tobago">Trinidad and Tobago </option>

                        <option value="Tokelau">Tokelau </option>

                        <option value="Tonga">Tonga </option>

                        <option value="Tunisia">Tunisia </option>

                        <option value="Turkey">Turkey </option>

                        <option value="Turkmenistan">Turkmenistan </option>

                        <option value="Turks and Caicos Islands">Turks and Caicos Islands </option>

                        <option value="Tuvalu">Tuvalu </option>

                        <option value="Uganda">Uganda </option>

                        <option value="Ukraine">Ukraine </option>

                        <option value="United Arab Emirate">United Arab Emirate</option>

                        <option value="United Kingdom">United Kingdom </option>

                        <option value="United States">United States </option>

                        <option value="Uruguay">Uruguay </option>

                        <option value="US Minor Outlying Islands">US Minor Outlying Islands </option>

                        <option value="USSR (former)">USSR (former) </option>

                        <option value="Uzbekistan">Uzbekistan </option>

                        <option value="Vatican City State (Holy See)">Vatican City State (Holy See) </option>

                        <option value="Vanuatu">Vanuatu </option>

                        <option value="Venezuela">Venezuela </option>

                        <option value="Viet Nam">Viet Nam </option>

                        <option value="Virgin Islands (British)">Virgin Islands (British) </option>

                        <option value="Virgin Islands (U.S.)">Virgin Islands (U.S.) </option>

                        <option value="Wallis and Futuna Islands">Wallis and Futuna Islands </option>

                        <option value="Western Sahara">Western Sahara </option>

                        <option value="Yemen">Yemen </option>

                        <option value="Yugoslavia">Yugoslavia </option>

                        <option value="Zaire">Zaire </option>

                        <option value="Zambia">Zambia </option>

                        <option value="Zimbabwe">Zimbabwe </option>

</select>
</td>
<td><span class="prop_formerror"><?php echo $formarr['country']; ?></span></td>
</tr>

<tr>
<td>No of Bed Room(s)</td>
<td>
<select name="bedrooms">
<?php 
for($i=1;$i<=30;$i++)
{
	echo "<option value='$i'";
	 if(($act == "edit") && ($i==$bedno)){echo "selected='selected'";} 
	echo ">$i</option>";	
}
?>
</select>
</td>
<td><span class="prop_formerror"><?php echo $formarr['bedrooms']; ?></span></td>
</tr>

<tr>
<td>Price in Figures</td>
<td><input type="text" name="pricefig"  value="<?php if($act == "edit"){echo $pricefig;} ?>" /></td>
<td><span class="prop_formerror"><?php echo $formarr['pricefig']; ?></span></td>
</tr>

<tr>
<td>Price in Words:</td>
<td><input type="text" name="pricewords" value="<?php if($act == "edit"){echo $pricewords;} ?>" />
  <em>e.g 3.5 million</em></td>
<td><span class="prop_formerror"><?php echo $formarr['pricewords']; ?></span></td>
</tr>

<tr>
<td>Negotiable?</td>
<td><input type="radio" name="negotiate" value="yes" <?php if( ($act == "edit") && ($negotiate == "yes")){echo "checked='checked'";} ?> /> Yes <input type="radio" name="negotiate" value="no" <?php if( ($act == "edit") && ($negotiate == "no")){echo "checked='checked'";} ?> /> No</td>
<td><span class="prop_formerror"><?php echo $formarr['negotiate']; ?></span></td>
</tr>

<tr>
<td>Contact Person</td>
<td>
 <select name="contact">
<?
// BUILD QUERY
		$selectQuery3 = new SelectQuery();
		
		$result3 = $selectQuery3 -> from("prop_contact")
								 ->select("propcontact_id","propcontact_name")
								 ->buildQuery()
								 ->getResult($conn);
								 
		 while ($row3 = $result3->fetch_assoc())
	 		{
			echo "<option value='$row3[propcontact_id]'";
			if( ($act=="edit") && ($contact == $row3['propcontact_id']) ){echo "selected='selected'";}
			echo ">$row3[propcontact_name]</option>";
			}
            ?>
</select>
</td>
<td><span class="prop_formerror"><?php echo $formarr['contact']; ?></span></td>
</tr>

<tr>
<td>Enable Property</td>
<td>
<input type="checkbox" name="enable" value="yes"  checked="checked" />
</td>
<td><span class="prop_formerror"><?php echo $formarr['enable']; ?></span></td>
</tr>

<tr>
<td></td>
<td>
<input type="submit" name="<?php if($act=="edit"){echo "update";}else{echo "submit";} ?>" value="<?php if($act=="edit"){echo "UPDATE PROPERTY";}else{echo "ADD PROPERTY";} ?>" />
</td>
<td></td>
</tr>
</table>
</fieldset>
</form>
</div>