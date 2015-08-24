<?php

//print_r($_GET);
$dirs = $_REQUEST['path'];
$dir = '/env/configurator/files/clipArts/';
$nameA = explode("/", $dirs);

$idx = sizeof($nameA);
$name = $nameA[$idx - 1];
$paths = scandir($dirs);
$i = 0;
// echo $name;
array_shift($paths);
array_shift($paths);
$skip = "Thumbs.db";
?>
<ul class="row-1">
<?php foreach($paths as $path => $value): ?>
		<?php if($value != $skip): ?>
		
							
								
					<? if($val != $skip): ?>
										<li><a href="javascript:;" data-clipart="<?=$name.'/'.$value?>"><img src="<?=$dir.$name.'/'.$value?>" alt="<?=$val?>" width="63" height="66"></a></li>
										<? if($i%4 === 0): ?>
										<br> 
										<?endif ?>
									<? endif ?>
							

						
		<? endif ?>
						<? $i++ ?>
<? endforeach ?>
</ul>
