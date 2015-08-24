<div id="content">
			<div id="section-header">
				<h2 class="curly">Shopping Cart</h2>
			</div><!-- header -->
			<div id="shopping-cart" class="grey-border">
				
				
				
				<?php if(count($itemsresults) == 0): ?>

				<h4>You have no items in your shopping cart</h2>

				</div><!-- shopping-cart -->

				<?php else: ?>
				
				<h4>Please review the products and quantities in your order.</h4>
				<h4>Remove products, or change quantities if necessary or continue shopping to add additional products.</h4>
				<form action="/shopping_cart/update_quantity" method="post" name="updateQuantity" id="updateQuantity">
<?		
				$productSubtotal = 0;
				$additionalFees = 0;
				foreach ($itemsresults as $key => $item)
				{
					$productSubtotal += $item->subtotal;
					$additionalFees += $item->second_side_fee;
?>
				<div class="order grey-border">
					<div class="order-headers left">
						<span class="item left" style="width:14%"><h3>Quantity</h3></span>
						<span class="item left"><h3>Product</h3></span>
						<span class="item left" style="width:14%"><h3>Unit Price</h3></span>
<?					if (isset($packagingsActive) && $packagingsActive) { ?>
						<span class="item left"><h3>Packaging</h3></span>
<?					} ?>
						<span class="item left" style="width:15%"><h3>Total</h3></span>
					</div><!--order-headers -->
					<div class="item left" style="width:14%">
						<input type="text" 
							   class="basket-amount-input"
							   name="orders_basket[<?=$item->id?>]" 
							   id="quantityItem<?=$key++?>" 
							   value="<?=$item->qty?>"
							   data-minAmount="<?=$item->packaging->id != 0 ? $item->packaging->getMinAmount() : '0'?>"
							   />
					</div><!-- quantity -->
					<div class="item left">
<?				if ($item->designpath != '') { ?>
						<a href="<?=$item->designpath?>" class="highslide" id="hsimage<?=$item->id; ?>" onclick="return hs.expand(this, { src: '<?=$item->designpath?>' })" border="0">
					<img src="<?=$item->designpath?>" alt="" />
<?				} else { ?>
						<a href="/env/product_images/<?=$item->productimage?>" class="highslide" id="hsimage<?=$item->id?>" onclick="return hs.expand(this, { src: '<?=$item->designpath?>' })" border="0">
							<img src="/env/product_images/<?=$item->productimage?>" alt="Your custom chocolate coins!" width="100" title="Click to see your product!" border="0" />
						</a>
<?				} ?>
						<p><?=$item->productname?></p>
						<a class="red" href="/orders/view/<?=$item->id?>">Review Product</a>
					</div><!-- product -->
					<div class="item left" style="width:15%">
						<p><?=$item->packaging->id != 0 ? money_format('%.2n', $item->packaging_rate) : money_format('%.2n', $item->rate)?></p>
					</div><!-- unit-price -->
<?					if (isset($packagingsActive) && $packagingsActive)
					{
						if ($item->packaging->id == 0 && $item->kind != 'MCC_GNG') {
?>
					<div class="item left" next='choosepk'>
						<a href="/shopping_cart/selectPackaging?basketId=<?=$item->id?>">Choose Packaging</a>
					</div><!-- product -->
<?							
						} elseif ($item->packaging->id == 0 && $item->kind == 'MCC_GNG') {
?>
					<div class="item left">
						--
					</div><!-- product -->
<?							
						} else {
?>
					<div class="item left">
						<a href="/env/packaging_images/<?=$item->packaging->image?>" class="highslide" id="hsimagePackaging<?=$item->packaging->id?>" onclick="return hs.expand(this, { src: '' })" border="0">
						<img src="/env/packaging_images/<?=$item->packaging->image?>" alt="Your custom chocolate coin's packaging!" width="100" title="Click to see the packaging!" border="0" /></a>
					</div><!-- product -->
<?
						}
					} ?>


					<div class="item left" style="width:15%">
						<p><?=money_format('%.2n', $item->subtotal)?></p>
					</div><!-- total -->
					<div style="margin-top: 50px; float: right; width: 15%;"  class="item left">
						<a class="red" href="#" onClick="javascript:deleteOrder(<?=$item->id?>);">Remove</a>
					</div><!-- remove -->
				</div><!-- order -->
<?				} ?>
				
			
				
				
			</div><!-- shopping-cart -->
			<span id="update-quantity" class="left"><a class="red" href="#" onClick="verifyQty(); return false;">Update Quantity</a></span>
			<span class="left" style="clear: left; margin-left: 20px; margin-top: 100px;">* Additional fee applies for customizing two sides of the coin.</span>
			</form>
			<form method="post" action="/shopping_cart/checkout/" name="checkoutForm" id="checkoutForm">
			<div id="request-date" class="right">
				<img class="left" style="margin-right: 5px;" src="/env/images/mcc/small-coins.png" />
				<h4 class="left">Requested Date</h4>
				
					<input class="left" type="text" name="requesteddate" id="requesteddate" />
				
				<img class="left" src="/env/images/calendar.png" onClick="javascript:$('#requesteddate').focus();" />
			</div><!-- request-date -->
			<div class="clear"></div>
			<span id="product-subtotal" class="right">
				<h3 style="text-align: right;">Additional Fees*: <span style="display: inline-block; width: 100px; margin-right: 10px;"><?php echo money_format('%.2n', $additionalFees); ?></span></h3>
				<h3 style="text-align: right;">Product Subtotal: <span style="display: inline-block; width: 100px;margin-right: 10px;"><?php echo money_format('%.2n', $productSubtotal); ?></span></h3>
				<h3 style="text-align: right;">Subtotal: <span style="display: inline-block; width: 100px;margin-right: 10px;"><?php echo money_format('%.2n', $additionalFees+$productSubtotal); ?></span></h3>
			</span>
			<div class="clear"></div>
			<a href='javascript:void(0)'><img style="margin-bottom: 30px;" class="right" src="/env/images/mcc/checkout.png" onClick="CheckoutSubmit(); return;" /></a>
			</form>
			<div class="clear"></div>
			<img style="margin-bottom: 10px;" class="right" src="/env/images/authorize.png" />
			<div class="clear pink-bar" style="margin-bottom: 20px;"></div>
		<script type="text/javascript">
			$('#requesteddate').datepicker({dateFormat: 'yy-mm-dd'});
					
			function deleteOrder(id){
				if (confirm("Are you sure you want to remove this order from your shopping cart?"))
					document.location.href='/orders/remove/' + id;
			}
			
			function verifyQty(){
				var result = true;
				$('.basket-amount-input').each(function (index,_input) {
					var input = $(_input);
					if (result && !isNaN(input.val()) && input.val() < input.attr('data-minAmount')) {
						alert( "Quantity needs to be at least "+input.attr('data-minAmount')+" for item #"+(index+1)+" in your shopping cart.");
						input.focus();
						result = false;
					}
				});
				if (result)
					document.updateQuantity.submit();
			}
			
			function CheckoutSubmit(){
				var result = true;
				$('div .order .item').each(function(){
					if($(this).attr('next') && $(this).attr('next') == 'choosepk'){
						alert('Please choose packaging option in order to continue');
						result = false;
					}
				});
				if(result)
					document.checkoutForm.submit()
				return true;
			}

		</script>

		<?php endif; ?>


