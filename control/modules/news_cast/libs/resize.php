<?

class ResizerImage {

    public static function imageresizer($originalImage, $toWidth, $toHeight, $imagetype, $path) {

        // Get the original geometry and calculate scales
        list($width, $height) = getimagesize($originalImage);
        $xscale = $width / $toWidth;
        $yscale = $height / $toHeight;

        // Recalculate new size with default ratio
        if ($yscale > $xscale) {
            $new_width = round($width * (1 / $yscale));
            $new_height = round($height * (1 / $yscale));
        } else {
            $new_width = round($width * (1 / $xscale));
            $new_height = round($height * (1 / $xscale));
        }
        // Resize the original image
        $imageResized = imagecreatetruecolor($new_width, $new_height);

        if ($imagetype == "image/jpeg" || $imagetype == "image/pjpeg" || $imagetype == "image/jpg" || $imagetype == "image/pjpg") {
            $imageTmp = imagecreatefromjpeg($originalImage);
            imagecopyresampled($imageResized, $imageTmp, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            $msg = (!imagejpeg($imageResized, $path)) ? "Image Not Uploaded!" : "Image Uploaded!";
        } elseif ($imagetype == "image/png") {
            $imageTmp = imagecreatefrompng($originalImage);
            imagecopyresampled($imageResized, $imageTmp, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            $msg = (!imagepng($imageResized, $path)) ? "Image Not Uploaded!" : "Image Uploaded!";
        } else {
            $imageTmp = imagecreatefromgif($originalImage);
            imagecopyresampled($imageResized, $imageTmp, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            $msg = (!imagegif($imageResized, $path)) ? "Image Not Uploaded!" : "Image Uploaded!";
        }

        return $msg;
    }

    public static function reduce_width($originalImg, $desiredWidth, $image_path) 
    {
        $properties = list($img_width, $img_height) = getimagesize($originalImg);
        if($img_width>$desiredWidth)
        {
            $img_type = $properties['mime'];
            //$this->check_type($img);
            $ratio = ($img_height / $img_width);
            $new_height = round($ratio * $desiredWidth);
            $im = imagecreatetruecolor($desiredWidth, $new_height);
            $jpeg_array = array("image/pjpg", "image/pjpeg", "image/jpg", "image/jpeg");

            if ($img_type == "image/gif") {
                $old_im = imagecreatefromgif($originalImg);
                $type = 'gif';
            } elseif (in_array($img_type, $jpeg_array)) {
                $old_im = imagecreatefromjpeg($originalImg);
                $type = 'jpg';
            } elseif ($img_type == "image/png") {
                $old_im = imagecreatefrompng($originalImg);
                $type = 'png';
            } else {
                $old_im = "Invalid image";
            }

            if ($old_im != "Invalid image") {
                imagecopyresampled($im, $old_im, 0, 0, 0, 0, $desiredWidth, $new_height, $img_width, $img_height);
                switch ($type) {
                    case 'gif':
                        imagegif($im, $image_path . basename($originalImg));
                        imagedestroy($im);
                        break;

                    case 'jpg':
                        imagejpeg($im, $image_path . basename($originalImg));
                        imagedestroy($im);
                        break;

                    case 'png':
                        imagepng($im, $image_path . basename($originalImg));
                        imagedestroy($im);
                        break;
                    default:
                        break;
                }
            } else {
                return FALSE;
            }
        }
        return;
    }

}

?>