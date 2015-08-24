<?
$pricesArray = array();
foreach (ORM::factory('product',$product->id)->getPrices() as $cost) {
	$pricesArray[] = array(
		'start' => intval($cost->qty_start),
		'end'	=> intval($cost->qty_end),
		'price'	=> floatval($cost->price)
	);
}
$pricesJson = json_encode($pricesArray);
//echo 'var prices = '.$pricesJson.';'; 
?>

		<div id="content" class="products-details row">
			<!-- Right 2 Col -->
		<div class="2-col col-md-12">
			<h2>Products</h2>
				<!-- Left Hand Col -->
				<div class="col-md-3 left-col">
					<ul>
					<?php foreach($categories  as $category):?>
                                    <?foreach ($category->products as $product_sidebar):?>
						<li><a href="/products/show/<?php echo $product_sidebar->products_description->title_url; ?>" title="<?php echo $product_sidebar->name; ?>"><?php echo $product_sidebar->name;?></a></li>
                        <?php endforeach; ?>
				<?php endforeach; ?>

				<? if(isset($gng_category)):?>
					<li><a href="<?='/products/category/'.$gng_category->categories_description->title_url?>"><?=$gng_category->name;?></a></li>
				<? endif ?>	
					</ul>
				</div>
				<!-- End Left Col -->
				<!-- Right Col -->
						<div class="right-col col-md-9">
						
						<!-- Top -->
							<div class="product-display col-md-12">
							<h4><?php echo $product->name; ?></h4>
								<div class="col-md-6">
									<img src="/env/product_images/<?php echo $product->image; ?>" alt="<?php echo $product->image_alt ?>">
								</div>
								<div class="col-md-6 tab-display">
									<ul>
										<li class="tab lt-brown tab-description selected"><a href="#" onclick="javascript:;">Details</a></li>
										<li class="tab grey tab-price"><a href="#" onclick="javascript:;">Price</a></li>
										<li class="tab grey tab-production"><a href="#" onclick="javascript:;">Production Time</a></li>
									</ul>
									<div class="description lt-brown rnd-10">
										<?php if(strlen($product->description) > 200)  echo substr($product->description , 0, 200)."..."; else echo $product->description; ?>
									</div>
									<div class="description-price lt-brown rnd-10" style="display: none;  z-index: 20; position:relative;">
										<p><?php echo $product->price; ?></p>
									</div>
									<div class="description-production lt-brown rnd-10" style="display: none;  z-index: 20; position:relative;">
										<p><?php echo $product->production_time; ?></p>
									</div>
									<br>
									<? if($product->kind=== 'MCB') { ?>
									<button class="btn orange rnd" data-href="/products/build/<?php echo $product->title_url; ?>">Get Started</button>
									<? } else { ?>
									<form method="POST" action="http://<?=$_SERVER['SERVER_NAME']?>/shopping_cart/addGnG/<?=$product->id?>">
									<form id="bagsForm" method="POST" action="/shopping_cart/addGnG/28">
									<a href="#" class="less reduce minus-1">-</a>
									<input type="text" class="quan-1" value="200" name="bags" id="bagsAmount" onkeydown="return isNumberKey(event);" onkeyup="recalculateAmounts();">
									<a href="#" class="more plus add-1">+</a>

									<button type="submit" class="btn orange rnd">Get Started</button>

									<input type="text" value="200" name="bags" id="bagsAmount"
						   onkeydown="return isNumberKey(event);"
						   onkeyup="recalculateAmounts();" class="hidden"/>

									<?			
			if ($gngoptions)
			{
				foreach ($gngoptions as $option)
				{
					$opt_list = explode('#',$option->values);
?>
					<div class="gngOption hidden">
						<label><?=$option->name?></label>
						<select name="options[<?=$option->id?>]">
<?						foreach ($opt_list as $_opt) { ?>
							<option><?=$_opt?></option>
<?						} ?>
						</select>
					</div>
<?
				}
			}
?>
					<span id="bagsTotal" class="hidden"> </span>

                         
									</form>
									<? } ?>
								</div>
								
							</div>

							<script>
							function getTotals(){
							$(document).ready(function(){
								$(".minus-1, .add-1").click(function(){
									// alert("fired");
									console.log($(".quan-1").val());
									var price = $(".quan-1").val() * <?=$pricesArray[0]['price']; ?>;
									$("#bagsTotal").html(price);
								});
							});
						}
						
						setTimeout(getTotals, 800);
							</script>
						<!-- End Top -->
						<!-- Bottom -->						
						<div class="product-display col-md-12">
								<h4>Recently Ordered</h4>
							<?php if (isset($recentDesigns[0])) { ?>
							<div class="product-info-box col-md-3 rnd-10-black row">
									<img src="/<?=$recentDesigns[0]->designpath?>" alt="gifts"><br>
									<h4>Product Title</h4><br>
									<p>Lorem ipsum dolor  sit amet, consectetur adipisicing elit </p><br>
									<img src="/env/images/mcb/tag.png" alt="gifts">
									<span class="price">$<?=$recentDesigns[0]->rate*$recentDesigns[0]->qty?></span><br>
									<button class="rnd btn btn-thin mango">Get Started</button>	
							</div><?php } ?>
							<?php if (isset($recentDesigns[1])) { ?>
							<div class="product-info-box col-md-3 rnd-10-black row">
									<img src="/<?=$recentDesigns[0]->designpath?>" alt="gifts"><br>
									<h4>Product Title</h4><br>
									<p>Lorem ipsum dolor  sit amet, consectetur adipisicing elit </p><br>									
									<img src="/env/images/mcb/tag.png" alt="gifts">
									<span class="price">$<?=$recentDesigns[1]->rate*$recentDesigns[1]->qty?></span><br>
									<button class="rnd btn btn-thin mango">Get Started</button>	
							</div>
							<?php } ?>
							<?php if (isset($recentDesigns[2])) { ?>
							<div class="product-info-box col-md-3 rnd-10-black row">
									<img src="/<?=$recentDesigns[0]->designpath?>" alt="gifts"><br>
									<h4>Product Title</h4><br>
									<p>Lorem ipsum dolor  sit amet, consectetur adipisicing elit </p><br>
									<img src="/env/images/mcb/tag.png" alt="gifts">
									<span class="price">$<?=$recentDesigns[2]->rate*$recentDesigns[2]->qty?></span><br>
									<button class="rnd btn btn-thin mango">Get Started</button>	
							</div>
							<?php } ?>
							<?php if (isset($recentDesigns[3])) { ?>
							<div class="product-info-box col-md-3 rnd-10-black row">
									<img src="/<?=$recentDesigns[0]->designpath?>" alt="gifts"><br>
									<h4>Product Title</h4><br>
									<p>Lorem ipsum dolor  sit amet, consectetur adipisicing elit </p><br>
									<img src="/env/images/mcb/tag.png" alt="gifts">
									<span class="price">$<?=$recentDesigns[3]->rate*$recentDesigns[3]->qty?></span><br>
									<button class="rnd btn btn-thin mango">Get Started</button>	
							</div>
							<?php } ?>
							<?php if (isset($recentDesigns[4])) { ?>
							<div class="product-info-box col-md-3 rnd-10-black row">
									<img src="/<?=$recentDesigns[0]->designpath?>" alt="gifts"><br>
									<h4>Product Title</h4><br>
									<p>Lorem ipsum dolor  sit amet, consectetur adipisicing elit </p><br>
									<img src="/env/images/mcb/tag.png" alt="gifts">
									<span class="price">$<?=$recentDesigns[4]->rate*$recentDesigns[4]->qty?></span><br>
									<button class="rnd btn btn-thin mango">Get Started</button>	
							</div>
							<?php } ?>
							<?php if (isset($recentDesigns[5])) { ?>
							<div class="product-info-box col-md-3 rnd-10-black row">
									<img src="/<?=$recentDesigns[0]->designpath?>" alt="gifts"><br>
									<h4>Product Title</h4><br>
									<p>Lorem ipsum dolor  sit amet, consectetur adipisicing elit </p><br>
									<img src="/env/images/mcb/tag.png" alt="gifts">
									<span class="price">$<?=$recentDesigns[5]->rate*$recentDesigns[5]->qty?></span><br>
									<button class="rnd btn btn-thin mango">Get Started</button>	
							</div>
							<?php } ?>
							<?php if (isset($recentDesigns[6])) { ?>
							<div class="product-info-box col-md-3 rnd-10-black row">
									<img src="/<?=$recentDesigns[0]->designpath?>" alt="gifts"><br>
									<h4>Product Title</h4><br>
									<p>Lorem ipsum dolor  sit amet, consectetur adipisicing elit </p><br>
									<img src="/env/images/mcb/tag.png" alt="gifts">
									<span class="price">$<?=$recentDesigns[6]->rate*$recentDesigns[6]->qty?></span><br>
									<button class="rnd btn btn-thin mango">Get Started</button>	
							</div>
							<?php } ?>
					
						</div>
						<div class="product-display col-md-12">
								<h4>Other Products</h4>
							<?php if (isset($productresults[0])) { ?>
							<div class="product-info-box col-md-3 rnd-10-black row">
									<img src="/env/product_images/<?=$productresults[0]->image ?>" alt="gifts"><br>
									<h4>Product Title</h4><br>
									<p>Lorem ipsum dolor  sit amet, consectetur adipisicing elit </p><br>
									<img src="/env/images/mcb/tag.png" alt="gifts">
									<span class="price">$<?=$productresults[0]->price ?></span><br>
									<button class="rnd btn btn-thin mango">Get Started</button>	
							</div><?php } ?>
							<?php if (isset($productresults[1])) { ?>
							<div class="product-info-box col-md-3 rnd-10-black row">
									<img src="/env/product_images/<?=$productresults[1]->image ?>" alt="gifts"><br>
									<h4>Product Title</h4><br>
									<p>Lorem ipsum dolor  sit amet, consectetur adipisicing elit </p><br>									
									<img src="/env/images/mcb/tag.png" alt="gifts">
									<span class="price">$<?=$productresults[1]->price ?></span><br>
									<button class="rnd btn btn-thin mango">Get Started</button>	
							</div>
							<?php } ?>
							<?php if (isset($productresults[2])) { ?>
							<div class="product-info-box col-md-3 rnd-10-black row">
									<img src="/env/product_images/<?=$productresults[2]->image ?>" alt="gifts"><br>
									<h4>Product Title</h4><br>
									<p>Lorem ipsum dolor  sit amet, consectetur adipisicing elit </p><br>
									<img src="/env/images/mcb/tag.png" alt="gifts">
									<span class="price">$<?=$productresults[2]->price ?></span><br>
									<button class="rnd btn btn-thin mango">Get Started</button>	
							</div>
							<?php } ?>
							<?php if (isset($productresults[3])) { ?>
							<div class="product-info-box col-md-3 rnd-10-black row">
									<img src="/env/product_images/<?=$productresults[3]->image ?>" alt="gifts"><br>
									<h4>Product Title</h4><br>
									<p>Lorem ipsum dolor  sit amet, consectetur adipisicing elit </p><br>
									<img src="/env/images/mcb/tag.png" alt="gifts">
									<span class="price">$<?=$productresults[3]->price ?></span><br>
									<button class="rnd btn btn-thin mango">Get Started</button>	
							</div>
							<?php } ?>
							<?php if (isset($productresults[4])) { ?>
							<div class="product-info-box col-md-3 rnd-10-black row">
									<img src="/env/product_images/<?=$productresults[4]->image ?>" alt="gifts"><br>
									<h4>Product Title</h4><br>
									<p>Lorem ipsum dolor  sit amet, consectetur adipisicing elit </p><br>
									<img src="/env/images/mcb/tag.png" alt="gifts">
									<span class="price">$<?=$productresults[4]->price ?></span><br>
									<button class="rnd btn btn-thin mango">Get Started</button>	
							</div>
							<?php } ?>
							<?php if (isset($productresults[5])) { ?>
							<div class="product-info-box col-md-3 rnd-10-black row">
									<img src="/env/product_images/<?=$productresults[5]->image?>" alt="gifts"><br>
									<h4>Product Title</h4><br>
									<p>Lorem ipsum dolor  sit amet, consectetur adipisicing elit </p><br>
									<img src="/env/images/mcb/tag.png" alt="gifts">
									<span class="price">$<?=$productresults[5]->price ?></span><br>
									<button class="rnd btn btn-thin mango">Get Started</button>	
							</div>
							<?php } ?>
							<?php if (isset($productresults[6])) { ?>
							<div class="product-info-box col-md-3 rnd-10-black row">
									<img src="/env/product_images/<?=$productresults[6]->image?>" alt="gifts"><br>
									<h4>Product Title</h4><br>
									<p>Lorem ipsum dolor  sit amet, consectetur adipisicing elit </p><br>
									<img src="/env/images/mcb/tag.png" alt="gifts">
									<span class="price">$<?=$productresults[6]->price ?></span><br>
									<button class="rnd btn btn-thin mango">Get Started</button>	
							</div>
							<?php } ?>
					
						</div>
						<!-- End Bottom -->
					</div>
						<!-- End Right Col -->
				</div>
					<!-- End 2 Col -->
				<div class="clear mid-space"></div>
		</div>
<?php
// echo "<pre>";
// print_r($recentDesigns);
// echo "</pre>";
?>