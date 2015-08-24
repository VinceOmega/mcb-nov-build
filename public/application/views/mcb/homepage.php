

	
				<div id="content" class="index row">
			<div class="col-md-4 col-xs-4 col-sm-4 col-lg-4 jumbotron-side">
					<div class="jumbotron-info-box type-list rnd-black row">
							<h4>How to get started</h4><br>
							<ul class="info-box-list">
								<li class="neop">Select one of the four product types</li>
								<li class="cross">Choose and apply custom design</li>
								<li class="check">Order your personalized chocolate bars</li>
							</ul>
							<button class="rnd btn btn-thin orange" data-href="/products">Get Started</button><br><br>
					</div>
					<div class="jumbotron-info-box special-events type-expo rnd-black row">
						<h4>Special Events</h4><br>
						<div class="col-md-2 col-xs-2 col-lg-2 col-sm-2">
							<img src="/env/images/mcb/hershey_bar.png" alt="candy bars">
						</div>
						<div class="col-md-8 col-xs-8 col-sm-8 col-lg-8">
							<blockquote> 
							Custom Designs<br>
							Created for<br>
							Any Event!
							</blockquote>
						</div>
					</div>
					<div class="jumbotron-info-box promote type-expo rnd-black row
					">
						<h4>Promote Your Business!</h4><br>
						<div class="col-md-2 col-xs-2 col-sm-2 col-lg-2">
							<img src="/env/images/mcb/gifts.png" alt="gifts">
						</div>
						<div class="col-md-8 col-xs-8 col-sm-8 col-lg-8">
							<blockquote>
							Lorem ipsum dolor
							sit amet Lorem Ipsum dolor 
							lorem </blockquote>
							<button class="rnd btn btn-thin orange" data-href="/about">Learn More</button><br><br>
						
						</div>
					</div>

			</div>
			<div class="col-md-8 col-xs-8 col-sm-8 col-lg-8 jumbotron rnd-15">
				<? if (!isset($slides)){ ?>
				<button class="btn orange" data-url="/products">Create your own!</button>
				<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12 jumbotron-bottom">

				</div>
				<? } else {?>
				<ul class="rslides home-slides">
				<?
					foreach($slides as $s => $v){
						$slide[] = $v; ?>
				<li style="background-image: url(env/images/mcc/slideshow/<?=$v->image?>)"><button class="btn orange" data-url="<?=$v->url?>">Create your own!</button></li>
				<? }}?>
				</ul>
			</div>
			<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12 large-section-text">
					You design. We mold. They enjoy!
			</div>
			<div class="row product-display col-md-12 col-xs-12 col-sm-12 col-lg-12">
			<?foreach($productresults as $products):?>
					<div class="product-info-box col-md-6 col-xs-6 col-sm-6 col-lg-6 row">
						<div class="col-md-5 col-xs-5 col-sm-5 col-lg-5">
							<img src="/env/product_images/<?php echo $products->image; ?>" alt="gifts" width="150" height="150">
						</div>
						<div class="col-md-6 col-xs-6 col-sm-6 col-lg-6">
							<h4><?php echo $products->name; ?></h4>
							<p><?php if(strlen($products->short_description) > 200) {$str = substr($products->short_description, 0, 200); echo str_pad($str, 203, "...");} else {echo $products->short_description;}?></p>
							<img src="/env/images/mcb/tag.png" alt="pricetag">
							<span class="price">$<?=money_format('%.2n', ORM::factory('product',$products->id)->getPriceStartingAt()).' per '.inflector::singular($products->unit);?></span>
							<button class="rnd btn btn-thin orange" data-href="/products/show/<?php echo $products->title_url; ?>">Get Started</button>
						</div>
					</div>
					
			<? endforeach ?>	
			</div>
			<!-- <div class="row product-display col-md-12">
					<div class="product-info-box col-md-6 row">
						<div class="col-md-5">
							<img src="/env/images/mcb/chocolate-pack.png" alt="gifts">
						</div>
						<div class="col-md-6">
							<h4>Product Title</h4>
							<p>Lorem ipsum dolor  sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quia nostrud</p>
							<img src="/env/images/mcb/tag.png" alt="gifts">
							<span class="price">23.00</span>
							<button class="rnd btn btn-thin orange" data-href="/products">Get Started</button>
						</div>
					</div>
				<div class="product-info-box col-md-6 row">
							<div class="col-md-5">
							<img src="/env/images/mcb/chocolate-pack.png" alt="gifts">
						</div>
						<div class="col-md-6">
							<h4>Product Title</h4>
							<p>Lorem ipsum dolor  sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quia nostrud</p>
							<img src="/env/images/mcb/tag.png" alt="gifts">
							<span class="price">23.00</span>
							<button class="rnd btn btn-thin orange" data-href="/products">Get Started</button>
						</div>
					</div>
			</div> -->
			<div class="misc-section row col-md-12 col-xs-12 col-sm-12 col-lg-12">
				<div class="misc-ocassions col-md-6 col-xs-6 col-sm-6 col-lg-6">
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
		<div class="chocolate-expo grey col-md-12 col-xs-12 col-sm-12 col-lg-12">
				<h5>MyChocolateBars.com</h5>
				<p>The gift of chocolate works for just about any occasion especiallly when you are dealing 
				with someone who is a chocolate lover. Whether you are looking for something to give as a special 
				gift for a romantic occasion or you need favors for your next event, custom chocolate Bars can be 
				a great option. At MyChocolateBars.com we provide the highest quality Belgian chocolate favors you
				can use to surprise your significant other or to create the perfect atmosphere for you wedding,
				shower or other party.</p>

				<h5>Personalized Chocolate Bars</h5>
				<p>Our delicious chocolate Bars can be personalized for your special day with just about any picture 
				or words. If you are looking for the perfect Bars shaped chocolates to give to your significant other for Valentine's Day or her birthday, 
				why no order our presonalized chocolate Bars that feature your favorite picture of the two of you?</p>

				<h5>Personalized Chocolate Favors</h5>
				<p>If you want the perfect favor for your wedding, shower or other event, our heart favors can be customized with pictures, words or your company logo.
				With our low prices, you will be able to buy enough so everyone can have the perfect personalized chocolate favors to enjoy at your special event. We can
				provide you with these chocolate favors no matter what the weather is like outside because we use only the best packaging to ensure your chocolates get to you without melting.
				</p>
		</div>

		<?
		echo "<pre>";
		foreach($slides as $s => $v){
			print_r($v);
		}
		echo "</pre>"
		?>

	</div>


<script>
$(document).ready(function(){
 $(function() {
    $(".rslides").responsiveSlides({
    	auto: true,
    	nav: false,
    	speed: 2000,
    	pause: true
    	 });
  });
});


</script>