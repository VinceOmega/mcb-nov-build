<?php
	foreach($_REQUEST as $key => $value){
		$$key = htmlspecialchars(trim(strip_tags($value)));
	} 

	// echo "<pre>";
	// print_r($_POST);
	// echo "</pre>";
	// die();

	// $image = "/env/configurator/files/clipArts/Americana/amr12.png";
	// $red = 255; $green = 70; $blue = 68;


	$temp = explode("?", $image);
	$image = $temp[0];
	$query = $temp[1];

	// print_r($temp);
	// $query = rand(1000000, 9999999);
	$imgdir = "/var/www/mch".$image;

$imgtype =  exif_imagetype($imgdir);
$date = date('Y_m_d_H_i_s');
$ext = trim(pathinfo($imgdir, PATHINFO_EXTENSION));

		 // echo $ext;
		 // die();

		if($ext !=  'png' && 
		$ext !=  'jpeg' && 
		$ext != 'jpg' &&
		$ext != 'gif' &&
		$ext != 'eps' &&
		$ext != 'tiff' &&
		$ext != 'bmp'){
		$data = array(
				'error' => 'This is the wrong type of file, Please upload a file that has the correct file types.'
			);
		//echo $ext;
		//echo json_encode($data);
		echo 'wrong file type';
		// sleep(3);
	//	header("Location:$_SERVER[HTTP_REFERER]");
		die();
	}
	// echo $ext;

	function replace_extension($filename, $new_extension) {
    $info = pathinfo($filename);
    return $info['dirname'] 
        . DIRECTORY_SEPARATOR 
        . $info['filename'] 
        . '.' 
        . $new_extension;
}

// transparent($imgdir);

// $blob = base64_decode(convert($tempimg_path, $red, $green, $blue));
// $layout->readImageBlob($blob);
// $layout->setImageFormat('png');

	if($ext === 'png' || $imgtype === 3){
					$im = imagecreatefromstring(base64_decode(transparent($imgdir, $imgtype)));
					
					imagepng($im, "/var/www/mch/env/html5_configurator/img/design/$post[sessionid]-$date-test_layer.png");
					$tempimg_path = "/var/www/mch/env/html5_configurator/img/design/$post[sessionid]-$date-test_layer.png";
					$imgdir = $tempimg_path;
					imagedestroy($im);
					 // echo $imgdir;
					$im = imagecreatefrompng($imgdir);
					//  $w = 0; $h = 0; $image_path = array();
					// $path_info = getimagesize($imgdir);
					// $w = $path_info[0]; $h = $path_info[1];
					// $blank = imagecreatetruecolor($w, $h);
					// $bg = imagecolorallocate($blank, $red, $green, $blue);
					// imagefilledrectangle($blank, 0, 0, $w, $h, $bg);
					// imagecopymerge($im, $blank, 0, 0, 0, 0, $w, $h, 40);
					// imagecolortransparent($im, $bg);

					 imagefilter($im, IMG_FILTER_COLORIZE, $red, $green, $blue);
					
					ob_start();
					imagepng($im);
					 $changed_file = base64_encode(ob_get_contents());
					 ob_end_clean();

					 imagepng($im, $imgdir."?".$query);
					$base64 = 'data:image/png'  . ';base64,' . $changed_file;
					imagedestroy($im);
					// imagedestroy($blank);
					echo $base64;
					// echo "<img src='$base64'><br>";

					// echo $imgtype;

					// echo "<img src=".$base64.">";
					//imagefilter($bm, IMG_FILTER_COLORIZE, $red, $green, $blue);
					// imagepng($bm, $imgdir."?".$query);
					 // $color = imagecolorallocate($bm, $red, $green, $blue); 
					//imagedestroy($bm);	
					// $imgdir = replace_extension($imgdir, 'png');
					//  echo $imgdir;
					// imagefill($im, 0, 0, $color);
					// header('Content-Type: image/png');
					// imagepng($im);
				
					// imagepng($handle, $imgdir."?".$query); 

					} else if($ext === 'jpeg' || $ext === 'jpg'  || $imgtype === 2){
					
					$im = imagecreatefromstring(base64_decode(transparent($imgdir, $imgtype)));
					imagepng($im, "/var/www/mch/env/html5_configurator/img/design/$post[sessionid]-$date-test_layer.png");
					$tempimg_path = "/var/www/mch/env/html5_configurator/img/design/$post[sessionid]-$date-test_layer.png";
					$imgdir = $tempimg_path;
					imagedestroy($im);
					$im = imagecreatefrompng($imgdir);

					imagefilter($im, IMG_FILTER_COLORIZE, $red, $green, $blue);
					ob_start();
						imagepng($im);
					 $changed_file = base64_encode(ob_get_contents());
					 ob_end_clean();

					 imagepng($im, $imgdir."?".$query);
					
					$base64 = 'data:image/png'  . ';base64,' . $changed_file;
					imagedestroy($im);
					echo $base64;
					// echo $imgtype;

					} else if ($ext === 'gif' || $imgtype === 1){
				
					// $im = imagecreatefromstring(base64_decode(transparent($imgdir, $imgtype)));
					// imagepng($im, "/var/www/mch/env/html5_configurator/img/design/$post[sessionid]-$date-test_layer.png");
					// $tempimg_path = "/var/www/mch/env/html5_configurator/img/design/$post[sessionid]-$date-test_layer.png";
					// $imgdir = $tempimg_path;
					// imagedestroy($im);

					$im = imagecreatefromgif($imgdir);
				
					imagefilter($im, IMG_FILTER_COLORIZE, $red, $green, $blue);

					ob_start();
					imagepng($im);
					 $changed_file = base64_encode(ob_get_contents());
					 ob_end_clean();

					 imagepng($im, $imgdir."?".$query);


					 $base64 = 'data:image/png'  . ';base64,' . $changed_file;
					
					imagedestroy($im);
					echo $base64;
					//echo "<img src='$base64'><br>";
					//echo $imgtype;


					} else if($ext === 'tiff' || $imgtype === 7 || $imgtype === 8){
				
					$im = imagecreatefromstring(base64_decode(transparent($imgdir, $imgtype)));
					imagepng($im, "/var/www/mch/env/html5_configurator/img/design/$post[sessionid]-$date-test_layer.png");
					$tempimg_path = "/var/www/mch/env/html5_configurator/img/design/$post[sessionid]-$date-test_layer.png";
					$imgdir = $tempimg_path;
					imagedestroy($im);

					$im = new Imagick();
					$im->setResolution(100, 100);
					$im->readImage($imgdir);
					$im->setImageFormat("png");

					$extln = strlen($ext);

					$dir = substr($imgdir, 0, strlen($imgdir)-$extln);
					$imgdir = $dir."png";
					// echo $imgdir;
					// die();
					$im->writeImages($imgdir, true);
					$im->destroy();

					$im = imagecreatefrompng($imgdir);
					// $white = imagecolorallocate($bm, 255, 255, 255); 
					imagefilter($im, IMG_FILTER_COLORIZE, $red, $green, $blue);
					// imagecolortransparent($bm, $white); 
					ob_start();
						imagepng($im);
					 $changed_file = base64_encode(ob_get_contents());
					 ob_end_clean();

					 imagepng($im, $imgdir."?".$query);
					
					$base64 = 'data:image/png'  . ';base64,' . $changed_file;
					imagedestroy($im);
					echo $base64;
					// echo $imgtype;

					}else if($ext === 'bmp' || $imgtype === 6){
				
					$im = imagecreatefromstring(base64_decode(transparent($imgdir, $imgtype)));
					imagepng($im, "/var/www/mch/env/html5_configurator/img/design/$post[sessionid]-$date-test_layer.png");
					$tempimg_path = "/var/www/mch/env/html5_configurator/img/design/$post[sessionid]-$date-test_layer.png";
					$imgdir = $tempimg_path;
					imagedestroy($im);

					$im = new Imagick();
					$im->setResolution(100, 100);
					$im->readImage($imgdir);
					$im->setImageFormat("png");

					$extln = strlen($ext);

					$dir = substr($imgdir, 0, strlen($imgdir)-$extln);
					$imgdir = $dir."png";
					// echo $imgdir;
					// die();
					$im->writeImages($imgdir, true);
					$im->destroy();
					
					$im = imagecreatefrompng($imgdir);
					// $white = imagecolorallocate($bm, 255, 255, 255); 
					imagefilter($im, IMG_FILTER_COLORIZE, $red, $green, $blue);
					// imagecolortransparent($bm, $white); 
					ob_start();
						imagepng($im);
					 $changed_file = base64_encode(ob_get_contents());
					 ob_end_clean();

					 imagepng($im, $imgdir."?".$query);
					
					$base64 = 'data:image/png'  . ';base64,' . $changed_file;
					imagedestroy($im);
					echo $base64;
					// echo $imgtype;

					}else if ($ext === 'eps'){
					
					$im = imagecreatefromstring(base64_decode(transparent($imgdir, $imgtype)));
					imagepng($im, "/var/www/mch/env/html5_configurator/img/design/$post[sessionid]-$date-test_layer.png");
					$tempimg_path = "/var/www/mch/env/html5_configurator/img/design/$post[sessionid]-$date-test_layer.png";
					$imgdir = $tempimg_path;
					imagedestroy($im);

					$im = new Imagick();
					$im->setResolution(100, 100);
					$im->readImage($imgdir);
					$im->setImageFormat("png");

					$extln = strlen($ext);

					$dir = substr($imgdir, 0, strlen($imgdir)-$extln);
					$imgdir = $dir."png";
					// echo $imgdir;
					// die();
					$im->writeImages($imgdir."?".$query, true);
					$im->destroy();

					$im = imagecreatefrompng($imgdir); 
					imagefilter($im, IMG_FILTER_COLORIZE, $red, $green, $blue);
					ob_start();
					imagepng($im);
					 $changed_file = base64_encode(ob_get_contents());
					 ob_end_clean();

					 imagepng($im, $imgdir."?".$query);
					 
					$base64 = 'data:image/png'  . ';base64,' . $changed_file;
					imagedestroy($im);
					echo $base64;
					// echo $imgtype;

					}
		
			 // echo "<img src=".substr($imgdir,12, strlen($imgdir)-1)."?".$query.">";
					// echo substr($imgdir,12, strlen($imgdir)-1)."?".$query;



function transparent($imgdir, $imgtype){


	list($width, $height) = getimagesize($imgdir);
$new_width = $width;
$new_height = $height;

// Resample
$image_p = imagecreatetruecolor($new_width, $new_height);
$ext = trim(pathinfo($imgdir, PATHINFO_EXTENSION));



					if($ext === 'png' || $imgtype === 3){
					$im = imagecreatefrompng($imgdir);
					} else if($ext === 'jpeg' || $ext === 'jpg' || $imgtype === 2){
					$im = imagecreatefromjpeg($imgdir);
					} else if ($ext === 'gif' || $imgtype === 1){
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
		// $brown = imagecolorallocate($im, 126, 64, 17);

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

}}				
					ob_start();
					 imagepng($im);

					 $changed_file = base64_encode(ob_get_contents());
					
					 ob_end_clean(); 
					  // $base64 = 'data:image/png'  . ';base64,' . $changed_file;

					imagedestroy($im);
			
					return $changed_file;
}

