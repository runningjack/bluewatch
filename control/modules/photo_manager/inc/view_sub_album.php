<script language="javascript" type="text/javascript" src="modules/photo_manager/jscript/ajax_page_loader.js"></script>
<link href="modules/photo_manager/css/style.css" rel="stylesheet" type="text/css"/>

<style type="text/css">
<!--
.whtxtx {
	color: #FFF;
}
-->
</style>
<div class="title-bar">&nbsp;&nbsp;<img src="modules/photo_manager/images/image_multi.png" /> <strong style="font-size:16px">Sub Album</strong>
[ <span style="color:#F60"><?= ucwords($_GET['alb']);?> ]&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#F60"><? echo isset($_GET['msg']) ? $_GET['msg'] : ""; ?></div>
<div class="wrapper">
<br />
<div class="cont">
  <form id="form1" name="form1" method="post" action="" onsubmit="return verify_checkbox()">
    <br />
    <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #F2F2F2">
      <tr>
        <td height="53" align="left" valign="top"><table width="100%" border="0" align="center" cellpadding="2" cellspacing="1">
          <tr>
            <td width="45" height="24" align="left" valign="middle" bgcolor="#D9F2FF" ><strong>&nbsp;#</strong></td>
            <td width="485" align="left" valign="middle" bgcolor="#D9F2FF"  ><strong>Sub Album Name</strong></td>
            <td width="282" align="left" valign="middle" bgcolor="#D9F2FF"  ><strong> Image(s)</strong></td>
            <td width="238" align="right" valign="middle" class="errorMsg"><a href="javascript:;" onclick="window.history.back();">Back</a></td>
          </tr>
          <? gallery_class::get_all_sub_albums(); // method that displays all sub albums ?>
        </table></td>
      </tr>
    </table>
  </form>
  <p>
</div>
</div>
