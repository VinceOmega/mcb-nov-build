<?php

	$size = "";
	$dirs = '/var/www/mch/env/configurator/files/clipArts';
	$dir_name = '/env/configurator/files/clipArts';

		$paths = scandir($dirs);
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
	// print_r($arts);
	// // print_r($art_path);
	// echo "</pre>";
$i = 1;
$skip = "Thumbs.db";
?>


					<p>Add a clip art image to your bar or upload your own. Uploaded images <br>
				are restricted to the following types: jpg, png, eps.</p>
				<form name="add_clipart" method="post" action="#">
				<label for="clipart_select">Add Clipart</label>
					<select name="clipart_select">
						<?php foreach($paths as $path => $value): ?>
						<option data-row="<?=$i?>" value="<?='/var/www/mch/env/configurator/files/clipArts'.'/'.$value?>"><?=$value?></option>
						<? $i++; ?>
						<?php endforeach ?>
					</select>
				</form>
					<div class="select-art-box clipArt col-md-6">
	
						<? $i = 1; ?>
						<ul class="row-1">
							<?php foreach($arts as $arrays => $path): ?>
								<?php foreach($path as $pkey => $val): ?>
									<? if($val != $skip): ?>
										<li><a href="javascript:;" data-clipart="<?='Americana'.'/'.$val?>"><img src="<?=$dir_name.'/'.'Americana'.'/'.$val?>" alt="<?=$val?>" width="63" height="66"></a></li><? if($i%4 === 0): ?> <br> <? endif ?>
									<? $i++; ?>
									<? endif ?>
								<? endforeach ?>
						<? endforeach ?>
						</ul>

					</div>
					<div class="button-submit col-md-2">
					<form method="post" action="javascript:;" class="ajax-upload" id="file-upload" enctype="multipart/form-data">
					
						<button class="btn mango upload-img">Add Image</button>
						<input type="hidden" value="<?php if(isset($files)){ $l = strlen($files); $path = substr($files, 1, $l-1); echo $path; }?>" name="layer_top">
						<input type="hidden" value="<?php if(isset($products)) echo $products->id;?>" name="productsid">
						<input type="hidden" value="<?php if(isset($productname)) echo $productname;?>" name="productname">
						<input type="hidden" value="<?php if(isset($session['session_id'])) echo $session['session_id'];?>" name="sessionid">
						<input type="hidden" value="<?php if(isset($session['user']->id)) echo $session['user']->id;?>" name="userid">
						<input type="hidden" value="" name="baseimg">
						<input type="hidden" value="" name="wrapper">
						<input type="hidden" value="" name="imgposx">
						<input type="hidden" value="" name="imgposy">
						<img  src="" id="wrapperimg" class="hidden">
					</form>
