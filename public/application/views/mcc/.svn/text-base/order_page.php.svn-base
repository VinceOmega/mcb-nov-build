<div id="content">
			<div id="section-header">
				<h2 class="curly">Shopping Cart</h2>
			</div><!-- header -->
			<div id="shopping-cart" class="grey-border">
				
			<div id="sidebar" class="grey-top grey-border left">
			
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
						<img src="<?php echo $order->designpath; ?>" alt="Your custom chocolate coins!" width="100" title="Click to enlarge your design" border="0" /></a>
							
              <?php endif; ?>
							<?php echo $order->productname; ?></p>
						</div><!-- product -->

						

						<div class="item2 left">
							<p><h3>Flavor: <font style="color:#000000;"><?php echo $order->flavorname; ?></h3></p>
							<br>
<?							
							$basket = ORM::factory('orders_basket')->find($order->id);
							foreach ($basket->orders_baskets_datas as $data)
								if ($data->type == 'Foil') {
									$_data = json_decode($data->data, TRUE);
?>
							<p><h3><?=$data->name?>: <?=$_data['name']?></h3></p>
							<br>
<?
								}
							$texts = $basket->getTextToShow(); 
							foreach ($texts as $text) { ?>
							<p>
								<h3>
									<?=$text->name?>: 
									<span style="font-size:12px; color:#<?=$text->color_hex?>; "><?=$text->text?></span>
									(Font: <?=$text->font?>)
								</h3>
							</p>
							<br>
<?							}

							if ($basket->orders_baskets_gngoptions)
								foreach ($basket->orders_baskets_gngoptions as $option) { ?>
							<p><h3><?=$option->name?>: <font style="color:#000000;"><?=$option->value?></font></h3></p>
							<br>
<?							}?>
							
							
							<br />
<?							if ($basket->packaging_id != 0) { ?>
							<p><h3>Packaging:</h3></p><br /><br />
							<a href="/env/packaging_images/<?=$basket->packaging->image?>" class="highslide" id="hsimagePackaging<?=$basket->packaging->id?>" onclick="return hs.expand(this, { src: '' })" border="0">
						<img src="/env/packaging_images/<?=$basket->packaging->image?>" alt="Your custom chocolate coin's packaging!" width="100" title="Click to see the packaging!" border="0" /></a>
	<?							if ($basket->orders_baskets_packagingoptions)
									foreach ($basket->orders_baskets_packagingoptions as $option) { ?>
							<p><h3><?=$option->name?>: <font style="color:#000000;"><?=$option->value?></font></h3></p>
							<br>
<?								}
							} ?>
							<br />
							
							
							<br>
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
				
				
			
	
	 
