<?php
//create the directory if doesn't exists (should have write permissons)
if(!is_dir("./files")) mkdir("./files", 0755); 
//move the uploaded file
$now = time();

/*
$myFile = "./files/testFile.txt";
$fh = fopen($myFile, 'w') or die("can't open file");
$stringData = "HERE IS YOUR PIXEL DATA\n";
fwrite($fh, $stringData);
$stringData = "-----------------------\n";
fwrite($fh, $stringData);
*/

list($width, $height) = getimagesize($_FILES['Filedata']['tmp_name']);
$new_width = $width;
$new_height = $height;

// Resample
$image_p = imagecreatetruecolor($new_width, $new_height);
if(strpos($_FILES['Filedata']['name'], '.jpg') > 0)
	$image = imagecreatefromjpeg($_FILES['Filedata']['tmp_name']);
elseif(strpos($_FILES['Filedata']['name'], '.gif') > 0)
	$image = imagecreatefromgif($_FILES['Filedata']['tmp_name']);
elseif(strpos($_FILES['Filedata']['name'], '.png') > 0)
	$image = imagecreatefrompng($_FILES['Filedata']['tmp_name']);

$colors = array(); 


//imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

if($image && imagefilter($image, IMG_FILTER_GRAYSCALE)) {

	//imagealphablending($image_p, true);

	$transparencyIndex = imagecolortransparent($image); 
	
	if ($transparencyIndex >= 0) { 

	} else {
		// Create an index for the color white
		$white = imagecolorallocate($image, 255, 255, 255);
		$black = imagecolorallocate($image, 0, 0, 0);
/*
		while(count($colors) <= 50) {
			
			$randColor = rand(0,255);
			 if(array_key_exists($randColor, $colors)) {
				continue;
			 } else {
				array_push($colors, $randColor);
			 }

		}*/
		//Set each pixel that is lighter than 200,200,200 to white
		for($x = 0; $x < $new_width; $x++) {

			for($y = 0; $y < $new_height; $y++) {
				
				$rgb = imagecolorat($image,$x,$y);
				$r = ($rgb >> 16) & 0xFF;
				$g = ($rgb >> 8) & 0xFF;
				$b = $rgb & 0xFF;
				

				if($r > 150 && $g > 150 && $b > 150)
					imagesetpixel($image, $x,$y, $white);
				else 
					imagesetpixel($image, $x,$y, $black);
				$stringData = 'Red: '.$r.' -- Green: '.$g.' -- Blue: '.$b.' \n';
				//fwrite($fh, $stringData);


			}


		}
		// Make the background transparent
		// TRUE COLOR
		//$white = imagecolorallocatealpha($image_p, 255, 255, 255, 0);  
		// RGB
		imagecolortransparent($image, $white);
		

	}
	//for($h = 1; $h < 55; $h++) {
	//	$greyVal = 255 - $h;
	//	$color = imagecolorallocate($image, $greyVal, $greyVal, $greyVal);
	//	imagecolortransparent($image, $color);

	//}


	if(strrpos($_FILES['Filedata']['name'], ".jpeg"))
		$_FILES['Filedata']['name'] = substr($_FILES['Filedata']['name'], 0, -5).".png";
	else
		$_FILES['Filedata']['name'] = substr($_FILES['Filedata']['name'], 0, -4).".png";

	imagepng($image, "./files/".$_FILES['Filedata']['name'], 1);

} else {

	$_FILES['Filedata']['name'] = substr($_FILES['Filedata']['name'], 0, -4).".png";
	move_uploaded_file($_FILES['Filedata']['tmp_name'], "./files/".$_FILES['Filedata']['name']);
}
//fclose($fh);

chmod("./files/".$_FILES['Filedata']['name'], 0777);
?>