<div id="content">
			<div id="pink-section-header">
				<h2 class="curly">Shopping Cart</h2>
			</div><!-- header -->
			<div id="shopping-cart" class="grey-border">
				
			<div id="sidebar" class="pink-top grey-border left">
			
				<?php foreach($orderresults as $orders):?>
				<div class="sidebar-link">
					<a href="/orders/view/<?php echo $orders->id; ?>">Order Item Number: <?php echo $orders->id; ?> || <?php echo $orders->productname; ?></a>
				</div>
				<div class="grey-bar"></div>
				<?php endforeach; ?>
				
			</div><!-- sidebar -->
			<div id="shopping-cart" class="grey-border">
				<h4>Order Item Number: <?php echo $order->id; ?></h4>
				<div class="order">

					<div class="order-headers left">
						<span class="item left"><h3>Product</h3></span>
						<span class="item2 left"><h3>Details</h3></span>
					</div><!--order-headers -->
						<div class="item left">
            <?php if(empty($order->designpath)): ?>
              <p><img src="/env/product_images/<?php echo $order->productimage; ?>" width="100" />
              <?php else: ?>
						<p><a href="<?php echo $order->designpath; ?>" class="highslide" id="hsimage<?php echo $order->id; ?>" onclick="return hs.expand(this, { src: '<?php echo $order->designpath; ?>' })" border="0">
						<img src="<?php echo $order->designpath; ?>" alt="Your custom chocolate hearts!" width="100" title="Click to enlarge your design" border="0" /></a>
							
              <?php endif; ?>
							<?php echo $order->productname; ?></p>
						</div><!-- product -->

						

						<div class="item2 left">
							<p><h3>Flavor: <font style="color:#000000;"><?php echo $order->flavorname; ?></h3></p>
							<br>
							<?php if($order->product_id != 2) : ?>
								<p><h3>Foil: <font style="color:#000000;"><?php echo $order->foilcolor; ?></h3></p>
								<br>
							<?php endif; ?>
							
							
							<?php if($order->product_id != 1) : ?>
								<p><h3>Text 1: <font style="color:#000000;"><?php echo $order->msg_text1; ?></font></h3></p>
								<br>
								<p><h3>Text 1 Font: <font style="color:#000000;"><?php echo $order->msg_text1font; ?></font></h3></p>
								<br>
								<p><h3>Text 1 Size: <font style="color:#000000;"><?php echo $order->msg_text1size; ?></font></h3></p>
								<br>
								<p><h3>Text 1 Color: <font style="color:#000000;"><?php echo $order->msg_text1color; ?></font></h3></p>
								<br>
								<?php if($order->product_id != 4) : ?>
									
									<p><h3>Text 2: <font style="color:#000000;"><?php echo $order->msg_text2; ?></font></h3></p>
									<br>
									<p><h3>Text 2 Font: <font style="color:#000000;"><?php echo $order->msg_text2font; ?></font></h3></p>
									<br>
									<p><h3>Text 2 Size: <font style="color:#000000;"><?php echo $order->msg_text2size; ?></font></h3></p>
									<br>
									<p><h3>Text 2 Color: <font style="color:#000000;"><?php echo $order->msg_text2color; ?></font></h3></p>
									<br>
								<?php endif; ?>
							<?php endif; ?>

									
							<p><h3>Quantity: <font style="color:#000000;"><?php echo $order->qty; ?></font></h3></p>
							<br>
							<p><h3>Unit Price: <font style="color:#000000;"><?php echo money_format('%.2n', $order->rate); ?></font></h3></p>
							<br>
							<p><h3>Order Total: <font style="color:#000000;"><?php echo money_format('%.2n', $order->subtotal); ?></font></h3></p>
							<br><br><br>
							<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
							<!--<p><h3><a href="/orders/edit/<?php echo $order->id; ?>">Edit Order</a></h3></p>-->
						</div><!-- item-left -->
						<div id="returnToCart" style="float:right;"><a href="/shopping_cart/">Return to Cart</a></div>
				</div><!-- order -->
			</div>
				
				
			
	
	 
