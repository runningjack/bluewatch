<?
	class ResizerImage{
		
		public static function imageresizer($originalImage, $toWidth, $toHeight, $imagetype, $path)
		{
						 
                        // Get the original geometry and calculate scales
                        list($width, $height) = getimagesize($originalImage);
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

                        if($imagetype == "image/jpeg" || $imagetype == "image/jpg" || $imagetype == "image/pjpg" || $imagetype == "image/pjpeg")
                        {
                                $imageTmp = imagecreatefromjpeg ($originalImage);
                                imagecopyresampled($imageResized, $imageTmp, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                                imagejpeg($imageResized, $path);	
                        }
                        elseif($imagetype == "image/png" || $imagetype == "image/x-png")
                        {
                                $imageTmp = imagecreatefrompng ($originalImage);
                                imagecopyresampled($imageResized, $imageTmp, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                                imagepng($imageResized, $path);	
                        }
                        elseif($imagetype == "image/gif")
                        {
                                $imageTmp = imagecreatefromgif ($originalImage);
                                imagecopyresampled($imageResized, $imageTmp, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                                imagegif($imageResized, $path);	
                        }
                        else
                        {
                                $imageTmp = imagecreatefromjpeg ($originalImage);
                                imagecopyresampled($imageResized, $imageTmp, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                                imagejpeg($imageResized, $path);
                        }

                        return;
		}
	}
?>