<?php
	session_start();

	// Set the content-type
	header("Content-type: image/png");
	
	// Create the image
	$im = imagecreatetruecolor(110, 60);
	
	// Create some colors
	$green = imagecolorallocate($im, 176, 0, 0);
	$backColour = imagecolorallocate($im, 255, 255, 255);
	$grey = imagecolorallocate($im, 0, 150, 0);

	//Change the background colour of the image to white
	imagefill($im, 0, 0, $backColour);

	// The text to draw
	$text = substr(md5(microtime()), 0 , 6);
	$token = md5(isset($_GET["zq"]) ? $_GET["zq"] : rand(10000, 1000000));
	$_SESSION[session_id() . "captcha_confirmimage_$token"] = $text;
	
	// Replace path by your own font path
	$font = 'tempsitc.ttf';
	
	// Add some shadow to the text
//	imagettftext($im, 40, -12, 12, 52, $grey, $font, $text);
	
	// Add the text
	imagettftext($im, 20, -12, 10, 25, $green, $font, $text);
	
	// Using imagepng() results in clearer text compared with imagejpeg()
	imagepng($im);
	imagedestroy($im);
?>