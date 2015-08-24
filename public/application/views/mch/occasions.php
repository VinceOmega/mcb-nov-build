<div id="content">
			<div id="pink-section-header">
				<h2 class="curly"><?php echo $occasion->name; ?></h2>
			</div><!-- header -->
			<div id="top">
				<div id="occasion" class="left">
					<div id="blurb" class="pink-top grey-border left">
						<h3><?php echo $occasion->headline; ?></h3>
						<p><?php echo $occasion->short_description; ?></p>
					</div><!-- blurb -->
					<a href="/products"><img style="clear: left; margin-top: 20px;" class="right" src="/env/images/<?=My_Template_Controller::getViewPrefix()?>/custom_button.png" /></a>
				</div><!-- occasion -->
				<div id="images" class="right">
          <?php if($occasion->image): ?>
					<img class="right" src="/env/product_images/<?php echo $occasion->image; ?>" ALT="<?php echo $occasion->image_alt; ?>" />
          <?php else: ?>
          <img src="/env/images/vday.png" />
          <?php endif; ?>
				</div><!-- images -->
			</div><!-- top -->
			<div class="pink-bar"></div>
			<div id="bottom">
				
				<?php foreach($productresults as $products):?>
				<div class="box grey-border left pink-corner">
					<img src="/env/product_images/<?php echo $products->image; ?>" width="100"" />
					<div class="product-details">
						<h3 class="curly"><?php echo $products->name; ?></h3>
						<p><?php echo $products->short_description; ?></p>
						<span class="price">Starting at <?php echo money_format('%.2n', $products->price).' per heart'; ?></span>
						<a href="/products/show/<?php echo $products->title_url; ?>"><img src="/env/images/<?=My_Template_Controller::getViewPrefix()?>/get_started_button.png" /></a>
					</div><!-- product-deatils -->
				</div><!-- box -->
				<?php endforeach; ?>
				

				<div style="margin: 5px auto;" class="clear large-box grey-border pink-top">
					<h3>Occasions</h3>
					
					<?php $i = 0; ?>
					<?php foreach( $occasionresults as $occasions ):?>
						<?php if($i == 0 || $i % 6 == 0) {
							echo '<ul class="occasions">';
						} ?>
						<li><a href="/occasions/<?php echo $occasions->title_url; ?>"><?php echo $occasions->name; ?></a></li><?php $i++; ?>
						<?php if($i % 6 == 0) {
							echo '</ul>';
						} ?>
					<?php endforeach; ?>
					<?php if($i % 6 != 0) {
							echo '</ul>';
					} ?>
				
				</div><!-- large-box -->
			</div><!-- bottom -->