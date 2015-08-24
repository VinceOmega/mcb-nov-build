<?php

$upsOptions = array(
	'US' => array(
		"ups_03_ground" => 'UPS Ground',
		"ups_12_three_day_select" => '3 Day Select',
		"ups_02_second_day_air" => '2nd Day Air',
		"ups_01_next_day_air" => 'Next Day Air',
		"ups_13_next_day_air_saver" => 'Next Day Air Saver',
		"ups_14_next_day_air_early_am" => 'Next Day Air Early AM'
	),
	'CA' => array(
		"ups_11_standart" => 'UPS Standard',
		"ups_08_expedited" => "Worldwide Expedited",
		"ups_65_saver" => "Worldwide Saver",
		"ups_07_express" => "Worldwide Express"
	),
	'_default' => array(
		"ups_07_express" => "Worldwide Express",
		"ups_08_expedited" => "Worldwide Expedited",		
	)
);

// create JS associated array to change the select box dynamicly
echo "<script>\n";
echo "var upsOptions = {\n";
foreach($upsOptions as $country => $options){
	echo "'$country' : {\n";
	foreach ($options as $key=>$value){
		echo "'$key' : '$value',\n";
	}
	echo "},\n";
}
echo "}\n";
echo "</script>\n";
?>
<script>
function populateShippingOptions(){
	var country = ($('#different_shipping').attr('checked')) ? $('#countrySelect1').val() : $('#countrySelect').val();
	var options = (upsOptions[country]) ? upsOptions[country] : upsOptions['_default'];
	var select = $('#shipping_method');
	select.find('option').remove();
	for (key in options){
		select.append('<option value="'+key+'">'+options[key]+'</option>');
	}
}
</script>
<script type="text/javascript" src="/env/js/country_state.js"></script>

<div id="centercontainersub">
	<img src="/env/images/cutomeraddress.png" alt="" id="header" />
	<div id="productinfo">
		<img src="/env/images/order_steps2.jpg" alt="" />
		<div id="holder">

			<form action="" method="POST" id="address">
				<div id="billing_div">
					<div class="header">Billing Address</div>	<br/>
						<?php  
						if ($billing_errors)
							foreach ($billing_errors as $billing_error)
								echo '<p class="error">'.$billing_error .'</p>';
						?>
						<label for="billing_firstname">First Name: *</label><input name="billing_firstname" id="billing_firstname" type="text" value="<?php echo $form['billing_firstname']?>" /><br/>
						<label for="billing_mi">Middle Initial:</label><input name="billing_mi" id="billing_mi" type="text" value="<?php echo $form['billing_mi']?>" /><br/>
						<label for="billing_lastname">Last Name:*</label><input name="billing_lastname" id="billing_lastname" type="text" value="<?php echo $form['billing_lastname']?>" /><br/>
						<label for="billing_company">Company:</label><input name="billing_company" id="billing_company" type="text" value="<?php echo $form['billing_company']?>" /><br/><br/>

						<label for="billing_address1">Address Line1: *</label><input name="billing_address1" id="billing_address1" type="text" value="<?php echo $form['billing_address1']?>" /><br/>
						<label for="billing_address2">Address Line2:</label><input name="billing_address2" id="billing_address2" type="text" value="<?php echo $form['billing_address2']?>" /><br/>
						<label for="billing_city">City: *</label><input name="billing_city" id="billing_city" type="text" value="<?php echo $form['billing_city']?>" /><br/>
						<br/>
							
						<label for="billing_zip">Zip/Postal code: *</label><input name="billing_zip" id="billing_zip" type="text" value="<?php echo $form['billing_zip']?>"/><br/>
						<p><label for="countrySelect">Country: *</label>
							<select id='countrySelect' name='billing_country' onchange='populateState(); populateShippingOptions();'></select>
						</p>
						<p><label for="stateSelect">State/Province: *</label><select id='stateSelect' name="billing_state"> </select></p>
						<br/><br/>
						<script type="text/javascript">
							var postState = '<?php echo ($this->session->get('billing_state')) ? $this->session->get('billing_state') : '' // echo (empty($_POST['billing_state'])) ? '' : $_POST['billing_state']?>';
							var postCountry = '<?php echo (empty($_POST['billing_country'])) ? 'US' : $_POST['billing_country'] ?>';
							initCountry(postCountry); 
						</script>																	
						<label for="billing_telephone">Phone: *</label><input name="billing_telephone" id="billing_telephone" type="text" value="<?php echo $form['billing_telephone']?>" /><br/>
						<label for="billing_email">Email: *</label><input name="billing_email" id="billing_email" type="text" value="<?php echo $form['billing_email']?>" /><br/>
						<!--
						<label>&nbsp;</label><input type="checkbox" name="create_account" id="create_account" onclick="showPasswordDiv(this)" <?php if  (isset($form['create_account']) AND $form['create_account']== 'on') echo 'checked=checked' ?>>
										<label for="create_account" class="blue fullWidth"> Create an account with this email </label> <br/>
						-->			
						<label>&nbsp;</label><input type="checkbox" name="different_shipping" id="different_shipping" onclick="showShippingDiv(this)" <?php if (isset($form['different_shipping']) AND $form['different_shipping']== 'on') echo 'checked=checked' ?>>
										<label for="different_shipping" class="blue fullWidth"> Shipping address is different </label> <br/>
						<br/>
				</div>
				<!--
				<div id="password_div" <?php //if (isset($form['create_account']) AND $form['create_account']== 'on') echo 'style="display:block"' ?>>
					<div class="header">Create an account</div><br/>
						<?php  
						/*
							if ($password_error)
								foreach ($password_error as $pass_err)
									echo '<p class="error">'. $pass_err .'</p>';
							
							if ($account_errors)
								foreach ($account_errors as $account_error)
									echo '<p class="error">'. $account_error .'</p>';							
						*/										
							?>
						<label for="password">Password: *</label>
						<input type="password" name="password" id="password" value="<?php //echo $form['password'] ?>" />
						
						<label for="confirm_password">Confirm Password: *</label>
						<input type="password" name="confirm_password" id="confirm_password" value="<?php //echo $form['confirm_password'] ?>" />
						<br/><br/>			
				</div>
				-->
				<div id="shipping_div" <?php if (isset($form['different_shipping']) AND $form['different_shipping']== 'on') echo 'style="display:block"' ?>>
					<div class="header">Shipping Address</div>	<br/>
						<?php  
						if ($shipping_errors)
							foreach ($shipping_errors as $shipping_error)
								echo '<p class="error">'.$shipping_error .'</p>';
						?>
						<label for="shipping_firstname">First Name: *</label><input name="shipping_firstname" id="shipping_firstname" type="text" value="<?php echo $form['shipping_firstname']?>" /><br/>
						<label for="shipping_mi">Middle Initial:</label><input name="shipping_mi" id="shipping_mi" type="text" value="<?php echo $form['shipping_mi']?>" /><br/>
						<label for="shipping_lastname">Last Name:*</label><input name="shipping_lastname" id="shipping_lastname" type="text" value="<?php echo $form['shipping_lastname']?>" /><br/>
						<label for="shipping_company">Company:</label><input name="shipping_company" id="shipping_company" type="text" value="<?php echo isset($form['shipping_company']) ? $form['shipping_company'] : ''?>" /><br/><br/>

						<label for="shipping_address1">Address Line1: *</label><input name="shipping_address1" id="shipping_address1" type="text" value="<?php echo $form['shipping_address1']?>" /><br/>
						<label for="shipping_address2">Address Line2:</label><input name="shipping_address2" id="shipping_address2" type="text" value="<?php echo $form['shipping_address2']?>" /><br/>
						<label for="shipping_city">City: *</label><input name="shipping_city" id="shipping_city" type="text" value="<?php echo $form['shipping_city']?>" /><br/>
						<br/>
							
						<label for="shipping_zip">Zip/Postal code: *</label><input name="shipping_zip" id="shipping_zip" type="text" value="<?php echo $form['shipping_zip']?>"/><br/>
						<p><label for="countrySelect1">Country: *</label>
							<select id='countrySelect1' name='shipping_country' onchange='populateState1(); populateShippingOptions();'></select>
						</p>
						<p><label for="stateSelect1">State/Province: *</label><select id='stateSelect1' name="shipping_state"> </select></p>								  
						<br/><br/>
						<script type="text/javascript">
							var postState1 = '<?php echo ($form['shipping_state']) ? $form['shipping_state'] : '' ?>';
							var postCountry1 = '<?php echo (empty($_POST['shipping_country'])) ? 'US' : $_POST['shipping_country'] ?>';
							initCountry1(postCountry1); 
						</script>
					<!--	<label for="shipping[phone]">Phone: *</label><input name="shipping_telephone" id="shipping[phone]" type="text" value="<?php //echo $form['shipping_telephone']?>" /><br/>
						<label for="shipping[email]">Email: *</label><input name="shipping_email" id="shipping[email]" type="text" value="<?php //echo $form['shipping_email']?>" /><br/>
					-->
				</div>				
				
				<div class="header">Shipping Options</div><br/>
					<?php  
						if ($error)
							foreach ($error as $err)
								echo '<p class="error">'. $err .'</p>';
						?>
					<label for="shipping_method">Shipping Option: *</label>
					<select id="shipping_method" name="shipping_method">
<?php
	$shippingCountry = (isset($_SESSION['shipping_country'])) ? $_SESSION['shipping_country'] : 'US';
	$shippingOptions = (isset($upsOptions[$shippingCountry])) ? $upsOptions[$shippingCountry] : $upsOptions['_default'];
	foreach ($shippingOptions as $key => $value){
		$selected = (isset($_POST['shipping_method']) && $_POST['shipping_method']==$key) ? ' SELECTED' : '';
		echo "<option value=\"$key\"$selected>$value</option>\n";
	}
?>					
<!--
						<option value="ups_03_ground">UPS Ground</option>	
						<option value="ups_12_three_day_select">3 Day Select</option>
						<option value="ups_02_second_day_air">2nd Day Air</option>
						<option value="ups_01_next_day_air">Next Day Air</option>
						<option value="ups_13_next_day_air_saver">Next Day Air Saver</option>
						<option value="ups_14_next_day_air_early_am">Next Day Air Early AM </option>	
-->						
					</select><br/><br/>
					
				<label>&nbsp;</label><input type="checkbox" name="newsletter" id="newsletter" <?php if (isset($form['newsletter'])) echo 'checked=checked'; else echo ''; ?> />
						<label for="newsletter" class="blue fullWidth"> Subscribe to our Newsletter</label> <br/><br/>
						
				<label for="comment">Enter comment:</label><textarea name="comment" id="comment"><?php echo $form['comment']?></textarea> 
						<br/><br/>
					
				<div id="proceed">
					<table>
						<tr>
							<td>
								<input type="submit" name="submit" id="proceed-checkout" value="" />
							</td>
						</tr>
					</table>	
					<div class="clear"></div>							
				</div>
			</form>
					
		</div>
	</div>
</div>
<div id="rightcontainersub">
	<div id="title">Order Summary</div>
	<div id="ordersummary">
	
	<?php 
			if ($cart->isEmpty())
				echo '<h3>Shopping cart is empty</h3><br><br>';
			else {
		?>
		
				<table cellspacing="3" class="orders">
					<tr>
						<th>Product</th>
						<th>Qty</th>
						<th>Total</th>
						
					</tr>
					<?php foreach($cart->items() as $item){ ?>
							<tr>
								<td class="product"><strong><?php echo $item->name ?></strong></td>				
								<td><?php echo $item->qty ?></td>
								<td><?php echo format::dollar($item->total) ?></td>
							</tr>	
					<?php } ?>
					
				</table>
<?php
	$discount = new Discount(false, $cart);
	$amount = $discount->amount();
?>
		
			<table class="summary">
				<tr>
					<td colspan="2"><strong>Subtotal:</strong></td>
					<td align="right"><?php echo format::dollar($cart->subtotal()) ?></td>							
				</tr>
				
				<tr>
					<td colspan="2"><strong>Discount:</strong></td>
					<td align="right"><?php echo format::dollar($amount['total']);?></td>
				</tr>
				
				<tr>
					<td colspan="2"><strong>Taxes:</strong></td>
					<td align="right">TBD</td>
				</tr>

										
				<tr>
					<td colspan="2"><strong>Shipping Cost:</strong></td>
					<td align="right">TBD</td>
				</tr>
				
				<tr>
					<td colspan="2"><strong>Order Total:</strong></td>
					<td align="right"><?php echo format::dollar($cart->subtotal() - $amount['total']) ?> </td>
				</tr>
				
				
				<tr>
					<td colspan="3" class="button"><a href="/cart"><img src="/env/images/back_to_order.jpg" alt="" /></a></td>
				</tr>
			</table>

			<?php } ?>	
	</div>
</div>
<div id="bottombar">
	<a href="#"><img src="/env/images/more_marble_care.jpg" alt="" /></a><a href="/contact"><img src="/env/images/contact_us_bottom.jpg" /></a><a href="#"><img src="/env/images/browse_products_bottom.jpg" alt="" /></a><a href="#"><img src="/env/images/checkout_bottom.jpg" alt="" /></a>
</div>

<script type="text/javascript">
function showShippingDiv(value){
	if (value.checked) {
		document.getElementById("shipping_div").style.display = "block";
	
		document.getElementById("shipping_firstname").value =document.getElementById("billing_firstname").value;
		document.getElementById("shipping_lastname").value =document.getElementById("billing_lastname").value;
		document.getElementById("shipping_mi").value =document.getElementById("billing_mi").value;
		
	}
	else
		document.getElementById("shipping_div").style.display = "none";
}

function showPasswordDiv(value){
	if (value.checked)
		document.getElementById("password_div").style.display = "block";
	else
		document.getElementById("password_div").style.display = "none";
}
<?php
	if (isset($_GET['msg']) && $_GET['msg']!=''){
		echo 'alert("'.urldecode($_GET['msg']).'");';
	}
?>
</script>