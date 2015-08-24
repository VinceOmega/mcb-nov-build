<script type="text/javascript" src="https://www.marble-cleaning-products.com/env/js/country_state.js"></script>
<?php 
	defined('SYSPATH') OR die('No direct access allowed.'); 

	$db = new Database();
	
	$users = ORM::factory('user')->orderby('lastname')->find_all();
	//$orderUsers	 = $db->query("SELECT DISTINCT CONCAT( last_name, ' ', first_name ) AS name FROM orders ORDER BY name");

	//$db->select("DISTINCT CONCAT( last_name, ' ', first_name ) AS name")->from('orders')->orderby('name')->get();
	
	$shippingMethods = array(
		'ups_03_ground'                => 'UPS Ground',
		'ups_12_three_day_select'      => '3 Day Select',
		'ups_02_second_day_air'        => '2nd Day Air',
		'ups_01_next_day_air'          => 'Next Day Air',
		'ups_13_next_day_air_saver'    => 'Next Day Air Saver',
		'ups_14_next_day_air_early_am' => 'Next Day Air Early AM'
	);
	$paymentMethods = array(
		'card'   => 'Credir Card',
		'paypal' => 'PayPal'
	);
	
	$cardTypes = array(
		'visa' => 'Visa',
		'mastercard' => 'Mastercard',
		'american express' => 'American Express',
		'discover' => 'Discover'
	);
	
	//for some reason ORM doesn't work
	$orderStatuses = $db->select('order_status_id as id, status_name')->from('orders_status_names')->orderby('id')->get();
	$products = $db->select('id, name')->from('products')->orderby('id')->get();	
	
	function val($group, $index){
		if (isset($_POST[$group]) && isset($_POST[$group][$index])) 
			return $_POST[$group][$index];
		else
			return '';
	}
?>
<script>
var products = new Array();
// old browsers don't have the "toFixed" JS function
if (!Number.toFixed) {
  Number.prototype.toFixed=function(n){
    return Math.round(this*Math.pow(10, n)) / Math.pow(10, n);
  }
}

function getUserDetails(id, type){
	var url = (type=='order_user') ? "/admin-console/users/getDetails?name="+id : "/admin-console/users/getDetails?id="+id;
	
	$.get(url, function(data) {
		$('#first_name').val( data.firstname );
		$('#last_name').val( data.lastname );
		$('#email').val( data.email );
		$('#telephone').val( data.telephone );

		$('#shipping_first_name').val(data.shipping_first_name);
		$('#shipping_last_name').val(data.shipping_last_name);
		$('#shipping_address1').val(data.shipping_address1);
		$('#shipping_address2').val(data.shipping_address2);
		$('#shipping_city').val(data.shipping_city);
		$('#stateSelect').val(data.shipping_state);
		$('#shipping_zip').val(data.shipping_zip);
		$('#shipping_phone').val(data.shipping_telephone);
		$('#shipping_email').val(data.shipping_email);
		$('#countrySelect').val(data.shipping_country);

		$('#billing_first_name').val(data.billing_first_name);
		$('#billing_last_name').val(data.billing_last_name);
		$('#billing_address1').val(data.billing_address1);
		$('#billing_address2').val(data.billing_address2);		
		$('#billing_city').val(data.billing_city);
		$('#stateSelect1').val(data.billing_state);
		$('#billing_zip').val(data.billing_zip);
		$('#billing_phone').val(data.billing_telephone);
		$('#billing_email').val(data.billing_email);
		$('#countrySelect1').val(data.billing_country);
		
	});	
}

function selectProduct(id, onReady){
	alert('@todo: fix this because there\'s no more single price per product.');
	$.get("/admin-console/products/getProductPrice/?id="+id, function(data) {
		$('#price').val(data);
		if (onReady) onReady();
	});		
}

function calcCart(){
	var subtotal = parseFloat($('#priceTotal').html());
	var shipping = parseFloat($('#shipping').html());	
	var discount = ($('#order_discount').val()=='') ? 0 : ( subtotal * 0.01 * parseFloat($('#order_discount').val())).toFixed(2);
	
	$('#subtotal').html( subtotal );	
	$('#discount').html(discount);
	$('#payment_total').html((subtotal + shipping - discount).toFixed(2));
}

function addProduct(){
	var error = false;

	if ($('#quantity').val()=='') error = 'Select product quantity';	
	if ($('#product').val()=='0') error = 'Select product';

	if (!error){
		var qnt = parseFloat($('#quantity').val());
		var price = parseFloat($('#price').val());
		var total = parseFloat($('#priceTotal').html());
		
		var sum = parseFloat(total + (qnt * price)).toFixed(2);
		
		var productId = $('#product').val();
		
		var id = products.length + 1;
		$('#productsTable tr:last').after('<tr id="product-'+id+'"><td>'+$('#product option:selected').text()+'</td><td id="qnt'+id+'">'+qnt+'</td><td id="price'+id+'">'+price+'</td><td><a href="javascript:void(0);" onClick="deleteProduct('+id+')">-</a></td></tr>');		
		$('#cart tr:last').after('<tr id="cart-'+id+'"><td>'+$('#product option:selected').text()+' ('+qnt+' x $'+price+')</td></tr>');		
		$('#priceTotal').html( sum );

		calcCart();
		products.push({'productId':productId, 'qnt':qnt});
		

	}else{
		alert(error);
		return false;
	}
}

function deleteProduct(id){
	var qnt = parseFloat($('#qnt'+id).html());
	var price = parseFloat($('#price'+id).html());
	var total = parseFloat($('#priceTotal').html());
	$('#product-'+id).remove();
	$('#cart-'+id).remove();	
	var sum = parseFloat(total - (qnt * price)).toFixed(2);
	$('#priceTotal').html( sum );	
	products[id-1] = null;
	calcCart();
	return false;
}


function getProducts(){
	var val = '';
	if (products.length=='') return '';
	for(key in products){
		if (products[key]!=null){
			val += '<-|->' + products[key]['productId'] + '||' + products[key]['qnt'];
		}
	}
	return val;
}

function submitForm(){
	var error = new Array();
	if ((val = getProducts())=='') error.push('Add products to the order\'s basket');

	if ($('#order_user').val() == '0') error.push('Choose an existent customer');
	
	if ($('#cc').attr('checked')){
		if ($('#card_name').val() == '') error.push('Enter card holder\'s name');
		if ($('#card_number').val() == '') error.push('Enter card number');	
		if ($('#expdate_month').val() == '0') error.push('Choose card expiration month');
		if ($('#expdate_year').val() == '0') error.push('Choose card expiration year');	
		if ($('#card_verification').val() == '0') error.push('Choose card verification number');
	}
	
	if ($('#total').val() == '') error.push('Order\'s total can\'t be empty');	
		
	if ($('#shipping_first_name').val() == '') error.push('Enter shipping first name');
	if ($('#shipping_last_name').val() == '') error.push('Enter shipping last name');
	if ($('#shipping_address1').val() == '') error.push('Enter shipping address 1');
	if ($('#shipping_city').val() == '') error.push('Enter shipping city');
	if ($('#countrySelect').val()=='US' && $('#stateSelect').val() == '') error.push('Select shipping state');
	if ($('#shipping_zip').val() == '') error.push('Enter shipping zip');
	if ($('#shipping_phone').val() == '') error.push('Enter shipping phone');	
	if ($('#shipping_email').val() == '') error.push('Enter shipping email');		
	if ($('#countrySelect').val() == '') error.push('Select shipping country');
	
	if ($('#billing_first_name').val() == '') error.push('Enter billing first name');
	if ($('#billing_last_name').val() == '') error.push('Enter billing last name');
	if ($('#billing_address1').val() == '') error.push('Enter billing address 1');
	if ($('#billing_city').val() == '') error.push('Enter billing city');
	if ($('#countrySelect1').val()=='US' && $('#stateSelect1').val() == '') error.push('Select billing state');
	if ($('#billing_zip').val() == '') error.push('Enter billing zip');
	if ($('#billing_phone').val() == '') error.push('Enter billing phone');
	if ($('#billing_email').val() == '') error.push('Enter billing email');
	if ($('#countrySelect1').val() == '') error.push('Select billing country');

	if (error.length==0){
		$('#products').val(val);
		$('form#form').submit();
	}else{
		alert(error.join("\n"));
	}
	return false;
}

function getShippingRate(){
	var error = new Array();
	if ((destZip = $('#shipping_zip').val())=='') error.push('Set the destination ZIP code');
	if ((destCountry = $('#countrySelect').val())=='') error.push('Select the destination country');	
	var cart = getProducts();
	if (cart == '') error.push('Add products to the order\'s basket');	
	var method = $('#shipping_method').val();
	
	if (error.length==0){
		$.post("/admin-console/orders/getShippingRate", 'products='+cart+'&destZip='+destZip+'&destCountry='+destCountry+'&method='+method, function(data) {
			$('#shipping').html(data);
			calcCart();
		});
	}else{
		alert(error.join("\n"));
	}		
}
</script>
<?php
	if (isset($this->error)){
		echo '<p style="color:red;">'.$this->error.'</p>';
	}
?>
<form action="/admin-console/orders/add" method="POST" id="form" >
<input type="hidden" name="products" id="products">
<div id="mainContent" style="width:100%">
	<div class="box">
		  <div class="left"></div>
		  <div class="right"></div>
		  <div class="heading">
		    <h2 id="heading">Add Order</h2>
		    <span id="buttons">
				<input type="button" onclick="submitForm();" value='Save' class="css-button"  />
				<input type="button" onclick="location = '/admin-console/orders'" value='Cancel' class="css-button"  />
			</span>
		</div>
	</div>
	<div style="width:1500px;">
	
	<div id="contentLeft">
		<div id="tabs" class="htabs" >
			<a tab="#tab_order_details">Order Details</a>
			<a tab="#tab_products">Products</a>
			<a tab="#tab_billing_address">Billing Address</a>			
			<a tab="#tab_shipping_address">Shipping Address</a>
		</div>
 	</div>
		
	<div id="contentRight" style="width:82%">
	
		<div id="tab_order_details">
			<table>
			<tr valign="top">
			<td>
			<table class="form">
				<tr>
					<th> </th>
					<th> </th>
				</tr>
				<tr>
					<td>Existent customer:</td>
					<td>
						<select name="order[user]" onChange="getUserDetails(this.value);" id="order_user">
							<option value="0">Select</option>
					<?php
						foreach ($users as $user){
							$selected = (val('order', 'user') == $user->id) ? ' SELECTED' : '';
							echo '<option value="'.$user->id.'"'.$selected.'>'.$user->lastname.' '.$user->firstname.'</option>';
						}
					?>
						</select><br/><a href="/admin-console/users/edit">Add customer</a>
					</td>
				</tr>
<!--				
				<tr>
					<td>Ungeristered customers who made order:</td>
					<td>
						<select name="order[order_user]" onChange="getUserDetails(this.value, 'order_user');" id="order_user">
							<option value="0">Select</option>
					<?php
					/*
						foreach ($orderUsers as $user){
							$selected = (val('order', 'order_user') == $user->name) ? ' SELECTED' : '';
							echo '<option value="'.$user->name.'"'.$selected.'>'.$user->name.'</option>';
						}
					*/
					?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Order ID:</td>
					<td><input type="text" name="order[trans_id]" value="<?php //echo val('order', 'trans_id');?>"></td>
				</tr>
-->				
				<tr>
					<td>Customer Name:</td>
					<td><input type="text" name="order[first_name]" value="<?php echo val('order', 'first_name');?>" id="first_name" readonly>  <input type="text" name="order[last_name]" value="<?php echo val('order', 'last_name');?>" id="last_name" readonly></td>
				</tr>
				<tr>
					<td>Email:</td>
					<td><input type="text" name="order[email]" value="<?php echo val('order', 'email');?>" id="email"></td>
				</tr>
				<tr>
					<td>Phone:</td>
					<td><input type="text" name="order[telephone]" value="<?php echo val('order', 'telephone');?>" id="telephone"></td>
				</tr>
				<tr>
					<td>Date Added:</td>
					<td><input type="text" name="order[date_created]" value="<?php echo (val('order', 'date_created')=='') ? date('Y-m-d h:i:s') : val('order', 'date_created');?>"></td>
				</tr>
				<tr>
					<td>Shipping method:</td>
					<td>
						<select name="shipping[method]" id="shipping_method">
					<?php
						foreach ($shippingMethods as $index=>$value){
							$selected = (val('shipping', 'method') == $index) ? ' SELECTED' : '';
							echo '<option value="'.$index.'"'.$selected.'>'.$value.'</option>';
						}
					?>
						</select>	
					</td>
				</tr>
				<tr>
					<td>Comment:</td>
					<td><textarea name="order[comment]" id="comment"><?php echo htmlspecialchars(val('order', 'comment'));?></textarea></td>
				</tr>				
				<tr>
					<td>Discount(%):</td>
					<td><input type="text" name="order[discount]" value="<?php echo val('order', 'discount');?>" id="order_discount" onChange="calcCart();"></td>
				</tr>				
				<tr>
					<td>Credit Card Payment Method:</td>
					<td>
						<input type="checkbox" id="cc" name="order[cc]" onClick="$('#ccData').toggle();">
					</td>
				</tr>
				<tr id="ccData" style="display:none;">
					<td colspan="2">
						<table style="border:1px dashed black;">
							<tr><td>Name on card:</td><td><input type="text" name="card[name]" id="card_name" value="<?php echo val('card', 'name');?>" ></td></tr>
							<tr><td>Card type:</td><td>
								<select name="card[type]">
							<?php
								foreach ($cardTypes as $index=>$value){
									$selected = (val('card', 'type') == $index) ? ' SELECTED' : '';
									echo '<option value="'.$index.'"'.$selected.'>'.$value.'</option>';
								}
							?>
								</select>				
							</td></tr>
							<tr><td>Card number:</td><td><input type="text" name="card[number]" id="card_number" value="<?php echo val('card', 'number');?>" ></td></tr>				
							<tr><td>Expiration Date: (mm/yy)</td><td>
								<select name="card[expdate_month]" id="expdate_month">	
									<option value="0">Month</option>
									<?php for ($i=1; $i<13; $i++){
											$selected = (val('card', 'expdate_month') == $i) ? ' SELECTED' : '';
											echo '<option  value="'.sprintf('%02d', $i).'"'. $selected .'>'.sprintf('%02d', $i).'</option>';
										}
									?>
								</select> 
								/ 
								<select name="card[expdate_year]" id="expdate_year">	
									<option  value="0">Year</option>
									<?php for ($i = date("y"); $i < date("y")+8; $i++){
											$selected = (val('card', 'expdate_year') == $i) ? ' SELECTED' : '';						
											echo '<option  value="'.$i.'" '. $selected .'>'.$i.'</option>';
										}
									?>
								</select>
							</td></tr>
							<tr><td>Verification Number:</td><td><input type="text" name="card[verification]" id="card_verification" value="<?php echo val('card', 'verification');?>" ></td></tr>					
						</table>
					</td>
				</tr>
			</table>
			</td>
			<td>
			<table id="cart" border="0">
			<tr><td>Products in the cart</td></tr>
			</table>
			<table>
				<tr><td>Subtotal</td><td colspan="2">$<span id="subtotal">0</span></td></tr>
				<tr><td>Shipping</td><td colspan="2">$<span id="shipping">0</span></td><td><a href="javascript:void(0);" onClick="getShippingRate();">Update</a></td></tr>				
				<tr><td>Discount</td><td colspan="2">$<span id="discount">0</span></td></tr>
				<tr><td>Total</td><td colspan="2">$<span id="payment_total">0</span></td></tr>
			</table>
			</td>
			</tr>
			</table>
		 </div>
			  
			 
		<div id="tab_products">
			<table class="list" id="productsTable">
				<tr>
					<th>Product</th>
					<!--<th>Product Type</th>-->
					<th>Q-ty</th>
					<th>Unit Price</th>
					<th></th>
				</tr>
				<tr>
					<td>
						<select name="product" id="product" onChange="selectProduct(this.value)">
						<option value="0">Select</option>
					<?php
						foreach ($products as $product){
							echo '<option value="'.$product->id.'">'.$product->name.'</option>';
						}
					?>							
						</select>
					</td>
					<!--
					<td>
						<select name="productType" id="productType">
						<option value="0">Select</option>
					<?php
						/*
						foreach ($productTypes as $type){
							echo '<option value="'.$type->id.'">'.$type->name.'</option>';
						}*/
					?>	
						</select>					
					</td>
					-->
					<td align="right"><input type="text" name="quantity" id="quantity" style="width:45px;" value="1"></td>
					<td align="right">$<input type="text" name="price" id="price" style="width:45px;" readonly></td>
					<td><a href="javascript:void(0);" onClick="addProduct();">+</a></td>
				</tr>	
				<tr>
					<td colspan="5">Total: $<span id="priceTotal">0</span></td>
				</tr>
			</table>
		 </div>
		 <?php
			if (isset($_POST['products'])){
				echo "<script>\n";
				$products = explode('<-|->', $_POST['products']);
				unset($products[0]);
				foreach ($products as $product){
					$arr = explode('||', $product);
					echo "$('#product').val(".$arr[0].");\n";
					echo "$('#quantity').val(".$arr[1].");\n";
					echo "selectProduct(".$arr[0].", function (){ addProduct(); });\n";
				}
				echo "</script>\n";
			}
		 ?>
			 
		 <div id="tab_shipping_address">
			<table class="form">
				<tr>
					<th> </th>
					<th> </th>
				</tr>
				<tr>
					<td>First Name*:</td>
					<td><input type="text" name="shipping[first_name]" value="<?php echo val('shipping', 'first_name');?>" id="shipping_first_name"></td>
				</tr>
				<tr>
					<td>Last Name*:</td>
					<td><input type="text" name="shipping[last_name]" value="<?php echo val('shipping', 'last_name');?>" id="shipping_last_name"></td>
				</tr>		
				<tr>
					<td>Company:</td>
					<td><input type="text" name="shipping[company]" value="<?php echo val('shipping', 'company');?>" id="shipping_company"></td>
				</tr>
				<tr>
					<td>Address 1*:</td>
					<td><input type="text" name="shipping[address1]" value="<?php echo val('shipping', 'address1');?>" id="shipping_address1"></td>
				</tr>
				<tr>
					<td>Address 2:</td>
					<td><input type="text" name="shipping[address2]" value="<?php echo val('shipping', 'address2');?>" id="shipping_address2"></td>
				</tr>
				<tr>
					<td>City*:</td>
					<td><input type="text" name="shipping[city]" value="<?php echo val('shipping', 'city');?>" id="shipping_city"></td>
				</tr>
				<tr>
					<td>State*:</td>
					<td><select id='stateSelect' name="shipping[state]"> </select></td>
				</tr>
				<tr>
					<td>Postal Code*:</td>
					<td><input type="text" name="shipping[zip]" value="<?php echo val('shipping', 'zip');?>" id="shipping_zip"></td>
				</tr>
				<tr>
					<td>Phone*:</td>
					<td><input type="text" name="shipping[phone]" value="<?php echo val('shipping', 'phone');?>" id="shipping_phone"></td>
				</tr>
				<tr>
					<td>Email*:</td>
					<td><input type="text" name="shipping[email]" value="<?php echo val('shipping', 'email');?>" id="shipping_email"></td>
				</tr>
				
				<tr>
					<td>Country*:</td>
					<td><select id='countrySelect' name='shipping[country]' onchange='populateState()'></select>
						<script type="text/javascript">
							var postState = "<?php echo val('shipping', 'state');?>";
							var postCountry = "<?php echo (val('shipping', 'county')=='') ? 'US' : val('shipping', 'county');?>";
							initCountry(postCountry); 
						</script>
					</td>
				</tr>
			</table>
		 </div>
		 
		 
		<div id="tab_billing_address" >
			<table class="form">
				<tr>
					<th> </th>
					<th> </th>
				</tr>
				<tr>
					<td>First Name*:</td>
					<td><input type="text" name="billing[first_name]" value="<?php echo val('billing', 'first_name');?>" id="billing_first_name"></td>
				</tr>
				<tr>
					<td>Last Name*:</td>
					<td><input type="text" name="billing[last_name]" value="<?php echo val('billing', 'last_name');?>" id="billing_last_name"></td>
				</tr>		
				<tr>
					<td>Company:</td>
					<td><input type="text" name="billing[company]" value="<?php echo val('billing', 'company');?>" id="billing_company"></td>
				</tr>
				<tr>
					<td>Address 1*:</td>
					<td><input type="text" name="billing[address1]" value="<?php echo val('billing', 'address1');?>" id="billing_address1"></td>
				</tr>
				<tr>
					<td>Address 2:</td>
					<td><input type="text" name="billing[address2]" value="<?php echo val('billing', 'address2');?>" id="billing_address2"></td>
				</tr>
				<tr>
					<td>City*:</td>
					<td><input type="text" name="billing[city]" value="<?php echo val('billing', 'city');?>" id="billing_city"></td>
				</tr>
				<tr>
					<td>State*:</td>
					<td><select id='stateSelect1' name="billing[state]"> </select></td>
				</tr>
				<tr>
					<td>Postal Code*:</td>
					<td><input type="text" name="billing[zip]" value="<?php echo val('billing', 'zip');?>" id="billing_zip"></td>
				</tr>
				<tr>
					<td>Phone*:</td>
					<td><input type="text" name="billing[phone]" value="<?php echo val('billing', 'phone');?>" id="billing_phone"></td>
				</tr>
				<tr>
					<td>Email*:</td>
					<td><input type="text" name="billing[email]" value="<?php echo val('billing', 'email');?>" id="billing_email"></td>
				</tr>
				
				<tr>
					<td>Country*:</td>
					<td><select id='countrySelect1' name='billing[country]' onchange='populateState1()'></select>
						<script type="text/javascript">
							var postState1 = "<?php echo val('billing', 'state');?>";
							var postCountry1 = "<?php echo (val('billing', 'county')=='') ? 'US' : val('shipping', 'county');?>";
							initCountry1(postCountry1); 
						</script>
					</td>
				</tr>
			</table>
		</div>	 

	</div>
	
	</div> 
	
	</div>
</form>

<script type="text/javascript"><!--
$.tabs('#tabs a', '<?php echo isset($_POST['selected_tab']) ? $_POST['selected_tab'] : ''?>'); 
// prepare the form when the DOM is ready
$(document).ready(function() {

  // Setup the ajax indicator
  $('body').append('<div id="ajaxBusy"><p><img src="/env/images/ajax-loader.gif"></p></div>');

  $('#ajaxBusy').css({
    display:"none",
    margin:"0px",
    paddingLeft:"0px",
    paddingRight:"0px",
    paddingTop:"0px",
    paddingBottom:"0px",
    position:"absolute",
    right:"3px",
    top:"3px",
     width:"auto"
  });
});

// Ajax activity indicator bound to ajax start/stop document events
$(document).ajaxStart(function(){
  $('#ajaxBusy').show();
}).ajaxStop(function(){
  $('#ajaxBusy').hide();
});
//--></script>