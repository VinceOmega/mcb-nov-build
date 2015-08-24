      <div id="content">
			<div id="section-header">
				<h2 class="curly"><?php if($status == 1): ?>Thank You For Your Order<?php else: ?>Your Order Could Not Be Completed.<?php endif; ?></h2>
			</div><!-- header -->
			<div id="checkout" class="grey-border left">
				<div id="credit" class="left">
					<div id="confirmation" class="grey-border">
            <?php if($status == 1): ?>
  						<h3>Order ID <?=$order->getOrderId()?></h3><br>
              <p style="font-weight:bold;"><?=$trans_status?></p> 
  						<p style="font-weight:bold;">Thank you for your order. Please feel free to call us at 1-866-230-7730 with any questions or concerns.</p>  
              <p style="font-weight:normal;">Please be sure to save your order number in case you need to inquire about your order in the future.</p> 
            <?php else: ?>
               <p style="font-weight:bold;"><?=$trans_status?></p>  
             <?php endif; ?>    
				<br><p><a href="/shopping_cart/checkout/">Return to Checkout</a></p>
					</div><!-- confirmation -->

				</div><!-- order -->

				<div id="order-summary" class="left">

					<center><img src="/env/images/mcc/step2.png" /></center>
					<div id="order-info" class="grey-border">
						<h4>Order Summary</h4>
						<br />
						<span class="a red left">Product</span>
						<span class="a red left center">Quantity</span>
						<span class="a red left center">Total</span>
						<div class="clear"></div>
            
            
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
  						<span class="a left"><?=$product_name?></span>
  						<span class="a left center"><?=$items->qty?></span>
  						<span class="a left center"><?=money_format('%.2n', $items->subtotal)?></span>
  						<div class="clear"></div>
<?
					}
					if ($additionalFees != 0)
					{
?>
  						<span class="a left">Additional Fees:</span>
  						<span class="a left center">&nbsp;</span>
  						<span class="a left center"><?=money_format('%.2n', $additionalFees); ?></span>
  						<div class="clear"></div>
<?						
					}
?>
						<span class="b left" style="width: 66%;">Subtotal:</span>
						<span class="c left"><?=money_format('%.2n', $order->subtotal)?></span>
						<span class="b left" style="width: 66%;">Shipping Cost:</span>
						<span class="c left">
							<div id="shipping_cost" name="shipping_cost">
								<?=money_format('%.2n', $order->shipping_total)?>
							</div>
						</span>
						<span class="b left" style="width: 66%;">Order Total:</span>
						<span class="c left">
							<div id="total_cost" name="total_cost">
								<?=money_format('%.2n', $order->order_total)?>
							</div>
						</span>
						<a style=" clear: both; margin: 10px 0px;" class="red left" href="/shopping_cart/">Back to Cart</a>

						<br class="clear" />
						<span class="red">Shipping Address</span>
						<br class="clear" />
						<span><?=$order->user->user_shipping_info->firstname.' '.$order->user->user_shipping_info->lastname?></span>
						<br class="clear" />
						<span><?=$order->user->user_shipping_info->address1.'<br/>'.$order->user->user_shipping_info->address2?></span>
						<br class="clear" />
						<span><?=$order->user->user_shipping_info->city.', '.$order->user->user_shipping_info->state.' '.$order->user->user_shipping_info->zip?></span>
						<br class="clear" />
            
						<br class="clear" />
						<span class="red">Billing Address</span>
						<br class="clear" />
						<span><?=$order->user->user_billing_info->firstname.' '.$order->user->user_billing_info->lastname?></span>
						<br class="clear" />
						<span><?=$order->user->user_billing_info->address1.'<br/>'.$order->user->user_billing_info->address2?></span>
						<br class="clear" />
						<span><?=$order->user->user_billing_info->city.', '.$order->user->user_billing_info->state.' '.$order->user->user_billing_info->zip?></span>
						<a style=" clear: both; margin: 10px 0px;" class="red left" href="/shopping_cart/checkout/">Back to Edit Addresses</a>

					</div><!-- order-info -->

				</div><!-- order-summary -->

			</div><!-- checkout -->

			<br class="clear" />

			<div class="clear pink-bar"></div>

			<br class="clear" />
