<?php
$success = "";
$errmsg = "";

if(isset($_GET['d']) && $_GET['d'] == 0)
{
require('conf/settings.php');
/*** EDITED BY IGINLA OMOTAYO ***/
include("modules/content_manager/classes/myclass.AutoLoader.php");
}else{
require('../../conf/settings.php');
/*** EDITED BY IGINLA OMOTAYO ***/
include("classes/myclass.ConfigData.php");
include("classes/myclass.SelectQuery.php");
}
$project_name = PROJECTNAME;
$get = content_man_class::get_web_page_details($_GET['id']);


// CREATE OBJECT OF CLASS CONNECTION
$id = (int) $_GET['id'];
$configData = new ConfigData;
$conn = $configData -> connectDB();

if(isset($_GET['del']) && ($_GET['del']=="1"))
{
	$del_id = (int) $_GET['cid'];
	
	// DELETE SECTION CONTENT
	$delQuery = new DeleteQuery();
	$totrowsdel = $delQuery ->from("pages_content")
							  ->where("content_id='$del_id'")
							  ->buildQuery()
							  ->execute($conn);
							  
	// GET IMAGES ATTACHED TO SECTION IN DB
		$imgselObj = new SelectQuery();
		$img_result =   $imgselObj -> from("section_img")
								   ->select("section_imglink")
								   ->where("section_id='$del_id'")
								   ->buildQuery()
								   ->getResult($conn);
								   
		// DELETE IMAGES FROM FOLDERS PAGEESOURCES IN ADMIN & ROOT						   
		while ($imgrow = $img_result->fetch_assoc())
		{
			unlink($imgrow['section_imglink']);
			unlink("../".$imgrow['section_imglink']);
		}
		
		// RUN QUERY TO DELETE THEM ALL FROM THE SECTION IMAGES TABLE
		$imgdelQuery = new DeleteQuery();
		$imgrowsdel = $imgdelQuery ->from("section_img")
							  ->where("section_id='$del_id'")
							  ->buildQuery()
							  ->execute($conn);
		
		
	if($totrowsdel > 0)
	{
		$success = "Section Successfully Deleted<br />";
	}else{
		$errmsg = "Error Deleting Section. Not Found<br />";
		}
}



// GET SECTION CONTENTS FOR DISPLAY
$selObj = new SelectQuery();
$con_result =    $selObj -> from("pages_content")
						   ->select("*")
						   ->where("page_id='$id'")
						   ->orderBy("order_column","ASC")
						   ->buildQuery()
						   ->getResult($conn);
						   
	
?>
<style type="text/css">
.title-bar{width:98%; background:url(modules/content_manager/images/hd.png); height:68px; margin-left:10px; padding-top:13px}

.properties{ position:relative; width:250px; padding:10px; margin-right:5px; text-align:right; top:10px;}

</style>
<link href="modules/content_manager/css/style.css" rel="stylesheet" type="text/css"/>

<div class="title-bar"><img src="modules/content_manager/images/page.png" width="32" height="32" /> <strong style="font-size:16px">Web Page Details</strong></div>
<div class="wrapper" style="height: inherit;">
<br />
<div class="cont">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="90%">
    <div><img src="modules/content_manager/images/tabs.png" alt="Edit Content" width="16" height="16" border="0" />
    <a href="javascript:;" onclick="javascript: if(document.getElementById('properties').style.display == 'block'){ document.getElementById('properties').style.display = 'none';} else { document.getElementById('properties').style.display = 'block'; }">View Properties</a> 
    
    <img src="modules/content_manager/images/edit.png" alt="Edit Content" width="16" height="16" border="0" />
    <a href="?<?= $project_name; ?>=Control Panel&INC=Content Manager&CMD=Edit Web Page&id=<?= $get['rf_id'];?>">Edit Page</a> 
    
    <img src="modules/content_manager/images/page.png" alt="Edit Content" width="16" height="16" border="0" />
    <a href="?<?= $project_name; ?>=Control Panel&INC=Content Manager&CMD=Add_Content&id=<?= $get['rf_id'];?>">Add a Section</a>
    
    <img src="modules/content_manager/images/page.png" alt="Edit Content" width="16" height="16" border="0" />
    <a href="?<?= $project_name; ?>=Control Panel&INC=Content Manager&CMD=Directory">Back to Directory Tree</a>

    </div>
    </td>
    <td align="right">
   <?php
   	if(isset($_REQUEST['cat']) && $_GET['cat'] != "0")
	{
		?>
<a href="?<?= $project_name; ?>=Control Panel&INC=Content Manager&CMD=Edit Web Page&id=<?= $_GET['id'];?>">
             <img src="modules/content_manager/images/b_edit.png" alt="Edit Content" width="16" height="16" border="0" /></a>
             &nbsp; &nbsp; &nbsp;
             <a href="?<?= $project_name; ?>=Control Panel&INC=Content Manager&CMD=Delete Web Page&id=<?= $_GET['id']; ?>"
             onclick="return confirm('Are You Sure You Want To Delete This Page(Y/N)?');">
             <img src="modules/content_manager/images/b_drop.png" alt="Delete Record" width="16" height="16" border="0" /></a>
             &nbsp; &nbsp; &nbsp;
        <?
	}
   ?>
    </td>
  </tr>
</table>

<div id="properties" style="display:none">
<br />Page Id: <?= $get['rf_id'];?>
<br />Category: <?= $get['category'];?>
<br />Name: <?= $get['name'];?>
<br />Title: <?= $get['title'];?>
<br />Description: <?= $get['desc'];?>
<br />Published: <?= $get['pub'];?>
<br />Date Created: <?= $get['dtc'];?>
<br />Date Last Modified: <?= $get['dtm'];?>
<br />Author: <?= $get['aut'];?>

</div>
<p>
<?php
		  if($errmsg != "")
		  {
		  	echo "<img src='modules/content_manager/images/warning.gif' /> 
		  	<span class='errMsg' style='font-weight: bold'>$errmsg</span>";
		  }
		  
		  if($success != "")
		  {
			  echo "<img src='modules/content_manager/images/yes.gif' /> 
		  	<span style='color: green; font-weight: bold;'>$success</span>";
		  }
?>
<br />
<strong style="font-size:15px; color:#333">Page Name: &nbsp;</strong><?= $get['name'];?></p>
<ul class="cnt_head" id="sortable">
<?php
// GET CONTENT & SECTION TITLE
while ($row = $con_result->fetch_assoc())
{
	echo "<li id=page_{$row['content_id']}>
	<h3>".$row['main_title']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href='.?".PROJECTNAME."=Control Panel&INC=Content Manager&CMD=Edit_Section&id=$get[rf_id]&cid=$row[content_id]'>
	<img src='modules/content_manager/images/b_edit.png' style='border: 0' /> Edit</a> 
	<a href='.?".PROJECTNAME."=Control Panel&INC=Content Manager&CMD=View Web Page&id=$id&cat=0&cid=$row[content_id]&d=0&del=1' onclick='return checkbox()'><img src='modules/content_manager/images/b_drop.png' style='border: 0' /> Delete</a>
	<span>Last modified by, $row[author] on ".date("F d, Y g:i a",$row['last_modified'])."</span>
	</h3>";
	echo "<div>" . $row['main_content'] . "</div></li>";
}

?>
</ul>

<style type="text/css">
.cnt_head{list-style-type: none; margin:0; padding:0;}
.cnt_head h3{ background-color: #666; padding: 3px 15px 2px 5px; color: #fff; margin-top: 0px; font-size: 14px;}
.cnt_head h3 img{}
.mhd{padding-right: 20px;}
.cnt_head li{margin: 0px 0px 0px 0px; background: #CCC; height: inherit;}
.cnt_head h3 span{padding: 3px 0px 0px 100px; font-size: 9px; font-style: italic; color: #fff;}
.cnt_head li div{height: inherit; display: block; position: relative;  width: 100%; background: #CCC; margin-bottom: 0px;}

#sortable { list-style-type: none; margin: 0; padding: 0; width: 100%; }
#sortable li { margin: 0 3px 13px 3px; padding: 1px; padding-left:0em; font-size: 1.4em; height: inherit; }
#sortable li span { position: absolute; margin-left: -1.3em; }
</style>

<link rel="stylesheet" href="modules/content_manager/jscript/themes/base/jquery.ui.all.css">
<script src="modules/content_manager/jscript/jquery-1.7.1.js"></script>
<script src="modules/content_manager/jscript/jquery.ui.core.js"></script>
<script src="modules/content_manager/jscript/jquery.ui.widget.js"></script>
<script src="modules/content_manager/jscript/jquery.ui.mouse.js"></script>
<script src="modules/content_manager/jscript/jquery.ui.sortable.js"></script>
<script type="text/javascript">
function checkbox()
{
var rtnval = confirm("Deleting this section, will delete all contents and images attached to this section. \n\n Are you sure you want to delete section?");
return rtnval;
}


$(function() {
	
$("#sortable").sortable({
    update: function(event, ui) {
        $.post("modules/content_manager/inc/sortajax.php", { pages: $('#sortable').sortable('serialize') } );
    }
});

//$( "#sortable" ).disableSelection();

});


</script>
</div>
</div>
<p>&nbsp;</p>

