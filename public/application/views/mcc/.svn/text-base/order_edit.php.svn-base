<div id="content">
			<div id="section-header">
				<h2 class="curly">Shopping Cart</h2>
			</div><!-- header -->
			<div id="shopping-cart" class="grey-border">
				
			<div id="sidebar" class="grey-top grey-border left">
			
				<?php foreach($orderresults as $orders):?>
				<div class="sidebar-link">
					<a href="/orders/view/<?php echo $orders->id; ?>">Order Number: <?php echo $orders->trans_id; ?> || <?php echo $orders->productname; ?></a>
				</div>
				<div class="grey-bar"></div>
				<?php endforeach; ?>
				
			</div><!-- sidebar -->
			<div id="shopping-cart" class="grey-border">
				<h4>Order Number: MCH-<?php echo $order->id; ?></h4>
				<div class="order">

					<div class="order-headers left">
						<span class="item left"><h3>Product</h3></span>
						<span class="item2 left"><h3>Details</h3></span>
					</div><!--order-headers -->
						<div class="item left">
						 <?php if(empty($order->designpath)): ?>
              <p><img src="/env/product_images/<?php echo $order->productimage; ?>" width="100" />
              <?php else: ?>
							<p><img src="<?php echo $order->designpath; ?>">
              <?php endif; ?>
							<?php echo $order->productname; ?></p>
						</div><!-- product -->

						

						<div class="item2 left">
							
							<form action="/orders/edit/<?php echo $order->id; ?>" method="post" name="editOrder">
							<p><h3>Flavor: 
								<?php $db=new Database; $flavorsresults = $db->query('SELECT * FROM flavors where id= '.$order->flavor_id.''); $flavor = $flavorsresults[0]; ?>
								<select name="order_flavor">
									
										<option value="<?php echo $flavor->id; ?>" selected><?php echo $flavor->name; ?></option>
									
								</select>
							</h3></p>
							<br>

							<?php if($order->product_id != 2) : ?>
							<p><h3>Foil: 
								<?php $foilsresults = $db->query('SELECT * FROM foil_colors where id= '.$order->foil_id.''); $foil = $foilsresults[0]; ?>
								<select name="order_foil">
									
										<option value="<?php echo $foil->id; ?>" selected><?php echo $foil->name; ?></option>
									
								</select>
							
							</h3></p>
							<br>
							<?php endif; ?>

							<?php if($order->product_id != 1) : ?>
								
								<p><h3>Text 1: <input type="text" style="width:265px;" name="text1" value="<?php echo $order->msg_text1; ?>"></input></h3></p>
								<br>
								<p><h3>Text 1 Font: <?php echo $order->msg_text1font; ?></h3></p>
								<br>
								<p><h3>Text 1 Size: <?php echo $order->msg_text1size; ?></h3></p>
								<br>
								<p><h3>Text 1 Color: <?php echo $order->msg_text1color; ?></h3></p>
								<br>
								<?php if($order->product_id != 4) : ?>
									<p><h3>Text 2: <input type="text" style="width:265px;" name="text2" value="<?php echo $order->msg_text2; ?>"></input></h3></p>
									<br>
									<p><h3>Text 2 Font: <?php echo $order->msg_text2font; ?></h3></p>
									<br>
									<p><h3>Text 2 Size: <?php echo $order->msg_text2size; ?></h3></p>
									<br>
									<p><h3>Text 2 Color: <?php echo $order->msg_text2color; ?></h3></p>
									<br>
								<?php endif; ?>
							
							<?php endif; ?>
							<p><h3>Quantity: <?php echo $order->qty; ?></h3></p>
							<br><br><br><br>
							
							<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
							<p><input type="submit" name="submit" value="Submit"></input></p>
							</form>
						</div><!-- item-left -->
					
				</div><!-- order -->
			</div>
				
				
			
	
	 
