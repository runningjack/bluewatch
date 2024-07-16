<?php
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

$errmsg = "";
$sucess = "";

if(isset($_POST['submit']))
{
// GET PAGE ID
$page_id = (int) $_GET['pid'];

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
		$img_array = scan_img_tag($content);
		$author = $_SESSION['validuser'];
		$page_id = $_GET['id'];
		$publish = $_POST['publish'];
		$datemod = time();
		
		// CREATE OBJECT OF CLASS CONNECTION
		$configData = new ConfigData;
		$conn = $configData -> connectDB();

		// CREATE AN INSERT DATA QUERY OBJECT
		$insertQuery = new InsertQuery();
		$img_insertQuery = new InsertQuery();
		
		$mydata = array(
						"page_id" => $page_id,
						"main_title" => $stitle,
						"main_content" => $content,
						"last_modified" => $datemod,
						"author" => $author,
						"publish" => $publish
						);
		
		$qresult = $insertQuery ->insertTable('pages_content')
					  			->insertData($mydata)
					  			->buildInsertQuery()
					  			->queryDB($conn);
								
		$nw_section_id  = $insertQuery -> getLastID();
		
		// ADD IMAGES IN THE CONTENT TO IMAGES TABLES
		foreach($img_array as $k => $v)
		{
			$imgdata = array("section_id" => $nw_section_id, "section_imglink" => $v, "page_id" => $page_id);
			$img_result = $img_insertQuery ->insertTable('section_img')
										->insertData($imgdata)
										->buildInsertQuery()
										->queryDB($conn);
										
			if($img_result){$imgdata = NULL;}
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
		
		// CERTAIN NOW THAT ALL UNWANTED UPLOADED EDITOR IMAGES HAS BEEN REMOVED

		
		
	if($qresult)
	{
		$success = "Section Successfully Created, Content Added";
	}else{
		$errmsg = "Error Inserting Data, Please try Again";
		}
	}

}
?>

<link href="modules/content_manager/css/style.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="modules/content_manager/jscript/form_validator.js"></script>
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

<form id="form" name="form" method="post" action="" onsubmit="return check_section()">
    <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center" valign="middle" background="modules/content_manager/images/hd.png">
            <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
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
                    <br />
                    <a href=".?<?= PROJECTNAME; ?>=Control Panel&INC=Content Manager&CMD=View Web Page&id=<?= $_GET['id']; ?>&cat=0&d=0"> &gt;&gt; Back to Page </a>
                    </td>
                </tr>
                <tr>
                    <td width="51%" align="left" valign="middle">&nbsp;</td>
                    <td align="left" valign="middle"></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<br />
<table width="98%" border="0" align="center" cellpadding="10" cellspacing="0" style="border:1px solid #EEE">
    <tr>
        <td colspan="2" align="left" valign="middle"></td>
    </tr>
    <tr>
    	<td><b>Section Title</b></td>
        <td><input type="text" name="stitle" id="stitle" />
    </tr>
    <tr>
        <td width="17%" align="left" valign="middle"><strong>Content</strong></td>
        <td width="83%" align="left" valign="middle">
        <!--	<textarea name="content" id="content"></textarea> 
        <textarea class="ckeditor" cols="80" id="content" name="content" rows="10">
        Your content goes here
        </textarea>
        -->
        <?php
        //// Include the CKEditor class.
        include_once "modules/content_manager/ckeditor/ckeditor.php";
        //// The initial value to be displayed in the editor.
        $initialValue = 'Your section content goes here...';
        //// Create a class instance.
        $CKEditor = new CKEditor();
        //// Path to the CKEditor directory, ideally use an absolute path instead of a relative dir.
        ////   $CKEditor->basePath = '/ckeditor/'
        //// If not set, CKEditor will try to detect the correct path.
        $CKEditor->basePath = 'modules/content_manager/ckeditor/';
        //// Create a textarea element and attach CKEditor to it.
        $CKEditor->editor("content", $initialValue);
        /* $CKEditor = new CKEditor();
          // $CKEditor->basePath = '/ckeditor/';
          // $CKEditor->config['width'] = 975;
           //$CKEditor->config['height'] = 400; */

           //$CKEditor->editor("editor1", "heloo", $config);
        ?>
        </td>
    </tr>
    <tr>
        <td align="left" valign="middle"><strong>Publish</strong></td>
        <td align="left" valign="middle">
            <label>
                <input name="publish" type="radio" id="radio" value="yes" checked="checked" />Yes
                <input name="publish" type="radio" id="radio2" value="no" />No
            </label>
        </td>
    </tr>
    <tr>
        <td align="left" valign="middle">&nbsp;</td>
        <td align="left" valign="middle">
            <input type="submit" name="submit" id="submit" value="Create Web Page" class="submitbtn" />
            <input type="reset" name="reset" id="reset" value="Reset" class="submitbtn" />
        </td>
    </tr>
</table>
</form>