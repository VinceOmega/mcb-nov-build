<?php

$size = "";
$dirs =  '/var/www/mch/env/html5_configurator/fonts' ;
	//echo $dirs;

	$paths = scandir($dirs);
	//print_r($paths);
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
	// echo "<pre>";
	// print_r($paths);
	// print_r($name);
	// echo "</pre>";
?>
<?
$bar_pattern = '\/products\/build\/[a-zA-Z]*';
$wrapper_pattern = '\/products\/wrapper\/[a-zA-Z]*';
if(isset($_COOKIE['bar']) || isset($_COOKIE['wrapper'])){
if(preg_match($_SERVER['PATH_INFO'], $bar_pattern)){
				foreach($_COOKIE['bar'] as $array){
						foreach($array as $key => $value){
								$$key = $value;
						}
				}
} else if (preg_match($_SERVER['PATH_INFO'], $wrapper_pattern)){
	foreach($_COOKIE['wrapper'] as $array){
						foreach($array as $key => $value){
								$$key = $value;
						}
				}
			}
}

?>
<form name="add_text_to_bar" action="#" method="post">
						<label for="line_1">Line 1</label><input name="line_1" type="text" value="<? if(isset($line_1)) echo $line_1; ?>">
						<select name="font_1">
					<!-- 	<option value="Please select a font"></option> -->
							<? if($paths) {?>
							 <? $tmp = ""; ?>
							<? foreach($paths as $path => $value){?>
							
							<option value="<?=$value?>" ><? echo substr($value, 0, strpos($value, "."));   ?></option>
							<? }}?>
					
						</select>
						<a href="javascript:;" class="minus_1">-</a><input type="number" name="quan_1" value="20" min="20" max="30"><a href="javascript:;" class="plus_1">+</a>&nbsp;<a href="javascript:;" class="remove_1">[x]</a><br>
						<label for="line_2">Line 2</label><input name="line_2" type="text" value="<? if(isset($line_2)) echo $line_2; ?>">
						<select name="font_2">
<!-- 						<option value="Please select a font"></option>
 -->							<? if($paths) {?>
							 <? $tmp = ""; ?>
							<? foreach($paths as $path => $value){?>
							
							<option value="<?=$value?>" ><? echo substr($value, 0, strpos($value, "."));   ?></option>
							<? }}?>
						</select>
						<a href="javascript:;" class="minus_2">-</a><input type="number" name="quan_2" value="20" min="20" max="30"><a href="javascript:;" class="plus_2">+</a>&nbsp;<a href="javascript:;" class="remove_2">[x]</a><br>
						<label for="line_3">Line 3</label><input name="line_3" type="text" value="<? if(isset($line_3)) echo $line_3; ?>">
						<select name="font_3">
						<!-- <option value="Please select a font"></option> -->
						<? if($paths) {?>
							 <? $tmp = ""; ?>
							<? foreach($paths as $path => $value){?>
							
							<option value="<?=$value?>" ><? echo substr($value, 0, strpos($value, "."));   ?></option>
							<? }}?>
						</select>
						<a href="javascript:;" class="minus_3">-</a><input type="number" name="quan_3" value="20" min="20" max="30"><a href="javascript:;" class="plus_3">+</a>&nbsp;<a href="javascript:;" class="remove_3">[x]</a><br>
						<label for="line_4">Line 4</label><input name="line_4" type="text" value="<? if(isset($line_4)) echo $line_4; ?>">
						<select name="font_4">
						<!-- <option value="Please select a font"></option> -->
							<? if($paths) {?>
							 <? $tmp = ""; ?>
							<? foreach($paths as $path => $value){?>
							
							<option value="<?=$value?>" ><? echo substr($value, 0, strpos($value, "."));   ?></option>
							<? }}?>
						</select>
						<a href="javascript:;" class="minus_4">-</a><input type="number" name="quan_4" value="20" min="20" max="30"><a href="javascript:;" class="plus_4">+</a>&nbsp;<a href="javascript:;" class="remove_4">[x]</a><br>
						<input type="hidden" value="" name="hquan_1">
						<input type="hidden" value="" name="hquan_2">
						<input type="hidden" value="" name="hquan_3">
						<input type="hidden" value="" name="hquan_4">
						<input type="hidden" value="" name="hfont_1">
						<input type="hidden" value="" name="hfont_2">
						<input type="hidden" value="" name="hfont_3">
						<input type="hidden" value="" name="hfont_4">
						<input type="hidden" value="" name="line_one_x">
						<input type="hidden" value="" name="line_two_x">
						<input type="hidden" value="" name="line_three_x">
						<input type="hidden" value="" name="line_four_x">
						<input type="hidden" value="" name="line_one_y">
						<input type="hidden" value="" name="line_two_y">
						<input type="hidden" value="" name="line_three_y">
						<input type="hidden" value="" name="line_four_y">


				</form>