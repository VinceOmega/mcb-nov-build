<script type="text/javascript">
function switch_to_edit()
{
	$('.personal_info .show_value').hide();
	$('.personal_info a').hide();
	$('.personal_info input[type=text]').show();
	$('.personal_info button').show();
}
</script>
<div id="content">
			<div id="section-header">
				<h2 class="curly">Customers - My Account Details</h2>
			</div><!-- header -->
<?			if (isset($general_message)){ ?>
			<div class="message"><?=$general_message?></div>
<?			} ?>
			<div id="customers_my_account_content">
				<div class="grey-border grey-corner personal_info">
					<img src="/env/images/mcc/my_account_personal_info_title.png" /><br /><br />
					<form method="POST" action="/customers/my_account/?edit_info">
<?					$errorsInForm = FALSE;
					foreach ($personal_info_fields as $section => $fields) {
						if ($section == 'shipping') {
							echo '<h4>Shipping Address</h4>';
						} elseif ($section == 'billing')
							echo '<h4>Billing Address</h4>';
						
						
						foreach ($fields as $field)
						{ 
							$error = FALSE;
							if (isset($errors[$field->formName])) {
								$error = $errors[$field->formName];
								$errorsInForm = TRUE;
							}
?>
					<div class="field <?=$error?'error':''?>">
						<span class="fieldName">
							<?=$field->name?><?=$field->required ? '*' : ''?>:
						</span>
						<span class="show_value"><?=$field->value?></span>
						<input type="text" name="<?=$field->formName?>" value="<?=$field->value?>" />
<?							if ($error) {  ?>
						<span class="error_msg"><?=$error?></span>
<?							} ?>
					</div>
<?						} ?>
<?					} ?>
					<a href="#" onclick="switch_to_edit(); return false;">Edit info</a>
					<button type="submit">
						<img src="/env/images/mcc/submit_button.png" />
					</button>
					</form>
<?					if ($errorsInForm) { ?>
					<script type="text/javascript">
						switch_to_edit();
					</script>	
<?					} ?>
				</div>
				<div class="grey-border grey-corner change_password">
					<img src="/env/images/mcc/my_account_change_password_title.png" /><br /><br />
					<form method="POST" action="/customers/my_account/?change_password">
					<div class="field <?=isset($errors['old_password'])?'error':''?>">
						<span class="fieldName">Current Password*:</span>
						<input type="password" name="old_password" value="" />
						<span class="error_msg"><?=isset($errors['old_password'])?$errors['old_password']:''?></span>
					</div>
					<div class="field <?=isset($errors['new_password'])?'error':''?>">
						<span class="fieldName">New Password*:</span>
						<input type="password" name="new_password" value="" />
						<span class="error_msg"><?=isset($errors['new_password'])?$errors['new_password']:''?></span>
					</div>
					<div class="field <?=isset($errors['new_password_again'])?'error':''?>">
						<span class="fieldName">Re-Enter Password*:</span>
						<input type="password" name="new_password_again" value="" />
						<span class="error_msg"><?=isset($errors['new_password_again'])?$errors['new_password_again']:''?></span>
					</div>
					<button type="submit">
						<img src="/env/images/mcc/submit_button.png" />
					</button>
					</form>
				</div>
				<div class="grey-border grey-corner previous_orders">
					<img src="/env/images/mcc/my_account_previous_orders_title.png" /><br /><br />
<?					if (count($orders) == 0) { ?>
					<span class="noOrdersMessage">You don't have any previous orders.</span>
<?					} else { ?>
					<ul class="orders">
<?						foreach ($orders as $order) { ?>
						<li>
							<span class="field">Order #:<?=$order->getOrderId()?></span>
							<span class="field">
								Date:
								<span class="value"><?=date_create($order->order_date)->format('M jS, Y')?></span>
							</span>
							<span class="field">Products:</span>
							<ul class="products">
<?								foreach ($order->orders_baskets as $orders_basket) { ?>
								<li>
									<?=$orders_basket->product->name?> x <?=$orders_basket->qty?> 
<?									if ($orders_basket->packaging_id != 0) { ?>
									Packaging: <?=$orders_basket->packaging->name?>
<?									} ?>
								</li>
<?								} ?>
							</ul>
<?							if ($order->site_id == My_Template_Controller::getCurrentSite()->id) { ?>
							<a href="/orders/order_again/<?=$order->id?>">Order Again</a>
<?							} else { ?>
							Please login into <a href="http://<?=$order->site->url?>"><?=$order->site->name?></a> to order again.
<?							} ?>
						</li>
<?						} ?>
					</ul>
<?					} ?>
				</div>
			</div>