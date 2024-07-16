<?
	class ResizerImage{
		
		public static function move($img, $location)
		{
			$move = @ move_uploaded_file($img, $location);
			return $move;
		}
		
		public static function imageresizer($originalImage, $toWidth, $toHeight, $imagetype)
		{
						 
			 // Get the original geometry and calculate scales
			 list($width, $height) = getimagesize($originalImage);
			 if(empty($toWidth) || empty($toHeight))
			 {
				 $toWidth = 200; // Default width if not specified
				 $toHeight = 180; // Default height if not specified
			 }
			 $xscale=$width/$toWidth;
			 $yscale=$height/$toHeight;
			 
			  // Recalculate new size with default ratio
			  if ($yscale>$xscale){
				  $new_width = round($width * (1/$yscale));
				  $new_height = round($height * (1/$yscale));
			  }
			  else {
				  $new_width = round($width * (1/$xscale));
				  $new_height = round($height * (1/$xscale));
			  }
			  
			  // Resize the original image
			  $imageResized = imagecreatetruecolor($new_width, $new_height);
			  @$imageTmp = ($imagetype == "image/jpeg" || $imagetype == "image/pjpeg" || $imagetype == "image/jpg" || $imagetype == "image/pjpg") ? imagecreatefromjpeg ($originalImage): imagecreatefrompng ($originalImage);
			  @imagecopyresampled($imageResized, $imageTmp, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			  
			  return $imageResized;
		}	
		
	}

?>