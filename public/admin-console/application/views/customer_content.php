<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>


<?php if (isset($errors)) {
		if (is_array($errors)) {
			 foreach ($errors as $error) {
			   echo '<p class="error">' . $error . '</p>';
			 }
		  }
		}
$db=new Database;
//$order = Order::getOrderByID($id);
$orders = Order::getOrdersByUser($id);			  
			  
?>
			  
<form action="<?php echo url::base() . $this->uri->segment(1). '/' . $this->uri->segment(2) . '/' .$this->uri->segment(3)?>" method="POST" id="form" >
<div id="mainContent" >
	<div class="box">
		  <div class="left"></div>
		  <div class="right"></div>
		  <div class="heading">
		    <h2 id="heading">Clients</h2>
		    <span id="buttons">
				<input type="submit" value="Save" name="save" class="css-button" />
				<input type="button" onclick="location = '<?php  echo url::base() . $this->uri->segment(1) ?>'" value='Cancel' class="css-button"  />
			</span>
		  </div>
	</div>
	
	<div id="contentLeft">
		<div id="tabs" class="htabs" >
			<a tab="#tab_general">General</a>
			<a tab="#tab_billing">Billing Address</a>
			<a tab="#tab_shipping">Shipping Address</a>
			<a tab="#tab_history">Order History</a>
		</div> 
 	</div>
		
	<div id="contentRight">
	
			
		<div id="tab_general">
			<div class="headline">Personal Information</div>
			<table>
				<colgroup>
					<col width="150" />
					<col  />
				</colgroup>
			
				<tr>
					<td><label for="firstname">First Name</label></td>
					<td><input type="text" name="firstname" id="firstname" class="formText" maxlength="255" value="<?php echo $customer->firstname ?>" /></td>
				</tr>
				<tr>
					<td><label for="lastname">Last Name</label></td>
					<td><input type="text" name="lastname" id="lastname" class="formText" maxlength="255" value="<?php echo $customer->lastname ?>" /></td>
				</tr>
				<tr>
					<td><label for="email">Email</label></td>
					<td><input type="text" name="email" id="email" class="formText" maxlength="255" value="<?php echo $customer->email ?>" /></td>
				</tr>
				<tr>
					<td><label for="telephone">Telephone</label></td>
					<td><input type="text" name="telephone" id="telephone" class="formText" maxlength="255" value="<?php echo $customer->telephone ?>" /></td>
				</tr>
				<tr>
					<td><label for="fax">Fax</label></td>
					<td><input type="text" name="fax" id="fax" class="formText" maxlength="255" value="<?php //echo $customer->fax ?>" /></td>
				</tr>
			</table>
			<br/><br/>
			<div class="headline">Change/Set Password</div>
			<table>
				<colgroup>
					<col width="150" />
					<col  />
				</colgroup>
				<tr>
					<td><label for="password">Password</label></td>
					<td><input type="password" name="password" id="password" class="formText" maxlength="255" /></td>
				</tr>	
				<tr>
					<td><label for="password_confirm">Cofirm</label></td>
					<td><input type="password" name="password_confirm" id="password_confirm" class="formText" maxlength="255" /></td>
				</tr>
			</table>
			<br/><br/>
			<div class="headline">Customer Group</div>
			<table>
				<colgroup>
					<col width="150" />
					<col  />
				</colgroup>
				<tr>
					<td colspan="2">Set customer group here</td>
				</tr>
				<tr>
					<td><label for="group">Group</label></td>
					<td>
						<select name="group" id="group">
							<option value="1">Client</option>
							<option value="2">Designer</option>
						</select>
					</td>
				</tr>
			</table>
			<br/><br/>
			<div class="headline">Newsletter</div>
			<table>
				<colgroup>
					<col width="150" />
					<col  />
				</colgroup>
				<tr>
					<td colspan="2">Would you like to subscribe to our newsletter</td>
				</tr>
				<tr>
					<td><label for="newsletter"></label></td>
					<td>	
						<select name="newsletter" id="newsletter">
							<option>Yes</option>
							<option>No</option>
						</select>					
					</td>
				</tr>
			</table>
			<br/><br/>
			<div class="headline">Status</div>
			<table>
				<colgroup>
					<col width="150" />
					<col  />
				</colgroup>
				<tr>
					<td><label for="status">Status</label></td>
					<td>
						<select name="status" id="status" >
							<option value="1">Registered</option>
							<option value="2" <?php if ($customer->logins == 0) echo 'selected=selected' ?> >Account created</option>
						</select>
					</td>
				</tr>
			
			</table>
		 </div>  <!-- div id="tab_general" -->
			  
			 
		<div id="tab_billing">
			  <div class="headline">Edit/Add Billing Address</div>
			  <h2>Billing Address</h2>
			  <table>
			  <colgroup>
					<col width="150" />
					<col  />
			  </colgroup>
			  <tr>
			  		<td><label for="billing_address1">Street Address</label></td>
					<td><input id="billing_address1" type="text" class="formText" name="billing_address1" maxlength="255" value="<?php echo $customer->users_detail->billing_address1; ?>" /></td>
			  </tr>
			  <tr>
			  		<td></td>
					<td><input id="billing_address2" type="text" class="formText" name="billing_address2" maxlength="255" value="<?php echo $customer->users_detail->billing_address2; ?>" /></td>
			  </tr>
			  <tr>
			  		<td><label for="billing_city">City</label></td>
					<td><input id="billing_city" type="text" class="formText" name="billing_city" maxlength="255" value="<?php echo $customer->users_detail->billing_city; ?>" /></td>
			  </tr>
			  <tr>
			  		<td><label for="billing_state">State/Province</label></td>
					<td><input id="billing_state" type="text" class="formText" name="billing_state" maxlength="255" value="<?php echo $customer->users_detail->billing_state; ?>" /></td>
			  </tr>
			  <tr>
			  		<td><label for="billing_zip">Zip/Postal Code</label></td>
					<td><input id="billing_zip" type="text" class="formText" name="billing_zip" maxlength="255" value="<?php echo $customer->users_detail->billing_zip; ?>" /></td>
			  </tr>
			   <tr>
			  		<td><label for="billing_country">Country</label></td>
					<td><input id="billing_country" type="text" class="formText" name="billing_country" maxlength="255" value="<?php echo $customer->users_detail->billing_country; ?>" /></td>
			  </tr>
			   <tr>
			  		<td><label for="billing_telephone">Telephone</label></td>
					<td><input id="billing_telephone" type="text" class="formText" name="billing_telephone" maxlength="255" value="<?php echo $customer->users_detail->billing_telephone; ?>" /></td>
			  </tr>
			   <tr>
			  		<td><label for="billing_email">Email</label></td>
					<td><input id="billing_email" type="text" class="formText" name="billing_email" maxlength="255" value="<?php echo $customer->users_detail->billing_email; ?>" /></td>
			  </tr>
			  </table>
		 </div>   <!-- div id="tab_billing" -->
			 
			 
		 <div id="tab_shipping">
			<div class="headline">Edit/Add Shipping Address</div>
			<h2>Shipping Address</h2>			
			<table>
				<colgroup>
					<col width="150" />
					<col  />
				</colgroup>
				<tr>
					<td><label for="shipping_address1">Street Address</label></td>
					<td><input id="shipping_address1" type="text" class="formText" name="shipping_address1" maxlength="255" value="<?php echo $customer->users_detail->shipping_address1; ?>" /></td>
				</tr>
				<tr>
					<td></td>
					<td><input id="shipping_address2" type="text" class="formText" name="shipping_address2" maxlength="255" value="<?php echo $customer->users_detail->shipping_address2; ?>" /></td>
				</tr>
				<tr>
					<td><label for="shipping_city">City</label></td>
					<td><input id="shipping_city" type="text" class="formText" name="shipping_city" maxlength="255" value="<?php echo $customer->users_detail->shipping_city; ?>" /></td>
				</tr>
				<tr>
					<td><label for="shipping_state">State/Province</label></td>
					<td><input id="shipping_state" type="text" class="formText" name="shipping_state" maxlength="255" value="<?php echo $customer->users_detail->shipping_state; ?>" /></td>
				</tr>
				<tr>
					<td><label for="shipping_zip">Zip/Postal Code</label></td>
					<td><input id="shipping_zip" type="text" class="formText" name="shipping_zip" maxlength="255" value="<?php echo $customer->users_detail->shipping_zip; ?>" /></td>
				</tr>
				<tr>
					<td><label for="shipping_country">Country</label></td>
					<td><input id="shipping_country" type="text" class="formText" name="shipping_country" maxlength="255" value="<?php echo $customer->users_detail->shipping_country; ?>" /></td>
				</tr>
				<tr>
					<td><label for="shipping_telephone">Telephone</label></td>
					<td><input id="shipping_telephone" type="text" class="formText" name="shipping_telephone" maxlength="255" value="<?php echo $customer->users_detail->shipping_telephone; ?>" /></td>
				</tr>
				<tr>
					<td><label for="shipping_email">Email</label></td>
					<td><input id="shipping_email" type="text" class="formText" name="shipping_email" maxlength="255" value="<?php echo $customer->users_detail->shipping_email; ?>" /></td>
				</tr>
			</table>
		 </div>   <!-- div id="tab_shipping" -->
		 
		 <div id="tab_history">
			  <div class="headline">View Order History</div>
			  <table>
				<colgroup>
					<col width="150" />
					<col width="150" />
					<col width="150" />
					<col width="150" />
					<col width="150" />					
				</colgroup>
				<?php
					if (count($orders)){	echo '---'.count($orders).'---<br><br>';
						echo '<tr><th>Order ID</th><th>Customer Name</th><th>Status</th><th>Date Added</th><th>Total</th><th>Action</th></tr>';
						foreach($orders as $order){
					?>
						<tr>
							<td><?php echo 'MCH'.$order->order_id; ?></td>
							<td><?php echo $order->order_total; ?></td>
							<td><?php echo format::format_date($order->order_date); ?></td>
							<td><?php echo '<select name="status">';
								$statusRes = $db->query('SELECT id, name FROM order_statuses');
								foreach($statusRes as $status) {
									echo '<option value="'.$status->id.'" '.($order->statusID == $status->id):'selected'?''.'>'.$status->name.'</option>';
									
								}
								?>
							</select></td>
							<td align="center"><a href="/admin-console/orders/edit/<?php echo $order->id ?>">Edit</a></td>
						</tr>
					<?php
						}
					}
					else
						echo 'No orders';
				?>
			  
			  </table>
		 </div>   <!-- div id="tab_history" -->
		 		
	</div>    	<!-- div id="contentRight" -->
</div>  <!-- div id='mainContent' -->
</form>

<script type="text/javascript"><!--
$.tabs('#tabs a', '<?php echo isset($_POST['selected_tab']) ? $_POST['selected_tab'] : '#tab_general'?>'); 
//--></script>