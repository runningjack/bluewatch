<? 
session_start();
error_reporting(E_ALL ^ E_NOTICE);
$alphanum = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
$new_image_name = substr(str_shuffle($alphanum), 0, 20);
require('../../../../../conf/settings.php');
include('../../../../../modules/content_manager/libs/content_man_class.php');
if($_POST['submit']){ $getMsg = content_man_class::upload_cms_image(); }
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>linkCMS | Insert or Modify Image</title>

<script type="text/javascript" src="../scripts/wysiwyg-popup.js"></script>
<script language="JavaScript" type="text/javascript">

/* ---------------------------------------------------------------------- *\
  Function    : insertImage()
  Description : Inserts image into the WYSIWYG.
\* ---------------------------------------------------------------------- */
function insertImage() {
	
	var n = WYSIWYG_Popup.getParam('wysiwyg');
	
	// get values from form fields
	var src = document.getElementById('src').value;
	var alt = document.getElementById('alt').value;
	var width = document.getElementById('width').value
	var height = document.getElementById('height').value
	var border = document.getElementById('border').value
	var align = document.getElementById('align').value
	var vspace = document.getElementById('vspace').value
	var hspace = document.getElementById('hspace').value
	
	// insert image
	WYSIWYG.insertImage(src, width, height, align, border, alt, hspace, vspace, n);
  	//window.close();
}

/* ---------------------------------------------------------------------- *\
  Function    : loadImage()
  Description : load the settings of a selected image into the form fields
\* ---------------------------------------------------------------------- */
function loadImage() {
	document.getElementById('submit').disabled = true;
	var n = WYSIWYG_Popup.getParam('wysiwyg');
	
	// get selection and range
	var sel = WYSIWYG.getSelection(n);
	var range = WYSIWYG.getRange(sel);
	
	// the current tag of range
	var img = WYSIWYG.findParent("img", range);
	
	// if no image is defined then return
	if(img == null) return;
		
	// assign the values to the form elements
	for(var i = 0;i < img.attributes.length;i++) {
		var attr = img.attributes[i].name.toLowerCase();
		var value = img.attributes[i].value;
		//alert(attr + " = " + value);
		if(attr && value && value != "null") {
			switch(attr) {
				case "src": 
					// strip off urls on IE
					if(WYSIWYG_Core.isMSIE) value = WYSIWYG.stripURLPath(n, value, false);
					document.getElementById('src').value = value;
				break;
				case "alt":
					document.getElementById('alt').value = value;
				break;
				case "align":
					selectItemByValue(document.getElementById('align'), value);
				break;
				case "border":
					document.getElementById('border').value = value;
				break;
				case "hspace":
					document.getElementById('hspace').value = value;
				break;
				case "vspace":
					document.getElementById('vspace').value = value;
				break;
				case "width":
					document.getElementById('width').value = value;
				break;
				case "height":
					document.getElementById('height').value = value;
				break;				
			}
		}
	}
	
	// get width and height from style attribute in none IE browsers
	if(!WYSIWYG_Core.isMSIE && document.getElementById('width').value == "" && document.getElementById('width').value == "") {
		document.getElementById('width').value = img.style.width.replace(/px/, "");
		document.getElementById('height').value = img.style.height.replace(/px/, "");
	}
}

/* ---------------------------------------------------------------------- *\
  Function    : selectItem()
  Description : Select an item of an select box element by value.
\* ---------------------------------------------------------------------- */
function selectItemByValue(element, value) {
	if(element.options.length) {
		for(var i=0;i<element.options.length;i++) {
			if(element.options[i].value == value) {
				element.options[i].selected = true;
			}
		}
	}
}

function getImgpath(rt)
{
	var new_name = document.getElementById('newname').value;
	if(navigator.appName == "Opera")
	{
		var path = document.getElementById('fileField').value;
		var pos =path.lastIndexOf( path.charAt( path.indexOf(":")+1) ); 
		var filename = path.substring( pos+1);
		var arr = filename.split(".");
		var new_img_name = new_name + "." + arr[1];
		document.getElementById('src').value = "pageresources/" + new_img_name;
	}
	else if(navigator.appName == "Microsoft Internet Explorer")
	{
		var path = document.getElementById('fileField').value;
		var pos =path.lastIndexOf( path.charAt( path.indexOf(":")+1) ); 
		var filename = path.substring( pos+1);
		var arr = filename.split(".");
		var new_img_name = new_name + "." + arr[1];
		document.getElementById('src').value = "pageresources/" + new_img_name;
	}
	else if(navigator.appName == "Mozilla")
	{
		var filename = document.getElementById('fileField').value;
		var arr = filename.split(".");
		var new_img_name = new_name + "." + arr[1];
		document.getElementById('src').value = "pageresources/" + new_img_name;
	}
	else
	{
		var filename = document.getElementById('fileField').value;
		var arr = filename.split(".");
		var new_img_name = new_name + "." + arr[1];
		document.getElementById('src').value = "pageresources/" + new_img_name;
	}
	
	document.getElementById('submit').disabled = false;
}



</script>
</head>
<body bgcolor="#EEEEEE" marginwidth="0" marginheight="0" topmargin="0" leftmargin="0" onLoad="loadImage();">
<form action="" method="post" enctype="multipart/form-data" name="form1">
  <table border="0" cellpadding="0" cellspacing="0" style="padding: 5px;">
    <tr>
      <td><span style="font-family: arial, verdana, helvetica; font-size: 9px; font-weight: bold;">Insert Image:</span><span style="color:#F30; font-weight:bold">
        <?= $getMsg; ?></span>
        <table width="380" border="0" cellpadding="0" cellspacing="0" style="background-color: #F7F7F7; border: 2px solid #FFFFFF; padding: 5px;">
          <tr>
            <td width="80" style="padding-bottom: 2px; padding-top: 0px; font-family: arial, verdana, helvetica; font-size: 11px;">Image:</td>
            <td width="300" style="padding-bottom: 2px; padding-top: 0px;">
             <input type="file" name="fileField" id="fileField" onChange="getImgpath('<?= PROJECTPATH; ?>')">
              <label>
                <input name="page_name" type="hidden" id="page_name" size="10" value="<?= $_SESSION['page']; ?>">
                <input type="hidden" name="src" id="src" value=""  style="font-size: 10px; width: 100%;">
                <input type="hidden" name="newname" id="newname" value="<?= $new_image_name; ?>">
              </label></td>
          </tr>
          <tr>
            <td style="padding-bottom: 2px; padding-top: 0px; font-family: arial, verdana, helvetica; font-size: 11px;">Alternate Text:</td>
            <td style="padding-bottom: 2px; padding-top: 0px;"><input type="text" name="alt" id="alt" value=""  style="font-size: 10px; width: 100%;"></td>
          </tr>
        </table>
        <table width="380" border="0" cellpadding="0" cellspacing="0" style="margin-top: 3px;">
          <tr>
            <td style="vertical-align:top;"><span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;">Layout:</span>
              <table width="180" border="0" cellpadding="0" cellspacing="0" style="background-color: #F7F7F7; border: 2px solid #FFFFFF; padding: 5px;">
                <tr>
                  <td style="padding-bottom: 2px; padding-top: 0px; font-family: arial, verdana, helvetica; font-size: 11px;">Width:</td>
                  <td style="width:60px;padding-bottom: 2px; padding-top: 0px;"><input type="text" name="width" id="width" value=""  style="font-size: 10px; width: 100%;"></td>
                </tr>
                <tr>
                  <td style="padding-bottom: 2px; padding-top: 0px; font-family: arial, verdana, helvetica; font-size: 11px;">Height:</td>
                  <td style="padding-bottom: 2px; padding-top: 0px;"><input type="text" name="height" id="height" value=""  style="font-size: 10px; width: 100%;"></td>
                </tr>
                <tr>
                  <td style="padding-bottom: 2px; padding-top: 0px; font-family: arial, verdana, helvetica; font-size: 11px;">Border:</td>
                  <td style="padding-bottom: 2px; padding-top: 0px;"><input type="text" name="border" id="border" value="0"  style="font-size: 10px; width: 100%;"></td>
                </tr>
              </table></td>
            <td width="10">&nbsp;</td>
            <td style="vertical-align:top;"><span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;">&nbsp;</span>
              <table width="200" border="0" cellpadding="0" cellspacing="0" style="background-color: #F7F7F7; border: 2px solid #FFFFFF; padding: 5px;">
                <tr>
                  <td style="width: 115px;padding-bottom: 2px; padding-top: 0px; font-family: arial, verdana, helvetica; font-size: 11px;" width="100">Alignment: </td>
                  <td style="width: 85px;padding-bottom: 2px; padding-top: 0px;"><select name="align" id="align" style="font-family: arial, verdana, helvetica; font-size: 11px; width: 100%;">
                    <option value="">Not Set</option>
                    <option value="left">Left</option>
                    <option value="right">Right</option>
                    <option value="texttop">Texttop</option>
                    <option value="absmiddle">Absmiddle</option>
                    <option value="baseline">Baseline</option>
                    <option value="absbottom">Absbottom</option>
                    <option value="bottom">Bottom</option>
                    <option value="middle">Middle</option>
                    <option value="top">Top</option>
                  </select></td>
                </tr>
                <tr>
                  <td style="padding-bottom: 2px; padding-top: 0px; font-family: arial, verdana, helvetica; font-size: 11px;">Horizontal Space:</td>
                  <td style="padding-bottom: 2px; padding-top: 0px;"><input type="text" name="hspace" id="hspace" value=""  style="font-size: 10px; width: 100%;"></td>
                </tr>
                <tr>
                  <td style="padding-bottom: 2px; padding-top: 0px; font-family: arial, verdana, helvetica; font-size: 11px;">Vertical Space:</td>
                  <td style="padding-bottom: 2px; padding-top: 0px;"><input type="text" name="vspace" id="vspace" value=""  style="font-size: 10px; width: 100%;"></td>
                </tr>
              </table></td>
          </tr>
        </table>
        <div align="right" style="padding-top: 5px;">
          <input name="submit" type="submit" id="submit" style="font-size: 12px;" onClick="insertImage();" value="Submit" >
          &nbsp;
          <input type="submit" value="  Close  " onClick="window.close();" style="font-size: 12px;" >
        </div></td>
    </tr>
  </table>
</form>
</body>
</html>
