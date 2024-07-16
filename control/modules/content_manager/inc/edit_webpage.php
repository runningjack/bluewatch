<?
session_start();
$getdetails = content_man_class::get_web_page_details($_GET['id']);
$_SESSION['page'] = strtolower(str_replace(' ','_',$getdetails['name']));
if($_POST['submit']){ 
$_SESSION['page'] = strtolower(str_replace(' ','_',$_POST['page_name']));
content_man_class::update_webpage();
}
?>

<link href="modules/content_manager/css/style.css" rel="stylesheet" type="text/css"/>
<script src="modules/content_manager/jscript/form_validator.js"></script>
<script type="text/javascript" src="modules/content_manager/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="modules/content_manager/ckeditor/_sample/sample.js"></script>
<!--
<script type="text/javascript" src="modules/content_manager/jscript/openwysiwyg/scripts/wysiwyg.js"></script>
<script type="text/javascript" src="modules/content_manager/jscript/openwysiwyg/scripts/wysiwyg-settings.js"></script>
<script type="text/javascript"> WYSIWYG.attach('content', miney); </script>
-->

<form id="form" name="form" method="post" action="" onsubmit="return form_chk()">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="middle" background="modules/content_manager/images/hd.png"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="50" align="left" valign="bottom"><img src="modules/content_manager/images/edit.png" width="32" height="32" /> <strong style="font-size:16px">Edit web page</strong></td>
        <td width="49%" height="50" align="left" valign="bottom"><span  id="errMsg" class="errMsg"><?= $_GET['msg'];?></span></td>
        </tr>
      <tr>
        <td width="51%" align="left" valign="middle">&nbsp;</td>
        <td align="left" valign="middle"></td>
        </tr>
    </table>
      <br /></td>
  </tr>
</table>
<br />
<table width="98%" border="0" align="center" cellpadding="10" cellspacing="0" style="border:1px solid #EEE">
  <tr>
    <td align="left" valign="middle">&nbsp;</td>
  </tr>
  <tr>
    <td width="20%" align="left" valign="middle"><strong>Web page name</strong></td>
    <td width="80%" align="left" valign="middle"><input name="page_name" type="text" class="txtbox" id="page_name" size="50" value="<?= $getdetails['name']; ?>" /> <input type="hidden" name="pid" id="pid"  value="<?= $getdetails['rf_id']; ?>"/> 
      <input type="checkbox" name="validate" id="validate"  onclick="validate_name()" />
      <span style="font-size:10px; color:#999">(Validate your web page name if there is a change. Make sure you don't use digits or special charaters) </span></td>
  </tr>
  <tr>
    <td align="left" valign="middle"><strong>Title</strong></td>
    <td align="left" valign="middle"><input name="page_title" type="text" class="txtbox" id="page_title" size="50" value="<?= $getdetails['title']; ?>" /></td>
  </tr>
  <tr>
    <td align="left" valign="middle"><strong>Description</strong></td>
    <td align="left" valign="middle"><input name="desc" type="text" class="txtbox" id="desc" size="50" value="<?= $getdetails['desc']; ?>" /></td>
  </tr>
  <tr>
    <td align="left" valign="middle"><strong>Category</strong></td>
    <td align="left" valign="middle"><label>
      <input name="cat" type="text" class="txtbox" id="cat" value="<?= trim($getdetails['category']); ?>" readonly="readonly"/>
    </label>
    </td>
  </tr>
  <tr>
   <?  if($getdetails['category'] == "Child"){  ?><td align="left" valign="middle"><strong><div id="tit" style="display:block">Parent Name</div></strong></td><? }?>
    <td align="left" valign="middle">
    <?
	 if($getdetails['category'] == "Child"){
   		 ?><select name="parent_name" id="parent_name" style="display:block"><?
    
		$get = content_man_class::get_all_parent_webpage();
		$count = count($get);
		for($i=0; $i <= $count-1; $i++)
		{
			echo '<option value=" '. $get[$i]['pname'].' ">' . $get[$i]['pname']. '</option>';
		}
		content_man_class::select_current_parent($getdetails['idx']);
		
		?></select><?
	 }
	 
	?>
    
    </td>
  </tr>
  <tr>
    <td align="left" valign="middle"><strong>Publish</strong></td>
    <td align="left" valign="middle"><label>
      <input name="publish" type="radio" id="radio" value="Yes" <? if($getdetails['pub'] == "Yes"){echo "checked";}?>/>
Yes
<input type="radio" name="publish" id="radio2" value="No" <? if($getdetails['pub'] == "No"){echo "checked";}?> />
    No</label></td>
  </tr>
  
   <tr>
  <td><b>Page Order</b></td>
  <td><select name="page_order">
  <?php 
  for($i=1; $i<101; $i++)
  {
	echo "<option value='$i' ";
		if($getdetails['pod'] == $i)
		{
			echo "selected='selected'";
		}
	echo ">$i</option>";  
  }
  ?>
  </select></td>
  </tr>
  
  <tr>
    <td align="left" valign="middle"></td>
	</td>
    <td align="left" valign="middle"><input type="submit" name="submit" id="submit" value="Update Web Page" class="submitbtn" />
      <input type="reset" name="reset" id="reset" value="Reset" class="submitbtn" /></td>
  </tr>
</table>
</form>
