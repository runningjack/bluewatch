<? 
	
	class gallery_class{
	
	
                private static $album;
		private static $e_album;
		private static $n_album;
		private static $album_category;
		private static $n_cat;
		private static $e_cat;
		private static $multi_select;
		private static $dim_size;
		private static $img_width;
		private static $img_height;
		private static $thumb_img_width;
		private static $thumb_img_height;
		private static $caption;
		private static $thumb;
		private static $desc;
		private static $publish;
		private static $album_id;
		private static $album_category_id;
		private static $content_id;
		private static $path;
		
		public static function rip_content() // set up fields
		{
			extract($_POST);
			self::$album = $album;
			self::$e_album = $e_album_name;
			self::$n_album = htmlentities($n_album_name);
			self::$album_category = $album_cat;
			self::$n_cat = htmlentities($n_cat_name);
			self::$e_cat = $e_cat_name;
			if(isset($multi)){self::$multi_select = $multi;}
			self::$dim_size = $size;
			self::$thumb = $thumb;
			self::$img_width = $img_width;
			self::$img_height = $img_height;
			self::$thumb_img_width = $thumb_img_width;
			self::$thumb_img_height = $thumb_img_height;
			self::$caption = htmlentities($caption);
			self::$desc = htmlentities($desc);
			self::$publish = $publish;
			if(isset($_GET['id'])){self::$content_id = $_GET['id'];}
			if(isset($path)){self::$path = $path;}
			
		}
				
		public static function build_album()
		{
			gallery_class::rip_content(); // call rip_content method
			
			// Get image dimension
			if(self::$dim_size == "default")
			{
				$toWidth = 500; // default image width
				$toHeight = 400; // default image height
			}
			else
			{
				$toWidth = self::$img_width;
				$toHeight = self::$img_height;
			}
			
			// Get image thumb dimension
			if(self::$thumb == "No")
			{
				$thumbWidth = 300; // default thumb image width
				$thumbHeight = 250; // default thumb image height
			}
			else
			{
				$thumbWidth = self::$thumb_img_width;
				$thumbHeight = self::$thumb_img_height;
			}
			
			gallery_class::check_img_to_upload($toWidth, $toHeight, $thumbWidth, $thumbHeight); // call check_img_to_upload method
			
						
		}
				
		private static function get_album_index() // get album id from existing album
		{
			$project_name = PROJECTNAME;
			$e_name = self::$e_album;
			$sql = mysql_query("SELECT album_id FROM album WHERE album_name = '$e_name'") or die(mysql_error());
			$result = mysql_fetch_object($sql);
			if(!$sql)
			{ 
				$val = false;
				echo "<script>alert('Sorry cannot get album index! Database error!');document.location.href='.?$project_name=Control Panel&INC=Photo Manager&CMD=Upload Picture&msg=Database error!'</script>";
			}
			else
			{ 
				$val = $result->album_id; 
			}
			return $val;
		}
		
		private static function get_album_category_index() // get album category id from existing category
		{
			$project_name = PROJECTNAME;
			$e_category = self::$e_cat;
			$sql = mysql_query("SELECT type_id FROM album_type WHERE type_name = '$e_category'") or die(mysql_error());
			$result = mysql_fetch_object($sql);
			if(!$sql)
			{ 
				$val = false;
				echo "<script>alert('Sorry cannot get album category index! Database error!');document.location.href='.?$project_name=Control Panel&INC=Photo Manager&CMD=Upload Picture&msg=Database error!'</script>";
			}
			else
			{ 
				$val = $result->type_id; 
			}
			return $val;
			
		}
		
		private static function create_album() // create new album
		{
			$project_name = PROJECTNAME;
			$n_name = self::$n_album;
			
			$sql = mysql_query("SELECT * FROM album WHERE album_name = '$n_name'") or die(mysql_error());
			$result = mysql_num_rows($sql);
			if($result == 0)
			{
				$sql = mysql_query("INSERT INTO album SET album_name = '$n_name'") or die(mysql_error());
				if(!$sql)
				{ 
					$val = false;
					echo "<script>alert('Sorry cannot Upload Picture! Database error!');document.location.href='.?$project_name=Control Panel&INC=Photo Manager&CMD=Upload Picture&msg=Database error!'</script>";
				}
				else
				{
					$sql = mysql_query("SELECT album_id FROM album WHERE album_name = '$n_name'") or die('Error in query!');
					$result = mysql_fetch_object($sql);
					$val = $result->album_id;
				}
			}
			else
			{
					$val = false;
					echo "<script>alert('Album Already Exists!');document.location.href='.?$project_name=Control Panel&INC=Photo Manager&CMD=Upload Picture&msg=Album Already Exist!'</script>";
					
			}
			
			return $val;
			
		}
		
		private static function create_album_category() // create new album category
		{
			$project_name = PROJECTNAME;
			$n_category = self::$n_cat;
			
			$sql = mysql_query("SELECT type_id FROM album_type WHERE type_name = '$n_category'") or die(mysql_error());
			$result = mysql_fetch_object($sql);
			if($result == 0)
			{
				$sql = mysql_query("INSERT INTO album_type SET type_name = '$n_category', type_album_id = '".self::$album_id."'") or die(mysql_error());
				if(!$sql)
				{ 
					$val = false;
					echo "<script>alert('Sorry cannot Upload Picture category index! Database error!');document.location.href='.?$project_name=Control Panel&INC=Photo Manager&CMD=Upload Picture&msg=Database error!'</script>";
				}
				else
				{
					$sql = mysql_query("SELECT type_id FROM album_type WHERE type_name = '$n_category'") or die(mysql_error());
					$result = mysql_fetch_object($sql);
					$val = $result->type_id;
				}
			}
			else
			{
				$val = false;
				echo "<script>alert('Album Category Already Exist!');document.location.href='.?$project_name=Control Panel&INC=Photo Manager&CMD=Upload Picture&msg=Album Category Already Exist!'</script>";
				
			}
			
			
			return $val;
			
		}
		
		private static function upload_single_file($toWidth, $toHeight, $thumbWidth, $thumbHeight) // upload single file
		{
			$project_name = PROJECTNAME;
			$alb_val = gallery_class::check_existence_of_album(); // call check_existence_of_album method
			$alb_cat_val = gallery_class::check_existence_of_album_category();  // call check_existence_of_album_category method
			
			if(is_numeric($alb_val) && is_numeric($alb_cat_val))
			{
				
                                require('resize.php');
				$imagetype = $_FILES['fileField']['type'];
							
				$large = "modules/photo_manager/uploads/large/";
				$small = "modules/photo_manager/uploads/small/";
                                //$original = "modules/photo_manager/uploads/original/";
				
				$alphanum = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
				$path_info = pathinfo($_FILES['fileField']['name']);
				$ext = $path_info['extension']; // get file extension
	
				$new_image_name = substr(str_shuffle($alphanum), 0, 10) . "." . $ext; // new image name
				
				$thumb_path     = $large . $new_image_name; 
				$large_path     = $small . $new_image_name;
                                //$original_path  = $original . $new_image_name;
				
				ResizerImage::imageresizer($_FILES['fileField']['tmp_name'], $toWidth, $toHeight, $imagetype, $thumb_path); // Create large image
				ResizerImage::imageresizer($_FILES['fileField']['tmp_name'], $thumbWidth, $thumbHeight, $imagetype, $large_path); // Create thumbnail
				//$uploaded = move_uploaded_file($_FILES['fileField']['tmp_name'],$original_path); //save the original image with its original dimensions
                                
				// Database insertion
                                $sql = mysql_query("INSERT INTO album_content 
                                                       SET content_album_id='".self::$album_id."',
                                                       content_type_id='".self::$album_category_id."',
                                                       img_caption='".self::$caption."',
                                                       img_description='".self::$desc."',
                                                       img_path='$large_path',
                                                       publish='".self::$publish."',
                                                       date_created='".date("F j, Y, g:i a")."',
                                                       date_modified='".date("F j, Y, g:i a")."',
                                                       author='".$_SESSION['validuser']."',
                                                       others='". "Image Name: ".$new_image_name . " Size: ". $toWidth . "x". $toHeight. "'"
                                        );
				
                                echo "<script>document.location.href='.?$project_name=Control Panel&INC=Photo Manager&CMD=Upload Picture&msg=Picture Uploaded!'</script>";				
			}
			
		}
		
		private static function upload_multiple_files($toWidth, $toHeight, $thumbWidth, $thumbHeight) // upload multiple files
		{
			$project_name = PROJECTNAME;
			$alb_val = gallery_class::check_existence_of_album(); // call check_existence_of_album method
			$alb_cat_val = gallery_class::check_existence_of_album_category();  // call check_existence_of_album_category method
			if(is_numeric($alb_val) && is_numeric($alb_cat_val))
			{
				require('resize.php');
				$alphanum = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
							
				$large = "modules/photo_manager/uploads/large/";
				$small = "modules/photo_manager/uploads/small/";
				
				$i = 0;
				foreach($_FILES['img']['name'] as $val)
				{
				   
					$path_info = pathinfo($_FILES['img']['name'][$i]);
					$ext = $path_info['extension']; // get file extension
		
					$new_image_name = substr(str_shuffle($alphanum), 0, 10) . "." . $ext; // new image name
					
					$thumb_path = $large . $new_image_name; 
					$large_path = $small . $new_image_name;
				   
				   ResizerImage::imageresizer($_FILES['img']['tmp_name'][$i], $toWidth, $toHeight, $_FILES['img']['type'][$i], $thumb_path); // Create large image
				   ResizerImage::imageresizer($_FILES['img']['tmp_name'][$i], $thumbWidth, $thumbHeight, $_FILES['img']['type'][$i], $large_path); // Create thumbnail
					// Database insertion
					$sql = mysql_query("INSERT INTO album_content 
									   SET content_album_id='".self::$album_id."',
									   content_type_id='".self::$album_category_id."',
									   img_caption='".self::$caption."',
									   img_description='".self::$desc."',
									   img_path='$large_path',
									   publish='".self::$publish."',
									   date_created='".date("F j, Y, g:i a")."',
									   date_modified='".date("F j, Y, g:i a")."',
									   author='".$_SESSION['validuser']."',
									   others='". "Image Name: ".$new_image_name . " Size: ". $toWidth . "x". $toHeight. "'");
					
					if(!sql)
					{ 
						$msg = "Error occured while creating album!";
						break;
					}
					else
					{ 
						$msg = "Album has been created!"; 
					}
					$i++;
				}
				echo "<script>document.location.href='.?$project_name=Control Panel&INC=Photo Manager&CMD=Upload Picture&msg=Picture Uploaded!'</script>";
			}
		}
		
		private static function check_img_to_upload($toWidth, $toHeight, $thumbWidth, $thumbHeight) // check if file to upload is in correct format
		{
			$project_name = PROJECTNAME;
			$type_array = array("image/jpeg", "image/pjpeg", "image/jpg", "image/pjpg", "image/png", "image/gif");
			 
			if(self::$multi_select == "Yes")
			{
				
				foreach($_FILES['img']['type'] as $val)
				{
					if(!in_array($val, $type_array))
					{
					  echo "<script>alert('Sorry files not uploaded! One or more files have incompatible file format!');document.location.href='.?$project_name=Control Panel&INC=Photo Manager&CMD=Upload Picture&msg=Sorry! One or more files have incompatible file format!'</script>";  
					}
				}
				
			 	gallery_class::upload_multiple_files($toWidth, $toHeight, $thumbWidth, $thumbHeight); // call upload_multiple_files method
			}
			else
			{
				if(!in_array($_FILES['fileField']['type'], $type_array))
				{
				  echo "<script>alert('Sorry file not uploaded! Incompatible file format!');document.location.href='.?$project_name=Control Panel&INC=Photo Manager&CMD=Upload Picture&msg=Sorry file not uploaded! Incompatible file format!'</script>";  
				}
				gallery_class::upload_single_file($toWidth, $toHeight, $thumbWidth, $thumbHeight); // call upload_single_file method
			}
			
		}
		
		private static function check_existence_of_album() // check if album exist else create new one
		{
			// Check for existing album
			if(self::$album == "Existing")
			{
				self::$album_id = gallery_class::get_album_index(); // call get_album_index method
			}
			else
			{ 
				self::$album_id = gallery_class::create_album(); // call create_album method
			}
			
			return self::$album_id;
		}
		
		private static function check_existence_of_album_category() // check if category exist else create new one
		{
			// Check for existing album
			if(self::$album_category == "Existing")
			{
				self::$album_category_id = gallery_class::get_album_category_index(); // call get_album_category_index method
			}
			elseif(self::$album_category == "New")
			{ 
				self::$album_category_id = gallery_class::create_album_category(); // call create_album_album method
			}
			else
			{
				self::$album_category_id = 0; // default value for non category
			}
			
			return self::$album_category_id;
		}
		
		public static function get_existing_albums() // get existing album for drop menu
		{
			$sql = mysql_query("SELECT * FROM album") or die(mysql_error());	
			$num = mysql_num_rows($sql);
			if($num != 0)
			{
				while($rows = mysql_fetch_array($sql))
				{
					echo "<option>$rows[1]</option>";
				}
			}
			else{
				echo "<option>No Album</option>";
			}
		}
		
		public static function get_existing_albums_category() // get existing album category for drop menu
		{
			$sql = mysql_query("SELECT * FROM album_type") or die(mysql_error());	
			$num = mysql_num_rows($sql);
			if($num != 0)
			{
				while($rows = mysql_fetch_array($sql))
				{
					echo "<option>$rows[1]</option>";
				}
			}
			else{
				echo "<option>No Category</option>";
			}
		}
			
		public static function get_all_album() // list all albums
		{
			$project_name = PROJECTNAME;
			$rowsPerPage = 10; // how many rows to show per page
			$pageNum = 1; // by default we show first page
			$inc = 0;
			if(isset($_GET['page']) >= 2)
			{
			$pageNum = $_GET['page'];
			$inc = ($_GET['page'] - 1) * $rowsPerPage;
			} 
					
			$offset = ($pageNum - 1) * $rowsPerPage; // counting the offset
			$j = 1;
			
			$query  = "SELECT * FROM  album ORDER BY album_name ASC LIMIT $offset, $rowsPerPage"; // get records and display it
			$result = mysql_query($query) or die(mysql_error());
			
			echo "<TABLE border=0 width=100% align=center cellpadding=2 cellspacing=1>";
			$c = 1;
			while ($myrow = mysql_fetch_array($result))
			{
				
				if($c % 2 == 0) {	$bgcolor="#FFFFFF";  }  else {  $bgcolor="#F9F9F9";  }
				$c++;
				echo "<TR>";
				
				echo "<TD width=35 height=40 align=left bgcolor=$bgcolor>&nbsp;";
				echo $inc + $j++;
							
				echo "<TD width=314 height=40 align=left  bgcolor=$bgcolor>&nbsp;";
				echo ucwords($myrow["album_name"]);
				
				echo "<TD width=153 height=40 align=left bgcolor=$bgcolor>&nbsp;";
				$get = gallery_class::get_no_of_sub_album($myrow["album_id"]); // Get the number of children this page has
				
                                /*if($get['num'] == 0)
                                {
					echo $get['num'];
				}
                                */
                                if($get == 0)
                                {
                                    echo $get;
                                }
				else
				{
					echo "<a href=\"?$project_name=Control Panel&INC=Photo Manager&CMD=View Sub Albums&alb=".$myrow["album_name"]."&id=$myrow[0]\">".$get['num']."</a>";
				}
			
					echo "<TD width=35 height=40 align=center bgcolor=$bgcolor>";
				?><a href="?<?= $project_name; ?>=Control Panel&INC=Photo Manager&CMD=Delete Album&id=<?= $myrow["album_id"]; ?>" onclick="return confirm('Deleting This Album Will Delete All Sub-Albums If Present!');"><img src="modules/photo_manager/images/b_drop.png" alt="Delete Record" width="16" height="16" border="0" /></a><?
				
			}
			echo "</TABLE>";
			
			$query2   = "SELECT COUNT(album_id) AS numrows FROM  album"; // how many rows we have in database
			$result2  = mysql_query($query2) or die(mysql_error());
			$row2     = mysql_fetch_array($result2);
			$numrows = $row2['numrows'];
			if($numrows != 0)
			{
			// how many pages we have when using paging?
			$maxPage = ceil($numrows/$rowsPerPage);
			
				if ($pageNum > 1)
				{
					$page = $pageNum - 1;
					
					$prev = "<a href=\"?$project_name=Control Panel&INC=Photo Manager&page=$page\"><img src='images/rewind.png' alt='Previous Page' width=16 height=16 border=0></a>";
					
					$first = "<a href=\"?$project_name=Control Panel&INC=Photo Manager&page=1\"><img src='images/skip_backward.png' alt='First Page' width=16 height=16 border=0></a>";
				} 
				else
				{
					$prev  = "<img src='modules/photo_manager/images/rewind.png' alt='Previous Page' width=16 height=16 border=0>";
					// we're on page one, don't enable 'previous' link
					$first = "<img src='modules/photo_manager/images/skip_backward.png' alt='First Page' width=16 height=16 border=0>";
					// nor 'first page' link
				}
			
				// print 'next' link only if we're not
				// on the last page
				if ($pageNum < $maxPage)
				{
					$page = $pageNum + 1;
					
					$next = "<a href=\"?$project_name=Control Panel&INC=Photo Manager&page=$page\"><img src='modules/photo_manager/images/fast_forward.png' alt='Next Page' width=16 height=16 border=0></a>";
					
					$last = "<a href=\"?$project_name=Control Panel&INC=Photo Manager&page=$maxPage\"><img src='modules/photo_manager/images/skip_forward.png' alt='Last Page' width=16 height=16 border=0></a>";
					
				} 
				else
				{
					$next = "<img src='modules/photo_manager/images/fast_forward.png' alt='Next Page' width=16 height=16 border=0>";      // we're on the last page, don't enable 'next' link
					$last = "<img src='modules/photo_manager/images/skip_forward.png' alt='Last Page' width=16 height=16 border=0>"; // nor 'last page' link
				
				}
			
			// print the page navigation link
	
echo <<<NavBar
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="background-image:url(modules/photo_manager/images/m.png)">
<tr>
<td height="26" align="center" valign="middle"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td width="22%" align="center" valign="middle">&nbsp;</td>
<td width="4%" align="center" valign="middle">		$first	</td>
<td width="4%" align="center" valign="middle">		$prev	</td>
<td width="4%" align="center" valign="middle">		$next	</td>
<td width="4%" align="center" valign="middle">		$last	</td>
<td width="36%" align="left" valign="middle">&nbsp;&nbsp;Page <font color='#FF6600'><strong>$pageNum</strong></font> of  <font color='#FF6600'><strong>$numrows</strong></font> Records &nbsp;</td>
</tr>
</table></td>
</tr>
</table>
NavBar;
	        }
			else
			{
echo <<<NavBar2
<p><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td align="left" valign="middle">&nbsp;&nbsp;<img src="modules/photo_manager/images/warning.gif" /><font color="#FF6600"> No Album Found!</font></td>
</tr>
</table>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="background-image:url(modules/photo_manager/images/m.jpg)">
<tr>
<td height="26" align="center" valign="middle"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
</tr>
</table></td>
</tr>
</table><br/>
NavBar2;
			}
	
		}
		
		public static function get_all_sub_albums() // list all sub albums
		{
			extract($_GET);
			
			$project_name = PROJECTNAME;
			$rowsPerPage = 10; // how many rows to show per page
			$pageNum = 1; // by default we show first page
			$inc = 0;
			if(isset($_GET['page']) >= 2)
			{
			$pageNum = $_GET['page'];
			$inc = ($_GET['page'] - 1) * $rowsPerPage;
			}  
					
			$offset = ($pageNum - 1) * $rowsPerPage; // counting the offset
			$j = 1;
			
			$query  = "SELECT * FROM  album_type WHERE type_album_id='$id' ORDER BY type_name ASC LIMIT $offset, $rowsPerPage"; // get records and display it
			$result = mysql_query($query) or die(mysql_error());
			
			echo "<TABLE border=0 width=100% align=center cellpadding=2 cellspacing=1>";
			$c = 1;
			while ($myrow = mysql_fetch_array($result))
			{
				
				if($c % 2 == 0) {	$bgcolor="#FFFFFF";  }  else {  $bgcolor="#F9F9F9";  }
				$c++;
				echo "<TR>";
				
				echo "<TD width=20 height=40 align=left bgcolor=$bgcolor>&nbsp;";
				echo $inc + $j++;
				echo "<TD width=200 height=40 align=left bgcolor=$bgcolor>&nbsp;";
				echo ucwords($myrow["type_name"]);
				
				echo "<TD width=200 height=40 align=left bgcolor=$bgcolor>&nbsp;";
				$get = gallery_class::get_no_of_img_in_sub_album($myrow["type_id"]); // Get the number of childred this page has
				if($get['num'] == 0)
				{
					echo $get['num'];
				}
				else
				{
					echo "<a href=\"?$project_name=Control Panel&INC=Photo Manager&CMD=View Images In Sub Album&sub_alb=".$myrow["type_name"]."&id=$myrow[0]\">".$get['num']."</a>";
				}
			
					echo "<TD width=20 height=40 align=center bgcolor=$bgcolor>";
				?><a href="?<?= $project_name; ?>=Control Panel&INC=Photo Manager&CMD=Delete Sub Album&alb=<?= $_GET['alb'];?>&album_id=<?= $_GET['id']; ?>&id=<?= $myrow[0]; ?>" onclick="return confirm('Deleting This Sub Album Will Delete All Images In It If Present!');"><img src="modules/photo_manager/images/b_drop.png" alt="Delete Record" width="16" height="16" border="0" /></a><?
				
			}
			echo "</TABLE>";
			
			$query2   = "SELECT COUNT(type_id) AS numrows FROM  album_type WHERE type_album_id='$id'"; // how many rows we have in database
			$result2  = mysql_query($query2) or die(mysql_error());
			$row2     = mysql_fetch_array($result2);
			$numrows = $row2['numrows'];
			if($numrows != 0)
			{
			// how many pages we have when using paging?
			$maxPage = ceil($numrows/$rowsPerPage);
			
				if ($pageNum > 1)
				{
					$page = $pageNum - 1;
					
					$prev = "<a href=\"?$project_name=Control Panel&INC=Photo Manager&CMD=View Sub Albums&page=$page&id=$id\"><img src='images/rewind.png' alt='Previous Page' width=16 height=16 border=0></a>";
					
					$first = "<a href=\"?$project_name=Control Panel&INC=Photo Manager&CMD=View Sub Albums&page=1&id=$id\"><img src='images/skip_backward.png' alt='First Page' width=16 height=16 border=0></a>";
				} 
				else
				{
					$prev  = "<img src='modules/photo_manager/images/rewind.png' alt='Previous Page' width=16 height=16 border=0>";
					// we're on page one, don't enable 'previous' link
					$first = "<img src='modules/photo_manager/images/skip_backward.png' alt='First Page' width=16 height=16 border=0>";
					// nor 'first page' link
				}
			
				// print 'next' link only if we're not
				// on the last page
				if ($pageNum < $maxPage)
				{
					$page = $pageNum + 1;
					
					$next = "<a href=\"?$project_name=Control Panel&INC=Photo Manager&CMD=View Sub Albums&page=$page&id=$id\"><img src='modules/photo_manager/images/fast_forward.png' alt='Next Page' width=16 height=16 border=0></a>";
					
					$last = "<a href=\"?$project_name=Control Panel&INC=Photo Manager&CMD=View Sub Albums&page=$maxPage&id=$id\"><img src='modules/photo_manager/images/skip_forward.png' alt='Last Page' width=16 height=16 border=0></a>";
					
				} 
				else
				{
					$next = "<img src='modules/photo_manager/images/fast_forward.png' alt='Next Page' width=16 height=16 border=0>";      // we're on the last page, don't enable 'next' link
					$last = "<img src='modules/photo_manager/images/skip_forward.png' alt='Last Page' width=16 height=16 border=0>"; // nor 'last page' link
				
				}
			
			// print the page navigation link
	
echo <<<NavBar
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="background-image:url(modules/photo_manager/images/m.png)">
<tr>
<td height="26" align="center" valign="middle"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td width="22%" align="center" valign="middle">&nbsp;</td>
<td width="4%" align="center" valign="middle">		$first	</td>
<td width="4%" align="center" valign="middle">		$prev	</td>
<td width="4%" align="center" valign="middle">		$next	</td>
<td width="4%" align="center" valign="middle">		$last	</td>
<td width="36%" align="left" valign="middle">&nbsp;&nbsp;Page <font color='#FF6600'><strong>$pageNum</strong></font> of  <font color='#FF6600'><strong>$numrows</strong></font> Records &nbsp;</td>
</tr>
</table></td>
</tr>
</table>
NavBar;
	        }
			else
			{
echo <<<NavBar2
<p><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td align="left" valign="middle">&nbsp;&nbsp;<img src="modules/photo_manager/images/warning.gif" /><font color="#FF6600"> No Sub Album Found!</font></td>
</tr>
</table>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="background-image:url(modules/photo_manager/images/m.jpg)">
<tr>
<td height="26" align="center" valign="middle"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
</tr>
</table></td>
</tr>
</table><br/>
NavBar2;
			}
	
		}
		
		public static function get_all_images_in_sub_album() // list all images of sub albums
		{
			extract($_GET);
			
			$project_name = PROJECTNAME;
			$rowsPerPage = 10; // how many rows to show per page
			$pageNum = 1; // by default we show first page
			$inc = 0;
			if(isset($_GET['page']) >= 2)
			{
			$pageNum = $_GET['page'];
			$inc = ($_GET['page'] - 1) * $rowsPerPage;
			} 
					
			$offset = ($pageNum - 1) * $rowsPerPage; // counting the offset
			$j = 1;
			
			$query  = "SELECT * FROM  album_content WHERE content_type_id='$id' ORDER BY content_id ASC LIMIT $offset, $rowsPerPage"; // get records and display it
			$result = mysql_query($query) or die(mysql_error());
			
			echo "<TABLE border=0 width=100% align=center cellpadding=2 cellspacing=1>";
			$c = 1;
			while ($myrow = mysql_fetch_array($result))
			{
				
				if($c % 2 == 0) {	$bgcolor="#FFFFFF";  }  else {  $bgcolor="#F9F9F9";  }
				$c++;
				echo "<TR>";
				echo "<TD width=20 height=40 align=left bgcolor=$bgcolor>&nbsp;";
				echo $inc + $j++;
							
				echo "<TD width=180 height=40 align=left  bgcolor=$bgcolor>&nbsp;";
				$miniContent = (strlen($myrow["img_caption"]) > 30 ) ? substr($myrow["img_caption"], 0, 30) . " ... " : $myrow["img_caption"];
				echo $miniContent;	
				
				echo "<TD width=180 height=40 align=left bgcolor=$bgcolor>&nbsp;";
				echo $myrow["others"];
				
				echo "<TD width=20 height=30 align=center bgcolor=$bgcolor>";
				?><a href="?<?= $project_name; ?>=Control Panel&INC=Photo Manager&CMD=View Image&sub_alb=<?= $_GET['sub_alb']; ?>&sub_album_id=<?=$_GET['id'];?>&id=<?= $myrow["content_id"];?>"><img src="modules/photo_manager/images/b_browse.png" alt="View Content" width="16" height="16" border="0" /></a><?
				
					echo "<TD width=20 height=30 align=center bgcolor=$bgcolor>";
				?><a href="?<?= $project_name; ?>=Control Panel&INC=Photo Manager&CMD=Edit Image&sub_alb=<?= $_GET['sub_alb']; ?>&sub_album_id=<?=$_GET['id'];?>&id=<?= $myrow["content_id"];?>"><img src="modules/photo_manager/images/b_edit.png" alt="Edit Content" width="16" height="16" border="0" /></a><?
				
					echo "<TD width=20 height=40 align=center bgcolor=$bgcolor>";
				?><a href="?<?= $project_name; ?>=Control Panel&INC=Photo Manager&CMD=Delete Image&sub_alb=<?= $_GET['sub_alb']; ?>&sub_album_id=<?=$_GET['id'];?>&id=<?= $myrow["content_id"]; ?>" onclick="return confirm('Are You Sure You Want To Delete This Image(Y/N)?');"><img src="modules/photo_manager/images/b_drop.png" alt="Delete Record" width="16" height="16" border="0" /></a><?
								
			}
			echo "</TABLE>";
			
			$query2   = "SELECT COUNT(content_type_id) AS numrows FROM  album_content WHERE content_type_id='$id'"; // how many rows we have in database
			$result2  = mysql_query($query2) or die(mysql_error());
			$row2     = mysql_fetch_array($result2);
			$numrows = $row2['numrows'];
			if($numrows != 0)
			{
			// how many pages we have when using paging?
			$maxPage = ceil($numrows/$rowsPerPage);
			
				if ($pageNum > 1)
				{
					$page = $pageNum - 1;
					
					$prev = "<a href=\"?$project_name=Control Panel&INC=Photo Manager&CMD=View Images In Sub Album&page=$page&id=$id\"><img src='images/rewind.png' alt='Previous Page' width=16 height=16 border=0></a>";
					
					$first = "<a href=\"?$project_name=Control Panel&INC=Photo Manager&CMD=View Images In Sub Album&page=1&id=$id\"><img src='images/skip_backward.png' alt='First Page' width=16 height=16 border=0></a>";
				} 
				else
				{
					$prev  = "<img src='modules/photo_manager/images/rewind.png' alt='Previous Page' width=16 height=16 border=0>";
					// we're on page one, don't enable 'previous' link
					$first = "<img src='modules/photo_manager/images/skip_backward.png' alt='First Page' width=16 height=16 border=0>";
					// nor 'first page' link
				}
			
				// print 'next' link only if we're not
				// on the last page
				if ($pageNum < $maxPage)
				{
					$page = $pageNum + 1;
					
					$next = "<a href=\"?$project_name=Control Panel&INC=Photo Manager&CMD=View Images In Sub Album&page=$page&id=$id\"><img src='modules/photo_manager/images/fast_forward.png' alt='Next Page' width=16 height=16 border=0></a>";
					
					$last = "<a href=\"?$project_name=Control Panel&INC=Photo Manager&CMD=View Images In Sub Album&page=$maxPage&id=$id\"><img src='modules/photo_manager/images/skip_forward.png' alt='Last Page' width=16 height=16 border=0></a>";
					
				} 
				else
				{
					$next = "<img src='modules/photo_manager/images/fast_forward.png' alt='Next Page' width=16 height=16 border=0>";      // we're on the last page, don't enable 'next' link
					$last = "<img src='modules/photo_manager/images/skip_forward.png' alt='Last Page' width=16 height=16 border=0>"; // nor 'last page' link
				
				}
			
			// print the page navigation link
	
echo <<<NavBar
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="background-image:url(modules/photo_manager/images/m.png)">
<tr>
<td height="26" align="center" valign="middle"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td width="22%" align="center" valign="middle">&nbsp;</td>
<td width="4%" align="center" valign="middle">		$first	</td>
<td width="4%" align="center" valign="middle">		$prev	</td>
<td width="4%" align="center" valign="middle">		$next	</td>
<td width="4%" align="center" valign="middle">		$last	</td>
<td width="36%" align="left" valign="middle">&nbsp;&nbsp;Page <font color='#FF6600'><strong>$pageNum</strong></font> of  <font color='#FF6600'><strong>$numrows</strong></font> Records &nbsp;</td>
</tr>
</table></td>
</tr>
</table>
NavBar;
	        }
			else
			{
echo <<<NavBar2
<p><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td align="left" valign="middle">&nbsp;&nbsp;<img src="modules/photo_manager/images/warning.gif" /><font color="#FF6600"> No Image Found!</font></td>
</tr>
</table>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="background-image:url(modules/photo_manager/images/m.jpg)">
<tr>
<td height="26" align="center" valign="middle"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
</tr>
</table></td>
</tr>
</table><br/>
NavBar2;
			}
	
		}
		
		public static function get_all_album_images() // list all albums images
		{
			//
			$project_name = PROJECTNAME;
			$rowsPerPage = 10; // how many rows to show per page
			$pageNum = 1; // by default we show first page
			$inc = 0;
			if(isset($_GET['page']) >= 2)
			{
			$pageNum = $_GET['page'];
			$inc = ($_GET['page'] - 1) * $rowsPerPage;
			} 
					
			$offset = ($pageNum - 1) * $rowsPerPage; // counting the offset
			$j = 1;
			
			$query  = "SELECT * FROM  album_content ORDER BY content_album_id  ASC LIMIT $offset, $rowsPerPage"; // get records and display it
			$result = mysql_query($query) or die(mysql_error());
			$c=1;
			while ($myrow = mysql_fetch_array($result))
			{
				if($c % 2 == 0) {	$bgcolor="#FFFFFF";  }  else {  $bgcolor="#F9F9F9";  }
				$c++;
				?>
            	  <tr>
                    <td height="35" align="left" valign="middle" bgcolor="<?= $bgcolor; ?>" ><?= $inc + $j++; ?></td>
                    <td align="left" valign="middle"  bgcolor="<?= $bgcolor; ?>"><?= gallery_class::album_name($myrow["content_album_id"]); // Get the album name using the id ?></td>
                    <td align="left" valign="middle"  bgcolor="<?= $bgcolor; ?>"><?
                    if($myrow["content_type_id"] == 0){ echo "Non";}
					else
					{ 
						echo gallery_class::get_sub_album_name($myrow["content_type_id"]); // Get the album type name using the id
					}
				
				    ?></td>
                    <td align="left" valign="middle"  bgcolor="<?= $bgcolor; ?>">
                    <?
						$caption = (strlen($myrow["img_caption"]) > 30 ) ? substr($myrow["img_caption"], 0, 30) . " ... " : $myrow["img_caption"];
	                    echo $caption;
					?>                    
					</td>
                    <td align="left" valign="middle"  bgcolor="<?= $bgcolor; ?>"><a href="?<?= $project_name; ?>=Control Panel&INC=Photo Manager&CMD=View Image&PLA=All&id=<?= $myrow["content_id"];?>"><img src="modules/photo_manager/images/b_browse.png" alt="View Content" width="16" height="16" border="0" /></a></td>
                    <td align="left" valign="middle"  bgcolor="<?= $bgcolor; ?>"><a href="?<?= $project_name; ?>=Control Panel&INC=Photo Manager&CMD=Edit Image&PLA=All&sub_album_id=<?=$myrow["content_type_id"];?>&id=<?= $myrow["content_id"];?>"><img src="modules/photo_manager/images/b_edit.png" alt="Edit Content" width="16" height="16" border="0" /></a></td>
                    <td align="left" valign="middle"  bgcolor="<?= $bgcolor; ?>"><a href="?<?= $project_name; ?>=Control Panel&INC=Photo Manager&CMD=Delete Image&id=<?= $myrow["content_id"]; ?>" onclick="return confirm('Are You Sure You Want To Delete This Image (Y/N)?');"><img src="modules/photo_manager/images/b_drop.png" alt="Delete Record" width="16" height="16" border="0" /></a></td>
                  </tr>
                <?
			}
			
			$query2   = "SELECT COUNT(content_type_id) AS numrows FROM  album_content"; // how many rows we have in database
			$result2  = mysql_query($query2) or die(mysql_error());
			$row2     = mysql_fetch_array($result2);
			$numrows = $row2['numrows'];
			if($numrows != 0)
			{
			// how many pages we have when using paging?
			$maxPage = ceil($numrows/$rowsPerPage);
			
				if ($pageNum > 1)
				{
					$page = $pageNum - 1;
					
					$prev = "<a href=\"?$project_name=Control Panel&INC=Photo Manager&CMD=View Album Images&page=$page\"><img src='images/rewind.png' alt='Previous Page' width=16 height=16 border=0></a>";
					
					$first = "<a href=\"?$project_name=Control Panel&INC=Photo Manager&CMD=View Album Images&page=1\"><img src='images/skip_backward.png' alt='First Page' width=16 height=16 border=0></a>";
				} 
				else
				{
					$prev  = "<img src='modules/photo_manager/images/rewind.png' alt='Previous Page' width=16 height=16 border=0>";
					// we're on page one, don't enable 'previous' link
					$first = "<img src='modules/photo_manager/images/skip_backward.png' alt='First Page' width=16 height=16 border=0>";
					// nor 'first page' link
				}
			
				// print 'next' link only if we're not
				// on the last page
				if ($pageNum < $maxPage)
				{
					$page = $pageNum + 1;
					
					$next = "<a href=\"?$project_name=Control Panel&INC=Photo Manager&CMD=View Album Images&page=$page\"><img src='modules/photo_manager/images/fast_forward.png' alt='Next Page' width=16 height=16 border=0></a>";
					
					$last = "<a href=\"?$project_name=Control Panel&INC=Photo Manager&CMD=View Album Images&page=$maxPage\"><img src='modules/photo_manager/images/skip_forward.png' alt='Last Page' width=16 height=16 border=0></a>";
					
				} 
				else
				{
					$next = "<img src='modules/photo_manager/images/fast_forward.png' alt='Next Page' width=16 height=16 border=0>";      // we're on the last page, don't enable 'next' link
					$last = "<img src='modules/photo_manager/images/skip_forward.png' alt='Last Page' width=16 height=16 border=0>"; // nor 'last page' link
				
				}
			
			// print the page navigation link
	
echo <<<NavBar
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="background-image:url(modules/photo_manager/images/m.png)">
<tr>
<td height="26" align="center" valign="middle"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td width="22%" align="center" valign="middle">&nbsp;</td>
<td width="4%" align="center" valign="middle">		$first	</td>
<td width="4%" align="center" valign="middle">		$prev	</td>
<td width="4%" align="center" valign="middle">		$next	</td>
<td width="4%" align="center" valign="middle">		$last	</td>
<td width="36%" align="left" valign="middle">&nbsp;&nbsp;Page <font color='#FF6600'><strong>$pageNum</strong></font> of  <font color='#FF6600'><strong>$numrows</strong></font> Records &nbsp;</td>
</tr>
</table></td>
</tr>
</table>
NavBar;
	        }
			else
			{
echo <<<NavBar2
<p><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td align="left" valign="middle">&nbsp;&nbsp;<img src="modules/photo_manager/images/warning.gif" /><font color="#FF6600"> No Image Found!</font></td>
</tr>
</table>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="background-image:url(modules/photo_manager/images/m.jpg)">
<tr>
<td height="26" align="center" valign="middle"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
</tr>
</table></td>
</tr>
</table><br/>
NavBar2;
			}
		}
		
		private static function get_no_of_sub_album($album_id) // get the total number of sub albums
		{
			$query = @mysql_query("SELECT * FROM album_type WHERE type_album_id = '$album_id'");
			$result = @mysql_num_rows($query);
			$row = mysql_fetch_object($query);
			if($result != 0)
			{
				$no_of_sub = array('num'=>$result, 'alb_id'=>$row->type_album_id);
			}
			else
			{
				$no_of_sub = "0";
			}
			
			return $no_of_sub;
		}
		
		private static function get_no_of_img_in_sub_album($type_id) // get the total number of images in sub album
		{
			$query = @mysql_query("SELECT * FROM album_content WHERE content_type_id = '$type_id'") or die(mysql_error());
			$result = @mysql_num_rows($query);
			$row = mysql_fetch_object($query);
			if($result != 0)
			{
				$no_of_imgs = array('num'=>$result, 'sub_id'=>$row->content_type_id);
			}
			else
			{
				$no_of_imgs = "0";
			}
			
			return $no_of_imgs;
		}
		
		
		private static function get_sub_album_name($sub_id) // get sub albums name
		{
			$query = mysql_query("SELECT * FROM album_type WHERE type_id = '$sub_id'") or die(mysql_error());
			$result = mysql_fetch_object($query);
			$num = mysql_num_rows($query);
			if($num != 0)
			{
				$name_of_sub = $result->type_name;
			}
			else
			{
				$name_of_sub = "Non";
			}
			return $name_of_sub;
		}
		
		
		public static function delete_album() //delete entire album
		{
			$project_name = PROJECTNAME;
			extract($_GET);
			mysql_query("START TRANSACTION");
			mysql_query("SET autocommit=0");
			$album_sql = @mysql_query("DELETE FROM album WHERE album_id='$id'") or die(mysql_error());
			$album_cat_sql = @mysql_query("DELETE FROM album_type WHERE 	type_album_id='$id'") or die(mysql_error());
			$sql = mysql_query("SELECT img_path FROM album_content WHERE  content_album_id='$id'");
			while($result = mysql_fetch_array($sql))
			{
				$img_path_large = basename($result["img_path"]);
				@unlink("modules/photo_manager/uploads/large/".$img_path_large); // unlink large images
				@unlink($result["img_path"]); // unlink thumbnails
			}
			$album_contenet_sql = @mysql_query("DELETE FROM album_content WHERE content_album_id='$id'") or die(mysql_error());
			
			//mysql_query("ROLLBACK");			
			mysql_query("COMMIT");
			echo "<script>document.location.href='.?$project_name=Control Panel&INC=Photo Manager&msg=Album Deleted!'</script>";
		}
		
		public static function delete_sub_album() //delete entire sub album
		{
			$project_name = PROJECTNAME;
			extract($_GET);
			$sql = mysql_query("SELECT img_path FROM album_content WHERE  content_album_id='$id'");
			while($result = mysql_fetch_array($sql))
			{
				$img_path_large = basename($result["img_path"]);
				@unlink("modules/photo_manager/uploads/large/".$img_path_large); // unlink large images
				@unlink($result["img_path"]); // unlink thumbnails
			}
			
			$content_sql = mysql_query("DELETE FROM album_content WHERE content_type_id='$id'");
			$sub_album_sql = mysql_query("DELETE FROM album_type WHERE type_id='$id'");
			if(!$content_sql || !$sub_album_sql)
			{
				echo "<script>document.location.href='.?$project_name=Control Panel&INC=Photo Manager&CMD=View Sub Albums&alb=$alb&id=$album_id&msg=Sub Album Not Deleted!'</script>";
			}
			else
			{
				echo "<script>document.location.href='.?$project_name=Control Panel&INC=Photo Manager&CMD=View Sub Albums&alb=$alb&id=$album_id&msg=Sub Album Deleted!'</script>";
			}
		}
		
		public static function delete_image() // single image
	    {
			$project_name = PROJECTNAME;
			extract($_GET);
			$sql = mysql_query("SELECT img_path FROM album_content WHERE  content_id='$id'") or die(mysql_error());
			$result = mysql_fetch_object($sql);
			$img_base= basename($result->img_path);
			$large = "modules/photo_manager/uploads/large/".$img_base;
                        $original = "modules/photo_manager/uploads/original/".$img_base;
			$small = $result->img_path;
			if(file_exists($large) && file_exists($small))
			{
				@unlink($large); // unlink large images
				@unlink($small); // unlink thumbnails
                                //@unlink($original); // unlink original
			}
			
			mysql_query("DELETE FROM album_content WHERE content_id='$id'") or die(mysql_error());
			
			if(!empty($sub_album_id))
			{
				echo "<script>document.location.href='.?$project_name=Control Panel&INC=Photo Manager&CMD=View Images In Sub Album&sub_alb=$sub_alb&id=$sub_album_id&msg=Image Deleted!'</script>";
			}
			else
			{
				echo "<script>document.location.href='.?$project_name=Control Panel&INC=Photo Manager&CMD=View Album Images&msg=Image Deleted!'</script>";
			}
			
			
		}
		
		
		private static function album_name($id) // return album name using id
		{
			$sql = mysql_query("SELECT * FROM album WHERE album_id='$id'");
			$result = mysql_fetch_object($sql);
			return $result->album_name;
		}
		
		
		private static function album_cat_id($a_id) // return album category id using album id
		{
			$sql = mysql_query("SELECT * FROM album_type WHERE type_album_id='$a_id'");
			$result = mysql_fetch_object($sql);
			return $result->type_id ;
		}
		
		public static function get_image_details() // image details
		{
			extract($_GET);
			$sql = mysql_query("SELECT * FROM album_content WHERE  content_id='$id'") or die(mysql_error());
			$result = mysql_fetch_object($sql);
			$sub_album_name = gallery_class::get_sub_album_name($result->content_type_id);
			$album_name = gallery_class::album_name($result->content_album_id);
			$arr_img = array('sub_album_name'=>$sub_album_name, 'album_name'=>$album_name, 'others'=>$result->others,
							 'cap'=>$result->img_caption, 'desc'=>$result->img_description, 'pub'=>$result->publish, 
							 'dc'=>$result->date_created, 'dm'=>$result->date_modified, 'auth'=>$result->author, 'path'=>$result->img_path);
			return $arr_img;
		}
		
		public static function update_image() // image updater
		{
			gallery_class::rip_content(); // call rip_content method
			
			// Get image dimension
			if(self::$dim_size == "default")
			{
				$toWidth = 500; // default image width
				$toHeight = 400; // default image height
			}
			else
			{
				$toWidth = self::$img_width;
				$toHeight = self::$img_height;
			}
			
			// Get image thumb dimension
			if(self::$thumb == "No")
			{
				$thumbWidth = 300; // default thumb image width
				$thumbHeight = 280; // default thumb image height
			}
			else
			{
				$thumbWidth = self::$thumb_img_width;
				$thumbHeight = self::$thumb_img_height;
			}
			
				
				if(!empty($_FILES['fileField']['name']))
				{
					gallery_class::check_img_to_update($toWidth, $toHeight, $thumbWidth, $thumbHeight); // call check_img_to_upload method
				}
				else
				{
					gallery_class::update_image_record($toWidth, $toHeight, $thumbWidth, $thumbHeight); // call image_upload_record method	
				}
			
		}
		
		private static function check_img_to_update($toWidth, $toHeight, $thumbWidth, $thumbHeight) // check if file to upload as update is in correct format
		{
			$cid = self::$content_id;
			$project_name = PROJECTNAME;
			$type_array = array("image/jpeg", "image/jpg", "image/pjpg", "image/pjpeg", "image/png", "image/gif");
			
			if(!in_array($_FILES['fileField']['type'], $type_array))
			{
			  echo "<script>alert('Sorry file not uploaded! Incompatible file format!');document.location.href='.?$project_name=Control Panel&INC=Photo Manager&CMD=Edit Image&id=$cid&msg=Sorry file not uploaded! Incompatible file format!'</script>";  
			}
			else
			{
			  gallery_class::update_image_record($toWidth, $toHeight, $thumbWidth, $thumbHeight); // call update_image_record method
			}
			
		}
		
		private static function update_image_record($toWidth, $toHeight, $thumbWidth, $thumbHeight) // upload image and update info in database
		{
			extract($_GET);
			$project_name = PROJECTNAME;
			$alb_val = gallery_class::check_existence_of_album(); // call check_existence_of_album method
			$alb_cat_val = gallery_class::check_existence_of_album_category();  // call check_existence_of_album_category method
			
			if(is_numeric($alb_val) && is_numeric($alb_cat_val))
			{
				$cid = self::$content_id;
			
				if(!empty($_FILES['fileField']['name']))
				{
				require('resize.php');
				$imagetype = $_FILES['fileField']['type'];
							
				$large = "modules/photo_manager/uploads/large/";
				$small = "modules/photo_manager/uploads/small/";
				
				$alphanum = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
				$path_info = pathinfo($_FILES['fileField']['name']);
				$ext = $path_info['extension']; // get file extension
	
				$new_image_name = substr(str_shuffle($alphanum), 0, 10) . "." . $ext; // new image name
				
				$thumb_path = $large . $new_image_name; 
				$large_path = $small . $new_image_name;
				
				ResizerImage::imageresizer($_FILES['fileField']['tmp_name'], $toWidth, $toHeight, $imagetype, $thumb_path); // Create large image
				ResizerImage::imageresizer($_FILES['fileField']['tmp_name'], $thumbWidth, $thumbHeight, $imagetype, $large_path); // Create thumbnail
				
				$img_path_large = basename(self::$path);
				@unlink("modules/photo_manager/uploads/large/".$img_path_large); // unlink large images
				@unlink(self::$path); // unlink thumbnails
						
				// Database insertion
					$sql = mysql_query("UPDATE album_content 
									   SET content_album_id='".self::$album_id."',
									   content_type_id='".self::$album_category_id."',
									   img_caption='".self::$caption."',
									   img_description='".self::$desc."',
									   img_path='$large_path',
									   publish='".self::$publish."',
									   date_modified='".date("F j, Y, g:i a")."',
									   others='". "Image Name: ".$new_image_name . " Size: ". $toWidth . "x". $toHeight. "'
									   WHERE content_id='$cid'");
				}
				else
				{
					// Database insertion
					$sql = mysql_query("UPDATE album_content 
									   SET content_album_id='".self::$album_id."',
									   content_type_id='".self::$album_category_id."',
									   img_caption='".self::$caption."',
									   img_description='".self::$desc."',
									   publish='".self::$publish."',
									   date_modified='".date("F j, Y, g:i a")."',
									   others='". "Image Name: ".$new_image_name . " Size: ". $toWidth . "x". $toHeight. "'
									   WHERE content_id='$cid'");
				}
				
				if($PLA == "All")
				{
					echo "<script>document.location.href='.?$project_name=Control Panel&INC=Photo Manager&CMD=Edit Image&PLA=All&sub_album_id=$sub_album_id&id=$cid&msg=Image Updated!'</script>";	
				}
				else
				{
					echo "<script>document.location.href='.?$project_name=Control Panel&INC=Photo Manager&CMD=Edit Image&sub_alb=$sub_alb&sub_album_id=$sub_album_id&id=$id&msg=Image Updated!'</script>";	
				}
			
		}
		
			
	}
			
	} // End of class
	
	
	
?>