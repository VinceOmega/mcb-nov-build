<?php
 error_reporting(-1);

$data = array();

foreach($_REQUEST as $key => $value){
	// echo "Key :".$key."\n\r";
	// echo "Value :".$value."\n\r";
		$$key = htmlspecialchars(trim(strip_tags($value)));
}


// print_r($_FILES);
// echo $_SERVER['HTTP_REFERER'];
// header("Location:$_SERVER[HTTP_REFERER]");
// die();

if(isset($_FILES['files']['name'])){


	// if($_FILES['files']['error'] > 0){
	// 	$data = array(
	// 			'error' => 'Something went wrong while uploading your file. Please try again.'
	// 		);

	// 	//echo json_encode($data);
	// 	echo 'There is a problem with your file, either the file was corrupted or the file upload was interrupted.
	// 	// <br> Please try again.';
	// 	// sleep(3);
	// 	//header("Location:$_SERVER[HTTP_REFERER]");
	// 	die();
	// }	


 	if($_FILES['files']['size'][0] < 0){
		$data = array(
				'error' => 'We need you to upload your resume'
			);

		echo 'file size less than zero';
		//echo json_encode($data);
		// sleep(3);
	//	header("Location:$_SERVER[HTTP_REFERER]");
		die();
	}



		$path = $_FILES['files']['name'][0];
		$ext = trim(pathinfo($path, PATHINFO_EXTENSION));

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




/* Handle the upload */
	$date = date("Y-m-d--H-i-s");
	$uploadpath = "/var/www/mch/env/html5_configurator/img/".$date."-".$_FILES["files"]["name"][0];
		
	if(file_exists($uploadpath)){

	  echo "same file";

		// header("Location:$_SERVER[HTTP_REFERER]?files=$uploadpath");
		 // sleep(3);
		die();
			
	} else {
		// var_dump($_FILES['resume']['name']);
		// die();
		
		$normalpath = "/env/html5_configurator/img/".$date."-".$_FILES["files"]["name"][0];
		move_uploaded_file($_FILES['files']['tmp_name'][0], $uploadpath);
		 $data = array('success' => 'Form was submitted', 'formData' => $_POST);
		// echo json_encode($data);

		 $imgdir = $uploadpath;

		 			if($ext === 'png'){
					

					list($width, $height) = getimagesize($imgdir);
					$new_width = $width;
					$new_height = $height;
					$image_p = imagecreatetruecolor($new_width, $new_height);


					$im = imagecreatefrompng($imgdir);

					$colors = array();




					imagepng(transparent($im, $new_width, $new_height), $imgdir); 
					imagedestroy($im); 
					} else if($ext === 'jpeg' || $ext === 'jpg'){


					list($width, $height) = getimagesize($imgdir);
					$new_width = $width;
					$new_height = $height;
					$image_p = imagecreatetruecolor($new_width, $new_height);
					
					$im = imagecreatefromjpeg($imgdir);
					$colors = array();




					imagepng(transparent($im, $new_width, $new_height), $imgdir); 
					imagedestroy($im); 
					


					} else if ($ext === 'gif'){

							list($width, $height) = getimagesize($imgdir);
					$new_width = $width;
					$new_height = $height;
					$image_p = imagecreatetruecolor($new_width, $new_height);


					$im = imagecreatefromgif($imgdir);

					$colors = array();




					imagepng(transparent($im, $new_width, $new_height), $imgdir); 
					imagedestroy($im); 
					
					} else if($ext === 'tiff'){
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
					$bm = imagecreatefrompng($imgdir);
					list($width, $height) = getimagesize($imgdir);
					$new_width = $width;
					$new_height = $height;
					// $white = imagecolorallocate($bm, 255, 255, 255); 
					// imagefilter($bm, IMG_FILTER_GRAYSCALE); 
					// imagecolortransparent($bm, $white); 
					imagepng(transparent($bm, $new_width, $new_height), $imgdir); 
					imagedestroy($bm);

					}else if($ext === 'bmp'){
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
					$bm = imagecreatefrompng($imgdir);
					list($width, $height) = getimagesize($imgdir);
					$new_width = $width;
					$new_height = $height;
					// $white = imagecolorallocate($bm, 255, 255, 255); 
					// imagefilter($bm, IMG_FILTER_GRAYSCALE); 
					// imagecolortransparent($bm, $white); 
					imagepng(transparent($bm, $new_width, $new_height), $imgdir); 
					imagedestroy($bm);
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
					$im->writeImages($imgdir, true);
					$bm = imagecreatefrompng($imgdir);
					list($width, $height) = getimagesize($imgdir);
					$new_width = $width;
					$new_height = $height;
					// $white = imagecolorallocate($bm, 255, 255, 255); 
					// imagefilter($bm, IMG_FILTER_GRAYSCALE); 
					// imagecolortransparent($bm, $white); 
					imagepng(transparent($bm, $new_width, $new_height), $imgdir); 
					imagedestroy($bm);
					}

					$uri = substr($imgdir, 13, strlen($imgdir)-1);
					 $ref = "";
					 $ref = explode("?", $_SERVER['HTTP_REFERER']);

			echo "$uri"; 
		//header("Location:$ref[0]?files=$uri");
	}
}




function transparent($im, $new_width, $new_height){

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
				return $im;
}

