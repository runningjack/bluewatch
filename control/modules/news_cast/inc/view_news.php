<?
require('conf/settings.php');
$project_name = PROJECTNAME;
$get = news_class::get_news_details($_GET['id']);
?>
<style type="text/css">
.title-bar{width:98%; background:url(modules/news_cast/images/hd.png); height:68px;padding-top:13px}
.properties{ position:relative; width:250px; padding:10px; margin-right:5px; text-align:right; top:10px;}

</style>
<link href="modules/news_cast/css/style.css" rel="stylesheet" type="text/css"/>

<div class="title-bar"><img src="modules/news_cast/images/newsd.png" width="32" height="32" /> <strong style="font-size:16px">News Details</strong></div>
<div class="wrapper">
<br />
<div class="cont">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="90%">
    <div><a href="javascript:;" onclick="javascript: if(document.getElementById('properties').style.display == 'block'){ document.getElementById('properties').style.display = 'none';} else { document.getElementById('properties').style.display = 'block'; }">View Properties</a></div>
    </td>
    <td align="right">
    &nbsp;
    <?
	if($_GET['cat'] != 0)
	{
		?>
	<a href="?<?= $project_name; ?>=Control Panel&INC=News Cast&CMD=Edit News&id=<?= $get['rf_id'];?>&cat=<?= $_GET['cat'];?>"><img src="modules/news_cast/images/b_edit.png" alt="Edit Content" width="16" height="16" border="0" /></a>
	&nbsp;&nbsp;&nbsp;&nbsp;
	
		<a href="?<?= $project_name; ?>=Control Panel&INC=News Cast&CMD=Delete News&id=<?= $get['rf_id']; ?>&cat=<?= $_GET['cat'];?>" onclick="return confirm('Are You Sure You Want To Delete This News (Y/N)?');"><img src="modules/news_cast/images/b_drop.png" alt="Delete Record" width="16" height="16" border="0" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?
	}
	?>
    </td>
  </tr>
</table>
<div id="properties" style="display:none">
  <table width="98%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="left" width="50%" valign="middle">
        <br />Page Id: <?= $get['rf_id'];?>
        <br />Type: <?= ($get['idx'] != 0) ? "Child" : "Parent";?>
        <br />Title: <?= $get['title'];?>
        <br />Published: <?= $get['pub'];?>
        <br />Date Created: <?= $get['dtc'];?>
        <br />Date Last Modified: <?= $get['dtm'];?>
        <br />Author: <?= $get['aut'];?>
      </td>
      <td align="left" valign="middle">
     <?  if(!empty($get['path'])){ ?><img src="<?= $get['path'];?>" /> Thumbnail<? } ?>
      </td>
    </tr>
  </table>
</div>
<p><br />
<strong style="font-size:15px; color:#333">News Name: &nbsp;</strong><?= $get['name'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

</p>
<p><br />
<?= stripslashes($get['content']);?>
</p>
</div>
</div>
