	<?php foreach($_REQUEST as $key => $value){
		$$key = htmlspecialchars(trim(strip_tags($value)));
	}
	$session = $_SESSION;
	?>
<div id="content" class="design-wrapper row">
		<!-- Hero Display for Bar -->
			<div class="jumbotron design-bar-custom col-md-12">
			<div class="flavor-txt">Design your wrapper</div>
				<div class="wrapper-background">
					<!-- <img src="/env/images/mcb/wrapper.png"> -->
					<!-- <img src="<?php if(isset($filesbg)) echo $filesbg; ?>" class="bg-img upload-image" height="100" width="100" <?php if(isset($filesbg)) echo "style = 'visibility: visible;'"; ?>> -->
					<div class="overlay clr">
							<ul>
								<li class="first-line"></li>
								<li class="second-line"></li>
								<li class="third-line"></li>
								<li class="fourth-line"></li>
							</ul>
							<img id="overlay-image" data-upload="" src="<?php if(isset($files)) echo '/'.$files; ?>" class="clip-art upload-image" height="100" width="100" <?php if(isset($files)) echo "style = 'visibility: visible;'"; ?>>
							<img id="original-image" data-upload=""  data-clipart="" src="<?php if(isset($files)) echo '/'.$files; ?>" class="hidden" height="100" width="100">
					
					</div>
				</div>
				<img src="" class="hidden" id="#wrapperimg"> 
				<form class="hidden">
				<?php if(isset($files)) {$size = getimagesize("/var/www/mch/".$files); $h = ($size[0])/3; $w = ($size[1])/3; } ?>
						Width: <input type="number" value="<?php if(isset($files)) echo $w; else echo '100';?>" name="img_width" min="50" max="200">
						Height: <input type="number" value="<?php if(isset($files)) echo $h; else echo '100';?>" name="img_height" min="50" max="200">
				</form>
				<div class="image-row"><button class="image-plus btn lt-brown">+</button>&nbsp;<button class="image-minus btn lt-brown">-</button>&nbsp;<button class="btn lt-brown image-remove">Remove</button></div>
						<label>Image Size</label>
			</div>
		<!-- End Display -->

			<div class="2-col col-2-layout col-md-12 row">
			<!-- Left-Col --> 
			<div class="left-col col-md-6 row">

				<div class="col-md-12 add-text-box">
					<h3><span class="step-number">Step 4.</span> Add Your Text</h3>
					<? include 'includes/font_selection.php' ; ?>
				</div>

				<div class="row col-md-12 clipart-box">
					<h3><span class="step-number">Step 6.</span> Add Clipart or Upload an Image</h3>
					<? include 'includes/clipart_section.php' ; ?>
							
				</div>
					
			</div>

			
	<!-- End Left Col -->
		</div>
	<!-- Begin Right Col -->
		<div class="right-col col-md-6 row">


			<div class="row col-md-12 clipart-box background-image">
					<h3><span class="step-number">Step 5.</span> Add Your Background</h3>
					<? include 'includes/wrapper_section.php'; ?>
					</div>
					
			</div>
			

			<div class="col-md-12 choose-color-box">
				<h3><span class="step-number">Step 7.</span> Choose Your Colors</h3><br>
			<ul>
				<li><a href="javascript:;" alt="color" class="clr blueberry" data-name="Blueberry"></a></li>
				<li><a href="javascript:;" alt="color" class="clr lime" data-name="Lime"></a></li>
				<li><a href="javascript:;" alt="color" class="clr pink" data-name="Pink"></a></li>
				<li><a href="javascript:;" alt="color" class="clr purple" data-name="Purple"></a></li>
				<li><a href="javascript:;" alt="color" class="clr cherry" data-name="Cherry"></a></li>
				<li><a href="javascript:;" alt="color" class="clr sunlight" data-name="Sunlight"></a></li>
				<li><a href="javascript:;" alt="color" class="clr pale-sun" data-name="Pale-Sun"></a></li>
				<li><a href="javascript:;" alt="color" class="clr sky" data-name="Sky"></a></li>
				<li><a href="javascript:;" alt="color" class="clr pale-sky" data-name="Pale-Sky"></a></li>
				<li><a href="javascript:;" alt="color" class="clr dark" data-name="Black"></a></li>
			</ul>

			<a class="text-color-link grey rnd-bar rnd selected" data-radio="active">&nbsp;&nbsp;Text Color: <span class="text-color">Black</span></a><br>
			<a class="clipart-color-link" data-radio="inactive">&nbsp;&nbsp;Clipart/Image Color : <span class="clipart-color">Black</span></a>
			
			</div>
				<form name="select_color" class="hidden">
					<input type="radio" name="color_select_type" value="text" id="radio-text" checked>Text
					<input type="radio" name="color_select_type" value="clipart" id="radio-clipart">Clipart
				</form>
				<form name="store_color" class="storeColor hidden" action="#" method="post">
					<input type="hidden" name="textColor" value="">
					<input type="hidden" name="artColor" value="">
				</form>
					</div>
			<!-- End Right Col -->
				</div>
		<!-- End 2 Col -->


			<div class="col-md-12 bottom-section">
	
					<button class="btn orange left" data-href="/products/build/<?php echo $products->title_url; ?>">&laquo; Edit Your Chocolate Bar </button>
					<button id="save-cart" class="btn orange right save-cart"  data-url="/shopping_cart">Check Out &raquo;</button>
					<button class="btn mango right <?if($user) echo 'save-later';?>"  <?if($user){?>data-url=<?}else{?>data-href=<? }?>"<?if ($user) { echo '/customers/my_account'; } else { echo '/customers/register';} ?>" >Save Your Design for Later</button>
		
					
			</div>

			<div class="clear large-space">

			</div>
	</div>

<div id="navi-listen">
	<div class="page">
				<a href="#"><img src="/env/images/mcb/close-x.png" alt="close" class="modal-close"></a>
		<blockquote>
				You are about to leave the application without saving your creation, are you sure you want to do this?
		</blockquote>
		<div class="button-menu">
			<button class="btn btn-thin orange save-n-quit">Save and Quit</button><button class="btn btn-thin mango quit">Quit</button>
		</div>
	</div>
</div>
<?php
	echo "<pre>";
	print_r($session);
	// print_r($user);
	print_r($category);
	echo "</pre>";
?>

<script>
$(document).ready(function(){

<? if($category->category_id == 11){ ?>
	
<? } else {?>
	storeWrapperValues();
	setTimeout(loadSavedValues_Wrapper, 1000);
<? }?>
	$("#container header a, #navigation a, footer.leaves ul li a").each(function(e){
			var url = $(this).attr("href");
			$(this).attr("data-href", url);
			$(this).attr("href", "#");
			$(this).off();
	});

	$("#container header a, #navigation a, footer.leaves ul li a").click( function(e){
		// alert("fired");
			// e.preventDefault();

					var link = $(this).data("href");
					$("button.quit, button.save-n-quit").attr("data-href", link);
					$("#navi-listen").fadeIn(500);
					$("#navi-listen .page").fadeIn(1500);
					
			return true;		
			
			});

	
});

</script>