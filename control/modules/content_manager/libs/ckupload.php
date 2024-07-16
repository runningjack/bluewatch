 <?php
//GET MY RESIZER CLASS

// GET EXTENSION
function getExtension($str) {
//$path_info = pathinfo($str);
//$ext = $path_info['extension']; // optional way to get file extension
	
$i = strrpos($str,".");
if (!$i) { return ""; }
$l = strlen($str) - $i;
$ext = substr($str,$i+1,$l);
return $ext;
}

require("resizer.php");
require("../classes/myclass.ConfigData.php");
require("../classes/myclass.InsertQuery.php");

$filename = $_FILES['upload']['name'];
$tmp_res = $_FILES['upload']['tmp_name'];
$filesize = $_FILES['upload']['size'];
$ext = getExtension($filename);
$hashstr = $filename.time();
$hashname = sha1($hashstr);
$max_width = 700;
$max_height = 700;

$url = '../../../../pageresources/'.$hashname.".".$ext;
$url2 = '../../../pageresources/'.$hashname.".".$ext;

 //extensive suitability check before doing anything with the file...
    if (($_FILES['upload'] == "none") OR (empty($_FILES['upload']['name'])) )
    {
       $message = "No file uploaded.";
    }
    else if ($_FILES['upload']["size"] == 0)
    {
       $message = "The file is of zero length.";
    }
    else if (($_FILES['upload']["type"] != "image/pjpeg") AND ($_FILES['upload']["type"] != "image/jpeg") AND ($_FILES['upload']["type"] != "image/png"))
    {
       $message = "The image must be in either JPG or PNG format. Please upload a JPG or PNG instead.";
    }
    else if (!is_uploaded_file($_FILES['upload']["tmp_name"]))
    {
       $message = "You may be attempting to hack our server. We're on to you; expect a knock on the door sometime soon.";
    }
    else {
      $message = "";
			if( $filesize > (1024*500) )
			{
			// IF IMAGE IS LARGE, RESIZE
			$move = ResizerImage::imageresizer($_FILES['upload']['tmp_name'], $max_width, $max_height, $_FILES['upload']['type'],$url);
			$move2 = ResizerImage::imageresizer($_FILES['upload']['tmp_name'], $max_width, $max_height, $_FILES['upload']['type'], $url2);
			}else{
			// IF IMAGE IS LARGE, RESIZE
			$move = ResizerImage::move($_FILES['upload']['tmp_name'], $url);
				if (!copy($url, $url2))
				{
					echo "failed to copy $file...\n";
				}else{$move2=true;}

			}

      if(!$move || !$move2)
      {
         $message = "Error moving uploaded file. Check the script is granted Read/Write/Modify permissions.";
      }else
	  {
      	$url = "pageresources/".$hashname.".".$ext;
				
				// CREATE OBJECT OF CLASS CONNECTION
				$configData = new ConfigData;
				$conn = $configData -> connectDB();

				// CREATE AN INSERT DATA QUERY OBJECT
				$insertQuery = new InsertQuery();
				$img_insertQuery = new InsertQuery();
				
				// ADD IMAGES TO EDITOR TABLE
				$mydata = array("path" => $url);
				$qresult = $insertQuery ->insertTable('editor_img')
										->insertData($mydata)
										->buildInsertQuery()
										->queryDB($conn);
	  }
   }
 
$funcNum = $_GET['CKEditorFuncNum'] ;
echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";
?>