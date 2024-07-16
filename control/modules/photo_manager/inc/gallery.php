<script language="javascript" type="text/javascript" src="modules/photo_manager/jscript/ajax_page_loader.js"></script>
<script language="javascript" type="text/javascript" src="modules/photo_manager/jscript/form_validator.js"></script>
<link href="modules/photo_manager/css/style.css" rel="stylesheet" type="text/css"/>
<style type="text/css">
<!--
.txtWhite {
	color: #FFF;
}
-->
</style>
<div class="title-bar">&nbsp;&nbsp;<img src="modules/photo_manager/images/image_multi.png" /> <strong style="font-size:16px">Photo Manager</strong>
&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#F60"><? echo isset($_GET['msg']) ? $_GET['msg'] : ""; ?></span></div>
<div class="wrapper">
<br />
<div class="cont">
<div class="create"><a href="?<?= PROJECTNAME; ?>=Control Panel&amp;INC=Photo Manager&amp;CMD=Upload Picture"><img src="modules/photo_manager/images/image_next.png" alt="Create Image" width="24" height="24" border="0" />&nbsp;Upload Picture</a> &nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:;" onclick="load_page('CMD=View Album Details&id=<?= $myrow["content_id"];?>')">
<a href="?<?= PROJECTNAME; ?>=Control Panel&amp;INC=Photo Manager&amp;CMD=View Album Images"><img src="modules/photo_manager/images/image.png" alt="View All" width="24" height="24" border="0" /> All Images</a></div>

  <form id="form1" name="form1" method="post" action="" onsubmit="return verify_checkbox()">
    <br />
    <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #F2F2F2">
      <tr>
        <td height="66" align="left" valign="top"><table width="100%" border="0" align="center" cellpadding="2" cellspacing="1">
          <tr>
            <td width="71" height="24" align="left" valign="middle" bgcolor="#D9F2FF" ><strong>&nbsp;#</strong></td>
            <td width="608" align="left" valign="middle" bgcolor="#D9F2FF"  ><strong>&nbsp;Main Album</strong></td>
            <td width="227" align="left" valign="middle" bgcolor="#D9F2FF"  ><strong>&nbsp;Sub Albums</strong></td>
            <td width="144" align="left" valign="middle" class="errorMsg">&nbsp;</td>
          </tr>
          <? gallery_class::get_all_album(); // method that displays all album ?>
        </table></td>
      </tr>
    </table>
  </form>
  <p>
</div>
</div>
