<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

	<script>
	$(function(){
		$('#slides').slides({
			preload: true,
			preloadImage: 'img/loading.gif',
			play: 5000,
			pause: 2500,
			hoverPause: true,
			animationStart: function(current){
				$('.caption').animate({
					bottom:-35
				},100);
				if (window.console && console.log) {
					// example return of current slide number
					console.log('animationStart on slide: ', current);
				};
			},
			animationComplete: function(current){
				$('.caption').animate({
					bottom:0
				},200);
				if (window.console && console.log) {
					// example return of current slide number
					console.log('animationComplete on slide: ', current);
				};
			},
			slidesLoaded: function() {
				$('.caption').animate({
					bottom:0
				},200);
			}
		});
		$('#slideshow').tabs({ fx: { opacity: 'toggle'} }).tabs("rotate", 6000, true);
	});
	</script>
	<style>
		#slideshow ul.ui-tabs-nav {
			display: block !important;
			text-align: center !important;
			background: none !important;
			border-radius: 0 !important;
			border: 0  !important;
			padding: 0 !important;
			margin: 10px 0 !important;
			margin-left: 270px !important;
		}
		#slideshow ul li
		{
			display: inline !important;
			border: none !important;
			float: none !important;
			margin: 0 !important;
			padding: 0 !important;
			position: static !important;
			top: 0 !important;
		}
		#slideshow ul li a {
			display: inline-block !important;
			height: 12px !important;
			background: url('/env/images/mcc/slideshow/bullets.png') no-repeat;
			background-position: -20px 0px;
			height: 12px !important;
			width: 12px !important;
			padding: 0 !important;
			margin: 0 3px !important;
		}
		#slideshow .ui-state-active a{
			background-position: 0px 0px;
		}
		#slideshow.ui-tabs ,
		#slideshow.ui-tabs .ui-tabs-panel {
			padding: 0 !important;
			border: none !important;
			border-radius: 0 !important;
		}
	</style>
		<div id="content" class="no-header">
			<div id="top">
				<div class="huge-box grey-border right relative">
					<div id="slideshow" style="background:none;">
<?						$slides = ORM::factory('slide')
										->orderby('order')
										->find_all();
						foreach ($slides as $k => $slide) { ?>
						<div id='slide-<?=$k+1?>'><?
							if ($slide->url) { 
?><a href="<?=$slide->url?>" target='_blank'><img width="590" src='/env/images/mcc/slideshow/<?=$slide->image?>' alt="<?=$slide->image_alt?>" /></a><?
							} else {
							?><img width="590" src='/env/images/mcc/slideshow/<?=$slide->image?>' alt="<?=$slide->image_alt?>" /><?
							}
						?></div><?
						} ?>
						<ul>
<?						foreach ($slides as $k => $slide) { ?>
							<li><a href="#slide-<?=$k+1?>"></a></li>
<?						} ?>
						</ul>
					</div>
				</div><!-- huge-box -->
				<div id="getstartedEvents" class="small-box grey-border left grey-corner relative" style="min-height: 162px;">
					<h3>How to get started:</h3>
					<ul id="started">
						<li><img src="/env/images/mcc/check_icon.png" /> 1. Select one of the four product types</li>
						<li><img src="/env/images/mcc/brush_icon.png" /> 2. Choose and apply custom design</li>
						<li><img src="/env/images/mcc/cart_icon.png" /> 3. Order your personalized chocolate coins</li>
					</ul>
					<a href="/products/"><img class="bottom-right" src="/env/images/<?=My_Template_Controller::getViewPrefix()?>/get_started_button.png" alt="Get Started" /></a>
				</div><!-- small-box -->
				<a href='/occasions/corporate_coins'>
				<div id="promotionEvents" class="small-box grey-border left grey-corner">
					<h3 style="margin-bottom: 18px;">Corporate Clients</h3>
					<img class="right big-image" src="/env/images/mcc/home_corporate.png" width="130" alt="Chocolate Coins for Corporate Clients" />
					<h4 style="display: inline-block; width: 156px;">Promote your business with our branded chocolate coins. 100% Belgian Chocolate.</h4>
				</div>
				</a><!-- small-box -->
				<a href='/products/category/grab_and_go'>
				<div id="specialEvents" class="small-box grey-border left grey-corner">
					<img src="/env/images/mcc/Small_Bulk_Coin_Banner.png" alt="Bulk Chocolate Coins" width="290" />
				</div>
				</a>
				<!--<a href='/occasions/'>
				<div id="specialEvents" class="small-box grey-border left grey-corner">
					<h3 style="margin-bottom: 18px;">Special Events</h3>
					<img class="right big-image" src="/env/images/mcc/special_event_img.png" width="130" alt="Chocolate Coins for Special Events" />
					<h4 style="display: inline-block; width: 156px;">Our Chocolate Coins are the perfect complement for your special occasion.</h4>
				</div>
				</a>--><!-- small-box -->
			</div><!-- top -->
			<div style="clear: both;margin: 5px 0;">
				<img src="/env/images/mcc/headline_design_mint_enjoy.jpg" />
			</div>
			<div id="bottom">
				
				<?php foreach($productresults as $products):?>
				<div class="box grey-border left grey-corner product-box-standard">
					<img src="/env/product_images/<?php echo $products->image; ?>" width="100" alt="<?php echo $products->meta_title; ?>"/>
					<div class="product-details">
						<h3 class="curly"><?php echo $products->name; ?></h3>
						<p><?php echo $products->short_description; ?></p>
						<span class="price">Starting at <?=money_format('%.2n', ORM::factory('product',$products->id)->getPriceStartingAt()).' per '.inflector::singular($products->unit); ?></span>
					</div><!-- product-deatils -->
					<a href="/products/show/<?php echo $products->title_url; ?>" class="link-btn"><img src="/env/images/<?=My_Template_Controller::getViewPrefix()?>/get_started_button.png" alt="Get Started" /></a>
				</div><!-- box -->
				<?php endforeach; ?>
				<div class="box grey-border left grey-corner product-box-standard">
					<img src="/env/images/mcc/gng_homepage.png" width="100" alt="Grab and Go Products"/>
					<div class="product-details">
						<h3 class="curly">Grab and Go Products</h3>
						<p>
							Need it faster? Our Grab n Go chocolate coins are in stock can ship within 2 days. They are a faster and more affordable option with the same quality of all our products. Our Chocolate Coins are the best you have ever tried. Forget about those waxy & gritty chocolates that you are used to.
						</p>
						<span class="price">Starting at $ 0.14 per coin</span>
					</div><!-- product-deatils -->
					<a href="/products/category/grab_and_go" class="link-btn"><img src="/env/images/mcc/get_started_button.png" alt="Grab and Go Products" /></a>
				</div><!-- box -->
				
				<div class="large-box grey-border left grey-top">
					<h3>Occasions</h3>
					<?php $i = 0; ?>
					<?php foreach( $occasionresults as $row ):?>
						<?php if($i == 0 || $i % 6 == 0) {
							echo '<ul class="occasions">';
						} ?>
						<li><a href="/occasions/<?php echo $row->title_url; ?>" title="<?php echo $row->name; ?>"><?php echo $row->name; ?></a></li><?php $i++; ?>
						<?php if($i % 6 == 0) {
							echo '</ul>';
						} ?>
					<?php endforeach; ?>
					<?php if($i % 6 != 0) {
							echo '</ul>';
					} ?>
				</div><!-- large-box -->
				<div class="medium-box grey-border left grey-top">
					<a href="/testimonials" style="text-decoration:none;"><h3>Testimonials</h3></a>
					<div class="testimonial">
						<p><?php echo $testimonialresult->description; ?></p>
						<span class="author">- <?php echo ''.$testimonialresult->name.' '.$testimonialresult->location.''; ?></span>
						<div class="clear"></div>
					</div><!-- testimonial -->
				</div><!-- large-box -->
				<div class="large-box grey-border left grey-top" style="width: 907px;">  
					<div align="center">
						<object style="height: 425px; width: 344px">
							<param name="movie" value="http://www.youtube.com/v/ue9GfZpM-2A&fs=1&rel=0">
							<param name="allowFullScreen" value="true">
							<param name="allowScriptAccess" value="always">
							<embed src="http://www.youtube.com/v/ue9GfZpM-2A&fs=1&rel=0" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="425" height="344">
						</object>
					</div>
					<h1 style="font-size: 16px">MyChocolateCoins.com, Your Source For Personalized &amp; Custom Chocolate Coins &amp; Casino Chips</h1>
					<p>Welcome to MyChocolateCoins.com. We create unique <a href="/products/show/Customized_Chocolate_Coins" title="Personalized Chocolate Coins">personalized chocolate coins</a> and chocolate casino chips for any occasion. Chocolate coins are a delicious treat that is perfect for use as party favors, <a href="/occasions/wedding" title="Personalized Wedding Favors">personalized wedding favors</a>, bridal shower favors or corporate favors. People of every age love chocolate and chocolate favors are perfect for every event from kids' party favors to <a href="/occasions/corporate_coins" title="Corporate Favors">corporate favors</a>..</p>

					<h2 style="font-size: 14px">Find Personalized Chocolate Favors For All Occasions Including Wedding, Party, Baby &amp; Bridal Shower, Corporate &amp; Many More</h2>

					<p>Our chocolate party favors are not only unique and memorable, they also taste great. All our chocolate coins are made with the highest quality Belgian chocolate, so they are not only adorable <a href="/occasions/baby_shower_coins" title="Baby Shower Favors">baby shower favors</a>  or party favors, but also a delicious treat. We never skimp on ingredients and always use the very best to ensure the best flavor possible.</p>

					<h2 style="font-size: 14px">Shop For Custom Chocolate Gold Coins &amp; Poker Chips</h2>

					<p>Create personalized chocolate coins or chocolate poker chips in minutes on our website. Follow the prompts to select the colors, personalized message and choose from a broad selection of clip art. Whether you are looking for <a href="/products/show/Customized_Casino_Chocolate_Chips" title="Custom Chocolate Casino Chips">custom chocolate casino chips</a> for a fundraiser or corporate favors or need unique chocolate favors, there is a design in our collection to fit any occasion.</p>

					<p>In the event you don't find the design you want for custom chocolate poker chips or chocolate gold coins, we can help. You can upload an original logo or design for your order.  If you don't have a design, we can help with that too. Our talented staff of graphic designers can create custom chocolate coins to your specifications. The design is etched into the chocolate favors and the foil packaging.	</p>
					
					<h2 style="font-size: 14px">Chocolate Gelt</h2>

					<p>We offer high quality chocolate Gelt, which is OU-D certified Kosher Dairy, and tastes absolutely amazing (we also offer Parve chocolate, upon request); in fact, all of our chocolates are Kosher. We have Blue and Silver chocolate coins with assorted Jewish designs, like the star of David, and are made with 100% Milk Belgian Chocolate.  You can also do your very own custom design for your chocolate gelt.  So, for the next festival of Hanukkah, buy chocolate coins here that are foil wrapped and 100% Kosher, and great for your kids to play dreidel with - you won't be disappointed by the quality.</p>
					
					<h2 style="font-size: 14px">Bulk Chocolate Coins</h2>

					<p>No matter the size of your request, <a href="http://www.mychocolatecoins.com">MyChocolateCoins.com</a> will handle the order, and you can expect a quick shipment for all of the chocolate coins that you buy in bulk. Whether you buy dark chocolate coins, foil wrapped chocolate coins, or candy coins, when you buy chocolate coins at <a href="http://www.mychocolatecoins.com">MyChocolateCoins.com</a> we can handle the volume of your order.  Customer satisfaction is our main goal!</p>
					
					<h2 style="font-size: 14px">Customized Chocolate Medals</h2>

					<p>You can create your very own customized chocolate medals for sporting events, employee rewards, family competitions, and more. Whether its gold medal award dark chocolate coins, Olympic medal award candy coins, and/or #1, #2, or #3 milk chocolate coins, you can create your very own customized design and foil wrapped chocolate medals to perfection.</p>
					
					<h2 style="font-size: 14px">Wholesale Chocolate Coins</h2>

					<p>When buying chocolate coins, it's important to weigh the overall cost of chocolate: Wholesale chocolate coins versus retail candy coin prices. There are a lot of needlessly expensive chocolate stores on the internet that offer you to buy chocolate coins at so-called discounts, but don't offer you the quality of chocolate that we strive for.   We offer are chocolate coins and candy coins at wholesale prices, in order to service our customers with great chocolate at a great price.</p>
					
					<h2 style="font-size: 14px">Money Can't Buy Happiness, but Chocolate Coins Can</h2>

					<p>Everyone loves chocolate, and everyone loves money. It's only natural that the two be brought together. Milk chocolate coins have been a holiday tradition since the 1920's, when American chocolatiers began selling chocolate gelt to celebrate Hannukah. Like so many things, what began as a simple part of a celebration turned into a big success. Chocolate coins are now made with hundreds of different designs, all wrapped carefully in foil to retain the impression on the chocolate itself. You can find chocolate coins for virtually every form of currency, and designs which reflect every holiday on the calendar.</p> 

					<p>There are even candy coins which break out of the coin mold. Companies sell customized chocolate poker chips, chocolate coins with company logos on them, and chocolate medals which are larger than the original coin design. The quality of the chocolate inside of the foil depends on where you buy them, but you'll find that there are a lot of coins that not only look great, but taste great too. Milk chocolate is the most commonly used and found candy, but you can also track down dark and white chocolate coins too. Every coin should come in a high quality gold or silver wrapper that both keeps it safe from melting and gives it the appearance of a real coin. You can purchase the coins in the traditional net bundle, or you can buy them in bulk to arrange yourself. Whether you're buying for the holidays, or just love having them around the house, nothing is richer than a bite from a coin made of chocolate.</p>

					</div>
			</div><!-- bottom -->
			
			
<script type="text/javascript">
			$(function() {
			
			  //remove js-disabled class
				$("#viewer").removeClass("js-disabled");
			
			  //create new container for images
				$("<div>").attr("id", "container").css({ position:"absolute"}).width($(".wrapper").length * 170).height(170).appendTo("div#viewer");
			  	
				//add images to container
				$(".wrapper").each(function() {
					$(this).appendTo("div#container");
				});
				
				//work out duration of anim based on number of images (1 second for each image)
				var duration = $(".wrapper").length * 2000;
				
				//store speed for later (distance / time)
				var speed = (parseInt($("div#container").width()) + parseInt($("div#viewer").width())) / duration;
								
				//set direction
				var direction = "rtl";
				
				//set initial position and class based on direction
				(direction == "rtl") ? $("div#container").css("left", $("div#viewer").width()).addClass("rtl") : $("div#container").css("left", 0 - $("div#container").width()).addClass("ltr") ;
				
				//animator function
				var animator = function(el, time, dir) {
				 
					//which direction to scroll
					if(dir == "rtl") {
					  
					  //add direction class
						el.removeClass("ltr").addClass("rtl");
					 		
						//animate the el
						el.animate({ left:"-" + el.width() + "px" }, time, "linear", function() {
												
							//reset container position
							$(this).css({ left:$("div#imageScroller").width(), right:"" });
							
							//restart animation
							animator($(this), duration, "rtl");
							
							//hide controls if visible
							($("div#controls").length > 0) ? $("div#controls").slideUp("slow").remove() : null ;			
											
						});
					} else {
					
					  //add direction class
						el.removeClass("rtl").addClass("ltr");
					
						//animate the el
						el.animate({ left:$("div#viewer").width() + "px" }, time, "linear", function() {
												
							//reset container position
							$(this).css({ left:0 - $("div#container").width() });
							
							//restart animation
							animator($(this), duration, "ltr");
							
							//hide controls if visible
							($("div#controls").length > 0) ? $("div#controls").slideUp("slow").remove() : null ;			
						});
					}
				}
				
				//start anim
				animator($("div#container"), duration, direction);
				
				
			});


			$(function() {
			
			  //remove js-disabled class
				$("#viewer2").removeClass("js-disabled");
			
			  //create new container for images
				$("<div>").attr("id", "container").css({ position:"absolute"}).width($(".wrapper").length * 170).height(170).appendTo("div#viewer2");
			  	
				//add images to container
				$(".wrapper").each(function() {
					$(this).appendTo("div#container");
				});
				
				//work out duration of anim based on number of images (1 second for each image)
				var duration = $(".wrapper").length * 2000;
				
				//store speed for later (distance / time)
				var speed = (parseInt($("div#container").width()) + parseInt($("div#viewer2").width())) / duration;
								
				//set direction
				var direction = "ltr";
				
				//set initial position and class based on direction
				(direction == "rtl") ? $("div#container").css("left", $("div#viewer2").width()).addClass("rtl") : $("div#container").css("left", 0 - $("div#container").width()).addClass("ltr") ;
				
				//animator function
				var animator = function(el, time, dir) {
				 
					//which direction to scroll
					if(dir == "rtl") {
					  
					  //add direction class
						el.removeClass("ltr").addClass("rtl");
					 		
						//animate the el
						el.animate({ left:"-" + el.width() + "px" }, time, "linear", function() {
												
							//reset container position
							$(this).css({ left:$("div#imageScroller").width(), right:"" });
							
							//restart animation
							animator($(this), duration, "rtl");
							
							//hide controls if visible
							($("div#controls").length > 0) ? $("div#controls").slideUp("slow").remove() : null ;			
											
						});
					} else {
					
					  //add direction class
						el.removeClass("rtl").addClass("ltr");
					
						//animate the el
						el.animate({ left:$("div#viewer2").width() + "px" }, time, "linear", function() {
												
							//reset container position
							$(this).css({ left:0 - $("div#container").width() });
							
							//restart animation
							animator($(this), duration, "ltr");
							
							//hide controls if visible
							($("div#controls").length > 0) ? $("div#controls").slideUp("slow").remove() : null ;			
						});
					}
				}
				
				//start anim
				animator($("div#container"), duration, direction);
				
				
			});
		</script>