<div id="content">
			<div id="section-header">
				<h2 class="curly"><?php echo $occasion->name; ?></h2>
			</div><!-- header -->
			<div id="top">
				<div id="occasion" class="left">
					<div id="blurb" class="grey-top grey-border left">
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
				<div class="box grey-border left grey-corner product-box-standard">
					<img src="/env/product_images/<?php echo $products->image; ?>" width="100" />
					<div class="product-details">
						<h3 class="curly"><?php echo $products->name; ?></h3>
						<p><?php echo $products->short_description; ?></p>
						<span class="price">Starting at <?php echo money_format('%.2n', ORM::factory('product',$products->id)->getPriceStartingAt()).' per '.inflector::singular($products->unit); ?></span>
					</div><!-- product-deatils -->
					<a href="/products/show/<?php echo $products->title_url; ?>" class="link-btn"><img src="/env/images/<?=My_Template_Controller::getViewPrefix()?>/get_started_button.png" /></a>
				</div><!-- box -->
				<?php endforeach; ?>
				<div class="box grey-border left grey-corner product-box-standard">
					<img src="/env/images/mcc/gng_homepage.png" width="100" />
					<div class="product-details">
						<h3 class="curly">Grab and Go Products</h3>
						<p>
							Need it faster? Our Grab n Go chocolate coins are in stock can ship within 2 days. They are a faster and more affordable option with the same quality of all our products. Our Chocolate Coins are the best you have ever tried. Forget about those waxy & gritty chocolates that you are used to.
						</p>
						<span class="price">Starting at $ 0.14 per coin</span>
					</div><!-- product-deatils -->
					<a href="/products/category/grab_and_go" class="link-btn"><img src="/env/images/mcc/get_started_button.png" alt="Grab and Go Products" /></a>
				</div><!-- box -->
				

				<div style="margin: 5px auto;" class="clear large-box grey-border grey-top">
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