<?php
error_reporting(E_ERROR | E_PARSE);

include("modules/content_manager/classes/myclass.AutoLoader.php");

function scan_img_tag($content) // scan for image tag comming from editor
{
	$arrpath = array();
	if(!empty($content))
	{
		$doc = new DOMDocument(); 
		$doc->loadHTML($content); 
		$xml = simplexml_import_dom($doc); 
		$images = $xml->xpath('//img'); 
		foreach ($images as $img) 
		{ 
		   $rep_path = str_replace('\"', '', $img['src']);
		   $arrpath[] = $rep_path;
		}
	}
	return $arrpath;
}

// CREATE OBJECT OF CLASS CONNECTION
		$configData = new ConfigData;
		$conn = $configData -> connectDB();
		
$errmsg = "";
$sucess = "";

if(isset($_REQUEST['id']) && isset($_REQUEST['cid']))
{
	$pid = $_GET['id'];
	$cid = $_GET['cid'];
	
	$go_query = true;
	
}else{
	header("Location: ?".PROJECTNAME."=Control Panel&INC=Content Manager");
	}



if(isset($_POST['submit']))
{
// GET PAGE ID
$page_id = (int) $_GET['id'];

	if(empty($_POST['stitle']))
	{
		$errmsg = "Please Fill in the Section Title";
	}else if(!isset($_GET['id']))
	{
		// PAGE ID NOT SET
		header("Location: .?".PROJECTNAME."=Control Panel&INC=Content Manager");
	}else
	{	
		// FORM DATA POSTED
		$stitle = $_POST['stitle'];
		$content = $_POST['content'];
		$author = $_SESSION['validuser'];
		$page_id = $_GET['id'];
		$datemod = time();

		// CREATE AN UPDATE QUERY OBJECT
		$updateQuery = new UpdateQuery();
		
				
		// BUILD QUERY
		$data = array();
		$data["main_title"] = $stitle;
		$data["main_content"] = $content;
		$data["last_modified"] = $datemod;
		$data["author"] = $author;
		
		file_put_contents("testcontent", $content);
		
		// UDATE CONTENT IN THE DATABASE
		$updatequery = new UpdateQuery();
		
		$uresult = $updatequery -> updateTable("pages_content")
							   -> dataToUpdate($data)
							   -> where("content_id='{$cid}'")
							   -> buildQuery()
							   -> updateContent($conn);
							   
		// GET ALL IMAGES PRESENT IN CONTENT HERE
		$imgarr = scan_img_tag($content);
		
		// GET ALL IMAGES ALREADY IN DB
		$imgselObj = new SelectQuery();
		$img_result =   $imgselObj -> from("section_img")
								   ->select("section_imglink")
								   ->where("section_id='$cid'")
								   ->buildQuery()
								   ->getResult($conn);
								   
		// GET THE IMAGES INSIDE AN ARRAY
		$imgcounter = 0;
		$img_db_arr = array();
		
		while ($imgrow = $img_result->fetch_assoc())
		{		
			$img_db_arr[$imgcounter] = $imgrow['section_imglink'];
			$imgcounter++;
		}
		
		// COMPUTE DIFFERENCE, IMAGES NEW IN CONTENT AND NOT IN THE DATABASE, THEN ADD...
		$new_imgadded_not_db = array_diff($imgarr, $img_db_arr);
		$img_insertQuery = new InsertQuery();
		
		foreach($new_imgadded_not_db as $key => $value)
		{
			$newimgdata = array("section_id" => $cid, "section_imglink" => $value, "page_id" => $page_id);
			$newimg_result = $img_insertQuery ->insertTable('section_img')
											   ->insertData($newimgdata)
											   ->buildInsertQuery()
											   ->queryDB($conn);
											   
			if($newimg_result){$imgdata = NULL;}
		}
		
		// COMPUTE DIFFERENCE, IMAGES NO MORE IN CONTENT BUT STILL IN THE DATABASE
		$img_remove_from_content = array_diff($img_db_arr, $imgarr);
		
		foreach($img_remove_from_content as $k => $v)
		{
			$imgdelQuery = new DeleteQuery();
			$imgdelresult = $imgdelQuery -> from("section_img")
									  -> where("section_imglink='$v'")
									  -> buildQuery()
									  -> execute($conn);
									  
			unlink($v); // DELETE THE IMAGE IN ADMIN PAGERESOURCES FOLDER
			unlink("../".$v); // DELETE THE IMAGE IN ADMIN PAGERESOURCES FOLDER
				
		}
		
		
		// CHECK FOR IMAGES ADDED TO THE CONTENT AREA BUT REMOVED BEFORE SUBMITING AND DELETE THEM FROM EDITOR IMAGE TABLE & FOLDERS
		// GET ALL IMAGES ALREADY IN EDITOR IMG TABLE
		$imgeditor_selObj = new SelectQuery();
		$imgeditor_result =   $imgeditor_selObj -> from("editor_img")
								   				->select("path")
								   				->buildQuery()
								   				->getResult($conn);
												
		$rows_affected = $imgeditor_selObj -> getAffectedRows();
		
		if($rows_affected > 0)
		{
			while($imgeditor_row = $imgeditor_result->fetch_assoc())
			{
				$editor_path = $imgeditor_row['path'];
				
				// CHECK IF PATH EXIST IN SECTION IMAGES
				$chk_exist = $imgeditor_selObj -> returnValue("section_imglink","section_img","section_imglink",$editor_path,$conn);
				
				// MEANING IMAGE HAS BEEN REMOVED FROM EDITOR WHEN SUBMITTING
				if($chk_exist == NULL)
				{
					unlink($editor_path);
					unlink("../".$editor_path);
				}
				
				// DO CLEAN UP TO TABLE EDITOR IMAGES
				$editor_imgdelQuery = new DeleteQuery();
				$editor_imgdelresult = $editor_imgdelQuery -> from("editor_img")
									  -> where("path='$editor_path'")
									  -> buildQuery()
									  -> execute($conn);
			}
		}
		
		// CERTAIN NOW THAT ALL UNWANTED UPLOADED EDITOR IMAGES HAVE BEEN REMOVED

		
		
		if($uresult)
		{
			$success = "Section Successfully Updated...";
		}else{
			$errmsg = "Error Updating Data, Please try Again...";
			}
	}

}

// IF VARIABLE TO QUERY ARE SET....GO AHEAD
if($go_query)
{
	// GET SECTION CONTENTS FOR DISPLAY
	$selObj = new SelectQuery();
	$con_result =    $selObj -> from("pages_content")
					   ->select("main_content","main_title","publish")
					   ->where("content_id='$cid'")
					   ->buildQuery()
					   ->getResult($conn);
						   
	// GET CONTENT & SECTION TITLE
	while ($row = $con_result->fetch_assoc())
	{
		$db_title = $row['main_title'];
		$db_content = $row['main_content'];
		$db_publish = $row['publish'];
	}
	
	scan_img_tag($content);

}
?>

<link href="modules/content_manager/css/style.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="modules/content_manager/jscript/form_validator.js"></script>
<script type="text/javascript" src="modules/content_manager/classes/jquery-1.7.1.min.js"></script>
<!--
<script type="text/javascript" src="modules/content_manager/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="modules/content_manager/ckeditor/_sample/sample.js"></script>
<script type="text/javascript" src="modules/content_manager/jscript/openwysiwyg/scripts/wysiwyg.js"></script>
<script type="text/javascript" src="modules/content_manager/jscript/openwysiwyg/scripts/wysiwyg-settings.js"></script>
<script type="text/javascript"> WYSIWYG.attach('content', miney); </script>
-->

<script type="text/javascript">

function check_section()
{
	
	var stitle =  document.getElementById("stitle").value;
	
	if(stitle==""||stitle==null)
	{
	alert("Please fill in the section title");
	return false
	}else{
	return true;
		}
}
</script>

<form id="form" name="form" method="post" action=".?<?php echo urldecode($_SERVER['QUERY_STRING']); ?>" onsubmit="return check_section()">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="middle" background="modules/content_manager/images/hd.png"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="50" align="left" valign="bottom"><img src="modules/content_manager/images/page_add.png" width="32" height="32" /> <strong style="font-size:16px">Add a Section</strong></td>
        <td height="50" align="left" valign="bottom">
          <?php
		  if($errmsg != "")
		  {
		  	echo "<img src='modules/content_manager/images/warning.gif' /> 
		  	<span class='errMsg'>$errmsg</span>";
		  }
		  
		  if($success != "")
		  {
			  echo "<img src='modules/content_manager/images/yes.gif' /> 
		  	<span style='color: green; font-weight: bold;'>$success</span>";
		  }
		  ?>
         </td>
        </tr>
      <tr>
        <td width="51%" align="left" valign="middle">&nbsp;</td>
        <td align="left" valign="middle"><a href=".?<?php echo PROJECTNAME."=Control Panel&INC=Content Manager&CMD=View Web Page&id=$pid&cat=0&d=0";?>">&gt;&gt; Back to Page</a></td>
        </tr>
    </table>
      <br /></td>
  </tr>
</table>
<br />
<table width="98%" border="0" align="center" cellpadding="10" cellspacing="0" style="border:1px solid #EEE">
  <tr>
    <td colspan="2" align="left" valign="middle"></td>
    </tr>
    <tr>
    	<td><b>Section Title</b></td>
        <td><input type="text" name="stitle" id="stitle" value="<?php echo $db_title; ?>" />
    </tr>
  <tr>
    <td width="17%" align="left" valign="middle"><strong>Content</strong></td>
    <td width="83%" align="left" valign="middle">
      <!--	<textarea name="content" id="content"></textarea> -->
 
<?php
// Include the CKEditor class.
include_once "modules/content_manager/ckeditor/ckeditor.php";
// Create a class instance.
$CKEditor = new CKEditor();
$CKEditor->basePath = 'modules/content_manager/ckeditor/';
$CKEditor->textareaAttributes = array("id" => "content");
$CKEditor->editor("content", $db_content);
?>

      </td>
  </tr>
  <tr>
    <td align="left" valign="middle"><strong>Publish</strong></td>
    <td align="left" valign="middle"><label>
	<input name="publish" type="radio" id="radio" value="yes" <?php if($db_publish=="yes"){echo "checked='checked'";} ?>/>Yes
	<input type="radio" name="publish" id="radio2" value="no" <?php if($db_publish=="no"){echo "checked='checked'";} ?>/>No</label></td>
  </tr>
  <tr>
    <td align="left" valign="middle">&nbsp;</td>
    <td align="left" valign="middle"><input type="submit" name="submit" id="submit" value="Update Section" class="submitbtn" />
      <input type="reset" name="reset" id="reset" value="Reset" class="submitbtn" /></td>
  </tr>
</table>
</form>
