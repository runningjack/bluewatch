<?php
error_reporting("E_ALL ^ E_NOTICE");

if(isset($_POST['upload']))
{

$mainsize_ischecked = $_POST['box-r'];
$main_w = $_POST['main-w'];
$main_h = $_POST['main-h'];

$default_main_w = 655;
$default_main_h = 280;

$mainthumb_width = 200;
$mainthumb_height = 200;
$odathumb_width = 200;
$odathumb_height = 200;


$thumbsize_ischecked = $_POST['thumb-r'];	
$thumb_w = $_POST['thumb-w'];
$thumb_h = $_POST['thumb-h'];

$default_thumb_w = 655;
$default_thumb_h = 280;


$homethumb_ischecked = $_POST['hthumb-r'];
$hthumb_w = $_POST['hthumb-w'];
$hthumb_h = $_POST['hthumb-h'];

$default_homethumb_w = 135;
$default_homethumb_h = 107;

// CHECK IF ODA IMAGES SIZE IS PICKED
if($thumbsize_ischecked == "yes")
{
$thumb_width = $thumb_w;
$thumb_height = $thumb_h;
}else
{
$thumb_width = $default_thumb_w;
$thumb_height = $default_thumb_h;	
}

// CHECK IF MAIN SIZE IS PICKED
if($mainsize_ischecked == "yes")
{
$main_width = $main_w;
$main_height = $main_h;
}else
{
$main_width = $default_main_w;
$main_height = $default_main_h;	
}

// CHECK IF HOMETHUMB IS PICKED
if($homethumb_ischecked == "yes")
{
$myhomethumb_width = $hthumb_w;
$myhomethumb_height = $hthumb_h;
}else
{
$myhomethumb_width = $default_homethumb_w;
$myhomethumb_height = $default_homethumb_h;	
}

//GET MY RESIZER CLASS
require("modules/property_manager/includes/resizer.php");

// CREATE OBJECT OF CLASS CONNECTION
$configData = new ConfigData;
$conn = $configData -> connectDB();

//PROCESS MAIN IMAGE
if($_FILES['mainpix']['size'] != 0)
{
	// IF MAINIMAGE IS UPLOADED WITH NO ERROR
	$m_tmp_name = $_FILES['mainpix']['tmp_name'];
	$m_name = $_FILES['mainpix']['name'];
	$m_type = $_FILES['mainpix']['type'];
		
		if($m_type == "image/jpeg" || $m_type == "image/jpg" || $m_type == "image/png" || $m_type == "image/gif")
			{
				//IMAGE MATCHES OUR TYPE..CONTINUE
				
				$alphanum = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
							
				$m_large = "modules/property_manager/images/property/";
				$m_small = "modules/property_manager/images/property/thumbs/";
				
				
				   
					$path_info = pathinfo($_FILES['mainpix']['name']);
					$ext = $path_info['extension']; // get file extension
					
					$new_image_name = substr(str_shuffle($alphanum), 0, 10) . "." . $ext; // new image name
					
					$thumb_path = $m_small . $new_image_name; 
					$large_path = $m_large . $new_image_name;
				   
				   ResizerImage::imageresizer($_FILES['mainpix']['tmp_name'], $main_width, $main_height, $_FILES['mainpix']['type'], $large_path);
				   // Create large image
				   
				  ResizerImage::imageresizer($_FILES['mainpix']['tmp_name'], $mainthumb_width, $mainthumb_height, $_FILES['mainpix']['type'][$key], $thumb_path); 				   // Create thumbnail
				   
				   // BUILD QUERY
					$data = array("imagemgr_link" => $new_image_name,
								  "imagemgr_propid" => $_GET['PID'],
								  );
					
					// CREATE NEW QUERY OBJECT
					$insertquery = new InsertQuery();
					
					$result = $insertquery -> insertTable("prop_imagemgr")
										  -> insertData($data)
										  -> buildInsertQuery()
										  -> queryDB($conn);
				   
				     // UPDATE MAIN IMAGE LINK
					// BUILD QUERY
					$data = array();
					$data["property_imgdefault"] = $new_image_name;
					$pid = $_GET['PID'];
					
					// CREATE NEW QUERY OBJECT
					$updatequery = new UpdateQuery();
					
					$result = $updatequery -> updateTable("prop_property")
							   -> dataToUpdate($data)
							   -> where("property_id='{$pid}'")
							   -> buildQuery()
							   -> updateContent($conn);
				   
				   if( ($_FILES['img']['size'] == 0) && ($_FILES['homethumb']['size'] == 0)){
				    header("Location: .?BQ=Control Panel&INC=Property&CMD=View_Exist_Prop&STA=imgconfirm"); }
			}
}

// IF A OTHER IMAGES IS UPLOADED
if(isset($_FILES['img']))
{
foreach ($_FILES['img']['size'] as $key => $error) 
{
	if ($error != 0)
	{
	// IF THUMBNAIL IS UPLOADED WITH NO ERROR
	$tmp_name = $_FILES['img']['tmp_name'][$key];
	$name = $_FILES['img']['name'][$key];
	$type = $_FILES['img']['type'][$key];
		
			if($type == "image/jpeg" || $type == "image/jpg" || $type == "image/png" || $type == "image/gif")
			{
				//IMAGE MATCHES OUR TYPE..CONTINUE
				
				$alphanum = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
							
				$large = "modules/property_manager/images/property/";
				$small = "modules/property_manager/images/property/thumbs/";
				
				
				   
					$path_info = pathinfo($_FILES['img']['name'][$key]);
					$ext = $path_info['extension']; // get file extension
					
					$new_image_name = substr(str_shuffle($alphanum), 0, 10) . "." . $ext; // new image name
					
					$thumb_path = $small . $new_image_name; 
					$large_path = $large . $new_image_name;
				   
				   ResizerImage::imageresizer($_FILES['img']['tmp_name'][$key], $thumb_width, $thumb_height, $_FILES['img']['type'][$key], $large_path);
				   // Create large image
				   
				  ResizerImage::imageresizer($_FILES['img']['tmp_name'][$key], $odathumb_width, $odathumb_height, $_FILES['img']['type'][$key], $thumb_path); 				   // Create thumbnail
				   
				   // BUILD QUERY
					$data = array("imagemgr_link" => $new_image_name,
								  "imagemgr_propid" => $_GET['PID'],
								  );
					
					// CREATE NEW QUERY OBJECT
					$insertquery = new InsertQuery();
					
					$result = $insertquery -> insertTable("prop_imagemgr")
										  -> insertData($data)
										  -> buildInsertQuery()
										  -> queryDB($conn);
				   
				   if($_FILES['homethumb']['size'] == 0)
				   {
					 header("Location: .?BQ=Control Panel&INC=Property&CMD=View_Exist_Prop&STA=imgconfirm"); 
				   }
			
	}
}

}
}


// IF HOMETHUMBNAIL IS UPLOADED

if($_FILES['homethumb']['size'] != 0)
{
	// IF MAINIMAGE IS UPLOADED WITH NO ERROR
	$m_tmp_name = $_FILES['homethumb']['tmp_name'];
	$m_name = $_FILES['homethumb']['name'];
	$m_type = $_FILES['homethumb']['type'];
		
		if($m_type == "image/jpeg" || $m_type == "image/jpg" || $m_type == "image/png" || $m_type == "image/gif")
			{
				//IMAGE MATCHES OUR TYPE..CONTINUE
				
				$alphanum = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
							
				$m_small = "modules/property_manager/images/property/homethumbs/";
				
				
				   
					$path_info = pathinfo($_FILES['homethumb']['name']);
					$ext = $path_info['extension']; // get file extension
					
					$new_image_name = substr(str_shuffle($alphanum), 0, 10) . "." . $ext; // new image name
					
					$small_path = $m_small . $new_image_name; 
				   
				   ResizerImage::imageresizer($_FILES['homethumb']['tmp_name'], $myhomethumb_width, $myhomethumb_height, $_FILES['homethumb']['type'], $small_path);
				   // Create large image
				   				   
					//GET AND DELETE THE FORMER IMAGETHUMB DEFAULT
					$pid = $_GET['PID'];
					$thumbQuery = new SelectQuery();
					$def_thumb = $thumbQuery -> returnValue("property_thumb","prop_property","property_id",$pid,$conn);
					
					if($def_thumb != "default.png")
					{
				    unlink("modules/property_manager/images/property/homethumbs/".$def_thumb);
					}
					// UPDATE MAIN IMAGE LINK
					// BUILD QUERY
					$data = array();
					$data["property_thumb"] = $new_image_name;
					
					
					// CREATE NEW QUERY OBJECT
					$updatequery2 = new UpdateQuery();
					
					$result3 = $updatequery2 -> updateTable("prop_property")
							   -> dataToUpdate($data)
							   -> where("property_id='{$pid}'")
							   -> buildQuery()
							   -> updateContent($conn);
				   
					if($result3){				   
				    header("Location: .?BQ=Control Panel&INC=Property&CMD=View_Exist_Prop&STA=imgconfirm");
					}else{$errstring = "One or more images not uploaded due to invalid extension";}
	}
}


}// end isset uploads


if(isset($_GET['STA']))
{
$sta = $_GET['sta'];
	
	switch($sta)
	{
		case "pconfirm":
		$status = "Property Successfully Added, You can upload images of property below";
		break;
		
		case "confirm":
		$returnstring = " Image Successfully Uploaded";
		break;
		
		
		case "delete":
		$returnstring = " Category Successfully Deleted";
		break;
	}
}
?>

<h2>ADD IMAGES TO PROPERTY</h2>

<p><a href="javascript:;" id='cspecify'>View Image Specifications</a>
<script type="text/javascript">
$(function(){
	$("#cspecify").click(function(){
	 $('#specify').slideToggle('slow', function() {});
    // Animation complete.
  });
});
</script>
<div id='specify' style="display:none">
Default Main: 655 X 280px<br />
  Default Thumbnail: 135 X 107px<br />
  Acceptable Image Format/Extensions [JPEG/GIF/PNG]
</div>
  <br />
  
<?php if(isset($_GET['STA']) && $_GET['STA'] == "pconfirm")
{
	echo "<b style='font-weight: bold; color: red; text-decoration: underline'>PROPERTY SUCCESSFULLY ADDED &gt;&gt;</b><br />";

echo "<a href='.?BQ=Control Panel&INC=Property&CMD=View_Exist_Prop&STA=imgconfirm' style='font-weight: bold; color: red; text-decoration: underline'>CLICK HERE TO SKIP THIS STEP &gt;&gt;</a>";
}
?>
  <br /><br />
  <script type="text/javascript" src="modules/property_manager/scripts/imguploader.js"></script>
</p>



<form name="" method="post" action="" enctype="multipart/form-data">

 <fieldset style="border: 2px solid #0CF">
 <legend><b><img src="modules/property_manager/images/addimage.png" style="float: left; margin-right: 5px:" /> UPLOAD SLIDER IMAGE</b></legend>
   <table width="592" border="0" style="margin-left: 20px;">

<tr>
<td>Upload:</td>
<td width="427">
<input type="file" name="mainpix" id="mainpix" size="40" style="color: #000" />
</td>
</tr>

<tr>
<td>Size:</td>
<td>
<span id="box1-d">
<input type="radio" name="box-r" id="box-r" value="no" checked="checked"/> Use Default
<input type="radio" name="box-r" id="box-r" value="yes" /> Specify Size
</span>

<div id="main-size" style="display:none;">
<label for="box1-w">Width:</label>
<input type="text" size="5" id="main-w" name="main-w" /> X 
<input type="text" size="5" id="main-h" name="main-h" /> 
<label for="box1-h">:Height</label>
</div>
</td>
</tr>
</table>
</fieldset>
<br /><br />
<fieldset style="border: 2px solid #0CF">
<legend><b><img src="modules/property_manager/images/thumb.png" style="float: left; margin-right: 5px:" />ADD OTHER PROPERTY IMAGES</b>
</legend><br />
<table>
<tr>
<td><a href="javascript:;" id="addthumb">Add Other Images</a></td>
<td id="thumbarea">
</td>
</tr>

<tr>
<td>Thumbnail size:</td>
<td>
<span id="thumb-d">
<input type="radio" name="thumb-r" id="thumb-r" value="no" checked="checked"/> Use Default
<input type="radio" name="thumb-r" id="thumb-r" value="yes" /> Specify Size
</span>

<div id="thumb-size" style="display:none;">
<label for="thumb-w">Width:</label>
<input type="text" size="5" id="thumb-w" name="thumb-w" /> X 
<input type="text" size="5" id="thumb-h" name="thumb-h" /> 
<label for="thumb-h">:Height</label>
</div>

</td>
</tr>

<tr>
<td></td>
<td>&nbsp;</td>
</tr>
</table>
</fieldset>

<br /><br />

<fieldset style="border: 2px solid #0CF">
 <legend><b><img src="modules/property_manager/images/addimage.png" style="float: left; margin-right: 5px:" /> UPLOAD HOMEPAGE THUMBNAIL</b></legend>
   <table width="592" border="0" style="margin-left: 20px;">

<tr>
<td>Upload Thumb:</td>
<td width="427">
<input type="file" name="homethumb" id="homethumb" size="40" style="color: #000" />
</td>
</tr>

<tr>
<td>Size:</td>
<td>
<span id="home_thumb">
<input type="radio" name="hthumb-r" id="hthumb-r" value="no" checked="checked"/> Use Default
<input type="radio" name="hthumb-r" id="hthumb-r" value="yes" /> Specify Size
</span>

<div id="homethumb-size" style="display:none;">
<label for="box1-w">Width:</label>
<input type="text" size="5" id="hthumb-w" name="hthumb-w" /> X 
<input type="text" size="5" id="hthumb-h" name="hthumb-h" /> 
<label for="box1-h">:Height</label>
</div>
</td>
<tr><td></td>
<td><input type="submit" name="upload" value="Upload Photos" /></td>
</tr>
</tr>
</table>
</fieldset>
</form>
</div>