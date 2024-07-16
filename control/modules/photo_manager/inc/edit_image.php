<? 
$get = gallery_class::get_image_details();
if(isset($_POST['button'])){ gallery_class::update_image(); } 
?>
<script type="text/javascript" src="modules/photo_manager/jscript/form_validator.js"></script>
<link href="modules/photo_manager/css/style.css" rel="stylesheet" type="text/css"/>
<div class="title-bar">&nbsp;&nbsp;<img src="modules/photo_manager/images/image_add.png" /> <strong style="font-size:16px">Edit Image</strong>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span style="color:#F30"><? echo isset($_GET['msg']) ? $_GET['msg'] : ""; ?></span></div>
<div class="wrapper">
<br>
<div class="cont">

  <form action="" method="post" enctype="multipart/form-data" name="albumform">
    <table width="98%" border="0" align="center" cellpadding="10" cellspacing="0">
      <tr>
        <td colspan="2" align="left" valign="middle"><div><a href="javascript:;" onclick="javascript: if(document.getElementById('spec').style.display == 'block'){ document.getElementById('spec').style.display = 'none';} else { document.getElementById('spec').style.display = 'block'; }">View image specifications</a></div>          <div id="spec" style="display:none; padding:5px; text-align:justify; color:#F30; line-height:20px">
          Please the image you should upload must be in any of these format jpeg, png or gif.</div> 
          
        </td>
        <td colspan="2" align="right" valign="middle">
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
		?>
        &nbsp;</td>
        </tr>
      <tr>
        <td width="18%" align="left" valign="middle"><strong>Album</strong></td>
        <td align="left" valign="middle">
        <input name="album" type="radio" id="album" onClick="get_value()" value="Existing" checked>
        Use existing album</td>
        <td align="left" valign="middle">&nbsp;</td>
        <td width="25%" rowspan="4" align="right" valign="top"><img src="<?= $get['path']; ?>"  style="border:1px dashed #CCC" /><br />
          <input type="hidden" name="path" id="path"  value="<?= $get['path']; ?>"/>
          <br />
Thumbnail</td>
      </tr>
      <tr>
        <td align="left" valign="middle"><strong><div id="existalbum">Existing albums</div></strong><strong><div id="albumname" style="display:none">Album name</div></strong></td>
        <td align="left" valign="middle"><select name="e_album_name" id="e_album_name">
              						     <? gallery_class::get_existing_albums(); ?>
                                         <option selected="selected"><?=$get['album_name'];?></option>
        								</select> <input name="n_album_name" type="text" class="input" id="n_album_name" size="50" style="display:none"></td>
        <td align="left" valign="middle">&nbsp;</td>
        </tr>
      <tr>
        <td align="left" valign="middle"><strong>Album Category</strong></td>
        <td align="left" valign="middle"><select name="album_cat" id="album_cat" onchange="get_cat_name(this.options[this.selectedIndex].value)">
          <option value="Non" <? if($get['sub_album_name'] == "Non"){ echo "selected";}?>>Non</option>
          <option value="Existing" <? if($get['sub_album_name'] != "Non"){ echo "selected";}?>>Existing</option>
        </select></td>
        <td align="left" valign="middle">
          <div id="cat" style="display:none"><strong>Category name</strong> 
            <input name="n_cat_name" type="text" class="input" id="cat_name" size="20">
            </div>
          <div id="e_cat" style="display:none"><strong>Existing Categories</strong> 
            <select name="e_cat_name" id="e_cat_name">
              <? gallery_class::get_existing_albums_category(); ?>
              <option selected="selected"><?=$get['sub_album_name'];?></option>
              </select>
            </div>
        </td>
        </tr>
      <tr>
        <td align="left" valign="top"><strong>Image</strong></td>
        <td width="36%" align="left" valign="top"><input type="file" name="fileField" id="fileField" >
        </td>
        <td width="21%" align="left" valign="top">&nbsp;</td>
        </tr>
      <tr>
        <td align="left" valign="middle"><strong>Size </strong></td>
        <td colspan="3" align="left" valign="middle"><input name="size" type="radio" id="size" onClick="get_dim()" value="default" checked >
Use default
  <label>
<input name="size" type="radio" id="size" onClick="get_dim()" value="specify">
Specify</label>
<div id="dim" style="display:none; padding:5px"><strong> Width</strong>
  <input name="img_width" type="text" class="input" id="img_width" size="4">
  <strong>Hieght</strong>
  <input name="img_height" type="text" class="input" id="img_height" size="4"></div></td>
      </tr>
      <tr>
        <td align="left" valign="middle"><strong>Thumbnail</strong></td>
        <td colspan="3" align="left" valign="middle"><input name="thumb" type="radio" id="radio" value="No" checked="checked" onClick="set_thumb()"/> 
          No 
          <input type="radio" name="thumb" id="radio2" value="Yes"  onClick="set_thumb()" /> 
          Yes <div id="thumb" style="display:none; padding:5px"><strong> Width</strong>
  <input name="thumb_img_width" type="text" class="input" id="img_width" size="4">
  <strong>Hieght</strong>
  <input name="thumb_img_height" type="text" class="input" id="img_height" size="4"></div></td>
      </tr>
      <tr>
        <td align="left" valign="middle"><strong>Caption</strong></td>
        <td colspan="3" align="left" valign="middle"><input name="caption" type="text" id="caption" size="50" class="input" value="<?=$get['cap'];?>"></td>
      </tr>
      <tr>
        <td align="left" valign="middle"><strong>Description</strong></td>
        <td colspan="3" align="left" valign="middle"><textarea name="desc" cols="38" rows="3" id="desc"><?=$get['desc'];?></textarea></td>
      </tr>
      <tr>
        <td align="left" valign="middle"><strong>Publish </strong></td>
        <td colspan="3" align="left" valign="middle">
        <input name="publish" type="radio" id="pub" value="Yes" <? if($get['pub'] == "Yes"){ echo "checked";} ?>/>
        Yes
        <label>
        <input name="publish" type="radio" id="pub" value="No" <? if($get['pub'] == "No"){ echo "checked";} ?>/>
        No</label></td>
      </tr>
      <tr>
        <td align="left" valign="middle"></td>
        <td colspan="3" align="left" valign="middle"><label>
          <input type="submit" name="button" id="button" value="Update Image" class="btn">
          <input type="reset" name="button2" id="button2" value="Reset" class="btn">
        </label></td>
      </tr>
    </table>
    &nbsp;</form>
</div>
</div>
<script language="javascript">open_exist_cat();</script>