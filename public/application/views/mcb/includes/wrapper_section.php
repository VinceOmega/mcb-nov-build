<?php

	
	$size = "";
	if($category->category_id == 11){
		// echo 'exec';
		// die();
		$dirs_banner = '/var/www/mch/env/html5_configurator/exec_wrapper';
	$dir_banner_name = '/env/html5_configurator/exec_wrapper';
	$folder = "exec_wrapper/";
	} else {
		// echo 'norm';
		// die();
	$dirs_banner = '/var/www/mch/env/html5_configurator/banner';
	$dir_banner_name = '/env/html5_configurator/banner';
	$folder = "banner/";
}
	$dirs_wrapper = '/var/www/mch/env/html5_configurator/wrapper';
	$dirs_wrapper_name = '/env/html5_configurator/wrapper';

		$paths = scandir($dirs_banner);
		$idx = sizeof($paths);
		$i = 0;
		$j = 0;
		$dir_array = Array();
		while($i < $idx){
		if( strpos($paths[$i], ".") === FALSE){

				array_push($dir_array, $paths[$i]);
				$i++;
	} else{
		
		$i++;
		}
	}
	array_shift($paths);
	array_shift($paths);
	$name = array();
	foreach($paths as $path){
	$name[] = explode(".", $path);

		
}

// foreach($paths as $path => $value){
// 				// array_shift($path);
// 				// array_shift($path);
// 				$arts[] = scandir($dirs.'/'.$value);		
// 		}

$arts[] = scandir($dirs.'/'.'Americana');
foreach($arts as $arrays => $path){

		 array_shift($arts["$arrays"]);
		 array_shift($arts["$arrays"]);

}
	// echo "<pre>";
	// print_r($paths);
	// // print_r($arts);
	// // print_r($art_path);
	// echo "</pre>";
$i = 1;
$skip = "Thumbs.db";
?>

<p>Add a background image to your bar or upload your own. Uploaded images <br>
				are restricted to the following types: jpg, png, eps.</p>
				<form name="add_clipart" method="post" action="#">
			<!-- 	<label for="clipart_select">Add Clipart</label>
					<select name="clipart_select">
						<option value="1">Americana</option>
						<option value="2">Europiana</option>
					</select> -->
				</form>
					<div class="select-art-box bg col-md-6">
						<ul class="row-1" <? if($category->category_id == 11) {?>style = "background-color:white;" <?} ?>>
							<? foreach($paths as $path => $file):?>
							<? $partial = $folder.$file ?> 
							<li <? if($category->category_id == 11) {?>style = "background-color:white;" <?} ?>><a href="javascript:;" data-clipart="<?=$partial?>" style="background-image: url(<?=$dir_banner_name.'/'.$file?>)"><img src="<?=$dir_banner_name.'/'.$file?>" alt="x-img" width="63" height="66" class="hidden"></a></li><? if($i%4 === 0): ?><br><? endif ?>
							<? $i++; ?>
							<? endforeach ?>
						<!-- 	<li><a href="javascript:;" data-clipart="purple-sm.jpg"><img src="/env/configurator/files/clipArts/Angels/ang1.png" alt="x-img" width="63" height="66" ></a></li>							
							<li><a href="javascript:;" data-clipart="sky.png"><img src="/env/configurator/files/clipArts/Anniversry/ann1.png" alt="x-img" width="63" height="66" ></a></li>							
							<li><a href="javascript:;" data-clipart=""><img src="/env/configurator/files/clipArts/Asian/asi1.png" alt="x-img" width="63" height="66" ></a></li>						
						 --></ul>
					<!-- 		<ul class="row-2">
							<li><a href="javascript:;"  data-clipart=""><img src="/env/configurator/files/clipArts/Birthday/bir1.png" alt="x-img" width="63" height="66" ></a></li>
							<li><a href="javascript:;"  data-clipart=""><img src="/env/configurator/files/clipArts/Christmas/chr1.png" alt="x-img" width="63" height="66" ></a></li>							
							<li><a href="javascript:;"  data-clipart=""><img src="/env/configurator/files/clipArts/Father's Day/fd-01.gif" alt="x-img" width="63" height="66" ></a></li>							
							<li><a href="javascript:;"  data-clipart=""><img src="/env/configurator/files/clipArts/Japanese/ja-01.gif" alt="x-img" width="63" height="66" ></a></li>						
						</ul> -->
					<!-- 		<ul class="row-3">
							<li><a href="javascript:;"  data-clipart="Medical/med1.png"><img src="/env/configurator/files/clipArts/Medical/med1.png" alt="x-img" width="63" height="66" ></a></li>
							<li><a href="javascript:;"  data-clipart="Real Estate/re-01.gif"><img src="/env/configurator/files/clipArts/Real Estate/re-01.gif" alt="x-img" width="63" height="66" ></a></li>							
							<li><a href="javascript:;"  data-clipart="SunMoon/sms1.png"><img src="/env/configurator/files/clipArts/SunMoon/sms1.png" alt="x-img" width="63" height="66" ></a></li>							
							<li><a href="javascript:;"  data-clipart="Wedding/qui17.png"><img src="/env/configurator/files/clipArts/Wedding/qui17.png" alt="x-img" width="63" height="66" ></a></li>						
						</ul> -->
					</div>
					<div class="button-submit col-md-2">
						<form method="post" action="javascript:;" class="ajax-upload" id="file-upload" enctype="multipart/form-data">
							<button class="btn mango upload-img">Add Image</button>
							<input type="hidden" value="<?php if(isset($files)) echo $files; ?>" name="layer_top">
							<input type="hidden" value="<?php if(isset($products)) echo $products->id;?>" name="productsid">
							<input type="hidden" value="<?php if(isset($productname)) echo $productname;?>" name="productname">
							<input type="hidden" value="<?php if(isset($session['session_id'])) echo $session['session_id'];?>" name="sessionid">
							<input type="hidden" value="" name="wrapper">
							<input type="hidden" value="<?php if(isset($user->id)) echo $user->id;?>" name="userid">
							
						</form>