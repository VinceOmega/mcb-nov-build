
<div id="content" class="quantity row">
<!--Start Cart -->
	<div class="col-md-12 col-xs-12 col-lg-12 col-sm-12 quantity-title">
		<h1>Choose Quantity</h1>
	</div>
		<div class="row col-md-12 col-xs-12 col-sm-12 col-lg-12 ghost">
			<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
			<?php foreach($orderresults as $orders):?>
				<h3><? echo isset($orders->productname);?></h3>
				<?php endforeach; ?>
			</div><br>
			<div class="col-md-3 col-xs-3 col-sm-3 col-lg-3 quantity-items">
			 <?php if(empty($order->designpath)): ?>
				<span class="cart-imgs"><img src="/env/product_images/<?php echo isset($order->productimage); ?>" alt="product" width="102"></span>
			<?php else: ?>
				<span class="cart-imgs"><a href="<?php echo isset($order->designpath); ?>" class="highslide" id="hsimage<?php echo isset($order->id); ?>" onclick="return hs.expand(this, { src: '<?php echo isset($order->designpath); ?>' })" border="0"><img src="<?php echo isset($order->designpath); ?>" alt="Your custom chocolate chocolate bar!" width="102" title="Click to enlarge your design" border="0" /></a></span>

			<?php endif; ?>
			</div>
			<div class="col-md-9 col-xs-9 col-sm-9 col-lg-9 quantity-description">
				<a href="#"><?php echo isset($order->productname); ?></a><br>
				<p> Product Unit Price : <b>US $<?php echo money_format('%.2n', isset($order->rate)); ?></b></p><br>
				<a class="btn rnd cream" href="/products/show/<?php echo isset($order->title_url); ?>">Review Product</a>
			</div>
			<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12 quantity-pack-text">
				<h3>Packaging</h3><br>
				<p><?=isset($order->description)?></p>
			</div>
			<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12 quantity-cal-section">
				<h3>Quantity</h3><br>
				<p>Product based on quantity</p><br>
			<!-- Brown Box -->	
				<div class="row col-md-4 col-xs-4 col-sm-4 col-lg-4 price-table">
					<div class="col-md-8 col-xs-8 col-sm-8 col-lg-8 left-col lt-brown first">
					50-99
					</div>
					<div class="col-md-4 col-xs-4 col-sm-4 col-lg-4 right-col lt-brown first">
					&nbsp;&nbsp;$<?=money_format('%2n', isset($order->rate)*50)?>-$<?=money_format('%2n', isset($order->rate)*99)?>
					</div>
					<div class="col-md-8 col-xs-8 col-sm-8 col-lg-8 left-col mocha">
					100-249
					</div>
					<div class="col-md-4 col-xs-4 col-sm-4 col-lg-4 right-col mocha">
					&nbsp;&nbsp;$<?=money_format('%2n', isset($order->rate)*100)?>-$<?=money_format('%2n', isset($order->rate)*249)?>
					</div>
					<div class="col-md-8 col-xs-8 col-sm-8 col-lg-8 left-col lt-brown">
					250-299
					</div>
					<div class="col-md-4 col-xs-4 col-sm-4 col-lg-4 right-col lt-brown">
					&nbsp;&nbsp;$<?=money_format('%2n', isset($order->rate)*250)?>-$<?=money_format('%2n', isset($order->rate)*299)?>
					</div>
					<div class="col-md-8 col-xs-8 col-sm-8 col-lg-8 left-col mocha last">
					1000+
					</div>
					<div class="col-md-4 col-xs-4 col-sm-4 col-lg-4 right-col mocha last">
					&nbsp;&nbsp;$<?=money_format('%2n', isset($order->rate)*1000)?>
					</div>
				</div>
			<!-- Brown Box -->
			<form method="POST" action="http://<?=$_SERVER['SERVER_NAME']?>/shopping_cart/update_quantity">	
			<div class="col-md-4 col-xs-4 col-sm-4 col-lg-4 quantity-selector">
					<span class="wrapper">
					Choose Quantity<br>

					<?php foreach($orderresults as $orders):?>
					<a href="#" onclick="javascript:;" class="reduce">-</a> <input type="text" name="orders_basket[<? echo $orders->id; ?>]" class="number-field" value="<?php echo $orders->qty; ?>"><a href="#" onclick="javascript:;" class="plus">+</a><br>
					<a href="#" class="update">Update</a>
					<input type="hidden" name="rate" class="item-rate" value="<?= isset($order->rate)?>">
					<?php endforeach; ?>
					</span>
			</div>
				<div class="col-md-4 col-xs-4 col-sm-4 col-lg-4 quantity-tabulation">
						<p>Unit Price: <b>$<?=money_format('%2n', isset($order->rate))?></b></p>
						<p>Subtotal: <b>$<span class="price-subtotal-col"></span></b></p>
				</div>
				<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12 quantity-submission">
					<button name="btn-quantity-add" class="btn orange btn-thin">Add to Cart</button>
				</div>
			</form>
			</div>	
				
			
		</div>
		<div class="clear large-space"></div>



</div>
<? 

echo "<pre>";
print_r($order);
echo "</pre>";