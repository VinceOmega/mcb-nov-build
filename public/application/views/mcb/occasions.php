<div id="content" class="occasions row">
		<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12 occasions title">
			<h3><?php echo $occasion->name; ?></h3>
		</div>

		<div class="2-col cols-2 row col-md-12 cold-sm-12 col-xs-12 col-lg-12">
				<div class="left-col  col-md-6 col-xs-6 col-sm-6 col-lg-6">
						<div class="occ-info-box">
						<blockquote>
							<b><?php echo $occasion->headline; ?></b>

							<?php echo $occasion->short_description; ?>
						</blockquote>
						<button class="btn orange" data-href="/products" >Create Your Custom Bar</button>
						</div>
				</div>
				<div class="right-col col-md-6 col-xs-6 col-sm-6 col-lg-6">
						<div class="large-genre-img">
						<?php if($occasion->image): ?>
							<img src="/env/product_images/<?php echo $occasion->image; ?>" ALT="<?php echo $occasion->image_alt; ?>" />
          				<?php else: ?>
          					<img src="/env/images/vday.png" />
          				<?php endif; ?>						
						</div>
				</div>

		</div>
		<hr>
		<div class="2-col cols-2 row col-md-12 cold-sm-12 col-xs-12 col-lg-12">
				<div class="left-col  col-md-6 col-xs-6 col-sm-6 col-lg-6">
					<?php foreach($productresults as $products):?>
					<div class="occ-product-box col-md-12 col-xs-12 col-sm-12 col-lg-12">
						<h4><?php echo $products->name; ?></h4><br>
						<div class="image col-md-3 col-xs-3 col-lg-3 col-lg-3">
						<img src="/env/product_images/<?php echo $products->image; ?>" alt="products" width="100">
						</div>
						<div class="description col-md-9 col-xs-9 col-sm-9 col-lg-9">
						<p><?php echo $products->short_description; ?></p>
						</div>
						<div class="btn-section col-md-12 col-xs-12 col-sm-12 col-lg-12">
						<button class="btn orange">Create Your Custom Bar</button>
						</div>
					</div>
						<?php endforeach; ?>
					<!-- <div class="occ-product-box col-md-12 col-xs-12 col-sm-12 col-lg-12">
						<h4>Chocolate Bars</h4><br>
						<div class="image col-md-3 col-xs-3 col-lg-3 col-lg-3">
						<img src="img/chocolate-pack.png" alt="products" width="100">
						</div>
						<div class="description col-md-9 col-xs-9 col-sm-9 col-lg-9">
						<p><b>Delicious Bars for you and yours!</b>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur mollis efficitur consequat. Donec mi nibh, elementum a sollicitudin ac, luctus a lacus. Vivamus dictum nunc lectus, vel sollicitudin mi finibus sed. Nunc in enim vulputate, commodo sapien at, elementum turpis. Pellentesque a congue justo. Integer vel enim vitae magna dictum lobortis. Aenean lacus diam, vestibulum sed leo sed, condimentum malesuada lorem.</p>
						</div>
						<div class="btn-section col-md-12 col-xs-12 col-sm-12 col-lg-12">
						<button class="btn orange">Create Your Custom Bar</button>
						</div>
					</div> -->
				</div>
				<div class="right-col col-md-6 col-xs-6 col-sm-6 col-lg-6">
					<?php foreach($productresults as $products):?>
					<div class="occ-product-box col-md-12 col-xs-12 col-sm-12 col-lg-12">
						<h4><?php echo $products->name; ?></h4><br>
						<div class="image col-md-3 col-xs-3 col-lg-3 col-lg-3">
						<img src="/env/product_images/<?php echo $products->image; ?>" alt="products" width="100">
						</div>
						<div class="description col-md-9 col-xs-9 col-sm-9 col-lg-9">
						<p><?php echo $products->short_description; ?></p>
						</div>
						<div class="btn-section col-md-12 col-xs-12 col-sm-12 col-lg-12">
						<button class="btn orange">Create Your Custom Bar</button>
						</div>
					</div>
					<?php endforeach; ?>
					<!-- <div class="occ-product-box col-md-12 col-xs-12 col-sm-12 col-lg-12">
						<h4>Chocolate Bars</h4><br>
						<div class="image col-md-3 col-xs-3 col-lg-3 col-lg-3">
						<img src="img/chocolate-pack.png" alt="products" width="100">
						</div>
						<div class="description col-md-9 col-xs-9 col-sm-9 col-lg-9">
						<p><b>Delicious Bars for you and yours!</b>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur mollis efficitur consequat. Donec mi nibh, elementum a sollicitudin ac, luctus a lacus. Vivamus dictum nunc lectus, vel sollicitudin mi finibus sed. Nunc in enim vulputate, commodo sapien at, elementum turpis. Pellentesque a congue justo. Integer vel enim vitae magna dictum lobortis. Aenean lacus diam, vestibulum sed leo sed, condimentum malesuada lorem.</p>
						</div>
						<div class="btn-section col-md-12 col-xs-12 col-sm-12 col-lg-12">
						<button class="btn orange">Create Your Custom Bar</button>
						</div>
					</div> -->
				</div>

		</div>
		<div class="misc-section row col-md-12 col-xs-12 col-sm-12 col-lg-12">
				<div class="misc-ocassions col-md-6 col-xs-6 col-sm-6 col-lg-6 ">
					<h4>Ocassions</h4>
					<ul class="col-md-4 col-xs-4 col-sm-4 col-lg-4">
						<li>Anniversary</li>
						<li>Baby shower</li>
						<li>Baptism/Christening</li>
						<li>Bar/BatMitzvah</li>
						<li>Birthday</li>
						<li>Communion</li>
					</ul>
					<ul class="col-md-4 col-xs-4 col-sm-4 col-lg-4">
						<li>Corporate</li>
						<li>Engagement</li>
						<li>Graduation</li>
						<li>Halloween</li>
						<li>Hannukah</li>
						<li>Quinceanera</li>
					</ul>
					<ul class="col-md-4 col-xs-4 col-sm-4 col-lg-4">
						<li>Sweet 16</li>
						<li>Valentine's Day</li>
						<li>Wedding</li>
					</ul>
				</div>
				<div class="misc-testimonials col-md-6 col-xs-6 col-sm-6 col-lg-6">
						<h4>Testimonials</h4>
					<div class="quote grey">
					<div class="triangle-up-sm quote-arrow"></div>
					<blockquote>
						"I am glad I found you guys, I could not get Teal Chocolate Bars
						anywhere else in the country. They go great with my event's decoration...
						the chocolate is so tasty and the presentation is fantastic!"
					</blockquote>
					<p>-Ryan Mervin Orange, TX</p>
					</div>
				</div> 
		</div>

</div>