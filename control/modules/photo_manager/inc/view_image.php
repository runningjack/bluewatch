<? $get = gallery_class::get_image_details();?>
<link href="modules/photo_manager/css/style.css" rel="stylesheet" type="text/css"/>
<div class="title-bar">&nbsp;&nbsp;<img src="modules/photo_manager/images/image_add.png" /> <strong style="font-size:16px"> Image Details</strong></div>
<div class="wrapper">
<br>
<div class="cont">

    <table width="98%" border="0" align="center" cellpadding="10" cellspacing="0">
      <tr>
        <td width="21%" align="left" valign="middle"><strong>Album</strong></td>
        <td align="left" valign="middle"><?=$get['album_name'];?></td>
        <td width="52%" rowspan="7" align="right" valign="top"><img src="<?= $get['path']; ?>"  style="border:1px dashed #CCC" /><br />
        <br />
        Thumbnail<br /><?= $get['others']; ?></td>
      </tr>
      <tr>
        <td align="left" valign="middle"><strong>Sub Album</strong></td>
        <td align="left" valign="middle"><?= $get['sub_album_name']; ?></td>
      </tr>
      <tr>
        <td align="left" valign="top"><strong>Caption</strong></td>
        <td width="27%" align="left" valign="top"><?=$get['cap'];?></td>
      </tr>
      <tr>
        <td align="left" valign="middle"><strong>Description</strong></td>
        <td align="left" valign="middle"><div align="justify"><?= nl2br($get['desc']);?></div></td>
      </tr>
      <tr>
        <td align="left" valign="middle"><strong>Publish </strong></td>
        <td align="left" valign="middle"><?=$get['pub'];?></td>
      </tr>
      <tr>
        <td align="left" valign="middle"><strong>Author</strong></td>
        <td align="left" valign="middle"><?=$get['auth'];?></td>
      </tr>
      <tr>
        <td align="left" valign="middle"><strong>Date Created</strong></td>
        <td align="left" valign="middle"><?=$get['dc'];?></td>
      </tr>
      <tr>
        <td align="left" valign="middle"><strong>Date Last Modified</strong></td>
        <td align="left" valign="middle"><?=$get['dm'];?></td>
        <td width="52%" align="right" valign="top">
        <?
			$project_name = PROJECTNAME;
			if(isset($_GET['PLA']) == "All")
			{
				?><a href=".?<?= $project_name;?>=Control Panel&INC=Photo Manager&CMD=View Album Images">Back</a><?
			}
			else
			{
				?><a href=".?<?= $project_name;?>=Control Panel&INC=Photo Manager&CMD=View Images In Sub Album&sub_alb=<?= $_GET['sub_alb']; ?>&id=<?= $_GET['sub_album_id']?>">Back</a><?
			}
		?>&nbsp;</td>
      </tr>
    </table>
    &nbsp;
</div>
</div>