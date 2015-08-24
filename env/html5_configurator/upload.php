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
					$im = imagecreatefrompng($imgdir);
					// $black = imagecolorallocate($im, 0, 0, 0);
					// imagefilter($im, IMG_FILTER_COLORIZE, 0, 0, 0); 
					// imagecolortransparent($im, $black);
					imagepng($im, $imgdir); 
					imagedestroy($im); 
					} else if($ext === 'jpeg' || $ext === 'jpg'){
					$im = imagecreatefromjpeg($imgdir);
					// $white = imagecolorallocate($im, 255, 255, 0);
					// imagefilter($im, IMG_FILTER_COLORIZE, 0, 0, 0); 
					// imagecolortransparent($im, $white);
					// $white = imagecolorallocate($im, 255, 255, 255);
					// imagefilter($im, IMG_FILTER_COLORIZE, 255, 255, 255); 
					// imagecolortransparent($im, $white);
					imagepng($im, $imgdir); 
					imagedestroy($im);
						// ob_start();
						//  $imagick = new \Imagick($imgdir);
    		// 			$imagick->shadeImage(true, 45, 20);
    				
    		// 			echo $imagick->getImageBlob();
    		// 			$changed_file = base64_encode(ob_get_contents());
    		// 			ob_end_clean();
    		// 			$base64 = 'data:image/jpg'  . ';base64,' . $changed_file;
    		// 			$imagick->destroy();
    		// 			echo $base64;

					} else if ($ext === 'gif'){
					$im = imagecreatefromgif($imgdir);
					// $white = imagecolorallocate($im, 255, 255, 255); 
					// imagefilter($im, IMG_FILTER_GRAYSCALE); 
					// imagecolortransparent($im, $white); 
					imagepng($im, $imgdir); 
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
					$im->destroy();
					$bm = imagecreatefrompng($imgdir);
					// $white = imagecolorallocate($bm, 255, 255, 255); 
					// imagefilter($bm, IMG_FILTER_GRAYSCALE); 
					// imagecolortransparent($bm, $white); 
					imagepng($bm, $imgdir); 
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
					$im->destroy();
					$bm = imagecreatefrompng($imgdir);
					// $white = imagecolorallocate($bm, 255, 255, 255); 
					// imagefilter($bm, IMG_FILTER_GRAYSCALE); 
					// imagecolortransparent($bm, $white); 
					imagepng($bm, $imgdir); 
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
					$im->destroy();
					$bm = imagecreatefrompng($imgdir);
					// $white = imagecolorallocate($bm, 255, 255, 255); 
					// imagefilter($bm, IMG_FILTER_GRAYSCALE); 
					// imagecolortransparent($bm, $white); 
					imagepng($bm, $imgdir); 
					imagedestroy($bm);
					}

					$uri = substr($imgdir, 13, strlen($imgdir)-1);
					 $ref = "";
					 $ref = explode("?", $_SERVER['HTTP_REFERER']);

			echo "$uri"; 
		//header("Location:$ref[0]?files=$uri");
	}
}