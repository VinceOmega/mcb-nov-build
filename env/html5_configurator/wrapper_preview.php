<?
/*
$post['wrapper'] = '/env/html5_configurator/banner/25_silver.png';
$post['layer_top'] = '/env/configurator/files/clipArts/Americana/amr12.png';
$post['layer_top_x'] = 452;
$post['layer_top_y'] = 359;
$post['line_1'] = 'This is a issue!';
$post['line_2'] = 'asdfdasfdasfdasf';
$post['line_3'] = 'dasfasdfasdasfas';
$post['line_4'] = 'fdasfdasddfasfds';
$post['line_1_font'] = '/var/www/mch/env/html5_configurator/fonts/ANASTAS.TTF';
$post['line_2_font'] = '/var/www/mch/env/html5_configurator/fonts/Arial.ttf';
$post['line_3_font'] = '/var/www/mch/env/html5_configurator/fonts/ArkansasDB_Normal.ttf';
$post['line_4_font'] = '/var/www/mch/env/html5_configurator/fonts/BrushScriptStd.otf';
$post['line_1_size'] = 20;
$post['line_2_size'] = 20;
$post['line_3_size'] = 20;
$post['line_4_size'] = 20;
$post['line_1_x'] = 281;
$post['line_2_x'] = 233;
$post['line_3_x'] = 0;
$post['line_4_x'] = 731;
$post['line_1_y'] = 197;
$post['line_2_y'] = 391;
$post['line_3_y'] = 242;
$post['line_4_y'] = 69;
$post['image_uploaded'] = false;
$post['red'] = 224;
$post['green'] = 70;
$post['blue'] = 68;

foreach($post as $key => $value){
		$$key = $value;
}

$a = array(
		'base' => $wrapper,
		'layer_top' => $layer_top,
		'layer_top_x' => $layer_top_x,
		'layer_top_y' => $layer_top_y,
		'line_1' => $line_1,
		'line_2' => $line_2,
		'line_3' => $line_3,
		'line_4' => $line_4,
		'line_1_font' => $line_1_font,
		'line_2_font' => $line_2_font,
		'line_3_font' => $line_3_font,
		'line_4_font' => $line_4_font,
		'line_1_size' => $line_1_size,
		'line_2_size' => $line_2_size,
		'line_3_size' => $line_3_size,
		'line_4_size' => $line_4_size,
		'line_1_x' => $line_1_x,
		'line_2_x' => $line_2_x,
		'line_3_x' => $line_3_x,
		'line_4_x' => $line_4_x,
		'line_1_y' => $line_1_y,
		'line_2_y' => $line_2_y,
		'line_3_y' => $line_3_y,
		'line_4_y' => $line_4_y,
		'image_uploaded' => $image_uploaded,
		'red' => $red,
		'green' => $green,
		'blue' => $blue
	);

*/

function wrapper($a){

$line_1 = $a['line_1'];
$line_2 = $a['line_2'];
$line_3 = $a['line_3'];
$line_4 = $a['line_4'];
$line_1_font = $a['line_1_font'];
$line_2_font = $a['line_2_font'];
$line_3_font = $a['line_3_font'];
$line_4_font = $a['line_4_font'];
$line_1_size = $a['line_1_size'];
$line_2_size = $a['line_2_size'];
$line_3_size = $a['line_3_size'];
$line_4_size = $a['line_4_size'];
$line_1_x = $a['line_1_x'];
$line_2_x = $a['line_2_x'];
$line_3_x = $a['line_3_x'];
$line_4_x = $a['line_4_x'];
$line_1_y = $a['line_1_y'];
$line_2_y = $a['line_2_y'];
$line_3_y = $a['line_3_y'];
$line_4_y = $a['line_4_y'];
$red = $a['red'];
$green = $a['green'];
$blue = $a['blue'];
$red_text = $a['red_text'];
$green_text = $a['green_text'];
$blue_text = $a['blue_text'];


$base = new \Imagick('/var/www/mch'.$a['base']);
$draw = new \ImagickDraw();
$textColor = "rgb($red_text, $green_text, $blue_text)";
$date = date('Y_m_d_H_i_s');


if(isset($a['layer_top']) && $a['layer_top'] != ""){
$layout = new \Imagick();
$layout_x = $a['layer_top_x']; $layout_y = $a['layer_top_y'];
	if($a['image_uploaded'] != true){
	$tempimg = '/var/www/mch/'.$a['layer_top'];
		$im = imagecreatefromstring(base64_decode(transparent($tempimg)));
		imagepng($im, "/var/www/mch/env/html5_configurator/img/design/$post[sessionid]-$date-test_layer.png");
		$tempimg_path = "env/html5_configurator/img/design/$post[sessionid]-$datetest_layer.png";
		$blob = base64_decode(convert($tempimg_path, $red, $green, $blue));
		$layout->readImageBlob($blob);
		$layout->setImageFormat('png');
	} else {
		$layout->readImage($img);
	}
}

if($line_1 != "" || $line_2 != "" || $line_3 != "" || $line_4 != ""){
// $line_1_x = $line_1_x + 100; $line_2_x = $line_2_x + 100; $line_3_x = $line_3_x + 100; $line_4_x = $line_4_x + 100;
$line_1_x = ($line_1_x < 0 ? 0 : $line_1_x); $line_1_x = ($line_1_x > 731 ? 731: $line_1_x);
$line_2_x = ($line_2_x < 0 ? 0 : $line_2_x); $line_2_x =  ($line_2_x > 731 ? 731: $line_2_x);
$line_3_x = ($line_3_x < 0 ? 0 : $line_3_x); $line_3_x =  ($line_3_x > 731 ? 731: $line_3_x);
$line_4_x = ($line_4_x < 0 ? 0 : $line_4_x); $line_4_x = ($line_4_x > 731 ? 731: $line_4_x); 

$draw->setFont($line_1_font);
$draw->setFontSize($line_1_size);
$draw->setFontWeight(700);
$draw->setFillColor($textColor);
$base->annotateImage($draw, $line_1_x, $line_1_y, 0, $line_1);

$draw->setFont($line_2_font);
$draw->setFontSize($line_2_size);
$draw->setFontWeight(700);
$draw->setFillColor($textColor);
$base->annotateImage($draw, $line_2_x, $line_2_y, 0, $line_2);

$draw->setFont($line_3_font);
$draw->setFontSize($line_3_size);
$draw->setFontWeight(700);
$draw->setFillColor($textColor);
$base->annotateImage($draw, $line_3_x, $line_3_y, 0, $line_3);

$draw->setFont($line_4_font);
$draw->setFontSize($line_4_size);
$draw->setFontWeight(700);
$draw->setFillColor($textColor);
$base->annotateImage($draw, $line_4_x, $line_4_y, 0, $line_4);
}

echo "line 1x : ". $line_1_x." line 2x : ".$line_2_x." line 3x : ".$line_3_x." line 4x: ".$line_4_x;

// $img = '/var/www/mch'.$a['layout'];
// $size = getimagesize($a['img']);
// $h = $size[1];
// $w = $size[0];
$h = 100;
$w = 100;
$x = $layout_x; $y = $layout_y;

// echo $x." ";
// echo $y;

	if($x < 134){

		$x = 134;
	}

	if($x > 186){

		$x = 186;
	} 

	if($y < 27){

		$y = 27;
	} 

	if($y > 84){

		$y = 84;
	} 


if(isset($a['layer_top']) && $a['layer_top'] != ""){
$layout->resizeImage($w, $h, Imagick::FILTER_LANCZOS, 1);
$base->compositeImage($layout, Imagick::COMPOSITE_OVERLAY, $x, $y);
	}

$bar = $base->writeImage('/var/www/mch/env/html5_configurator/img/design/$post[sessionid]-$date-test_wrapper.png');
$base->destroy();
	if($bar){
$barpath = "env/html5_configurator/img/design/$post[sessionid]-$date-test_bar.png";
// echo "x-axis : ".$x." y-axis : ".$y;
echo "<img src='$barpath'>";
return $bar;
	} else {
return false;
	}
}


function exWrapper($a){

$line_1 = $a['line_1'];
$line_2 = $a['line_2'];
$line_3 = $a['line_3'];
$line_4 = $a['line_4'];
$line_1_font = $a['line_1_font'];
$line_2_font = $a['line_2_font'];
$line_3_font = $a['line_3_font'];
$line_4_font = $a['line_4_font'];
$line_1_size = $a['line_1_size'];
$line_2_size = $a['line_2_size'];
$line_3_size = $a['line_3_size'];
$line_4_size = $a['line_4_size'];
$line_1_x = $a['line_1_x'];
$line_2_x = $a['line_2_x'];
$line_3_x = $a['line_3_x'];
$line_4_x = $a['line_4_x'];
$line_1_y = $a['line_1_y'];
$line_2_y = $a['line_2_y'];
$line_3_y = $a['line_3_y'];
$line_4_y = $a['line_4_y'];
$red = $a['red'];
$green = $a['green'];
$blue = $a['blue'];
$red_text = $a['red_text'];
$green_text = $a['green_text'];
$blue_text = $a['blue_text'];
$date = date('Y_m_d_H_i_s');

$base = new \Imagick('/var/www/mch'.$a['base']);
$draw = new \ImagickDraw();
$textColor = "rgb($red_text, $green_text, $blue_text)";


if(isset($a['layer_top']) && $a['layer_top'] != ""){
$layout = new \Imagick();
$layout_x = $a['layer_top_x']; $layout_y = $a['layer_top_y'];
	if($a['image_uploaded'] != true){
	$tempimg = '/var/www/mch/'.$a['layer_top'];
		$im = imagecreatefromstring(base64_decode(transparent($tempimg)));
		imagepng($im, "/var/www/mch/env/html5_configurator/img/design/$post[sessionid]-$date-test_layer.png");
		$tempimg_path = "env/html5_configurator/img/design/$post[sessionid]-$datetest_layer.png";
		$blob = base64_decode(convert($tempimg_path, $red, $green, $blue));
		$layout->readImageBlob($blob);
		$layout->setImageFormat('png');

	} else {
		$layout->readImage($img);
	}
}

if($line_1 != "" || $line_2 != "" || $line_3 != "" || $line_4 != ""){
$line_1_x = $line_1_x + 25; $line_2_x = $line_2_x + 25; $line_3_x = $line_3_x + 25; $line_4_x = $line_4_x + 25;
$line_1_x = ($line_1_x < 65 ? 65 : $line_1_x); $line_1_x = ($line_1_x > 198 ? 198: $line_1_x);
$line_2_x = ($line_2_x < 65 ? 65 : $line_2_x); $line_2_x =  ($line_2_x > 198 ? 198: $line_2_x);
$line_3_x = ($line_3_x < 65 ? 65 : $line_3_x); $line_3_x =  ($line_3_x > 198 ? 198: $line_3_x);
$line_4_x = ($line_4_x < 65 ? 65 : $line_4_x); $line_4_x = ($line_4_x > 198 ? 198: $line_4_x); 

$draw->setFont($line_1_font);
$draw->setFontSize($line_1_size);
$draw->setFontWeight(700);
$draw->setFillColor($textColor);

$base->annotateImage($draw, $line_1_x, $line_1_y, 0, $line_1);

$draw->setFont($line_2_font);
$draw->setFontSize($line_2_size);
$draw->setFontWeight(700);
$draw->setFillColor($textColor);

$base->annotateImage($draw, $line_2_x, $line_2_y, 0, $line_2);

$draw->setFont($line_3_font);
$draw->setFontSize($line_3_size);
$draw->setFontWeight(700);
$draw->setFillColor($textColor);

$base->annotateImage($draw, $line_3_x, $line_3_y, 0, $line_3);

$draw->setFont($line_4_font);
$draw->setFontSize($line_4_size);
$draw->setFontWeight(700);
$draw->setFillColor($textColor);

$base->annotateImage($draw, $line_4_x, $line_4_y, 0, $line_4);
}

echo "line 1x : ". $line_1_x." line 2x : ".$line_2_x." line 3x : ".$line_3_x." line 4x: ".$line_4_x;

// $img = '/var/www/mch'.$a['layout'];
// $size = getimagesize($a['img']);
// $h = $size[1];
// $w = $size[0];
$h = 100;
$w = 100;
$x = $layout_x; $y = $layout_y;

// echo $x." ";
// echo $y;

	if($x < 134){

		$x = 134;
	}

	if($x > 186){

		$x = 186;
	} 

	if($y < 27){

		$y = 27;
	} 

	if($y > 84){

		$y = 84;
	} 

$date = date('Y_m_d_H_i_s');
if(isset($a['layer_top']) && $a['layer_top'] != ""){
$layout->resizeImage($w, $h, Imagick::FILTER_LANCZOS, 1);
$base->compositeImage($layout, Imagick::COMPOSITE_OVERLAY, $x, $y);
	}

$bar = $base->writeImage('/var/www/mch/env/html5_configurator/img/design/$post[sessionid]-$date-test_wrapper.png');
$base->destroy();
	if($bar){
$barpath = "env/html5_configurator/img/design/$post[sessionid]-$date-test_bar.png";
// echo "x-axis : ".$x." y-axis : ".$y;
echo "<img src='$barpath'>";
return $bar;
	} else {
return false;
	}
}


// echo $post['layer_top_x']." ";
// echo $post['layer_top_y']." ";
wrapper($a);
// exWrapper($a);


function convert($image, $red, $green, $blue){

	ob_start();
	$temp = explode("?", $image);
	$image = $temp[0];
	$query = $temp[1];
	// $query = rand(1000000, 9999999);
	$imgdir = $image;

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


	if($ext === 'png' || $imgtype === 3){
					 ob_start();
					 $im = imagecreatefrompng($imgdir);
					 imagefilter($im, IMG_FILTER_COLORIZE, $red, $green, $blue);
					 imagepng($im);
					 $changed_file = base64_encode(ob_get_contents());
					 ob_end_clean();
					
					imagedestroy($im);
				

					return $changed_file;

			
					} else if($ext === 'jpeg' || $ext === 'jpg'  || $imgtype === 2){
					$im = imagecreatefromjpeg($imgdir);
					// $white = imagecolorallocate($im, 255, 255, 255); 
					imagefilter($im, IMG_FILTER_COLORIZE, $red, $green, $blue);
					// imagecolortransparent($im, $white); 
					imagepng($im);
					 
					$changed_file = base64_encode(ob_get_contents());
					ob_end_clean(); 

					imagedestroy($im);

					return $changed_file;
					} else if ($ext === 'gif' || $imgtype === 1){
					$im = imagecreatefromgif($imgdir);
					// $white = imagecolorallocate($im, 255, 255, 255); 
					imagefilter($im, IMG_FILTER_COLORIZE, $red, $green, $blue);
					// imagecolortransparent($im, $white); 
					imagepng($im);

					$changed_file = base64_encode(ob_get_contents());
					ob_end_clean(); 

					imagedestroy($im);

					return $changed_file;

					} else if($ext === 'tiff' || $imgtype === 7 || $imgtype === 8){
					$im = new Imagick();
					$im->setResolution(100, 100);
					$im->readImage($imgdir);
					$im->setImageFormat("png");

					$extln = strlen($ext);

					$dir = substr($imgdir, 0, strlen($imgdir)-$extln);
					$imgdir = $dir."png";
					// echo $imgdir;
					// die();
					// $im->writeImages($imgdir."?".$query, true);
					// $bm = imagecreatefrompng($imgdir);
					// $white = imagecolorallocate($bm, 255, 255, 255); 
					imagefilter($im, IMG_FILTER_COLORIZE, $red, $green, $blue);
					// imagecolortransparent($bm, $white); 
					imagepng($im); 
					
					$changed_file = base64_encode(ob_get_contents());
					ob_end_clean(); 

					imagedestroy($im);

					return $changed_file;

					}else if($ext === 'bmp' || $imgtype === 6){
					$im = new Imagick();
					$im->setResolution(100, 100);
					$im->readImage($imgdir);
					$im->setImageFormat("png");

					$extln = strlen($ext);

					$dir = substr($imgdir, 0, strlen($imgdir)-$extln);
					$imgdir = $dir."png";
					// echo $imgdir;
					// die();
					// $im->writeImages($imgdir, true);
					// $bm = imagecreatefrompng($imgdir);
					// $white = imagecolorallocate($bm, 255, 255, 255); 
					imagefilter($im, IMG_FILTER_COLORIZE, $red, $green, $blue);
					// imagecolortransparent($bm, $white); 
					imagepng($im);

					$changed_file = base64_encode(ob_get_contents());
					ob_end_clean(); 

					imagedestroy($im);

					return $changed_file;

					}else if ($ext === 'eps'){
					$im = new Imagick();
					$im->setResolution(100, 100);
					$im->readImage($imgdir);
					$im->setImageFormat("png");

					$extln = strlen($ext);

					$dir = substr($imgdir, 0, strlen($imgdir)-$extln);
					$imgdir = $dir."png";
					// echo $imgdir;
					// die();
					// $im->writeImages($imgdir."?".$query, true);
					// $bm = imagecreatefrompng($imgdir);
					// $white = imagecolorallocate($bm, 255, 255, 255); 
					imagefilter($im, IMG_FILTER_COLORIZE, $red, $green, $blue);
					// imagecolortransparent($bm, $white); 
					imagepng($im); 

					$changed_file = base64_encode(ob_get_contents());
					ob_end_clean(); 

					imagedestroy($im);

					return $changed_file;

					}
		
}

function transparent($imgdir){

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
				imagefilter($im, IMG_FILTER_EMBOSS);
}}				
					 imagepng($im);

					 $changed_file = base64_encode(ob_get_contents());
					
					 ob_end_clean(); 
					  // $base64 = 'data:image/png'  . ';base64,' . $changed_file;

					imagedestroy($im);
			
					return $changed_file;
}