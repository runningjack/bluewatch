<?
	class settings_class{
		
		public static function apply_settings()
		{
			extract($_POST);
			$cname = htmlentities($name);
			$ft = htmlentities($footer);

            $imagetype = $_FILES['fileField']['type'];
			$uploads = "modules/settings/logo/";
			$path = $uploads.$_FILES['fileField']['name'];
			$max_filesize = 100000;
			
			$max_filesizeword = "100kb";
			
			if(empty($_FILES['fileField']['name']))
			{
				$path = "";
				settings_class::update_settings_tbl($cname, $path, $ft);
				die();
			}
			else
			{
			
					if ($_FILES['fileField']['size'] > $max_filesize) {
					
						$msg = "That file type is too large, keep your image size at maximum of $max_filesizeword!";
						
					}
					
					list($imagewidth, $imageheight) = getimagesize($_FILES['fileField']['tmp_name']);
				
					$maxwidth = 352;
					$maxheight = 73;
					if($imagewidth > $maxwidth || $imageheight > $maxheight) {
				
					$msg = "That file type is too large! it must be less than 350 * 72 in size!";
				
					}
					
					if(!$msg)
					{
						settings_class::directory_transverser();
						if(move_uploaded_file($_FILES['fileField']['tmp_name'], $uploads.$_FILES['fileField']['name']))
						{ 
							
							settings_class::update_settings_tbl($cname, $path, $ft);
						
						} 
						else
						{ 
							$msg = "Couldn't upload file!"; 
						}	
					}
			
			}
			return $msg;
			
		}
		
		private static function update_settings_tbl($cname, $path, $ft)
		{
			$project_name = PROJECTNAME;
			if(empty($_FILES['fileField']['name']))
			{
				$sql = "UPDATE settings SET company_name='$cname', footer='$ft' WHERE id=1";
			}
			else
			{
				$sql = "UPDATE settings SET company_name='$cname', imgpath='$path', footer='$ft' WHERE id=1";
			}
			mysql_query($sql) or die(mysql_error());
			
			echo "<script>document.location.href='.?$project_name=Control Panel&INC=Settings&msg=Settings Applied!'</script>";
			die();
		}
		
		private static function directory_transverser() // transvers directory and return an array of files contained
		{
			$dir = 'modules/settings/logo';
			// check whether $dirname is a directory
			if  (is_dir($dir))
			// change its mode to 755 (rwx,rw,rw)
			//chmod($dir, 0755);
			$dir_handle  =  @opendir($dir);
			if(!$dir_handle)
			return  false;
	
			// traversal for every entry in the directory
			$filPath = array();
			while (($file = @readdir($dir_handle)) !== false)
			{
				// ignore '.' and '..' directory
				if  ($file  !=  "."  &&  $file  !=  "..")  {
					$dirPath = $dir."/".$file;
					unlink($dirPath);
				
				}
			}
			
			// chose the directory
			@closedir($dir_handle);	
			return;
		}
		
	}
?>