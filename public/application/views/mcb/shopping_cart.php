<script>
var quantity=new Array();
</script>
<div id="content" class="cart row">
<!-- Start Cart -->
	<div class="col-md-12 cart-details">
		<h1>Shopping Cart</h1>
	</div>
	<div class="col-md-12 cart-bar rnd-bar rnd lt-brown">
		<ul>
			<li>Product</li>
			<li>Unit Price</li>
			<li>Qty</li>
			<li>Total</li>
		</ul>
	</div>
	<!-- Details of Cart -->

		<?php if(count($itemsresults) == 0): ?>

				<h4>You have no items in your shopping cart</h2>

				</div><!-- shopping-cart -->

		<?php else: ?>
	
<form action="/shopping_cart/update_quantity" method="post" name="updateQuantity" id="updateQuantity">
<div class="cart-border col-md-12 ">
			<?php $total = 0; $i = 1; $productSubtotal = 0; $additionalFees = 0?>
			<?php foreach($itemsresults as $items):?>
			<?php $total += $items->subtotal; 
			$productSubtotal = $productSubtotal + $items->subtotal;
			$additionalFees = $additionalFees + $items->second_side_fee;
					?>
		<div class="col-md-3 cart-items">
			<span class="cart-imgs">
			<a href="<?php if($items->wrapperpath){echo $items->wrapperpath;} else {echo "/env/product_images/".$items->wrapperpath;}?>" class="highslide" id="hsimage<?php echo $items->id; ?>" onclick="return hs.expand(this, { src: '<?php echo $items->wrapperpath; ?>' })" border="0">
			<?php if($items->wrapperpath != null){ ?><img src="<?=$items->wrapperpath  ?>" alt="Your custom chocolate bars!" width="100" title="Click to see your product!" border="0"> <? } ?></a>
			<a href="<?php if($items->designpath){echo $items->designpath;} else {echo "/env/product_images/".$items->productimage;}?>" class="highslide" id="hsimage<?php echo $items->id; ?>" onclick="return hs.expand(this, { src: '<?php echo $items->designpath; ?>' })" border="0">
			<img src="<?php if($items->designpath){echo $items->designpath;} else {echo "/env/product_images/".$items->productimage;} ?>" alt="Your custom chocolate bars!" width="100" title="Click to see your product!" border="0"></a></span>
		</div>
		<div class="col-md-3 cart-description">
			<a href="/orders/view/<?php echo $items->id; ?>"><?php echo $items->productname; ?></a><br>
			<p><?php echo $items->productdescription ?></p>
			<a class="btn mango rnd" href="/orders/remove/<?php echo $items->id; ?>">Remove</a>&nbsp;<a class="btn grey rnd" href="/orders/view/<?php echo $items->id; ?>">Review Product</a>
		</div>
		<div class="col-md-2 price">
			$<?php echo money_format('%.2n', $items->rate); ?>
		</div>
		<div class="col-md-2 qty item-col num-">
		
			<a href="#" class="reduce minus-">-</a><input type="text" <?=($items->kind == 'MCB_GNG')? "class='quantityItem cart_qual qual-'": "class='cart_qual qual-'"?> name="orders_basket[<? echo $items->id; ?>]" id="quantityItem<?php echo $i; ?>" value="<?php echo $items->qty; ?>"><a href="#" class="plus add-">+</a>
			<br>
			<a href="#"  class="update-btn" onClick="if(! check_amount()) return false; javascript:verifyQty()">Update</a>
		</div>
		<div class="col-md-2 price total">
			$<?php echo money_format('%.2n', $items->subtotal); ?>
		</div><br>

		<hr>
		<?php $i++; ?>
		<?php endforeach; ?>
	
</div>
</form>
	<!-- End of Cart Details -->
<div class="col-md-12 cart-total">
	<form method="post" action="/shopping_cart/checkout/" name="checkoutForm" id="checkoutForm">
		<div class="empty col-md-8">
		<!-- Leave Empty -->
		</div>
		<div class="col-md-4 cart-request-section">
			
			<label>Request Date </label><input name="date_request left hasDatepicker" type="text" name="requestddate" id="requesteddate"><img src="/env/images/mcb/calendar-icon.png" alt="pick date" class="date-picker" onclick="javascript:$('#requesteddate').focus();">
			<br>
			<span class="addl-fees">Additional Fees*: <span class="price">&nbsp;US $<?php echo money_format('%.2n', $additionalFees); ?></span></span><br>
			<span class="prod-subtotal">Product Subtotal: <span class="price">US $<?php echo money_format('%.2n', $productSubtotal); ?></span></span><br>
			<span class="prod-total">Subtotal: <span class="price ">US $<?php echo money_format('%.2n', $additionalFees + $productSubtotal); ?></span></span><br>
			<a class="rnd grey btn" href="/products">Continue Shopping</a><button class="rnd orange btn btn-thin" onclick="document.checkoutForm.submit();">Checkout</button>
		</div>
	</form>
</div>

<?php endif; ?>
	<div class="clear large-space">

	</div>

	<?
if(isset($itemsresults)){
 echo "<pre>";
 foreach($itemsresults as $items){
 print_r($items);
 // echo $items->order_id;
}
 echo "</pre>";
}
?>



	 
		<script>
					
			function deleteOrder(id){
			
				var r = confirm("Are you sure you want to remove this order from your shopping cart?");
				if (r == true) {
					document.location = '/orders/remove/' + id;
				} else {
					
				}
					
			}
			
		</script>
		<script>
			function verifyQty(){
				
				var qtylen = quantity.length;
				//alert(qtylen);
				for(var k=1; k < qtylen; k++) {
					var caseVal = quantity[k][1];
					switch (caseVal) {
					case 1:	
						if(document.getElementById("quantityItem"+k).value < 300) {
							alert("Quantity needs to be at least 300 for item #"+k+" in your shopping cart.");
							document.getElementById("quantityItem"+k).focus();
							return false;
						}
						break;
					case 2:
						if(document.getElementById("quantityItem"+k).value < 50) {
							alert("Quantity needs to be at least 50 for item #"+k+" in your shopping cart.");
							document.getElementById("quantityItem"+k).focus();
							return false;
						}

						break;
					case 3:
						if(document.getElementById("quantityItem"+k).value < 500) {
							alert("Quantity needs to be at least 500 for item #"+k+" in your shopping cart.");
							document.getElementById("quantityItem"+k).focus();
							return false;
						}

						break;
					case 4:
						if(document.getElementById("quantityItem"+k).value < 600) {
							alert("Quantity needs to be at least 600 for item #"+k+" in your shopping cart.");
							document.getElementById("quantityItem"+k).focus();
							return false;
						}

						break;
					
					} 
				
				}
				
				document.updateQuantity.submit();

			}

		</script>


<script type="text/javascript">
    function check_amount() {
        var error = false;
        $('.quantityItem').each(function(){
            var amount = $(this).val();
            if(amount < 200) {
                $('#popupInfo').css('display', 'block');
                error = true;
            }
        });
        if(error)
            return false;
        else
            return true;
    }

    function hideErrorBlock() {
        $('#popupInfo').css('display', 'none');
    }
</script>


