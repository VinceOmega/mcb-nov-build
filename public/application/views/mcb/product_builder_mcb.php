	<?php foreach($_REQUEST as $key => $value){
		$$key = htmlspecialchars(trim(strip_tags($value)));
	}
	$session = $_SESSION;
	?>
<?
	$bars_path_img = "/env/html5_configurator/bars";
	if($category->category_id == 12 || $category->category_id == 13){
		$class = "cat-1-75";
		$size_dir = "/175x175";
		$dark = "/dark-1-75.png";
		$milk = "/milk-1-75.png";
		$combo = "/combo-1-75.png";

	} else if($category->category_id == 11){
			
		if($products->id == 62){
			$class = "cat-4-6";
			$size_dir  = "/4x6+2x3";
			$dark = "/dark-4-6.png";
			$milk = "/milk-4-6.png";
			$combo = "/combo-4-6.png";
		} else if($products->id == 63){
			$class = "cat-9-5";
			$size_dir  = "/9x5";
			$dark = "/dark-9-5-8.png";
			$milk = "/milk-9-5-8.png";
			$combo = "/combo-9-5-8.png";
		} else if($products->id == 64){
			$class = "cat-9-5";
			$size_dir  = "/9x5";
			$dark = "/dark-9-5-8.png";
			$milk = "/milk-9-5-8.png";
			$combo = "/combo-9-5-8.png";
		} else if($products->id == 65){
			$class = "cat-14-8";
			$size_dir  = "/14x8";
			$dark = "/dark-14-8.png";
			$milk = "/milk-14-8.png";
			$combo = "/combo-14-8.png";
		}
	} else if($category->category_id == 10){
		
			if($products->id == 58){
				$class = "cat-4-6";
				$size_dir  = "/4x6+2x3";
				$dark = "/dark-4-6.png";
				$milk = "/milk-4-6.png";
				$combo = "/combo-4-6.png";
		} else if($products->id == 59){
				$class = "cat-5-2";
				$size_dir  = "/2x5";
				$dark = "/dark-5-2.png";
				$milk = "/milk-5-2.png";
				$combo = "";
		} else if($products->id == 60){
				$class = "cat-5-2";
				$size_dir  = "/2x5";
				$dark = "/dark-5-2.png";
				$milk = "/milk-5-2.png";
				$combo = "";
		} else if($products->id == 61){
				$class = "cat-4-6";
				$size_dir  = "/4x6+2x3";
				$dark = "/dark-4-6.png";
				$milk = "/milk-4-6.png";
				$combo = "/combo-4-6.png";
		}
	}
?>

	<div id="content" class="design-bar row">
		<!-- Hero Display for Bar -->
			<div class="jumbotron design-bar-custom col-md-12">
				<div class="flavor-txt">Design your chocolate bars</div>  

					<div class="overlay" <?if(isset($dark)): $size = getimagesize('/var/www/mch'.$bars_path_img.$size_dir.$dark); $w = $size[0]; $h = $size[1]; ?>style="background-image: url(<? echo $bars_path_img.$size_dir.$dark; ?>); height:<?=$h?>px; width:<?=$w?>px;" <? endif ?>>
							<ul <? if(isset($class)): ?>class="<?=$class?>"<? endif ?>>
								<li class="first-line"></li>
								<li class="second-line"></li>
								<li class="third-line"></li>
								<li class="fourth-line"></li>
							</ul>
							<img id="overlay-image" data-upload="" src="<?php if(isset($files)) echo '/'.$files; ?>" class="clip-art upload-image" height="100" width="100" <?php if(isset($files)) echo "style = 'visibility: visible;'"; ?>>
							<img id="original-image" data-upload=""  data-clipart="" src="<?php if(isset($files)) echo '/'.$files; ?>" class="clip-art upload-image" height="100" width="100" >

					</div>
				<form class="hidden">
						<?php if(isset($files)) {$size = getimagesize("/var/www/mch/".$files); $h = ($size[0])/3; $w = ($size[1])/3; } ?>
						Width: <input type="number" value="<?php if(isset($files)) echo $w; else echo '100';?>" name="img_width" min="50" max="200">
						Height: <input type="number" value="<?php if(isset($files)) echo $h; else echo '100';?>" name="img_height" min="50" max="200">
				</form>

						<div class="image-row"><button class="image-plus btn lt-brown">+</button>&nbsp;<button class="image-minus btn lt-brown">-</button>&nbsp;<button class="btn lt-brown image-remove">Remove</button></div>
						<label>Image Size</label>
			</div>
		<!-- End Display -->
		<!-- 2 Col Start -->
		<div class="2-col col-2-layout col-md-12 row">
			<!-- Left-Col --> 
			<div class="left-col col-md-6 row">
				<div class="col-md-12 notes-box">
					<h5>Important Notes</h5><br/>
					(Please read before ordering)<br/>
					<ol>
						<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
						incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quia nostrud</li>
						<li>Eercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
						in reprehenderit in volutate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur</li>
						<li>Sin occaecut cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est
						laborum. Sed ut perspicaiatis unde omnis iste natus error sit voluptatem accusantium.</li>
						<li>Doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventor veritatis et 
						quasi archietecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia.</li>
						<li>soluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui
						ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia.</li>
					</ol>
			</div>

			<div class="row col-md-12 clipart-box">
				<h3><span class="step-number">Step 2.</span> Add Clipart or Upload an Image</h3>
				<? include 'includes/clipart_section.php' ; ?>
					</div>
					
			</div>

			
	<!-- End Left Col -->
		</div>
	<!-- Begin Right Col -->
		<div class="right-col col-md-6 row">
			
			<div class="col-md-12 add-text-box">
				<h3><span class="step-number">Step 1.</span> Add Your Text</h3>
				<? include 'includes/font_selection.php' ; ?>
			</div>

			<div class="col-md-12 choose-type-bar">
				<h3><span class="step-number">Step 3.</span> Choose Your Chocolate Type</h3><br>
				<p>Choose your chocolate type. The milk and dark chocolate combination is this. The milk and dark chocolate combination is this.</p>
						<form name="type_select" action="#" method="post">
							<? if(isset($dark) && $dark != ""): ?>
							<input type="radio" value="1" name="bar_type" checked>&nbsp;Milk chocolate<br>
							<? endif ?>
							<? if(isset($milk) && $milk != ""): ?>
							<input type="radio" value="2" name="bar_type">&nbsp;Dark chocolate<br>
							<? endif ?>
							<? if(isset($combo) && $combo != ""): ?>
							<input type="radio" value="3" name="bar_type">&nbsp;Milk and dark combo<br>
							<? endif ?>
							<? if(isset($dark) && $dark != ""): ?>
							<img id="bar-milk" class="hidden" data-type="1" src="<? echo $bars_path_img.$size_dir.$dark; ?>">
							<? endif ?>
							<? if(isset($milk) && $milk != ""): ?>
							<img  id="bar-dark" class="hidden" data-type="2" src="<? echo $bars_path_img.$size_dir.$milk; ?>">
							<? endif ?>
							<? if(isset($combo) && $combo != ""): ?>
							<img  id="bar-both" class="hidden" data-type="3" src="<? echo $bars_path_img.$size_dir.$combo; ?>">
							<? endif ?>
						</form>
					</div>
			<!-- End Right Col -->
				</div>
		<!-- End 2 Col -->
		</div>

			<div class="col-md-12 bottom-section">
					<button class=" btn orange save" data-url="/products/wrapper/<?php echo $products->title_url; ?>">Continue with Step 4 &raquo;</button>
			</div>

			<div class="clear large-space">
					
			</div>

	</div>

<?php
echo "<pre>";
// print_r($_SESSION);
// print_r($_COOKIE);
echo "-------------------";
print_r($products);
print_r($category);
echo "</pre>";


?>

<script>
$(document).ready(function(){
	storeBarValues();
loadSavedValues_Bar();
// loadBarTypes();
 setTimeout(loadBarTypes, 800);

});

</script>

