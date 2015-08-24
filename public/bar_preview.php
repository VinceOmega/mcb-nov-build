<?

$post['base'] = '/env/html5_configurator/bars/14x8/dark-14-8.png';
$post['layer_top'] = '/env/configurator/files/clipArts/Americana/amr12.png';
$post['layer_top_x'] = 185;
$post['layer_top_y'] = 84;
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
$post['line_1_x'] = 40;
$post['line_2_x'] = 197;
$post['line_3_x'] = 65;
$post['line_4_x'] = 65;
$post['line_1_y'] = 70;
$post['line_2_y'] = 100;
$post['line_3_y'] = 120;
$post['line_4_y'] = 160;
$post['image_uploaded'] = false;

foreach($post as $key => $value){
		$$key = $value;
}

$a = array(
		'base' => $base,
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
		'image_uploaded' => $image_uploaded
	);



function tinyBar($a){

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
$line_1_y = 50;
$line_2_y = 80;
$line_3_y = 100;
$line_4_y = 140;

$base = new \Imagick('/var/www/mch'.$a['base']);
$draw = new \ImagickDraw();
$fillColor = $base->getImagePixelColor (0, 0);
$textColor = "rgb(126, 64, 17)";

if(isset($a['layer_top']) && $a['layer_top'] != ""){
$layout = new \Imagick();
$layout_x = $a['layer_top_x']; $layout_y = $a['layer_top_y'];
	if($a['image_uploaded'] != true){
		$img = '/var/www/mch/'.$a['layer_top'];
		$blob = base64_decode(convert($img));
		$layout->readImageBlob($blob);
		$layout->setImageFormat('png');

	} else {
		$layout->readImage($img);
	}
}

if($line_1 != "" || $line_2 != "" || $line_3 != "" || $line_4 != ""){
$line_1_x = $line_1_x + 100; $line_2_x = $line_2_x + 100; $line_3_x = $line_3_x + 100; $line_4_x = $line_4_x + 100;
$line_1_x = ($line_1_x < 140 ? 140 : $line_1_x); $line_1_x = ($line_1_x > 164 ? 164: $line_1_x);
$line_2_x = ($line_2_x < 140 ? 140 : $line_2_x); $line_2_x =  ($line_2_x > 164 ? 164: $line_2_x);
$line_3_x = ($line_3_x < 140 ? 140 : $line_3_x); $line_3_x =  ($line_3_x > 164 ? 164: $line_3_x);
$line_4_x = ($line_4_x < 140 ? 140 : $line_4_x); $line_4_x = ($line_4_x > 164 ? 164: $line_4_x); 

$size = getimagesize('/var/www/mch'.$a['base']);
$w = $size[0];
$h = $size[1];

$tras = new Imagick();
$mask = new Imagick();

$tras->newImage($w, $h, new ImagickPixel('grey30'));
$mask->newImage($w, $h, new ImagickPixel('black'));

// $tras->paintTransparentImage(new ImagickPixel('black'), 0.4, 0);



$draw->setFont($line_1_font);
$draw->setFontSize($line_1_size);
$draw->setFontWeight(700);
$draw->setFillColor($textColor);
$tras->annotateImage($draw, $line_1_x-1, $line_1_y-1, 0, $line_1);
$draw->setFillColor('white');
$mask->annotateImage($draw, $line_1_x, $line_1_y, 0, $line_1);
$mask->annotateImage($draw, $line_1_x-1, $line_1_y-1, 0, $line_1);
$draw->setFillColor('black');
$mask->annotateImage($draw, $line_1_x-2, $line_1_y-2, 0, $line_1);




$draw->setFont($line_2_font);
$draw->setFontSize($line_2_size);
$draw->setFontWeight(700);
$draw->setFillColor($textColor);
$tras->annotateImage($draw, $line_2_x-1, $line_2_y-1, 0, $line_2);
$draw->setFillColor('white');
$mask->annotateImage($draw, $line_2_x, $line_2_y, 0, $line_2);
$mask->annotateImage($draw, $line_2_x-1, $line_2_y-1, 0, $line_2);
$draw->setFillColor('black');
$mask->annotateImage($draw, $line_2_x-2, $line_2_y-2, 0, $line_2);





$draw->setFont($line_3_font);
$draw->setFontSize($line_3_size);
$draw->setFontWeight(700);
$draw->setFillColor($textColor);
$tras->annotateImage($draw, $line_3_x-1, $line_3_y-1, 0, $line_3);
$draw->setFillColor('white');
$mask->annotateImage($draw, $line_3_x, $line_3_y, 0, $line_3);
$mask->annotateImage($draw, $line_3_x-1, $line_3_y-1, 0, $line_3);
$draw->setFillColor('black');
$mask->annotateImage($draw, $line_3_x-2, $line_3_y-2, 0, $line_3);





$draw->setFont($line_4_font);
$draw->setFontSize($line_4_size);
$draw->setFontWeight(700);
$draw->setFillColor($textColor);
$tras->annotateImage($draw, $line_4_x-1, $line_4_y-1, 0, $line_4);
$draw->setFillColor('white');
$mask->annotateImage($draw, $line_4_x, $line_4_y, 0, $line_4);
$mask->annotateImage($draw, $line_4_x-1, $line_4_y-1, 0, $line_4);
$draw->setFillColor('black');
$mask->annotateImage($draw, $line_4_x-2, $line_4_y-2, 0, $line_4);


$mask->setImageMatte(false);

$tras->compositeImage($mask, Imagick::COMPOSITE_COPYOPACITY, 0, 0);
$base->compositeImage($tras, Imagick::COMPOSITE_DISSOLVE, 0, 0);
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

$bar = $base->writeImage('/var/www/mch/public/test_bar.png');
$base->destroy();
	if($bar){
$barpath = "test_bar.png";
// echo "x-axis : ".$x." y-axis : ".$y;
echo "<img src='$barpath'>";
return $bar;
	} else {
return false;
	}
}


function smallBar($a){

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
$line_1_y = 50;
$line_2_y = 80;
$line_3_y = 100;
$line_4_y = 140;


$base = new \Imagick('/var/www/mch'.$a['base']);

$draw = new \ImagickDraw();
$fillColor = $base->getImagePixelColor(0, 0);
$textColor = "rgb(126, 64, 17)";

if(isset($a['layer_top']) && $a['layer_top'] != ""){
$layout = new \Imagick();
$layout_x = $a['layer_top_x']; $layout_y = $a['layer_top_y'];
	if($a['image_uploaded'] != true){
		$img = '/var/www/mch/'.$a['layer_top'];
		$blob = base64_decode(convert($img));
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


$size = getimagesize('/var/www/mch'.$a['base']);
$w = $size[0];
$h = $size[1];

$tras = new Imagick();
$mask = new Imagick();

$tras->newImage($w, $h, new ImagickPixel('grey30'));
$mask->newImage($w, $h, new ImagickPixel('black'));

// $tras->paintTransparentImage(new ImagickPixel('black'), 0.4, 0);



$draw->setFont($line_1_font);
$draw->setFontSize($line_1_size);
$draw->setFontWeight(700);
$draw->setFillColor($textColor);
$tras->annotateImage($draw, $line_1_x-1, $line_1_y-1, 0, $line_1);
$draw->setFillColor('white');
$mask->annotateImage($draw, $line_1_x, $line_1_y, 0, $line_1);
$mask->annotateImage($draw, $line_1_x-1, $line_1_y-1, 0, $line_1);
$draw->setFillColor('black');
$mask->annotateImage($draw, $line_1_x-2, $line_1_y-2, 0, $line_1);




$draw->setFont($line_2_font);
$draw->setFontSize($line_2_size);
$draw->setFontWeight(700);
$draw->setFillColor($textColor);
$tras->annotateImage($draw, $line_2_x-1, $line_2_y-1, 0, $line_2);
$draw->setFillColor('white');
$mask->annotateImage($draw, $line_2_x, $line_2_y, 0, $line_2);
$mask->annotateImage($draw, $line_2_x-1, $line_2_y-1, 0, $line_2);
$draw->setFillColor('black');
$mask->annotateImage($draw, $line_2_x-2, $line_2_y-2, 0, $line_2);





$draw->setFont($line_3_font);
$draw->setFontSize($line_3_size);
$draw->setFontWeight(700);
$draw->setFillColor($textColor);
$tras->annotateImage($draw, $line_3_x-1, $line_3_y-1, 0, $line_3);
$draw->setFillColor('white');
$mask->annotateImage($draw, $line_3_x, $line_3_y, 0, $line_3);
$mask->annotateImage($draw, $line_3_x-1, $line_3_y-1, 0, $line_3);
$draw->setFillColor('black');
$mask->annotateImage($draw, $line_3_x-2, $line_3_y-2, 0, $line_3);





$draw->setFont($line_4_font);
$draw->setFontSize($line_4_size);
$draw->setFontWeight(700);
$draw->setFillColor($textColor);
$tras->annotateImage($draw, $line_4_x-1, $line_4_y-1, 0, $line_4);
$draw->setFillColor('white');
$mask->annotateImage($draw, $line_4_x, $line_4_y, 0, $line_4);
$mask->annotateImage($draw, $line_4_x-1, $line_4_y-1, 0, $line_4);
$draw->setFillColor('black');
$mask->annotateImage($draw, $line_4_x-2, $line_4_y-2, 0, $line_4);


$mask->setImageMatte(false);

$tras->compositeImage($mask, Imagick::COMPOSITE_COPYOPACITY, 0, 0);
$base->compositeImage($tras, Imagick::COMPOSITE_DISSOLVE, 0, 0);
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

$bar = $base->writeImage('/var/www/mch/public/test_bar.png');
$base->destroy();
	if($bar){
$barpath = "test_bar.png";
echo "x-axis : ".$x." y-axis : ".$y;
echo "<img src='$barpath'>";
return $bar;
	} else {
return false;
	}
}

function mediumBar($a){

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
$line_1_y = 70;
$line_2_y = 100;
$line_3_y = 120;
$line_4_y = 160;

$base = new \Imagick('/var/www/mch'.$a['base']);
$draw = new \ImagickDraw();
$fillColor = $base->getImagePixelColor(0, 0);
$textColor = "rgb(126, 64, 17)";


if(isset($a['layer_top']) && $a['layer_top'] != ""){
$layout = new \Imagick();
$layout_x = $a['layer_top_x']; $layout_y = $a['layer_top_y'];
	if($a['image_uploaded'] != true){
		$img = '/var/www/mch/'.$a['layer_top'];
		$blob = base64_decode(convert($img));
		$layout->readImageBlob($blob);
		$layout->setImageFormat('png');

	} else {
		$layout->readImage($img);
	}
}

if($line_1 != "" || $line_2 != "" || $line_3 != "" || $line_4 != ""){
// $line_1_x = $line_1_x + 25; $line_2_x = $line_2_x + 25; $line_3_x = $line_3_x + 25; $line_4_x = $line_4_x + 25;
$line_1_x = ($line_1_x < 40 ? 40 : $line_1_x); $line_1_x = ($line_1_x > 235 ? 235: $line_1_x);
$line_2_x = ($line_2_x < 40 ? 40 : $line_2_x); $line_2_x =  ($line_2_x > 235 ? 235: $line_2_x);
$line_3_x = ($line_3_x < 40 ? 40 : $line_3_x); $line_3_x =  ($line_3_x > 235 ? 235: $line_3_x);
$line_4_x = ($line_4_x < 40 ? 40 : $line_4_x); $line_4_x = ($line_4_x > 235 ? 235: $line_4_x); 

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

$bar = $base->writeImage('/var/www/mch/public/test_bar.png');
$base->destroy();
	if($bar){
$barpath = "test_bar.png";
// echo "x-axis : ".$x." y-axis : ".$y;
echo "<img src='$barpath'>";
return $bar;
	} else {
return false;
	}
}

function largeBar($a){

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
$line_1_y = 70;
$line_2_y = 100;
$line_3_y = 120;
$line_4_y = 160;

$base = new \Imagick('/var/www/mch'.$a['base']);
$draw = new \ImagickDraw();
$fillColor = $base->getImagePixelColor(0, 0);
$textColor = "rgb(126, 64, 17)";


if(isset($a['layer_top']) && $a['layer_top'] != ""){
$layout = new \Imagick();
$layout_x = $a['layer_top_x']; $layout_y = $a['layer_top_y'];
	if($a['image_uploaded'] != true){
		$img = '/var/www/mch/'.$a['layer_top'];
		$blob = base64_decode(convert($img));
		$layout->readImageBlob($blob);
		$layout->setImageFormat('png');

	} else {
		$layout->readImage($img);
	}
}

if($line_1 != "" || $line_2 != "" || $line_3 != "" || $line_4 != ""){
// $line_1_x = $line_1_x + 25; $line_2_x = $line_2_x + 25; $line_3_x = $line_3_x + 25; $line_4_x = $line_4_x + 25;
$line_1_x = ($line_1_x < 80 ? 85 : $line_1_x); $line_1_x = ($line_1_x > 187 ? 187: $line_1_x);
$line_2_x = ($line_2_x < 80 ? 85 : $line_2_x);  $line_2_x = ($line_2_x > 187 ? 187: $line_2_x);
$line_3_x = ($line_3_x < 80 ? 85 : $line_3_x);  $line_3_x = ($line_3_x > 187 ? 187: $line_3_x);
$line_4_x = ($line_4_x < 80 ? 85 : $line_4_x);  $line_4_x = ($line_4_x > 187 ? 187: $line_4_x); 

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

$bar = $base->writeImage('/var/www/mch/public/test_bar.png');
$base->destroy();
	if($bar){
$barpath = "test_bar.png";
// echo "x-axis : ".$x." y-axis : ".$y;
echo "<img src='$barpath'>";
return $bar;
	} else {
return false;
	}
}


function kingBar($a){

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

$base = new \Imagick('/var/www/mch'.$a['base']);
$draw = new \ImagickDraw();
$fillColor = $base->getImagePixelColor(0, 0);
$textColor = "rgb(126, 64, 17)";


if(isset($a['layer_top']) && $a['layer_top'] != ""){
$layout = new \Imagick();
$layout_x = $a['layer_top_x']; $layout_y = $a['layer_top_y'];
	if($a['image_uploaded'] != true){
		$img = '/var/www/mch/'.$a['layer_top'];
		$blob = base64_decode(convert($img));
		$layout->readImageBlob($blob);
		$layout->setImageFormat('png');

	} else {
		$layout->readImage($img);
	}
}

if($line_1 != "" || $line_2 != "" || $line_3 != "" || $line_4 != ""){
// $line_1_x = $line_1_x + 25; $line_2_x = $line_2_x + 25; $line_3_x = $line_3_x + 25; $line_4_x = $line_4_x + 25;
$line_1_x = ($line_1_x < 70 ? 70 : $line_1_x); $line_1_x = ($line_1_x > 196 ? 197 + 20 : $line_1_x);
$line_2_x = ($line_2_x < 70 ? 70 : $line_2_x);  $line_2_x = ($line_2_x > 196 ? 197 + 20 : $line_2_x);
$line_3_x = ($line_3_x < 70 ? 70 : $line_3_x);  $line_3_x = ($line_3_x > 196 ? 197 + 20 : $line_3_x);
$line_4_x = ($line_4_x < 70 ? 70 : $line_4_x);  $line_4_x = ($line_4_x > 196 ? 197 + 20 : $line_4_x); 

$size = getimagesize('/var/www/mch'.$a['base']);
$w = $size[0];
$h = $size[1];

$tras = new Imagick();
$mask = new Imagick();

$tras->newImage($w, $h, new ImagickPixel('grey30'));
$mask->newImage($w, $h, new ImagickPixel('black'));

// $tras->paintTransparentImage(new ImagickPixel('black'), 0.4, 0);



$draw->setFont($line_1_font);
$draw->setFontSize($line_1_size);
$draw->setFontWeight(700);
$draw->setFillColor($textColor);
$tras->annotateImage($draw, $line_1_x-1, $line_1_y-1, 0, $line_1);
$draw->setFillColor('white');
$mask->annotateImage($draw, $line_1_x, $line_1_y, 0, $line_1);
$mask->annotateImage($draw, $line_1_x-1, $line_1_y-1, 0, $line_1);
$draw->setFillColor('black');
$mask->annotateImage($draw, $line_1_x-2, $line_1_y-2, 0, $line_1);




$draw->setFont($line_2_font);
$draw->setFontSize($line_2_size);
$draw->setFontWeight(700);
$draw->setFillColor($textColor);
$tras->annotateImage($draw, $line_2_x-1, $line_2_y-1, 0, $line_2);
$draw->setFillColor('white');
$mask->annotateImage($draw, $line_2_x, $line_2_y, 0, $line_2);
$mask->annotateImage($draw, $line_2_x-1, $line_2_y-1, 0, $line_2);
$draw->setFillColor('black');
$mask->annotateImage($draw, $line_2_x-2, $line_2_y-2, 0, $line_2);





$draw->setFont($line_3_font);
$draw->setFontSize($line_3_size);
$draw->setFontWeight(700);
$draw->setFillColor($textColor);
$tras->annotateImage($draw, $line_3_x-1, $line_3_y-1, 0, $line_3);
$draw->setFillColor('white');
$mask->annotateImage($draw, $line_3_x, $line_3_y, 0, $line_3);
$mask->annotateImage($draw, $line_3_x-1, $line_3_y-1, 0, $line_3);
$draw->setFillColor('black');
$mask->annotateImage($draw, $line_3_x-2, $line_3_y-2, 0, $line_3);





$draw->setFont($line_4_font);
$draw->setFontSize($line_4_size);
$draw->setFontWeight(700);
$draw->setFillColor($textColor);
$tras->annotateImage($draw, $line_4_x-1, $line_4_y-1, 0, $line_4);
$draw->setFillColor('white');
$mask->annotateImage($draw, $line_4_x, $line_4_y, 0, $line_4);
$mask->annotateImage($draw, $line_4_x-1, $line_4_y-1, 0, $line_4);
$draw->setFillColor('black');
$mask->annotateImage($draw, $line_4_x-2, $line_4_y-2, 0, $line_4);


$mask->setImageMatte(false);

$tras->compositeImage($mask, Imagick::COMPOSITE_COPYOPACITY, 0, 0);
$base->compositeImage($tras, Imagick::COMPOSITE_DISSOLVE, 0, 0);
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

$bar = $base->writeImage('/var/www/mch/public/test_bar.png');
$base->destroy();
	if($bar){
$barpath = "test_bar.png";
// echo "x-axis : ".$x." y-axis : ".$y;
echo "<img src='$barpath'>";
return $bar;
	} else {
return false;
	}
}
// echo $post['layer_top_x']." ";
// echo $post['layer_top_y']." ";
//tinyBar($a); //1-75
smallBar($a); //14-8
// mediumBar($a); //5-2
// largeBar($a); //4-6
//kingBar($a); //9-5-8
$ext = ".".trim(pathinfo($a['base'], PATHINFO_EXTENSION));
echo basename($a['base'], $ext);



function convert($imgdir){

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
		$brown = imagecolorallocate($im, 126, 64, 17);

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
					imagesetpixel($im, $x,$y, $brown);
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