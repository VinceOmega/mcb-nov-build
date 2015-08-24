<div id="content">
			<div id="section-header">
				<h2 class="curly">Shopping Cart</h2>
			</div><!-- header -->
			<div id="shopping-cart" class="grey-border">
				<h4>Please review the products and quantities in your order.</h4>
				<h4>Remove products, or change quantities if necessary or continue shopping to add additional products.</h4>
				
				<?php $total = 0; ?>
				<?php foreach($itemsresults as $items):?>
				<?php $total += $items->total; ?>
				<div class="order grey-border">
					<div class="order-headers left">
						<span class="item left"><h3>Quantity</h3></span>
						<span class="item left"><h3>Product</h3></span>
						<span class="item left"><h3>Unit Price</h3></span>
						<span class="item left"><h3>Total</h3></span>
					</div><!--order-headers -->
					<div class="item left">
						<form method="post" action="">
							<input type="text" name="quantity" value="<?php echo $items->qty; ?>" />
						</form>
					</div><!-- quantity -->
					<div class="item left">
						<img src="/env/images/<?php echo $items->productimage; ?>" />
						<p><?php echo $items->productname; ?></p>
						<a class="red" href="/orders/view/<?php echo $items->id; ?>">Review Detail</a> | <a class="red" href="/orders/edit/<?php echo $items->id; ?>">Edit Product</a>
					</div><!-- product -->
					<div class="item left">
						<p><?php echo money_format('%.2n', $items->rate); ?></p>
					</div><!-- unit-price -->
					<div class="item left">
						<p><?php echo money_format('%.2n', $items->total); ?></p>
					</div><!-- total -->
					<div style="margin-top: 50px;"  class="item left">
						<a class="red" href="/orders/delete/<?php echo $items->id; ?>">Remove</a>
					</div><!-- remove -->
				</div><!-- order -->
				<?php endforeach; ?>
				
			
				
				
			</div><!-- shopping-cart -->
			<span id="update-quantity" class="left"><a class="red" href="#">Update Quantity</a></span>
			<div id="request-date" class="right">
				<img class="left" style="margin-right: 5px;" src="/env/images/mcc/small-coins.png" />
				<h4 class="left">Requested Date</h4>
				<form method="post" action="">
					<input class="left" type="text" name="requesteddate" id="requesteddate" />
				</form>
				<img class="left" src="/env/images/calendar.png" />
			</div><!-- request-date -->
			<div class="clear"></div>
			<span id="product-subtotal" class="right"><h3>Product Subtotal: <?php echo money_format('%.2n', $total); ?></h3></span>
			<div class="clear"></div>
			<a href="checkout1.html"><img style="margin-bottom: 30px;" class="right" src="/env/images/mcc/checkout.png" /></a>
			<div class="clear"></div>
			<img style="margin-bottom: 10px;" class="right" src="/env/images/authorize.png" />
			<div class="clear pink-bar" style="margin-bottom: 20px;"></div>
		<script>
			$('#requesteddate').datepicker({dateFormat: 'yy-mm-dd'});
		</script>
	 
