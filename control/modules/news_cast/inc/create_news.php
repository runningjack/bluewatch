<?
session_start();
if($_POST['submit'])
{ 
	$_SESSION['page'] = strtolower(str_replace(' ','_',$_POST['news_name']));
	news_class::create_news();
	
}
?>

<link href="modules/news_cast/css/style.css" rel="stylesheet" type="text/css"/>
<script src="modules/news_cast/jscript/form_validator.js"></script>
<!--
<script type="text/javascript" src="modules/news_cast/jscript/openwysiwyg/scripts/wysiwyg.js"></script>
<script type="text/javascript" src="modules/news_cast/jscript/openwysiwyg/scripts/wysiwyg-settings.js"></script>
<script type="text/javascript"> WYSIWYG.attach('content', miney); </script>
-->


<form action="" method="post" enctype="multipart/form-data" name="form" id="form" onsubmit="return form_chk()">

<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center" valign="middle" background="modules/news_cast/images/hd.png">
            <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td height="50" align="left" valign="bottom"><img src="modules/news_cast/images/add_news2.png" width="32" height="32" /> <strong style="font-size:16px">Create News</strong></td>
                    <td height="50" align="left" valign="bottom">&nbsp;</td>
                    <td height="50" align="left" valign="bottom"><div id="error" class="errorMsg"><?= $_GET['msg'];?></div></td>
                </tr>
                <tr>
                    <td width="26%" align="left" valign="middle">&nbsp;</td>
                    <td width="12%" align="left" valign="middle"></td>
                    <td width="62%" align="left" valign="middle"></td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<br />

<table width="98%" border="0" align="center" cellpadding="10" cellspacing="0" style="border:1px solid #EEE">
    <tr>
        <td colspan="2" align="left" valign="middle">&nbsp;</td>
    </tr>
    <tr>
        <td width="17%" align="left" valign="middle"><strong>News  name</strong></td>
        <td width="83%" align="left" valign="middle">
            <input name="news_name" type="text" class="txtbox" id="news_name" size="50" />      &nbsp;&nbsp;&nbsp;
            <input type="checkbox" name="validate" id="validate"  onclick="validate_name()" />      
            <span style="font-size:10px; color:#999">(Validate news name. Make sure you don't use digits or special characters)</span>
        </td>
    </tr>
    <tr>
        <td align="left" valign="middle"><strong>Title</strong></td>
        <td align="left" valign="middle"><input name="news_title" type="text" class="txtbox" id="news_title" size="50" /></td>
    </tr>
    <tr>
        <td align="left" valign="middle">
            <strong>Thumbnail<br><span style="display:none" id="size"><br><br><br>Size</span></strong>
        </td>
        <td align="left" valign="middle">
            <input name="image" type="checkbox" id="image" value="Yes" onClick="show_img_field()">
            <br/><br/>
            <input type="file" name="fileField" id="fileField" style="display:none">
            <div id="showSpec" style="display:none">
                <input name="size" type="radio" id="size" onClick="get_dim()" value="default" checked >Use default
                <label><input name="size" type="radio" id="size" onClick="get_dim()" value="specify">Specify</label>
                <div id="dim" style="display:none; padding:5px"><strong> Width</strong>
                    <input name="img_width" type="text" class="input" id="img_width" size="4">
                    <strong>Height</strong>
                    <input name="img_height" type="text" class="input" id="img_height" size="4">
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td align="left" valign="middle"><strong>Category</strong></td>
        <td align="left" valign="middle">
            <label>
                <select name="news_cat" id="news_cat" onchange="showparent(this.options[this.selectedIndex].value)">
                    <option value="Parent">Parent</option>
                    <option value="Child">Child</option>
                </select>
            </label>
        </td>
    </tr>
    <tr>
        <td align="left" valign="middle"><strong><div id="tit" style="display:none">Parent Name</div></strong></td>
        <td align="left" valign="middle">
            <select name="parent_name" id="parent_name" style="display:none">
                <? news_class::get_all_parent_news(); ?>
            </select> 
        </td>
    </tr>
    <tr>
        <td align="left" valign="middle"><strong>Content</strong></td>
        <!--<td align="left" valign="middle"><textarea name="content" id="content"></textarea></td>-->
        <td align="left" valign="middle">
        <?php
        //// Include the CKEditor class.
        include_once "modules/news_cast/ckeditor/ckeditor.php";
        //// The initial value to be displayed in the editor.
        $initialValue = 'Your news content here...';
        //// Create a class instance.
        $CKEditor = new CKEditor();
        //// Path to the CKEditor directory, ideally use an absolute path instead of a relative dir.
        ////   $CKEditor->basePath = '/ckeditor/'
        //// If not set, CKEditor will try to detect the correct path.
        $CKEditor->basePath = 'modules/news_cast/ckeditor/';
        //// Create a textarea element and attach CKEditor to it.
        $CKEditor->editor("content", $initialValue);
        /* $CKEditor = new CKEditor();
        // $CKEditor->basePath = '/ckeditor/';
        // $CKEditor->config['width'] = 975;
        //$CKEditor->config['height'] = 400; */

        //$CKEditor->editor("editor1", "heloo", $config);
        ?>
        </td>
    </tr>
    <tr>
        <td align="left" valign="middle"><strong>Publish</strong></td>
        <td align="left" valign="middle">
            <label>
                <input name="publish" type="radio" id="radio" value="Yes" checked="checked" />Yes
                <input type="radio" name="publish" id="radio2" value="No" />No
            </label>
        </td>
    </tr>
    <tr>
        <td align="left" valign="middle">&nbsp;</td>
        <td align="left" valign="middle">
            <input type="submit" name="submit" id="submit" value="Create News" class="submitbtn"/>
            <input type="reset" name="reset" id="reset" value="Reset" class="submitbtn" />
        </td>
    </tr>
</table>
</form>
<script language="javascript">
	document.getElementById("news_title").disabled = true;
	document.getElementById("news_cat").disabled = true;
	document.getElementById("fileField").disabled = true;
	document.getElementById("submit").disabled = true;
	document.getElementById("news_name").disabled = false;
</script>