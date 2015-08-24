<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script type="text/javascript">


function switch_to_edit()
{
	$('.personal_info .show_value').hide();
	$('.personal_info a').hide();
	$('.personal_info input[type=text]').show();
	$('.personal_info button').show();
}
</script>

<?php foreach($_GET as $key => $value){
			$$key = $value;
	}?>

<?php foreach($baskets as $key => $order_etc){
			$products[] = $order_etc;
}

if(isset($designs)){
foreach($designs as $key => $designs_etc){
			$saved["$key"] = $designs_etc;
	}
}

foreach($bcount as $key => $v){
	foreach( $v as $k => $value){
			$bcount_value["$k"] = $value;
		}
}

$btotal = $bcount_value["COUNT(o.id)"];

foreach($dcount as $key => $v){
				foreach( $v as $k => $value){
			$dcount_value["$k"] = $value;
		}
}

$dtotal = $dcount_value["COUNT(*)"];


			

foreach($personal_info_fields as $section => $fields){
		if($section === 'user'){
			foreach($fields as $field){

					$userInfo["$field->formName"] = $field->value;
			}
		}

		if($section === 'shipping'){
			foreach($fields as $field){
					// print_r($field);
					$shipping["$field->formName"] = $field->value;
			}
		}

		if($section === 'billing'){
			foreach($fields as $field){
					// print_r($field);
					$billing["$field->formName"] = $field->value;
			}
		}
}



?>


<div id="content" class="account-details row">
		<div class="2-col row col-md-12">
				<h2>My Account Details</h2>

<?			if (isset($general_message)){ ?>
			<div class="message"><?=$general_message?></div>
<?			} ?>
		<div class="col-md-3 left-col">
			<div class="col-md-12 user-details rnd-15">
				<h2>Personal Info</h2>
<?					$errorsInForm = FALSE;
					foreach ($personal_info_fields as $section => $fields) {
						if ($section == 'shipping') {
							echo '<h3>Shipping Address</h3>';
						} elseif ($section == 'billing')
							echo '<h3>Billing Address</h3>';
?>						
						<ul>
<?						foreach ($fields as $field)
						{ 
							$error = FALSE;
							if (isset($errors[$field->formName])) {
								$error = $errors[$field->formName];
								$errorsInForm = TRUE;
							}
?>
					
							<li><?=$field->value?></li>

<?							if ($error) {  ?>
						<span class="error_msg"><?=$error?></span>
<?							} ?>
					
<?						} ?>
</ul>
<?					} ?>

<?					if ($errorsInForm) { ?>
					<script type="text/javascript">
						switch_to_edit();
					</script>	
<?					} ?>
					<button class="btn rnd orange edit-details">Edit</button><br><br><br>
				<div class="mid-space" style="background-color: white; width: 115%; height: 50px; left: -18px; position: relative;">

				</div>
				<div class="col-md-12 change-pwd rnd-15">
					<h3>Password</h3>
					<button class="btn rnd orange edit-password">Change Password</button>
				</div>

			</div>
		</div>
				<!-- End Left Hand Col -->
				<!-- Right Hand Col -->	
<div class="right-col col-md-9">
				<!-- Top Portion -->
		<div class="rnd-15-black row no-bottom">
				<div class="row product-display col-md-12">
			
				<h2>Saved Designs</h2>
				<? if(isset($ost)) $idx = $ost; else $idx = 1; ?>
				<? $lmt = 0; ?>
				<? if(isset($saved)){$itemnums = sizeof($saved);}?>
				<? if(isset($saved)){ ?>
				<? foreach($saved as $array){ ?>
					
					<div class="product-info-box col-md-6 row " >

		
						<div class="col-md-6">
						
							<img src="/<?=substr($array->designpath ,0 , strlen($array->designpath)); ?>" alt="gifts" width="225" height="150">
							
							<a href="#">Delete</a>
						</div>
						<div class="col-md-6 item-menu">
							<h5>Product Name</h5>
							<span class="social">
							Share: <a href="mailto:"><img src="/env/images/mcb/email-color.png" alt="social icons"></a>
							<div class="fb-share-button" data-href="<? echo 'http://'.$_SERVER['HTTP_HOST'].'/'.$array->designpath?>" data-layout="icon"></div>
							<!-- <img src="/env/images/mcb/facebook-color.png" alt="social icons"> -->
							<a href="https://twitter.com/share" class="twitter-share-button" data-count="none"><img src="/env/images/mcb/twitter-color.png" alt="social icons"></a>
							</span><br>
							<button data-href="/orders/order_again/<?=$array->order_id?>" class="rnd btn btn-thin orange">Order Now!</button>
						</div>	
				
					</div>
					
				<? $idx++; ?>
			<? } ?>
		<? } ?>

				<? if(isset($ost)) {
					
						$lmt = $ost;
						
					}?>
	
						<? $cnt = 0; $k = 1;?>
			<div class="rnd rnd-bar col-md-6 peanut pagination">
					<?$cnt = floor($lmt/10); if($lmt%10 != 0){$cnt++; }?>
					<?
					// echo $lmt; echo $cnt; ?>
					<span> Items <?=$lmt?>-<?=$lmt+$itemnums ?> of <?= $dtotal?> total </span>
					<ul>
						<? if(isset($ost)){
							$prev = $ost -10;
							$next = $ost + 10;
						} else {
							$prev = 1; $next = 11;
						}

						if($prev < 0){
							$prev = 1;
						}

						if($next > $dtotal - 1){
							$next = $dtotal - 1;
						}

						if(!isset($ust)){
							$ust = 1;
						}
						?>

						<li><a href="?ust=<?=$ust?>&ost=<?=$prev?>"><< Previous |</a></li>
						
						<? while($k <= ceil($dtotal/10)){ ?>
						<li><a href="my_account?ust=<?php if(isset($ust))  echo $ust; else echo 1; ?>&ost=<?= 10*($k-1)+1?>" class="<? if($k === 1){echo 'selected';} ?>"><?= $k; ?></a></li>
						<? $k++; } ?>
						<li><a href="?ust=<?=$ust?>&ost=<?=$next?>" class="next"> Next | >></a></li>
					</ul>
				</div>
		
	</div>
</div>
		<!-- End Top -->
		<!-- Bottom Section -->
	<div class="rnd-15-black row no-bottom">
		<div class="row order-display col-md-12">
			<h2>Previous Orders</h2>
				
<?					if (count($orders) == 0) { ?>
					<span class="noOrdersMessage">You don't have any previous orders.</span>
<?					} else { ?>
					<? $in = 1; ?>
					<? $st = 0; ?>
					<? $ordnum = count($orders) ?>
<?						foreach ($orders as $order) { ?>
					
					<div class="rnd rnd-bar lt-brown order-bar col-md-12">
					<ul>
						<li>Order NO.:<span class="hvy-txt">&nbsp;<?=$order->getOrderId()?></span></li>
						<li>Product Name</li>
						<li>Date</li>
						<li>Qty</li>
						<li>Unit Price</li>
						<li>Total</li>
					</ul>
					</div>
					<div class="order-details col-md-12">
						<ul>
						
<?								foreach ($order->orders_baskets as $orders_basket) { ?>
								<?php
								foreach($products as $pkey => $obj){
								if(is_object($obj)){	
								 	if(intval($obj->id) === intval($orders_basket->order_id)){ 
								 	echo "<li><img src='/env/product_images/$obj->image'></li>"; 
						

									?>
								<li class="product-name"><?=substr($orders_basket->product->name, 0 , 8)."..."?></li>
								<li><?=date_create($order->order_date)->format('M jS, Y')?></li>
								<li><?=$orders_basket->qty?></li> 						
								<li>$<?=$orders_basket->rate?></li>
<? $total = $orders_basket->qty * $orders_basket->rate;?><li>$<?=money_format('%.2n', $total)?></li><br>										
<?								} } } } ?>
						</ul>
<?							if ($order->site_id == My_Template_Controller::getCurrentSite()->id) { ?>
							<button data-href="/orders/order_again/<?=$order->id?>" class="btn rnd orange btn-thin" id="Re-Order-btn">Re-Order</button>
<?							if($in < 11){ $st = $in;}
							$in++;
						} else { ?>
							Please login into <button data-href="http://<?=$order->site->url?>"><?=$order->site->name?></button> to order again.
<?							} ?>
					</div>
					<!-- End Bottom Section -->
					
<?						} ?>
<? $cnt = 0; $k = 1;?>
			<div class="rnd rnd-bar col-md-6 peanut pagination">
					<span> Items <?=$st?>-<?=$st+$ordnum ?> of <?= $btotal?> total </span>
					<ul>
							<? if(isset($ust)){
							$prev = $ust -10;
							$next = $ust + 10;
						} else {
							$prev = 1; $next = 11;
						}

						if($prev < 0){
							$prev = 1;
						}

						if($next > $dtotal - 1){
							$next = $dtotal - 1;
						}

						if(!isset($ost)){
							$ost = 1;
						}
						?>
						<li><a href="?ust=<?=$prev?>&ost=<?=$ost?>"><< Previous |</a></li>
						<?$cnt = ceil($btotal/10);?>
						<? while($k <= $cnt){ ?>
						<li><a href="my_account?ost=<?php if(isset($ost)) echo $ost; else echo 1; ?>&ust=<?= 10*($k-1)+1?>" class="<? if($k === 1){echo 'selected';} ?>"><?= $k; ?></a></li>
						<? $k++; } ?>
						<li><a href="?ust=<?=$next?>&ost=<?=$ost?>" class="next"> Next | >></a></li>
					</ul>
				</div>
					
<?					} ?>
				</div>
				
			</div>
		
		</div>
		<!-- End Right Col -->
	</div>
	<!-- End 2 Col -->
</div>
<!-- End Content -->

<div id="edit-details">

<form method="POST" action="/customers/my_account/?edit_info">
			<a href="#"><img src="/env/images/mcb/close-x.png" alt="close" class="modal-close"></a>	
				<div class="container row">
					<div class="col-sx-4 col col-sm-4 col-md-4 col-lg-4 row-1">
						<span class="fieldName">
							First Name*:
						</span>
						<input type="text" name="userFirstname" value="<?=$userInfo['userFirstname']?>" >
			
						<span class="fieldName">
							Last Name*:
						</span>
						<input type="text" name="userLastname" value="<?=$userInfo['userLastname']?>" >
				
						<span class="fieldName">
							Email*:
						</span>
						<input type="text" name="userEmail" value="<?=$userInfo['userEmail']?>" >
			
						<span class="fieldName">
							Company:
						</span>
						<input type="text" name="userCompany" value="<?=$userInfo['userCompany']?>" >
		
						<span class="fieldName">
							Address Line 1*:
						</span>
						<input type="text" name="userAddress1" value="<?=$userInfo['userAddress1']?>" >
					
						<span class="fieldName">
							Address Line 2:
						</span>
						<input type="text" name="userAddress2" value="<?=$userInfo['userAddress2']?>" >
			
						<span class="fieldName">
							City*:
						</span>
						<input type="text" name="userCity" value="<?=$userInfo['userCity']?>" >
				
						<span class="fieldName">
							State*:
						</span>
					<?php			foreach ($personal_info_fields['user'] as $field)
		{ 

			if ($field->db_name == 'state')
			{
?>

	<select name="userState" id="<?=$field->formName?>" placeholder=" State/Province*" required>
					<option value="000">Select a state*</option>
				<?php 
					foreach($states as $state) {
						$selected = ($state->abbr == $field->value) ? 'selected' : '';
						echo '<option name="'.$state->abbr.'" value="'.$state->abbr.'" '.$selected.'>'.$state->name.'</option>';
					}
	?>
	</select>
			
						<span class="fieldName">
							Zip Code*:
						</span>
						<input type="text" name="userZip" value="<?=$userInfo['userZip']?>" >
			
						<span class="fieldName">
							Country*:
						</span>
<?php						
					}else if ($field->db_name == 'country'){

			
?>
			
			
				<select name="userCountry" id="<?=$field->formName?>" placeholder=" Country*" required>
					<option value="000">Select a country*</option>
					<option name="US" value="US" <?=($field->value == 'US')?'selected':''?>>United States</option>
					<option name="CA" value="CA" <?=($field->value == 'CA')?'selected':''?>>Canada</option>
				</select><br>

			
			
<? } } ?>		
						<span class="fieldName">
							Phone*:
						</span>
						<input type="text" name="userPhone1" value="<?=$userInfo['userPhone1']?>" >
			
						<span class="fieldName">
							Secondary Phone:
						</span>
						<input type="text" name="userPhone2" value="<?=$userInfo['userPhone2']?>" >
				</div>
				<div class="col-sx-4 col col-sm-4 col-md-4 col-lg-4 row-2">	
<h4>Shipping Address</h4>					
						<span class="fieldName">
							First Name*:
						</span>
						<input type="text" name="shippingFirstname" value="<?=$shipping['shippingFirstname']?>" >
				
						<span class="fieldName">
							Last Name*:
						</span>
						<input type="text" name="shippingLastname" value="<?=$shipping['shippingLastname']?>" >
				
						<span class="fieldName">
							Company:
						</span>
						<input type="text" name="shippingCompany" value="<?=$shipping['shippingCompany']?>" >
				
						<span class="fieldName">
							Address Line 1*:
						</span>
						<input type="text" name="shippingAddress1" value="<?=$shipping['shippingAddress1']?>" >
				
						<span class="fieldName">
							Address Line 2:
						</span>
						<input type="text" name="shippingAddress2" value="<?=$shipping['shippingAddress2']?>" >
				
						<span class="fieldName">
							City*:
						</span>
						<input type="text" name="shippingCity" value="<?=$shipping['shippingCity']?>" >
			
						<span class="fieldName">
							State*:
						</span>
	<?php			foreach ($personal_info_fields['shipping'] as $field)
		{ 

			if ($field->db_name == 'state')
			{
?>

	<select name="s_state" id="<?=$field->formName?>" placeholder=" State/Province*" required>
					<option value="000">Select a state*</option>
				<?php 
					foreach($states as $state) {
						$selected = ($state->abbr == $field->value) ? 'selected' : '';
						echo '<option name="'.$state->abbr.'" value="'.$state->abbr.'" '.$selected.'>'.$state->name.'</option>';
					}
	?>
	</select>
						<span class="fieldName">
							Zip Code*:
						</span>
						<input type="text" name="shippingZip" value="<?=$shipping['shippingZip']?>">
			
						<span class="fieldName">
							Country*:
						</span>
						
								<?php
			}else if ($field->db_name == 'country'){

			
?>
			
			
				<select name="s_country" id="<?=$field->formName?>" placeholder=" Country*" required>
					<option value="000">Select a country*</option>
					<option name="US" value="US" <?=($field->value == 'US')?'selected':''?>>United States</option>
					<option name="CA" value="CA" <?=($field->value == 'CA')?'selected':''?>>Canada</option>
				</select><br>

			
			
<? } } ?>		

						<span class="fieldName">
							Phone:
						</span>
						<input type="text" name="shippingPhone1" value="<?=$shipping['shippingPhone1']?>" >
	
						<span class="fieldName">
							Secondary Phone:
						</span>
						<input type="text" name="shippingPhone2" value="<?=$shipping['shippingPhone2']?>" >
				</div>
				<div class="col-sx-4 col col-sm-4 col-md-4 col-lg-4 row-3">
<h4>Billing Address</h4>				
						<span class="fieldName">
							First Name*:
						</span>
						<input type="text" name="billingFirstname" value="<?=$billing['billingFirstname']?>" >
				
						<span class="fieldName">
							Last Name*:
						</span>
						<input type="text" name="billingLastname" value="<?=$billing['billingLastname']?>" >
				
						<span class="fieldName">
							Company:
						</span>
						<input type="text" name="billingCompany" value="<?=$billing['billingCompany']?>" >
				
						<span class="fieldName">
							Address Line 1*:
						</span>
						<input type="text" name="billingAddress1" value="<?=$billing['billingAddress1']?>" >
			
						<span class="fieldName">
							Address Line 2:
						</span>
						<input type="text" name="billingAddress2" value="<?=$billing['billingAddress2']?>" >
				
						<span class="fieldName">
							City*:
						</span>
						<input type="text" name="billingCity" value="<?=$billing['billingCity']?>" >
				
						<span class="fieldName">
							State*:
						</span>
					<?php			foreach ($personal_info_fields['shipping'] as $field)
		{ 

			if ($field->db_name == 'state')
			{
?>

	<select name="s_state" id="<?=$field->formName?>" placeholder=" State/Province*" required>
					<option value="000">Select a state*</option>
				<?php 
					foreach($states as $state) {
						$selected = ($state->abbr == $field->value) ? 'selected' : '';
						echo '<option name="'.$state->abbr.'" value="'.$state->abbr.'" '.$selected.'>'.$state->name.'</option>';
					}
	?>
	</select>
						<span class="fieldName">
							Zip Code*:
						</span>
						<input type="text" name="billingZip" value="<?=$billing['billingZip']?>" >
			
						<span class="fieldName">
							Country*:
						</span>
								
								<?php
			}else if ($field->db_name == 'country'){

			
?>
			
			
				<select name="s_country" id="<?=$field->formName?>" placeholder=" Country*" required>
					<option value="000">Select a country*</option>
					<option name="US" value="US" <?=($field->value == 'US')?'selected':''?>>United States</option>
					<option name="CA" value="CA" <?=($field->value == 'CA')?'selected':''?>>Canada</option>
				</select><br>

			
			
<? } } ?>		
						<span class="fieldName">
							Phone*:
						</span>
						<input type="text" name="billingPhone1" value="<?=$billing['billingPhone1']?>">
			
						<span class="fieldName">
							Secondary Phone:
						</span>
						<input type="text" name="billingPhone2" value="<?=$billing['billingPhone2']?>" >
			</div>
					<!-- <a href="#" onclick="switch_to_edit(); return false;" >Edit info</a> -->
				<div class="col-sx-12 col col-sm-12 col-md-12 col-lg-12 row-4">
					<button type="submit" class="btn btn-thin mango">
						Submit
					</button>
				</div>
			</div>
	</form>
</div>


<div id="edit-password">
	<form method="POST" action="/customers/my_account/?change_password">
					<a href="#"><img src="/env/images/mcb/close-x.png" alt="close" class="modal-close"></a>
						<span class="fieldName">Current Password*:</span>
						<input type="password" name="old_password" value="">
						<span class="error_msg"></span>
				
						<span class="fieldName">New Password*:</span>
						<input type="password" name="new_password" value="">
						<span class="error_msg"></span>
				
						<span class="fieldName">Re-Enter Password*:</span>
						<input type="password" name="new_password_again" value="">
						<span class="error_msg"></span>
					
					<button type="submit" class="btn btn-thin mango">
						Submit
					</button>
	</form>
</div>

<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

<?php
echo "<pre>";
print_r($baskets);
print_r(get_class_methods($baskets));
echo "</pre>";

?>

<?php
// echo "<pre>";
// print_r($personal_info_fields);
// echo "<pre>";
?>

<?php
// echo "<pre>";
// print_r($userInfo);
// echo "</pre>";
?>

<?php
// echo "<pre>";
// echo $cnt;
//print_r($products);
// echo "</pre>";
?>

<?php
// echo "<pre>";
// print_r($orders_basket);
// echo "</pre>";
?>

<?php
echo "<pre>";
foreach($saved as $obj){
print_r($obj);
}
echo "</pre>";
?>

<?php
echo "<pre>";
print_r($bcount_value);
echo "</pre>";
?>


<?php
echo "<pre>";
print_r($dcount_value);
echo "</pre>";
?>


<?php
// echo "<pre>";
// if(isset($ust)){ echo $ust; echo "<br>"; echo $ost;}
// echo "</pre>";
?>

<?php
	//echo $lmt; echo $idx;
?>

