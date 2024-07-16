<?
	class news_class{
		
		private static $author;
		private static $c_date;
		private static $m_date;
		private static $nname;
		private static $ntitle;
		private static $sum;
		private static $parent_nam;
		private static $pub;
		private static $height;
		private static $width;
		private static $image_chk;
		private static $size;
		private static $content;
		private static $news_cat;
		private static $img;
		
		public static function set_fields() // set all fields
		{
			extract($_POST);
			self::$author = $_SESSION['validuser'];
			self::$c_date = date("F j, Y, g:i a");  
			self::$m_date = date("F j, Y, g:i a");  
			self::$nname = htmlentities($news_name);
			self::$ntitle = htmlentities($news_title);
			//self::$sum = htmlentities($sum);
			self::$parent_nam = trim($parent_name);
			self::$size = $size;
			if(isset($news_cat)){ self::$news_cat = $news_cat; }
			if(isset($image)){ self::$image_chk = $image; }
			self::$pub = $publish;
			self::$content = $content;
			self::$height = htmlentities($img_height);
			self::$width = htmlentities($img_width);	
			
		}
		
		public static function get_all_news() // list all news
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
                // if $_GET['page'] defined, use it as page number

                $offset = ($pageNum - 1) * $rowsPerPage; // counting the offset
                $j = 1;
			
			$query  = "SELECT * FROM  news_content WHERE news_category = 'Parent' ORDER BY news_id ASC LIMIT $offset, $rowsPerPage"; // get records and display it
			$result = mysql_query($query) or die('Error!');
			
			echo "<TABLE border=0 width=100% align=center cellpadding=2 cellspacing=1>";
			$c = 1;
			while ($myrow = mysql_fetch_array($result))
			{
				
				if($c % 2 == 0) {	$bgcolor="#FFFFFF";  }  else {  $bgcolor="#F9F9F9";  }
				 $c++;
				echo "<TR><TD width=29 height=40 align=left bgcolor=$bgcolor>&nbsp;";
				echo '<input type="checkbox" name="news[]" id="web" value="'.$myrow["news_id"].'" />';
				
				echo "<TD width=29 height=40 align=left bgcolor=$bgcolor>&nbsp;";
				echo $inc + $j++;
							
				echo "<TD width=314 height=40 align=left  bgcolor=$bgcolor>&nbsp;";
				echo ucwords($myrow["news_name"]);
				
				echo "<TD width=153 height=40 align=left bgcolor=$bgcolor>&nbsp;";
				$get = news_class::get_no_of_children($myrow["news_id"]); // Get the number of childred this page has
				$val = ($get == 0) ? $get : '<span style=" color:red">' .$get. '</span>';
				echo $val;
				 				
				echo "<TD width=50 height=40 align=center bgcolor=$bgcolor>";
				?><a href="?<?= $project_name; ?>=Control Panel&INC=News Cast&CMD=View News&id=<?= $myrow["news_id"];?>&cat=<?= $myrow["news_index"];?>"><img src="modules/news_cast/images/b_browse.png" alt="View Content" width="16" height="16" border="0" /></a><?
					echo "<TD width=35 height=40 align=center bgcolor=$bgcolor>";
				?><a href="?<?= $project_name; ?>=Control Panel&INC=News Cast&CMD=Edit News&id=<?= $myrow["news_id"];?>&cat=<?= $myrow["news_index"];?>"><img src="modules/news_cast/images/b_edit.png" alt="Edit Content" width="16" height="16" border="0" /></a><?
				
				echo "<TD width=35 height=40 align=center bgcolor=$bgcolor>";
				?><a href="?<?= $project_name; ?>=Control Panel&INC=News Cast&CMD=Delete News&id=<?= $myrow["news_id"]; ?>&cat=<?= $myrow["news_index"];?>" onclick="return confirm('Deleting This News Will Delete All Sub-News If Present!');"><img src="modules/news_cast/images/b_drop.png" alt="Delete Record" width="16" height="16" border="0" /></a><?
				
			
					
			}
			echo "</TABLE>";
			
			$query2   = "SELECT COUNT(news_id) AS numrows FROM  news_content WHERE news_category='Parent'"; // how many rows we have in database
			$result2  = mysql_query($query2) or die('Error, query failed');
			$row2     = mysql_fetch_array($result2);
			$numrows = $row2['numrows'];
			if($numrows != 0)
			{
			// how many pages we have when using paging?
			$maxPage = ceil($numrows/$rowsPerPage);
			
				if ($pageNum > 1)
				{
					$page = $pageNum - 1;
					
					$prev = "<a href=\"?$project_name=Control Panel&INC=News Cast&page=$page\"><img src='images/rewind.png' alt='Previous Page' width=16 height=16 border=0></a>";
					
					$first = "<a href=\"?$project_name=Control Panel&INC=News Cast&page=1\"><img src='images/skip_backward.png' alt='First Page' width=16 height=16 border=0></a>";
				} 
				else
				{
					$prev  = "<img src='modules/news_cast/images/rewind.png' alt='Previous Page' width=16 height=16 border=0>";
					// we're on page one, don't enable 'previous' link
					$first = "<img src='modules/news_cast/images/skip_backward.png' alt='First Page' width=16 height=16 border=0>";
					// nor 'first page' link
				}
			
				// print 'next' link only if we're not
				// on the last page
				if ($pageNum < $maxPage)
				{
					$page = $pageNum + 1;
					
					$next = "<a href=\"?$project_name=Control Panel&INC=News Cast&page=$page\"><img src='modules/news_cast/images/fast_forward.png' alt='Next Page' width=16 height=16 border=0></a>";
					
					$last = "<a href=\"?$project_name=Control Panel&INC=News Cast&page=$maxPage\"><img src='modules/news_cast/images/skip_forward.png' alt='Last Page' width=16 height=16 border=0></a>";
					
				} 
				else
				{
					$next = "<img src='modules/news_cast/images/fast_forward.png' alt='Next Page' width=16 height=16 border=0>";      // we're on the last page, don't enable 'next' link
					$last = "<img src='modules/news_cast/images/skip_forward.png' alt='Last Page' width=16 height=16 border=0>"; // nor 'last page' link
				
				}
			
			// print the page navigation link
	
echo <<<NavBar
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="background-image:url(modules/news_cast/images/m.png)">
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
<td align="left" valign="middle">&nbsp;&nbsp;<img src="modules/news_cast/images/warning.gif" /><font color="#FF6600"> No News Found!</font></td>
</tr>
</table>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="background-image:url(modules/news_cast/images/m.jpg)">
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
		
		private static function get_no_of_children($newsid) // get the total number of children a particular news has
		{
			$sql = mysql_query("SELECT news_index FROM news_content WHERE news_index = '$newsid'");
			$num = mysql_num_rows($sql);
			return $num;
		}
		
		public static function get_all_parent_news() // get all parent news nodes
		{
			
			$sql = mysql_query("SELECT * FROM news_content WHERE news_category='Parent'") or die("Error in query!");
			$num  = mysql_num_rows($sql);
			$arr = array();
			if($num == 0)
			{
				echo '<option value="">' ."No Node!". '</option>';
			}
			else
			{
				while($rows = mysql_fetch_array($sql))
				{
					extract($rows);
					echo '<option value=" '. $news_name.' ">' . $news_name. '</option>';
				}	
			}
		}
		
		public static function get_news_for_treeview() // get all parent and child news for treeview 
		{
			
			$treequery = mysql_query("SELECT * FROM news_content WHERE news_category='Parent'") or die('Error in query!');
			$treesql = mysql_num_rows($treequery);
			
			if($treesql != 0)
			{
				while($treerows = mysql_fetch_array($treequery))
				{
					$treepid = $treerows["news_id"];
					
					$treenodequery = mysql_query("SELECT news_id, news_name, news_index FROM news_content  WHERE news_index = '$treepid'") or die('Error in query!');
					$treelistsub = array();
					while($treenoderows = mysql_fetch_array($treenodequery))
					{
						extract($treenoderows);
						$treelistsub[] = array('n_name'=>$news_name, 'n_id'=>$news_id, 'indx'=>$news_index);
					}	
					
					extract($treerows);
										
					$treelist[] = array('n_name'=>trim($news_name), 'arr'=>$treelistsub);
					
				}
				return $treelist;
			}
			else
			{
				echo '<img src="modules/content_manager/images/warning.gif" />&nbsp;No News Found!';
			}
			
			
		}
		
		public static function get_unpublished_news_for_listview() // get all unpublished news for listview 
		{
			$sql = mysql_query("SELECT * FROM news_content WHERE news_published = 'No'");
			$num = mysql_num_rows($sql);
			
			if($num != 0)
			{
				while($rows = mysql_fetch_array($sql))
				{
					extract($rows);
					$unlistarr[] = array('news_name'=>trim($news_name), 'news_id'=>trim($news_id), 'ind'=>$news_index);
				}
				return $unlistarr;
			}
			else
			{
				echo '<img src="modules/content_manager/images/warning.gif" />&nbsp;No News Found!';
			}
			
			
		}
	
		public static function create_news() // create news
		{
			news_class::set_fields();
			$project_name = PROJECTNAME;
			
			$sql = mysql_query("SELECT * FROM news_content WHERE news_name = '".self::$nname."' AND news_category='".self::$news_cat."'") or die(mysql_error());
			$result = mysql_num_rows($sql);
			if($result != 0) // if news name exist
			{
				echo "<script>document.location.href='.?$project_name=Control Panel&INC=News Cast&CMD=Create News&msg=News Name Already Exist!'</script>"; 
				die();
			}
			
			if(self::$image_chk == "Yes")
			{ 
				if(empty($_FILES['fileField']['name']))
				{
					echo "<script>document.location.href='.?$project_name=Control Panel&INC=News Cast&CMD=Create News&msg=No Image Selected!'</script>"; 
					die();
				}
				$image_name = news_class::validate_img_and_upload();
			} 
			else { $image_name = ""; }
			
			if(self::$news_cat == "Parent")
			{
			
				$index = 0;
				//insert into news_content table
				$sql = mysql_query("INSERT INTO news_content
								   SET news_name='".addslashes(self::$nname)."',
								   news_title = '".addslashes(self::$ntitle)."',
								   news_category = '".self::$news_cat."',
								   news_index = '$index',
								   news_content = '".self::$content."',
								   image_path = '$image_name',
								   news_published = '".self::$pub."',
								   date_created = '".self::$c_date."',
								   date_modified = '".self::$m_date."',
								   author = '".self::$author."'
								   ") or die(mysql_error());
				
			}
			else
			{
				// retrive parent index if news is child then insert into news_content table
				$sql2 = mysql_query("SELECT * FROM news_content WHERE news_name = '".self::$parent_nam."'") or die(mysql_error());
				$ind = mysql_fetch_object($sql2);
				$index = $ind->news_id;
				// insert into news_content table
				$sql = mysql_query("INSERT INTO news_content
								   SET news_name='".addslashes(self::$nname)."',
								   news_title = '".addslashes(self::$ntitle)."',
								   news_category = '".self::$news_cat."',
								   news_index = '$index',
								   news_content = '".addslashes(self::$content)."',
								   image_path = '$image_name',
								   news_published = '".self::$pub."',
								   date_created = '".self::$c_date."',
								   date_modified = '".self::$m_date."',
								   author = '".self::$author."'
								   ") or die(mysql_error());
			}
			echo "<script>document.location.href='.?$project_name=Control Panel&INC=News Cast&CMD=Create News&msg=News Created!'</script>"; 
			
		}
		
		public static function validate_img_and_upload() // validate image and upload
		{
			// Get image dimension
			if(self::$size == "default")
			{
				$toWidth = 50; // default image width
				$toHeight = 50; // default image height
			}
			else
			{
				if(self::$width == "" || self::$height == "")
				{
					$toWidth = 50; // default image width
					$toHeight = 50; // default image height
				}
				else
				{
					$toWidth = self::$width;
					$toHeight = self::$height;	
				}
			}
			
			$project_name = PROJECTNAME;
			$imagetype = $_FILES['fileField']['type'];
			$type_array = array("image/jpeg", "image/png", "image/png", "image/pjpeg", "image/pjpg");
			//list($width, $height) = getimagesize($_FILES['fileField']['size']);
			
			if(!in_array($_FILES['fileField']['type'], $type_array))
			{
			  echo "<script>alert('Sorry file not uploaded! Incompatible file format!');document.location.href='.?$project_name=Control Panel&INC=News Cast&CMD=Create News&msg=Sorry file not uploaded! Incompatible file format!'</script>";  
			  die();
			}
			else
			{
				
				$thumb = "modules/news_cast/thumbnails/";
                                $large = "modules/news_cast/large/";
				
				$alphanum = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
				$path_info = pathinfo($_FILES['fileField']['name']);
				$ext = $path_info['extension']; // get file extension
	
				$new_image_name = substr(str_shuffle($alphanum), 0, 10) . "." . $ext; // new image name
				require('resize.php');
				$thumb_path = $thumb . $new_image_name;
                                $large_img_path = $large . $new_image_name;
				ResizerImage::imageresizer($_FILES['fileField']['tmp_name'], $toWidth, $toHeight, $imagetype, $thumb_path); // Create thumbnail
				$uploaded = move_uploaded_file($_FILES['fileField']['tmp_name'],$large_img_path);
                                if($uploaded){
                                    ResizerImage::reduce_width($large_img_path, 300, $large);
                                }
			}
				
                        return $thumb_path;	
		}
		
		public static function delete_news() // delete news
		{
			
			$project_name = PROJECTNAME;
			extract($_GET);
			$sql = mysql_query("SELECT news_id, news_name, news_index, image_path FROM news_content WHERE news_id='$id'") or die(mysql_error());
			$result = mysql_fetch_object($sql);
			$name = trim($result->news_name);
			$path = $result->image_path;
			$index = $result->news_index;
			
			if($cat == 0)
			{
				$sqlpath = mysql_query("SELECT image_path, news_name FROM news_content WHERE news_index='$id'") or die(mysql_error());
				$num = mysql_num_rows($sqlpath);
				if($num != 0)
				{
					while($resultpath = mysql_fetch_array($sqlpath)) 
					{
						@unlink($path);
						content_man_class::delete_images($name);
					}
					
					@unlink($path);
					content_man_class::delete_images($name);
					mysql_query("DELETE FROM news_content WHERE news_index='$id'") or die(mysql_error());
					
				}
				else
				{
					    @unlink($path);
						content_man_class::delete_images($name);
				}
				mysql_query("DELETE FROM news_content WHERE news_id='$id'") or die(mysql_error());
			    
			}
			else
			{
				    @unlink($path);
					content_man_class::delete_images($name);
					mysql_query("DELETE FROM news_content WHERE news_id='$id'") or die(mysql_error());
			}
			
			echo "<script>document.location.href='?$project_name=Control Panel&INC=News Cast&msg=News Deleted!'</script>";
		}
		
		public static function get_news_details($val) // view news
		{
			$sql = mysql_query("SELECT * FROM news_content WHERE news_id = '$val'");
			$result = mysql_fetch_object($sql);
			$details = array('rf_id'=>$result->news_id, 'name'=>$result->news_name, 'title'=>$result->news_title, 'category'=>$result->news_category, 'pub'=>$result->news_published, 'dtc'=>$result->date_created, 'dtm'=>$result->date_modified, 'aut'=>$result->author,'content'=>$result->news_content, 'idx'=>$result->news_index, 'path'=>$result->image_path);
			return $details;
		}
		
		 public static function get_parent_name($val) // get parent name
		{
			$sql = mysql_query("SELECT * FROM news_content WHERE news_id = '$val'");
			$result = mysql_fetch_object($sql);
			echo '<option value="'.$result->news_name.'" selected="selected">'.$result->news_name.'</option>';
		}
		
		public static function update_news()
		{
			extract($_GET);
			news_class::set_fields();
			$project_name = PROJECTNAME;
			if(self::$news_cat  == "Child") // child news  get index of parent
			{
				$sql = mysql_query("SELECT news_id FROM news_content WHERE news_name='".self::$parent_nam."'") or die(mysql_error());	
				$result = mysql_fetch_object($sql);
				$index = $result->news_id;
			}
			else
			{
				self::$news_cat = "Parent";
				$index = 0;
			}
			
			if(self::$image_chk == "Yes")
			{
				
				if(empty($_FILES['fileField']['name']))
				{
					echo "<script>document.location.href='.?$project_name=Control Panel&INC=News Cast&CMD=Edit News&id=$id&cat=$cat&msg=No Image Selected!'</script>"; 
					die();
				}
				
				$sql = mysql_query("SELECT image_path FROM news_content WHERE news_id='$id'") or die(mysql_error());	
				$result = mysql_fetch_object($sql);
				$path = $result->image_path;
				@unlink($path); // delete existing image
				
				$image_name = news_class::validate_img_and_upload();
				// insert into news_content table
				$sql = mysql_query("UPDATE news_content
								   SET news_name='".addslashes(self::$nname)."',
								   news_title = '".addslashes(self::$ntitle)."',
								   news_category = '".self::$news_cat."',
								   news_index = '$index',
								   news_content = '".addslashes(self::$content)."',
								   image_path = '$image_name',
								   news_published = '".self::$pub."',
								   date_modified = '".self::$m_date."',
								   author = '".self::$author."'
								   WHERE news_id='$id'
								   ") or die(mysql_error());
				
			}
			else
			{
				// insert into news_content table
				$sql = mysql_query("UPDATE news_content
								   SET news_name='".self::$nname."',
								   news_title = '".self::$ntitle."',
								   news_category = '".self::$news_cat."',
								   news_index = '$index',
								   news_content = '".addslashes(self::$content)."',
								   news_published = '".self::$pub."',
								   date_modified = '".self::$m_date."',
								   author = '".self::$author."'
								   WHERE news_id='$id'
								   ") or die(mysql_error());				
			}	
			
			 $page = $_SESSION['page'];
			 $img_editor = content_man_class::scan_img_tag(self::$content);  // images in the editor 
			 $editor_img_in_table = content_man_class::editor_images_in_table($page);
			 if(!empty($editor_img_in_table))
			 {
				 // delete from root pageresource director
				 $arrtbl = array();
				 foreach($editor_img_in_table as $img)
				 {
					if(!in_array($img, $img_editor)){ $arrtbl[] = $img;}
				 }	
				 foreach($arrtbl as $delimg)
				 {
					unlink("../" . $delimg );
					unlink($delimg);
					mysql_query("DELETE FROM editor_img WHERE path='$delimg' AND page='$page'") or die(mysql_error());
				 }
			 }
			echo "<script>document.location.href='.?$project_name=Control Panel&INC=News Cast&CMD=Edit News&id=$id&cat=$cat&msg=News Updated!'</script>"; 
			
		}
		
		public static function delete_news_selected() // news marked for  deletion
		{
		   $numDel = count($_POST['news']);
		   
		   for($i=0; $i<=$numDel; $i++)
		   {
			   $idDel = @$_POST['news'][$i];
			   $msg = news_class::check_selected_delete($idDel);
		   }
		  
		   return $msg;
		 }
		 
		private static function check_selected_delete($idDel)// Scan before final deletion
		{
			
			$sql = mysql_query("SELECT news_id, news_name, news_index, image_path FROM news_content WHERE news_id='$idDel'") or die(mysql_error());
			$result = mysql_fetch_object($sql);
			$name = @trim($result->news_name);
			$path = @$result->image_path;
			$index = @$result->news_index;
			
			$sqlpath = mysql_query("SELECT image_path, news_name FROM news_content WHERE news_index='$idDel'") or die(mysql_error());
			$num = mysql_num_rows($sqlpath);
			if($num != 0)
			{
				while($resultpath = mysql_fetch_array($sqlpath)) 
				{
					@unlink($path);
					content_man_class::delete_images($name);
				}
				mysql_query("DELETE FROM news_content WHERE news_index='$idDel'") or die(mysql_error());
				
			}
			
			@unlink($path);
			content_man_class::delete_images($name);
			mysql_query("DELETE FROM news_content WHERE news_id='$idDel'") or die(mysql_error());
			
			return "Selected News Successfully Deleted!";
		}
		
		public static function create_session() // create current page session
		{
			$_SESSION['page'] = strtolower(str_replace(' ','_',$_GET['newsname']));
		}
		
		
	}// end class

?>