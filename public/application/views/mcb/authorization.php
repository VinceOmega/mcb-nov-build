
<script type="text/javascript" src="/env/js/gen_validatorv4.js" xml:space="preserve"></script>


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
						<div class="rnd cement inner-filling">

						</div>
						<div class="icon-space  note-cement">
							<div class="clr lt-grey">

							</div>
						</div>
				</div>
				
				<div class="rnd ghost outer-skin">
						<div class="rnd cement inner-filling complete">

						</div>
				</div>
			</div>
		<!-- End Header and Progrees Bar -->
		<!-- Two column set up -->
					
		<form method="post" action="https://<?=$_SERVER['SERVER_NAME']?>/shopping_cart/order_status" name="checkoutform" id="checkoutform">
			<div class=" 2-col col-md-12 row checkout-payment-summary">
			<!--Begin Left Col -->
				<div class="col-md-8 left-col">
					<h3>Payment Type</h3>
					<input type="hidden" name="orderid" id="orderid" value="<?=$order->id?>" />
					<input type="hidden" name="shippingtotal" id="shippingtotal" value="<?=$order->shipping_total?>" />
					<input type="hidden" name="ordertotal" id="ordertotal" value="<?=$order->order_total?>" />

						<input name="payment_method" type="radio" checked value="credit_card" onclick="toggleSet(this)"><span>Credit Card</span><img src="/env/images/mcb/mastercard.png" alt="Master Card Logo"><img src="/env/images/mcb/visa.png" alt="VISA Logo"><img src="/env/images/mcb/americanexpress.png" alt="American Express Logo"><img src="/env/images/mcb/discover.png" alt="Discover Logo"><br>
<?//						<div class="header"><input type="radio" name="payment_method" value="paypal" onclick="toggleSet(this)" id="input_payment_method_paypal">PayPal</div>?>
<?						if (FALSE !== strpos($_SERVER['SERVER_NAME'], 'beta.polardesign.com')) { ?>
<input type="radio" name="payment_method" value="testpayment" onclick="toggleSet(document.getElementById('input_payment_method_paypal'))">Test Payment
<?						} ?>


					<label for="card_fields">Credit Card Information</label><br/>
							<fieldset name="card_fields">
								
							
              
					
								<label for="cname">Name on Card:</label>
								<input type="text" name="cname" placeholder=" Card Name" id="cname" value="" required/>
						

							
								<label for="ctype">Card Type:</label>
								<select name="ctype" id="ctype" required>
									<option name="cardType" value="000">Select Card Type</option>
									<option name="visa" value="visa">Visa</option>
									<option name="mastercard" value="mastercard">Mastercard</option>
									<option name="amex" value="amex">American Express</option>
								</select><br>
						

					
								<label for="cnumber">Card Number:</label>
								<input type="text" name="cnumber" placeholder=" Card Number" id="cnumber" value="" required/>
					

							
								<label for="expiration">Expiration Date (MM/YY):</label>
								<input type="text" name="expiration" placeholder=" Expiration Date" id="expiration" value="" required/>
							

							
								<label for="verification">Card Verification Number:</label><br>
								<input type="text" name="verification" placeholder=" xxx" id="verification" value="" size="10" required/>
								<div class="clr grey" onclick="javasctipt:showhideBox('whatsThis'); return false;">?</div>
							
							

							<input type="hidden" name="place_order" value="1">
							<div id="whatsThis" class="grey-border left" style="width:250px;height:75px;overflow:hidden;display:none;float:left;position:absolute;left:350px;top:380px;background-color:#EEEEEE;padding:10px;"><p>The CVV is the 3 or 4 digit code located, usually, on the back of your credit card in a small box.</p></div>
					

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

									<span class="check-subtotal">Subtotal: <span class="price">US $<?=money_format('%.2n', $order->subtotal)?></span></span><br>
									<span class="check-shipping">Shipping Cost: <span class="price">US $<?=money_format('%.2n', $order->shipping_total)?></span></span><br>
									<span class="check-total">Order Total: <span class="price ">US $<?=money_format('%.2n', $order->order_total)?></span></span><br>
						<a href="/shopping_cart/" id="btn-back-cart">Back to Cart</a>
								<h4>Shipping Address</h4><br/>
									<b><?=$user->user_shipping_info->firstname.' '.$user->user_shipping_info->lastname; ?></b>
									<ul>
										<li><?=$user->user_shipping_info->address1.' , '.$user->user_shipping_info->address2; ?></li>
										<li><?=$user->user_shipping_info->city; ?></li>
										<li><?= $user->user_shipping_info->zip.' , '.$user->user_shipping_info->state; ?></li>
									</ul>
									<h4>Billing Address</h4><br/>
									<b><?=$user->user_billing_info->firstname.' '.$user->user_billing_info->lastname?></b>
									<ul>
										<li><?= $user->user_billing_info->address1.' , '.$user->user_billing_info->address2; ?></li>
										<li><?=$user->user_billing_info->city; ?></li>
										<li><?=$user->user_billing_info->zip.' , '.$user->user_billing_info->state; ?></li>
									</ul>
									<a href="/shopping_cart/checkout/" alt="prev page">Back to Edit Addresses</a>
						</div>

				</div>
			<!-- End Right Col -->
		</div>
		<!-- End 2 Col Layout -->
		<div class="divider medium-space row col-md-12"></div>
	<div class="col-md-12 checkout-payment-submit-btn">
			<button type="submit" name="Submit" class="btn btn-thin orange">Place Order</button>
		</div>
</form>
		<div class="clear large-space"></div>
	</div>
	<!-- End Content -->
<script language="JavaScript" type="text/javascript"
    xml:space="preserve">//<![CDATA[
//You should create the validator only after the definition of the HTML form
var frmvalidator  = new Validator("checkoutform");
frmvalidator.EnableOnPageErrorDisplaySingleBox();
frmvalidator.EnableMsgsTogether();

frmvalidator.addValidation("cname","req","Please enter the name that is on the Credit Card",
        "VWZ_IsChecked(document.forms['checkoutform'].elements['payment_method'],'credit_card')");
frmvalidator.addValidation("cname","maxlen=100",	"Max length for name is 100",
        "VWZ_IsChecked(document.forms['checkoutform'].elements['payment_method'],'credit_card')");
frmvalidator.addValidation("cname","alpha_s","Name can contain alphabetic chars only",
        "VWZ_IsChecked(document.forms['checkoutform'].elements['payment_method'],'credit_card')");

frmvalidator.addValidation("ctype","dontselect=000", "Please select a card type",
        "VWZ_IsChecked(document.forms['checkoutform'].elements['payment_method'],'credit_card')");

frmvalidator.addValidation("cnumber","numeric", "The card number must be only numbers - no spaces other characters",
        "VWZ_IsChecked(document.forms['checkoutform'].elements['payment_method'],'credit_card')");
frmvalidator.addValidation("cnumber","req", "Please enter card number",
        "VWZ_IsChecked(document.forms['checkoutform'].elements['payment_method'],'credit_card')");

frmvalidator.addValidation("expiration","maxlen=5", "Expiration date is too long",
        "VWZ_IsChecked(document.forms['checkoutform'].elements['payment_method'],'credit_card')");
frmvalidator.addValidation("expiration","req", "Please Enter an expiration date",
        "VWZ_IsChecked(document.forms['checkoutform'].elements['payment_method'],'credit_card')");

frmvalidator.addValidation("verification","maxlen=4", "CVV number is too long",
        "VWZ_IsChecked(document.forms['checkoutform'].elements['payment_method'],'credit_card')");
frmvalidator.addValidation("verification","req", "Please Enter a CVV number",
        "VWZ_IsChecked(document.forms['checkoutform'].elements['payment_method'],'credit_card')");


//]]></script>


<script type="text/javascript">
function toggleSet(rad) {
	var type = rad.value;
	if(type == 'paypal') {

		document.getElementById("cname").readOnly = true;
		document.getElementById("ctype").readOnly = true;
		document.getElementById("cnumber").readOnly = true;
		document.getElementById("expiration").readOnly = true;
		document.getElementById("verification").readOnly = true;

		document.getElementById("cname").disabled = true;
		document.getElementById("ctype").disabled = true;
		document.getElementById("cnumber").disabled = true;
		document.getElementById("expiration").disabled = true;
		document.getElementById("verification").disabled = true;

	} else {

		document.getElementById("cname").readOnly = false;
		document.getElementById("ctype").readOnly = false;
		document.getElementById("cnumber").readOnly = false;
		document.getElementById("expiration").readOnly = false;
		document.getElementById("verification").readOnly = false;

		document.getElementById("cname").disabled = false;
		document.getElementById("ctype").disabled = false;
		document.getElementById("cnumber").disabled = false;
		document.getElementById("expiration").disabled = false;
		document.getElementById("verification").disabled = false;


	}


}
</script>