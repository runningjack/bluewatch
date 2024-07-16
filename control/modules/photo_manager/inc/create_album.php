<? if(isset($_POST['button'])){ gallery_class::build_album(); } ?>
<script type="text/javascript" src="modules/photo_manager/jscript/add_image.js"></script>
<script type="text/javascript" src="modules/photo_manager/jscript/form_validator.js"></script>
<link href="modules/photo_manager/css/style.css" rel="stylesheet" type="text/css"/>
<div class="title-bar">&nbsp;&nbsp;<img src="modules/photo_manager/images/image_add.png" /> <strong style="font-size:16px">Add Image</strong>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span style="color:#F30"><? echo isset($_GET['msg']) ? $_GET['msg'] : ""; ?></span></div>
<div class="wrapper">
<br>
<div class="cont">

  <form action="" method="post" enctype="multipart/form-data" name="albumform">
    <table width="98%" border="0" align="center" cellpadding="10" cellspacing="0">
      <tr>
        <td colspan="4" align="left" valign="middle">
 <div><a href="javascript:;" onclick="javascript: if(document.getElementById('spec').style.display == 'block'){ document.getElementById('spec').style.display = 'none';} else { document.getElementById('spec').style.display = 'block'; }">View image specifications</a></div>
<div id="spec" style="display:none; padding:5px; text-align:justify; color:#F30; line-height:20px">
Please the image you should upload must be in any of these formats: jpeg, png or gif.<br />
Your Banner slide must be 900 x 300
</div>
        </td>
      </tr>
      <tr>
        <td width="18%" align="left" valign="middle"><strong>Album</strong></td>
        <td colspan="3" align="left" valign="middle">
            <input name="album" type="radio" id="album" onClick="get_value()" value="Existing" checked>Use existing album
            <input name="album" type="radio" id="album" onClick="get_value()" value="New">New album
        </td>
      </tr>
      <tr>
        <td align="left" valign="middle"><strong><div id="existalbum">Existing albums</div></strong><strong><div id="albumname" style="display:none">Album name</div></strong></td>
        <td colspan="3" align="left" valign="middle">
            <select name="e_album_name" id="e_album_name"><? gallery_class::get_existing_albums(); ?></select> 
            <input name="n_album_name" type="text" class="input" id="n_album_name" size="50" style="display:none"></td>
      </tr>
      <tr>
        <td align="left" valign="middle"><strong>Album Category</strong></td>
        <td align="left" valign="middle">
            <select name="album_cat" id="album_cat" onchange="get_cat_name(this.options[this.selectedIndex].value)">
              <option value="Non">Non</option>
              <option value="New">New</option>
              <option value="Existing">Existing</option>
            </select>
        </td>
        <td colspan="2" align="left" valign="middle">
            <div id="cat" style="display:none"><strong>Category name</strong> 
                <input name="n_cat_name" type="text" class="input" id="cat_name" size="20">
            </div>
            <div id="e_cat" style="display:none"><strong>Existing Categories</strong> 
                <select name="e_cat_name" id="e_cat_name"><? gallery_class::get_existing_albums_category(); ?></select>
            </div>
        </td>
      </tr>
      <tr>
        <td align="left" valign="top"><strong>Image</strong></td>
        <td width="20%" align="left" valign="top"><input type="file" name="fileField" id="fileField" onChange="enablebtn()" style="display:block"><input type="hidden" value="0" id="theValue" />
          <div id="filediv"> </div></td>
        <td width="30%" align="left" valign="top"><input name="multi" type="checkbox" id="multi" onClick="show_files()" value="Yes">Use multiple uploads</td>
        <td width="32%" align="left" valign="top"><div id="numfiles" style="display:none"> <a href="javascript:;" onclick="addEvent();"><img src="modules/photo_manager/images/more.png" alt="Add More" width="24" height="24" border="0"> Add Image</a></div></td>
      </tr>
      <tr>
        <td align="left" valign="middle"><strong>Size</strong></td>
        <td colspan="3" align="left" valign="middle">
            <input name="size" type="radio" id="size" onClick="get_dim()" value="default" checked >Use default
            <label><input name="size" type="radio" id="size" onClick="get_dim()" value="specify">Specify</label>
            <div id="dim" style="display:none; padding:5px">
                <strong>Width</strong><input name="img_width" type="text" class="input" id="img_width" size="4">
                <strong>Height</strong><input name="img_height" type="text" class="input" id="img_height" size="4">
            </div>
        </td>
      </tr>
      <tr>
        <td align="left" valign="middle"><strong>Thumbnail</strong></td>
        <td colspan="3" align="left" valign="middle">
            <input name="thumb" type="radio" id="radio" value="No" checked="checked" onClick="set_thumb()"/>No 
            <input type="radio" name="thumb" id="radio2" value="Yes"  onClick="set_thumb()" />Yes
            <div id="thumb" style="display:none; padding:5px">
                <strong> Width</strong><input name="thumb_img_width" type="text" class="input" id="img_width" size="4">
                <strong>Hieght</strong><input name="thumb_img_height" type="text" class="input" id="img_height" size="4">
            </div>
        </td>
      </tr>
      <tr>
        <td align="left" valign="middle"><strong>Caption</strong></td>
        <td colspan="3" align="left" valign="middle"><input name="caption" type="text" id="caption" size="50" class="input" ></td>
      </tr>
      <tr>
        <td align="left" valign="middle"><strong>Description</strong></td>
        <td colspan="3" align="left" valign="middle"><textarea name="desc" cols="38" rows="3" id="desc"></textarea></td>
      </tr>
      <tr>
        <td align="left" valign="middle"><strong>Publish </strong></td>
        <td colspan="3" align="left" valign="middle">
            <input name="publish" type="radio" id="radio5" value="Yes" checked>Yes
            <label><input name="publish" type="radio" id="radio6" value="No">No</label>
        </td>
      </tr>
      <tr>
        <td align="left" valign="middle"></td>
        <td colspan="3" align="left" valign="middle">
            <label>
                <input type="submit" name="button" id="button" value="Add Image" class="btn" disabled>
                <input type="reset" name="button2" id="button2" value="Reset" class="btn">
            </label>
        </td>
      </tr>
    </table>&nbsp;
  </form>
</div>
</div>