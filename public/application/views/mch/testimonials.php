<div id="content">
			<div id="pink-section-header">
				<h2 class="curly">Testimonials</h2>
			</div><!-- header -->
			<div id="top">
				<div id="testimonial"><center>
				<?php foreach($testimonialresults as $testimonial): ?>
					<div id="blurb" class="pink-top grey-border" style="width:90%;">
						<h3><?php echo $testimonial->name.' - '.$testimonial->location; ?></h3>
						<p><?php echo $testimonial->description; ?></p>
					</div><!-- blurb -->
					
				<?php endforeach; ?>
					</center>
				</div><!-- testimonial -->
			
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
						<a href="/products/<?php echo $products->id; ?>"><img src="/env/images/<?=My_Template_Controller::getViewPrefix()?>/get_started_button.png" /></a>
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