<?php
	foreach($_REQUEST as $key => $value){
		$$key = htmlspecialchars(trim(strip_tags($value)));
	} $imgdir = '/var/www/mch'.$image;

	// echo $imgdir; die();

	 ob_start();

list($width, $height) = getimagesize($imgdir);
$new_width = $width;
$new_height = $height;

// Resample
$image_p = imagecreatetruecolor($new_width, $new_height);
$ext = trim(pathinfo($imgdir, PATHINFO_EXTENSION));



					if($ext === 'png'){
					$im = imagecreatefrompng($imgdir);
					} else if($ext === 'jpeg' || $ext === 'jpg'){
					$im = imagecreatefromjpeg($imgdir);
					} else if ($ext === 'gif'){
					$im = imagecreatefromgif($imgdir);
				}

$colors = array(); 

//imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

if($im && imagefilter($im, IMG_FILTER_GRAYSCALE)) {

	//imagealphablending($image_p, true);

	$transparencyIndex = imagecolortransparent($im); 
	
	if ($transparencyIndex >= 0) { 

	} else {
		// Create an index for the color white
		$white = imagecolorallocate($im, 255, 255, 255);
		$black = imagecolorallocate($im, 0, 0, 0);

		//Set each pixel that is lighter than 200,200,200 to white
		for($x = 0; $x < $new_width; $x++) {

			for($y = 0; $y < $new_height; $y++) {
				
				$rgb = imagecolorat($im,$x,$y);
				$r = ($rgb >> 16) & 0xFF;
				$g = ($rgb >> 8) & 0xFF;
				$b = $rgb & 0xFF;
				

				if($r > 150 && $g > 150 && $b > 150)
					imagesetpixel($im, $x,$y, $white);
				else 
					imagesetpixel($im, $x,$y, $black);
				$stringData = 'Red: '.$r.' -- Green: '.$g.' -- Blue: '.$b.' \n';



			}


		}
		// Make the background transparent
		// TRUE COLOR
		//$white = imagecolorallocatealpha($image_p, 255, 255, 255, 0);  
		// RGB
				imagecolortransparent($im, $white);
				imagefilter($im, IMG_FILTER_EMBOSS);
}}				
					 imagepng($im);

					 $changed_file = base64_encode(ob_get_contents());
					
					 ob_end_clean(); 
					  $base64 = 'data:image/png'  . ';base64,' . $changed_file;

					imagedestroy($im);
			
					echo $base64;

				