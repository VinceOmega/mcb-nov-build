<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<?php echo html::script(array (url::base().'media/js/fckeditor/fckeditor.js'), FALSE); ?>
<script type="text/javascript">
window.onload = function()
{
	// Automatically calculates the editor base path based on the _samples directory.
	// This is usefull only for these samples. A real application should use something like this:
	// oFCKeditor.BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.
	var sBasePath = '<?php echo url::base() ?>/media/js/fckeditor/';

	
}
</script>

<?php 
//$id = $this->uri->segment(3);
$argumentarray = Router::$arguments;
$users = new User_Model;

$user_shipping = new User_shipping_info_Model;
$user_billing = new User_billing_info_Model;
$orderdb = new Order_Model;
	  


if (isset($argumentarray[0])) {
$id = $argumentarray[0];
$user = $users->getUserByID($id);
$site = ORM::factory('site',$user->site_id);
} else {
$id = $users->getNextID();
$user = ORM::factory('user');
}
$orders = Order::getOrdersByUser($id);		
$i=0;
$j=0;

$shipping_infos = $user_shipping->getShippingInfoByUser($id);
$billing_infos = $user_billing->getBillingInfoByUser($id);
//$orders = $orderdb->getOrdersFromUser($id);



//$db = new Database();
//$orders = $db->select('orders.id as order_id, orders.order_qty as order_qty, orders.order_total as order_total, orders.order_date as order_date, payment_status.name as status_name ')->from('orders')
//		->join('payments', 'orders.paymentID', 'payments.id', 'left')
//		->join('payment_status', 'payments.statusID', 'payment_status.id', 'left')
//		->where('orders.id',$id)
//		->get()
//	;



?>		


<form action="<?php echo url::base() . $this->uri->segment(1). '/' . $this->uri->segment(2) . '/' .$id; ?>" method="POST" enctype="multipart/form-data" id="form" >
<div id="mainContent" >




	<div class="box">
		  <div class="left"></div>
		  <div class="right"></div>
		  <div class="heading">
		    <h2 id="heading">Users</h2>
		    <span id="buttons">
				<input type="submit" value="Save" name="save" class="css-button" />
				<!--<a onclick="location = '<?php  echo url::base() . $this->uri->segment(1); ?>'" class="button"><span>Cancel</span></a>-->
				<input type="button" onclick="location = '<?php  echo url::base() . $this->uri->segment(1); ?>'" value='Cancel' class="css-button"  />
			</span>
		  </div>
	</div>
	
	
	
	<div id="contentLeft">
		<div id="tabs" class="htabs" >
			<a tab="#tab_general"><input type="hidden" name="tab_general" >General</a>
			<a tab="#tab_shipping">Shipping Info</a>
			<a tab="#tab_billing">Billing Info</a>
			<a tab="#tab_orders">Orders</a>
		</div> 
 	</div>

	
	<div id="contentRight">
		<div id="tab_general" >
			<div class="headline">General Information</div>
			<table>
			<colgroup>
				<col width="150" />
				<col width="550"/>
			</colgroup>
		
			<tr>
				<td><label for="userFirstName"><strong>First Name</strong></label></td>
				<td><input type="text" name="userFirstName" id="userFirstName" class="name" maxlength="255" value="<?php echo $user->firstname; ?>" /></td>
			</tr>
			<tr>
				<td><label for="userLastName"><strong>Last Name</strong></label></td>
				<td><input type="text" name="userLastName" id="userLastName" class="name" maxlength="255" value="<?php echo $user->lastname; ?>" /></td>
			</tr>	
			<tr>
				<td><label for="userEmail"><strong>Email</strong></label></td>
				<td><input type="text" name="userEmail" id="userEmail" class="name" maxlength="255" value="<?php echo $user->email; ?>" /></td>		
			</tr>
			<tr>
				<td><label for="userPhone"><strong>Phone</strong></label></td>
				<td><input type="text" name="userPhone" id="userPhone" class="name" maxlength="255" value="<?php echo $user->phone1; ?>" /></td>		
			</tr>
			<tr>
				<td><label for="userPhone"><strong>Site</strong></label></td>
				<td><?=$site->name; ?></td>		
			</tr>
			</table>
		 </div>  <!-- div id="tab_general" -->
		 
		
		 <div id="tab_shipping" >
			  <div class="headline">Shipping Info</div>
			  <table>
			  <colgroup>
					<col />
					<col width="100" />
					<col width="100" />
					<col width="100" />
					<col width="75" />
					<col width="50" />
			  </colgroup>
			  <tr>
			  		<td><label for="metaTitle"><strong>Company</strong></label></td>
					<td><label for="metaTitle"><strong>Address 1</strong></label></td>
					<td><label for="metaTitle"><strong>Address 2</strong></label></td>
					<td><label for="metaTitle"><strong>City</strong></label></td>
					<td><label for="metaTitle"><strong>State</strong></label></td>
					<td><label for="metaTitle"><strong>Zip</strong></label></td>
			  </tr>
				<?php
				
			  	foreach($shipping_infos as $shipping_info){
				echo '<tr>';
					echo '<td><label for="shippingCompany">'.$shipping_info->company.'</label></td>';
					echo '<td><label for="shippingAddress1">'.$shipping_info->address1.'</label></td>';
					echo '<td><label for="shippingAddress2">'.$shipping_info->address2.'</label></td>';
					echo '<td><label for="shippingCity">'.$shipping_info->city.'</label></td>';
					echo '<td><label for="shippingState">'.$shipping_info->state.'</label></td>';
					echo '<td><label for="shippingZip">'.$shipping_info->zip.'</label></td>';
				echo '</tr>';
				}?>
			
			  
			  </table>
		 </div>   <!-- div id="tab_shipping" -->
		 
		  <div id="tab_billing" >
			  <div class="headline">Billing Info</div>
			  <table>
			  <colgroup>
					<col />
					<col width="100" />
					<col width="100" />
					<col width="100" />
					<col width="75" />
					<col width="50" />
			  </colgroup>
			  <tr>
			  		<td><label for="metaTitle"><strong>Company</strong></label></td>
					<td><label for="metaTitle"><strong>Address 1</strong></label></td>
					<td><label for="metaTitle"><strong>Address 2</strong></label></td>
					<td><label for="metaTitle"><strong>City</strong></label></td>
					<td><label for="metaTitle"><strong>State</strong></label></td>
					<td><label for="metaTitle"><strong>Zip</strong></label></td>
			  </tr>
				<?php
				
			  	foreach($billing_infos as $billing_info){
				echo '<tr>';
					echo '<td><label for="billingCompany">'.$billing_info->company.'</label></td>';
					echo '<td><label for="billingAddress1">'.$billing_info->address1.'</label></td>';
					echo '<td><label for="billingAddress2">'.$billing_info->address2.'</label></td>';
					echo '<td><label for="billingCity">'.$billing_info->city.'</label></td>';
					echo '<td><label for="billingState">'.$billing_info->state.'</label></td>';
					echo '<td><label for="billingZip">'.$billing_info->zip.'</label></td>';
				echo '</tr>';
				}?>
			
			  
			  </table>
		 </div>   <!-- div id="tab_billing" -->


		   <div id="tab_orders" >
			  <div class="headline">Orders</div>
			  <table>
			  <colgroup>
					<col width="100" />
					<col width="100" />
					<col width="100" />
					<col width="100" />
					<col width="100" />
			  </colgroup>
			  <tr>
			  		<td><label for="metaTitle"><strong>Order Number</strong></label></td>
					<td><label for="metaTitle"><strong>Total</strong></label></td>
					<td><label for="metaTitle"><strong>Order Date</strong></label></td>
					<td><label for="metaTitle"><strong>Payment Status</strong></label></td>
			  </tr>
				<?php
				
			  	foreach($orders as $order){
				echo '<tr>';
					echo '<td><label for="orderNumber"><a href="'.url::base().'admin-console/orders/edit/'.$order->id.'">'.$order->order_id.'<a/></label></td>';
					echo '<td><label for="orderTotal">'.$order->order_total.'</label></td>';
					echo '<td><label for="orderDate">'.$order->order_date.'</label></td>';

					echo '<td><label for="orderStatusName">'.$order->status_name.'</label></td>';
				echo '</tr>';
				}?>
			
			  
			  </table>
		 </div>   <!-- div id="tab_orders" -->


	</div>    	<!-- div id="contentRight" -->
</div>  <!-- div id='mainContent' -->
</form>
<script type="text/javascript"><!--
$.tabs('#tabs a', '<?php echo isset($_POST['selected_tab']) ? $_POST['selected_tab'] : '#tab_general'?>'); 
//--></script>

 
<script type="text/javascript"><!--							 
var option_row = <?php echo $i?>;

function addOption() {	
	html  = '<div id="option' + option_row + '" class="option">';
	html += '<table class="form">';
	html += '<tr>';
	html += '<td>Option:</td>';
	html += '<td>';
	html += '<input type="text" name="product_option[' + option_row + '][name]" value="Option ' + option_row + '" onkeyup="$(\'#option option[value=\\\'option' + option_row + '\\\']\').text(this.value);" />&nbsp;<br />';
	html += '</td>';
	html += '</tr>';
	html += '<tr>';
	html += '<td colspan="2"><a onclick="addOptionValue(\'' + option_row + '\');" class="button"><span>Add Option Value</span></a> <a onclick="removeOption(\'' + option_row + '\');" class="button"><span>Remove</span></a></td>';
	html += '</tr>';
	html += '</table>';
	html += '</div>';
		 
	$('#options').append(html);
	
	$('#option').append('<option value="option' + option_row + '">Option ' + option_row + '</option>');
	$('#option option[value=\'option' + option_row + '\']').attr('selected', 'selected');
	$('#option').trigger('change');

	option_row++;
}

function removeOption(option_row) {
	$('#option option[value=\'option' + option_row + '\']').remove();
	$('#option option[value^=\'option' + option_row + '_\']').remove();
	$('#options div[id=\'option' + option_row + '\']').remove();
	$('#options div[id^=\'option' + option_row + '_\']').remove();
}

var option_value_row = <?php echo $j?>;

function addOptionValue(option_id) {
	html  = '<div id="option' + option_id + '_' + option_value_row + '" class="option">';
	html += '<table class="form">';
	html += '<tr>';
	html += '<td>Option Value:</td>';
	html += '<td>';
	html += '<input type="text" name="product_option[' + option_id + '][options][' + option_value_row + '][name]" value="Option Value ' + option_value_row + '" onkeyup="$(\'#option option[value=\\\'option' + option_id + '_' + option_value_row + '\\\']\').text(\'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\' + this.value);" />&nbsp;<br />';
	html += '</td>';
	html += '</tr>';
	html += '<tr>';		
	html += '<td colspan="2"><a onclick="removeOptionValue(\'' + option_id + '_' + option_value_row + '\');" class="button"><span>Remove</span></a></td>';
	html += '</tr>';
	html += '</table>';
	html += '</div>';
	
	$('#options').append(html);
	
	option = $('#option option[value^=\'option' + option_id + '_\']:last');
	
	if (option.size()) {
		option.after('<option value="option' + option_id + '_' + option_value_row + '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Option Value ' + option_value_row + '</option>');
	} else {
		$('#option option[value=\'option' + option_id + '\']').after('<option value="option' + option_id + '_' + option_value_row + '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Option Value ' + option_value_row + '</option>');
	}
	
	$('#option option[value=\'option' + option_id + '_' + option_value_row + '\']').attr('selected', 'selected');
	
	$('#option').trigger('change');
	
	option_value_row++;
}

function removeOptionValue(option_value_row) {
	$('#option option[value=\'option' + option_value_row + '\']').remove();
	$('#option' + option_value_row).remove();
}
//--></script>

<script type="text/javascript"><!--							 
var attr_row = <?php echo $i?>;

function addAttribute() {	
	html  = '<div id="attr' + attr_row + '" class="option">';
	html += '<table class="form">';
	html += '<tr>';
	html += '<td>Attribute:</td>';
	html += '<td>';
	html += '<input type="text" name="product_attr[' + attr_row + '][name]" value="Attribute ' + attr_row + '" onkeyup="$(\'#attr option[value=\\\'attr' + attr_row + '\\\']\').text(this.value);" />&nbsp;<br />';
	html += '</td>';
	html += '</tr>';
	html += '<tr>';
	html += '<td colspan="2"><a onclick="addAttributeValue(\'' + attr_row + '\');" class="button"><span>Add Attribute Value</span></a> <a onclick="removeAttribut(\'' + attr_row + '\');" class="button"><span>Remove</span></a></td>';
	html += '</tr>';
	html += '</table>';
	html += '</div>';
		 
	$('#attributes').append(html);
	
	$('#attr').append('<option value="attr' + attr_row + '">Attribute ' + attr_row + '</option>');
	$('#attr option[value=\'attr' + attr_row + '\']').attr('selected', 'selected');
	$('#attr').trigger('change');

	attr_row++;
}

function removeAttribut(attr_row) {
	$('#attr option[value=\'attr' + attr_row + '\']').remove();
	$('#attr option[value^=\'attr' + attr_row + '_\']').remove();
	$('#attributes div[id=\'attr' + attr_row + '\']').remove();
	$('#attributes div[id^=\'attr' + attr_row + '_\']').remove();
}

var attr_value_row = <?php echo $j?>;

function addAttributeValue(attr_id) {
	html  = '<div id="attr' + attr_id + '_' + attr_value_row + '" class="option">';
	html += '<table class="form">';
	html += '<tr>';
	html += '<td>Attribute Value:</td>';
	html += '<td>';
	html += '<input type="text" name="product_attr[' + attr_id + '][attributes][' + attr_value_row + '][name]" value="Attribute Value ' + attr_value_row + '" onkeyup="$(\'#attr option[value=\\\'attr' + attr_id + '_' + attr_value_row + '\\\']\').text(\'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\' + this.value);" />&nbsp;<br />';
	html += '</td>';
	html += '</tr>';
	html += '<tr>';		
	html += '<td colspan="2"><a onclick="removeAttributeValue(\'' + attr_id + '_' + attr_value_row + '\');" class="button"><span>Remove</span></a></td>';
	html += '</tr>';
	html += '</table>';
	html += '</div>';
	
	$('#attributes').append(html);
	
	attr = $('#attr option[value^=\'attr' + attr_id + '_\']:last');
	
	if (attr.size()) {
		attr.after('<option value="attr' + attr_id + '_' + attr_value_row + '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Attribute Value ' + attr_value_row + '</option>');
	} else {
		$('#attr option[value=\'attr' + attr_id + '\']').after('<option value="attr' + attr_id + '_' + attr_value_row + '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Attribute Value ' + attr_value_row + '</option>');
	}
	
	$('#attr option[value=\'attr' + attr_id + '_' + attr_value_row + '\']').attr('selected', 'selected');
	
	$('#attr').trigger('change');
	
	attr_value_row++;
}

function removeAttributeValue(attr_value_row) {
	$('#attr option[value=\'attr' + attr_value_row + '\']').remove();
	$('#attr' + attr_value_row).remove();
}
//--></script>