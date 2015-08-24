     <div id="content" class="checkout-payment row">
<!-- Header and Progress Bar -->
	<div class="checkout-header">
				<h1>Checkout</h1><br>
		<div class="rnd ghost outer-skin">
						<div class="rnd canary inner-filling">

						</div>
						<div class="icon-space home-canary">
							<div class="clr lt-grey">

							</div>
						</div>
				</div>
				
				<div class="rnd ghost outer-skin">
						<div class="rnd canary inner-filling">

						</div>
						<div class="icon-space card-cement">
							<div class="clr lt-grey">

							</div>
						</div>
				</div>
				
				<div class="rnd ghost outer-skin">
						<div class="rnd canary inner-filling">

						</div>
						<div class="icon-space  note-cement">
							<div class="clr lt-grey">

							</div>
						</div>
				</div>
				
				<div class="rnd ghost outer-skin">
						<div class="rnd canary inner-filling complete">

						</div>
				</div>
			</div>
		<!-- End Header and Progrees Bar -->
		<!-- Two column set up -->
		<div class=" 2-col col-md-12 row checkout-payment-summary">
			<!--Begin Left Col -->
			<div class="col-md-8 left-col">
				<h1><?php if($status == 1): ?>Thank You For Your Order<?php else: ?>Your Order Could Not Be Completed.<?php endif; ?></h1>
		
            <?php if($status == 1): ?>
  						<h3>Order ID <?=$order->getOrderId()?></h3><br>
              <p><?=$trans_status?></p> 
  						<p>Thank you for your order. Please feel free to call us at 1-866-230-7730 with any questions or concerns.</p>  
              <p>Please be sure to save your order number in case you need to inquire about your order in the future.</p> 
            <?php else: ?>
               <p><?=$trans_status?></p>  
             <?php endif; ?>    
				<br><p><a href="/shopping_cart/checkout/">Return to Checkout</a></p>
			</div>
			<!-- End Left Col -->
				<div class="col-md-4 right-col">
					<h3>Order Summary</h3><br>
						<div class="row col-md-12 total-box">
							<ul class="col-md-11 rnd-bar rnd-10 lt-brown">
								<li>Product</li>
								<li>Qty</li>
								<li>Total</li>
							</ul>
            
            
<?php				
					$additionalFees = 0;
					foreach($itemsresults as $items)
					{
						$additionalFees += $items->second_side_fee;
						$basket = ORM::factory('orders_basket',$items->orders_basket_id);
						$product_name = $items->productname;
						if ($basket->packaging_id != 0)
							$product_name .= ' - '.$basket->packaging->name;
?>
  						<ul class="col-md-11 line-item">
								<li>Item Name</li>
								<li><?=$items->qty;?></li>
								<li class="price">$<?=$items->rate * $items->qty?></li>
						</ul>
<? } ?>
<? if($order){ ?>
									<span class="check-subtotal">Subtotal: <span class="price">US $<?=money_format('%.2n', $order->subtotal)?></span></span><br>
									<span class="check-shipping">Shipping Cost: <span class="price">US $<?=money_format('%.2n', $order->shipping_total)?></span></span><br>
									<span class="check-total">Order Total: <span class="price ">US $<?=money_format('%.2n', $order->order_total)?></span></span><br>
<? } ?>				
						
					<?	if($billingName){ ?>
								<h4>Shipping Address</h4><br/>
									<b><?= $shippingName; ?></b>
									<ul>
										<li><?=$shippingAddress; ?></li>
										<li><?=$shippingCity; ?></li>
									</ul>
									<h4>Billing Address</h4><br/>
									<b><?=$billingName;?></b>
									<ul>
										<li><?= $billingAddress; ?></li>
										<li><?=$billingCity; ?></li>
									</ul>
									
							<?	} ?>
						</div>

				</div>
			<!-- End Right Col -->
		</div>
		<!-- End 2 Col Layout -->
	<div class="clear large-space"></div>
	</div>