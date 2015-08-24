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
	});
	</script>
		<div id="content">
			<div id="top">
				<div class="huge-box grey-border right pink-corner relative">
					<a href="/products/category/grab_and_go"><img src="/env/images/mch/Bulk-Hearts-Banner-590x456.png" /></a>

					<!--<img style="bottom: -10px; left: -10px;" class="bottom-left z-back" src="/env/images/heart_cluster2.png" />
					<img style="right: -20px;" class="top-right z-back" src="/env/images/heart_cluster1.png" />-->
					
					<!--<h2 class="curly">See What Our Customers Have Made</h2>
					<?php $numRecent = count($recentHearts);
					
					if($numRecent >= 3): ?>

						<div id="imageScroller">
							<div id="viewer" class="js-disabled">
								<?php foreach($recentHearts as $recentHeart): ?>
								<?php 
									$msgtext = '';
									if($recentHeart->msg_text1 != 'NULL') $msgtext .= $recentHeart->msg_text1;
									if($recentHeart->msg_text2 != 'NULL') $msgtext .= ' '.$recentHeart->msg_text2;
									if($msgtext != '') $msgtext = '\''.$msgtext.'\' ';
									if ($recentHeart->product_id == 1)  $msgtext = ''.$recentHeart->name.' Foil Chocolate Hearts';
									if ($recentHeart->product_id == 2)  $msgtext .= 'Picture Chocolate Hearts';
									if ($recentHeart->product_id == 4)  $msgtext .= $recentHeart->name.' Chocolate Hearts';
									if ($recentHeart->product_id == 3)  $msgtext .= $recentHeart->name.' Chocolate Hearts';
								?>
									<a class="wrapper" title="Design <?php echo $recentHeart->id; ?>"><img class="logo" id="design<?php echo $recentHeart->id; ?>" src="<?php echo $recentHeart->designpath; ?>" alt="<?php echo $msgtext; ?>" width="230"></a>
								<?php endforeach; ?>
							</div>
						</div>

						<div id="imageScroller">
							<div id="viewer2" class="js-disabled">
								<?php foreach($recentHeartsBack as $recentHeart): ?>
								<?php 
									$msgtext = '';
									if($recentHeart->msg_text1 != 'NULL') $msgtext .= $recentHeart->msg_text1;
									if($recentHeart->msg_text2 != 'NULL') $msgtext .= ' '.$recentHeart->msg_text2;
									if($msgtext != '') $msgtext = '\''.$msgtext.'\' ';
									if ($recentHeart->product_id == 1)  $msgtext = ''.$recentHeart->name.' Foil Chocolate Hearts';
									if ($recentHeart->product_id == 2)  $msgtext .= 'Picture Chocolate Hearts';
									if ($recentHeart->product_id == 4)  $msgtext .= $recentHeart->name.' Chocolate Hearts';
									if ($recentHeart->product_id == 3)  $msgtext .= $recentHeart->name.' Chocolate Hearts';
								?>
									<a class="wrapper" title="Design <?php echo $recentHeart->id; ?>"><img class="logo" id="design<?php echo $recentHeart->id; ?>" src="<?php echo $recentHeart->designpath; ?>" alt="<?php echo $msgtext; ?>" width="230"></a>
								<?php endforeach; ?>
							</div>
						</div>


					<?php else: ?>
						<img class="z-front" style="position: absolute; top: 240px; left: 10px;" src="/env/images/merry_christmas.png" />
						<img class="z-back" style="position: absolute; top: 30px; left: 150px;" src="/env/images/congrat_jason.png" />
						<img class="z-back" style="position: absolute; top: 150px; left: 400px;" src="/env/images/happy_anniversary.png" />
					<?php endif; ?>
					<a href="/products/"><img class="bottom-right" style="margin: 10px;" src="/env/images/<?=My_Template_Controller::getViewPrefix()?>/custom_button.png" alt="Create your Custom Chocolate Heart" /></a>-->
				</div><!-- huge-box -->
				<div id="getstartedEvents" class="small-box grey-border left pink-corner relative">
					<h3>How to get started:</h3>
					<ul id="started">
						<li><img src="/env/images/check_icon.png" /> 1. Select one of the four product types</li>
						<li><img src="/env/images/brush_icon.png" /> 2. Choose and apply custom design</li>
						<li><img src="/env/images/cart_icon.png" /> 3. Order your personalized chocolate hearts</li>
					</ul>
					<a href="/products/"><img class="bottom-right" src="/env/images/<?=My_Template_Controller::getViewPrefix()?>/get_started_button.png" alt="Get Started" /></a>
				</div><!-- small-box -->
				<a href='/occasions/'>
				<div id="specialEvents" class="small-box grey-border left">
					<h3>Special Events</h3>
					<h4 class="left" style="width: 40%; margin-top: 25px;">Custom Designs Created for Any Event!</h4>
					<img class="right" src="/env/images/special_event_img.png" alt="Chocolate Hearts for Special Events" />
				</div>
				</a><!-- small-box -->
				<a href='/occasions/corporate'>
				<div id="promotionEvents" class="small-box grey-border left">
					<h3>Promote Your Business!</h3>
					<h4 class="left" style="width: 30%; margin-top: 40px;">Click Here to Learn How</h4>
					<img class="right" src="/env/images/promote_img.png" alt="Promote your Business" />
				</div>
				</a><!-- small-box -->
			</div><!-- top -->
			<div class="pink-bar"></div>
			<div id="bottom">
				
				<?php foreach($productresults as $products):?>
				<div class="box grey-border left pink-corner">
					<img src="/env/product_images/<?php echo $products->image; ?>" width="100" alt="<?php echo $products->meta_title; ?>"/>
					<div class="product-details">
						<h3 class="curly"><?php echo $products->name; ?></h3>
						<p><?php echo $products->description; ?></p>
						<span class="price">Starting at <?php echo money_format('%.2n', $products->price).' per heart'; ?></span>
						<a href="/products/show/<?php echo $products->title_url; ?>"><img src="/env/images/<?=My_Template_Controller::getViewPrefix()?>/get_started_button.png" alt="Get Started" /></a>
					</div><!-- product-deatils -->
				</div><!-- box -->
				<?php endforeach; ?>
				
				<div class="large-box grey-border left pink-top">
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
				<div class="medium-box grey-border left pink-top">
					<a href="/testimonials" style="text-decoration:none;"><h3>Testimonials</h3></a>
					<div class="testimonial">
						<p><?php echo $testimonialresult->description; ?></p>
						<span class="author">- <?php echo ''.$testimonialresult->name.' '.$testimonialresult->location.''; ?></span>
						<div class="clear"></div>
					</div><!-- testimonial -->
				</div><!-- large-box -->
				<div class="large-box grey-border left pink-top" style="width: 907px;">  

					<h2 style="font-size: 14px">MyChocolateHearts.com</h2>

					<p>The gift of chocolate works for just about any occasion, especially when you are dealing with someone who is a chocolate lover. Whether you are looking for something to give as a special gift for a romantic occasion or you need favors for your next event, custom chocolate hearts can be a great option. At MyChocolateHearts.com, we provide the highest quality Belgian chocolate favors you can use to surprise your significant other or to create the perfect atmosphere for your wedding, shower or other party.</p>

					<h2 style="font-size: 14px">Personalized Chocolate Hearts</h2>

					<p>Our delicious chocolate hearts can be personalized for your special day with just about any picture or words. If you are looking for the perfect heart shaped chocolates to give to your significant other for Valentine's Day or her birthday, why not order our personalized chocolate hearts that feature your favorite picture of the two of you? It will truly be a gift she will cherish forever, even if she does indulge in it after taking a picture.</p>
					
					<h2 style="font-size: 14px">Personalized Chocolate Favors</h2>

					<p>If you want the perfect favor for your wedding, shower or other event, our heart favors can be customized with pictures, words or your company logo. With our low prices, you will be able to buy enough so everyone can have the perfect personalized chocolate favors to enjoy at your special event. We can provide you with these chocolate favors no matter what the weather is like outside because we use only the best packaging to ensure your chocolates get to you without melting.</p>

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