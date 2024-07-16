<?
session_start();
if($_POST['submit'])
{ 
	$_SESSION['page'] = strtolower(str_replace(' ','_',$_POST['page_name']));
	$getMsg = content_man_class::create_webpage();
	
}
?>

<link href="modules/content_manager/css/style.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="modules/content_manager/jscript/form_validator.js"></script>
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
        <td height="50" align="left" valign="bottom"><img src="modules/content_manager/images/page_add.png" width="32" height="32" /> <strong style="font-size:16px">Create web page</strong></td>
        <td height="50" align="left" valign="bottom"><span class="errMsg">
          <?= $_GET['msg'];?>
        </span></td>
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
    <td colspan="2" align="left" valign="middle"></td>
    </tr>
  <tr>
    <td width="17%" align="left" valign="middle"><strong>Web page name</strong></td>
    <td width="83%" align="left" valign="middle"><input name="page_name" type="text" class="txtbox" id="page_name" size="50" />      &nbsp;&nbsp;&nbsp;
      <input type="checkbox" name="validate" id="validate"  onclick="validate_name()" />      
      <span style="font-size:10px; color:#999">(Validate your web page name. Make sure you don't use digits or special charaters) </span></td>
  </tr>
  <tr>
    <td align="left" valign="middle"><strong>Title</strong></td>
    <td align="left" valign="middle"><input name="page_title" type="text" class="txtbox" id="page_title" size="50" /></td>
  </tr>
  <tr>
    <td align="left" valign="middle"><strong>Description</strong></td>
    <td align="left" valign="middle"><input name="desc" type="text" class="txtbox" id="desc" size="50" /></td>
  </tr>
  <tr>
    <td align="left" valign="middle"><strong>Category</strong></td>
    <td align="left" valign="middle"><label>
        <select name="cat" id="cat" onchange="showparent(this.options[this.selectedIndex].value)">
          <option value="Parent">Parent</option>
          <option value="Child">Child</option>
          <option value="Non">Non</option>
        </select>
    </label></td>
  </tr>
  <tr>
    <td align="left" valign="middle"><strong><div id="tit" style="display:none">Parent Name</div></strong></td>
    <td align="left" valign="middle">
    <select name="parent_name" id="parent_name" style="display:none">
    <?
	$get = content_man_class::get_all_parent_webpage_creation();
	$count = count($get);
	for($i=0; $i <= $count-1; $i++)
	{
		echo '<option value=" '. $get[$i]['pname'].' ">' . $get[$i]['pname']. '</option>';
		
	}
	?>
 
    </select> 
    
    </td>
  </tr>
  
  <tr>
    <td align="left" valign="middle"><strong>Publish</strong></td>
    <td align="left" valign="middle"><label>
      <input name="publish" type="radio" id="radio" value="Yes" checked="checked" />
Yes
<input type="radio" name="publish" id="radio2" value="No" />
    No</label></td>
  </tr>
  <tr>
  <td><b>Page Order</b></td>
  <td><select name="page_order">
  <?php 
  for($i=1; $i<101; $i++)
  {
	echo "<option value='$i'>$i</option>";  
  }
  ?>
  </select></td>
  </tr>
  <tr>
    <td align="left" valign="middle">&nbsp;</td>
    <td align="left" valign="middle"><input type="submit" name="submit" id="submit" value="Create Web Page" class="submitbtn" />
      <input type="reset" name="reset" id="reset" value="Reset" class="submitbtn" /></td>
  </tr>
</table>
</form>
<script language="javascript">
	document.getElementById("page_title").disabled = true;
	document.getElementById("desc").disabled = true;
	document.getElementById("cat").disabled = true;
	document.getElementById("submit").disabled = true;
	document.getElementById("page_name").disabled = false;
</script>