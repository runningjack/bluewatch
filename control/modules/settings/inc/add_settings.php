<? 
$set = setting_class::get_settings();
if(isset($_POST['button'])){ $getMsg = settings_class::apply_settings();}
?>

<link href="modules/settings/css/style.css" rel="stylesheet" type="text/css"/>
<div class="title-bar">&nbsp;&nbsp;<img src="modules/settings/images/settings.png" width="32" height="32" /> <strong style="font-size:16px">System Settings</strong>&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#F60"><? echo isset($_GET['msg']) ? $_GET['msg'] : ""; ?></span></div>
<div class="wrapper">
<br />
<div class="cont">
  <p>&nbsp;</p>
  <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
    <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
      <tr>
        <td colspan="2" align="center" valign="middle">&nbsp;</td>
        </tr>
      <tr>
        <td width="28%" align="right" valign="middle"><strong>Company's Name</strong></td>
        <td width="72%" align="left" valign="middle"><label>
          <input name="name" type="text" class="input" id="name" size="50" value="<?= $set['name']; ?>" />
        </label></td>
      </tr>
      <tr>
        <td align="right" valign="top"><strong>Banner </strong></td>
        <td align="left" valign="top"><input type="file" name="fileField" id="fileField" onChange=" return enableSubmit()"/>&nbsp;<div><a href="#" onclick="javascript: if(document.getElementById('bannerspec').style.display == 'block'){ document.getElementById('bannerspec').style.display = 'none';} else { document.getElementById('bannerspec').style.display = 'block'; }">Click to view banner specifications</a></div>
<div id="bannerspec" style="display:none; color:#F30">
<br />Banner must be less than 350 x 72
<br />Must be in jpg, png or gif format
<br />Must be less than 100kb
</div></td>
      </tr>
      <tr>
        <td align="right" valign="middle"><strong>Footer</strong></td>
        <td align="left" valign="middle"><label>
          <input name="footer" type="text" class="input" id="footer" size="50" value="<?= $set['footer']; ?>" />
        </label></td>
      </tr>
      <tr>
        <td align="right" valign="middle"><input type="hidden" name="sid" id="sid" value="<?= $set['id']; ?>" /></td>
        <td align="left" valign="middle"><input type="submit" name="button" id="button" value="Apply Settings" class="btn"  /> &nbsp;&nbsp;<span class="errorMsg"><? echo isset($getMsg) ? $getMsg: ""; ?></span></td>
      </tr>
      <tr>
        <td align="left" valign="middle">&nbsp;</td>
        <td align="left" valign="middle">&nbsp;</td>
      </tr>
    </table>
  </form>
</div>
</div>
