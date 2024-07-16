<script language="javascript" type="text/javascript" src="modules/photo_manager/jscript/ajax_page_loader.js"></script>
<link href="modules/photo_manager/css/style.css" rel="stylesheet" type="text/css"/>
<style type="text/css">
<!--
.txtWhite {
	color: #FFF;
}
-->
</style>
<div class="title-bar">&nbsp;&nbsp;<img src="modules/photo_manager/images/image_multi.png" /> <strong style="font-size:16px">All Images In Sub Album</strong> [ <span style="color:#F60"><?= ucwords($_GET['sub_alb']);?></span> ]
&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#F60"><? echo isset($_GET['msg']) ? $_GET['msg'] : ""; ?></span></div>
<div class="wrapper">
<br />
<div class="cont">
  <form id="form1" name="form1" method="post" action="" onsubmit="return verify_checkbox()">
    <br />
    <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #F2F2F2">
      <tr>
        <td height="68" align="left" valign="top"><table width="100%" border="0" align="center" cellpadding="2" cellspacing="1">
          <tr>
            <td width="49" height="24" align="left" valign="middle" bgcolor="#D9F2FF" ><strong>&nbsp;#</strong></td>
            <td width="409" align="left" valign="middle" bgcolor="#D9F2FF" ><strong>&nbsp;Image Caption</strong></td>
            <td width="441" align="left" valign="middle" bgcolor="#D9F2FF" ><strong>&nbsp;Other Info</strong></td>
            <td width="145" align="right" valign="middle" class="errorMsg"><a href="javascript:;" onclick="window.history.back();">Back</a></td>
          </tr>
          <? gallery_class::get_all_images_in_sub_album(); // method that displays all sub albums ?>
        </table></td>
      </tr>
    </table>
  </form>
  <p>
</div>
</div>
