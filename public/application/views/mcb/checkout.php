
<script type="text/javascript" src="/env/js/gen_validatorv4.js" xml:space="preserve"></script>


<script type="text/javascript">
	  var submitPressed = 0;
      var shippingCosts = new Array(); 
      <?php 
        print 'var subtotal = '.$order->subtotal.';';
        foreach($shippingcosts as $cost) {
            print 'shippingCosts['.$cost->shipping_method_id.'] = '.$cost->price.';
            ';
        } 
        ?>
       function changeShippingCost() {
          var shipping = shippingCosts[document.checkoutform.shippingMethod.value];
          var total = subtotal + shipping;
          
          var shippingFormatted = shipping.toFixed(2);
          var totalFormatted = total.toFixed(2);
          document.checkoutform.shippingtotal.value = shippingFormatted;
          document.checkoutform.ordertotal.value = totalFormatted;
          document.getElementById("shipping_cost").innerHTML = "$"+shippingFormatted+"";
          document.getElementById("total_cost").innerHTML = "$"+totalFormatted+"";
       }
       
function copyBillingInfo(select) {
	
	if (!$(select).attr('checked'))
		return;
	
	$('#checkoutform input').each(function(index,_input){
		var input = $(_input);
		if (input.attr('name').substr(0,7) == 'billing') {
			var shippingInputName = 'shipping'+input.attr('name').substr(7);
			$('input[name="'+shippingInputName+'"]').val(input.val());
		}
	});

	$('#checkoutform select').each(function(index,_select){
		var select = $(_select);
		if (select.attr('name').substr(0,7) == 'billing') {
			var shippingInputName = 'shipping'+select.attr('name').substr(7);
			$('select[name="'+shippingInputName+'"]').val(select.val());
		}
	});
	
	isCanada();
}
       

	   function checkDate() {
			var dat = document.getElementById("requesteddate");
			var thedate = dat.value;
			var yearV = thedate.substring(0,4);
			var monthV = thedate.substring(5,7)-1;
			var dayV = thedate.substring(8,10);
			var reqdate = new Date(yearV, monthV, dayV); //Month is 0-11 in JavaScript
			var today = new Date();
			var datediff = reqdate - today;
			var daysdiff = datediff / 86400000;
			submitPressed++;
			var popupBox = document.getElementById("popupInfo");
			var popupHead = document.getElementById("tooSoonHead");
			var popupText = document.getElementById("tooSoonText");
			var closeMeBox = document.getElementById("closeMe");
			if(popupBox.style.display=='none' && daysdiff > 10) {
				// The popup box is not shown and the date is after 10 days ahead. 
				return true;
			} else if(popupBox.style.display=='none' && daysdiff <= 10) {
				// The popup box is not shown and the date is less than 10 days from now. 
				// Either the user has not yet tried to submit the data or has just changed the date.
				if(daysdiff <= 0) {
					//alert("Before Today");
					popupHead.innerHTML = "<H3>Date Error</H3>";
					popupText.innerHTML = "<p>The date that you selected is in the past. Please select a future date and try again.</p>";
					closeMeBox.innerHTML = 'Click to close and change Requested Date.';
					showhideBox('popupInfo');
					return false;
				} else if(daysdiff <= 10) {
					popupHead.innerHTML = "<H3>Rush Order</H3>";
					popupText.innerHTML = "<p>It might take up to 10 business days to deliver custom chocolate Product.</p><p>If products are needed earlier, we offer RUSH DELIVERY. We will contact you if this is the case to process the RUSH ORDER FEE. RUSH ORDER FEE may be avoided by selecting a later 'Requested Date.' By clicking CONTINUE, you recognize that you may be contacted about the RUSH ORDER FEE.</p>";
					closeMeBox.innerHTML = 'Click to close and change Requested Date, or click Continue to accept that you may be contacted about a rush order fee.';
					showhideBox('popupInfo');
					return false;
				}
			} else if(popupBox.style.display=='block' && daysdiff <= 10) {
				// The popup box is shown, which means the user clicked has already tried to submit. 
				// The user changed the date but there was an error in the JS and the popup was not hidden
				if(daysdiff <= 0) {
					//alert("Before Today");
					popupHead.innerHTML = "<H3>Date Error</H3>";
					popupText.innerHTML = "<p>The date that you selected is in the past. Please select a future date and try again.</p>";
					closeMeBox.innerHTML = 'Click to close and change Requested Date.';
					//showhideBox('popupInfo');
					return false;
				} else if(daysdiff <= 10) {
					return true;
				}
			} else {
				// The popup box is shown, which means the user clicked has already tried to submit. 
				// The user must have changed the date
				return true;
			}
	   }

	   function isCanada() {
			var ele = document.getElementById("shippingCountry");
			if (document.checkoutform.shippingCountry.value == "CA")	{
				
				var shipping = shippingCosts[document.checkoutform.shippingMethod.value] + 30;
				var total = subtotal + shipping;

				var shippingFormatted = shipping.toFixed(2);
				var totalFormatted = total.toFixed(2);
				document.checkoutform.shippingtotal.value = shippingFormatted;
				document.checkoutform.ordertotal.value = totalFormatted;
				document.getElementById("shipping_cost").innerHTML = "$"+shippingFormatted+"";
				document.getElementById("total_cost").innerHTML = "$"+totalFormatted+"";

			} else {
				
				var shipping = shippingCosts[document.checkoutform.shippingMethod.value];
				var total = subtotal + shipping;

				var shippingFormatted = shipping.toFixed(2);
				var totalFormatted = total.toFixed(2);
				document.checkoutform.shippingtotal.value = shippingFormatted;
				document.checkoutform.ordertotal.value = totalFormatted;
				document.getElementById("shipping_cost").innerHTML = "$"+shippingFormatted+"";
				document.getElementById("total_cost").innerHTML = "$"+totalFormatted+"";

			}


	   }
       
      
      </script>
      
     <script>
	$(function() {
		$( "#requesteddate" ).datepicker({dateFormat: 'yy-mm-dd'});
	});
	</script>

	<div id="content" class="checkout row">
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
						<div class="rnd cement inner-filling">

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
	<?			if (FALSE === User_Model::logged_in()) { ?>
		<div class="col-md-12 checkout-login-form rnd-10">
			<form action="/customers/login" method="post" name="customer_login_form">

			<h3>Login</h3>
				<input type="text" name="email" value="" placeholder="email" required> 
				<input type="password" name="password" value="" placeholder="password" required>
				<input type="submit" name="login" value="Sign In" class="rnd btn orange">
				<input type="checkbox" name="remember_me" value="0"> <span>Remember Me?</span>
				<a href="#" class="reset-pwd">Forgot Password?</a>					
			</form>
		</div>
		<!-- Two column set up -->
	<?			} ?>
<form method="post" action="https://<?=$_SERVER['SERVER_NAME']?>/shopping_cart/authorization" name="checkoutform" id="checkoutform" class="rnd-10 row">
		<div class=" 2-col col-md-12 row checkout-summary">
			<!--Begin Left Col -->
			<div class="col-md-8 left-col">
					<h3>Or fill in this form</h3>

					<!-- Form Left Col Start -->
						<div class="col-md-6 left-col">
							<h4>Billing Address</h4>
          <input type="hidden" name="orderid" id="orderid" value="<?php echo $order->id; ?>" />
          <input type="hidden" name="shippingtotal" id="shippingtotal" value="<?php echo $order->shipping_total; ?>" />
          <input type="hidden" name="ordertotal" id="ordertotal" value="<?php echo ($order->subtotal+$order->shipping_total); ?>" />
        
		   	
			
<?			if (!$user) { ?>
		  					<input name="userEmail" id="userEmail" value="<?=$user ? $user->email : ''?>" placeholder=" Email*" type="email" required><br>
							<input name="userPassword" placeholder=" Password*" type="password" required><br>
							<span class="eg">(At least 8 characters)</span><br>
							<input name="confpassword" placeholder=" Confirm Password*" type="password" required><br>
							<input name="billingFirstname" placeholder=" First Name*" type="text" value="<?=$user ? $user->firstname : ''?>" required><br>
							<input name="billingLastname" placeholder=" Last Name*" type="text" value="<?=$user ? $user->lastname : ''?>" required><br>
							<input name="billingCompany" placeholder=" Company" type="text" value="<?=$user ? $user->company : ''?>"><br>
							<input name="billingAddress1" placeholder=" Address Line 1*" type="text" value="<?=$user ? $user->address1 : ''?>" required><br>
							<input name="billingAddress2" placeholder=" Address Line 2" type="text" value="<?=$user ? $user->address2 : ''?>"><br>
							<input name="billingCity" placeholder=" City*" type="text" value="<?=$user ? $user->city : ''?>" required>&nbsp;
						
<?			} else{  ?>
							<input name="userEmail" id="userEmail" value="<?=$user ? $user->email : ''?>" placeholder=" Email*" type="email" required><br>
							<input name="billingFirstname" placeholder=" First Name*" type="text" value="<?=$user ? $user->firstname : ''?>" required><br>
							<input name="billingLastname" placeholder=" Last Name*" type="text" value="<?=$user ? $user->lastname : ''?>" required><br>
							<input name="billingCompany" placeholder=" Company" type="text" value="<?=$user ? $user->company : ''?>"><br>
							<input name="billingAddress1" placeholder=" Address Line 1*" type="text" value="<?=$user ? $user->address1 : ''?>"  required><br>
							<input name="billingAddress2" placeholder=" Address Line 2" type="text" value="<?=$user ? $user->address2 : ''?>"><br>
							<input name="billingCity" placeholder=" City*" type="text"  value="<?=$user ? $user->city : ''?>" required>&nbsp;
<? } ?>

<?php		
		foreach ($formFields['billing'] as $field)
		{ 

			if ($field->db_name == 'state')
			{
?>
			
			
				<select name="<?=$field->formName?>" id="<?=$field->formName?>" placeholder=" State/Province*" required>
					<option value="000">Select a state*</option>
				<?php 
					foreach($states as $state) {
						$selected = ($state->abbr == $field->value) ? 'selected' : '';
						echo '<option name="'.$state->abbr.'" value="'.$state->abbr.'" '.$selected.'>'.$state->name.'</option>';
					}
				
				?>
				</select><br>

				<input name="billingZip" placeholder=" Zip Code*" type="text" value="<?=$user ? $user->zip : ''?>" required> &nbsp;
<?php
			}else if ($field->db_name == 'country'){

			
?>
			
			
				<select name="<?=$field->formName?>" id="<?=$field->formName?>" placeholder=" Country*" required>
					<option value="000">Select a country</option>
					<option name="US" value="US" <?=($field->value == 'US')?'selected':''?>>United States</option>
					<option name="CA" value="CA" <?=($field->value == 'CA')?'selected':''?>>Canada</option>
				</select>

			
			
<? } } ?>
				<input name="billingPhone1" placeholder=" Phone*" type="phone" value="<?=$user ? $user->phone1 : ''?>" required> &nbsp;
				 <input name="billingPhone2" placeholder=" Secondary Phone" type="phone" value="<?=$user ? $user->phone2 : ''?>">
				<span class="eg">(Numbers only)</span>	
	</div><!-- End Form Left Col -->

	<div class="col-md-6 right-col">
							<h4>Shipping Address</h4>
				
			
		<input class="checkbox" type="checkbox" name="same" onClick="copyBillingInfo(this);" value="Shipping Address same as Billing Address"  style="display: inline-block;"/><span>Same as Billing Address </span>
		<br><br>
						

							<input name="shippingFirstname" value="<?=$user ? $user->user_shipping_info->firstname : " " ?>" placeholder=" First Name*" type="text" required><br>
							<input name="shippingLastname" value="<?=$user ? $user->user_shipping_info->lastname : " " ?>" placeholder=" Last Name*" type="text" required><br>
								
							<br>
							<input name="shippingCompany" value="<?=$user ? $user->user_shipping_info->company : " " ?>" placeholder=" Company" type="text"><br>
							<input name="shippingAddress1" value="<?$user ? $user->user_shipping_info->address1 : " " ?>" placeholder=" Address Line 1*" type="text" required><br>
							<input name="shippingAddress2" value="<?=$user ? $user->user_shipping_info->address2 : " "?>" placeholder=" Address Line 2" type="text"><br>
							<input name="shippingCity" value="<?=$user ? $user->user_shipping_info->city : " " ?>" placeholder=" City*" type="text" required>&nbsp;
<?		

		foreach ($formFields['shipping'] as $field)
		{ 
			if ($field->db_name == 'phone1' || $field->db_name == 'phone2') continue;
			if ($field->db_name == 'country')
			{
?>
		
					<select name="<?=$field->formName?>" id="<?=$field->formName?>" required>	
					<option value="000">Select a country*</option>
					<option name="US" value="US" <?=($field->value == 'US')?'selected':''?>>United States</option>
					<option name="CA" value="CA" <?=($field->value == 'CA')?'selected':''?>>Canada</option>
					</select>
					<input name="shippingZip" value="<?=$user ? $user->user_shipping_info->zip : " " ?>" placeholder=" Zip*" type="text" required>&nbsp;

		

		
<?			
			} else if ($field->db_name == 'state')
			{
?>
				<select name="<?=$field->formName?>" id="<?=$field->formName?>" required>
					<option value="000">Select a state*</option>
				<?php 
					foreach($states as $state) {
						$selected = ($state->abbr == $field->value) ? 'selected' : '';
						echo '<option name="'.$state->abbr.'" value="'.$state->abbr.'" '.$selected.'>'.$state->name.'</option>';
					}?>
				</select>
<?php
				}
			}
				?>
				
<br>
					
			<input class="checkbox" type="checkbox" name="email-updates" value="Yes" style="display: inline-block;" /><span>Yes sign me up for email updates </span><br>
			<input type="checkbox" name="share" value="Yes" style="display: inline-block;" checked /><span>Share my creation with other users on MyChocolateHearts.com </span><br>
<!-- 			<input type="submit" name="save" value="Save" class="btn orange rnd"> -->

			</div>
			<!-- End Left Col -->
		</div>

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
						</div>
				</div>
			<!-- End Right Col -->
		</div>
		<!-- End 2 Col Layout -->
	<div class="col-md-12 checkout-shipping-method">
			<p>Custom products turnaround time is 5-7 business days plus shipping time. 
			Grab and Go products turnaround time is 1 business days plus shipping time.
			</p>
			<span class="bottom-form">
					<label for="shipping_select">Please choose shipping method*</label><br>
					<select name="shippingMethod"  onChange="javascript:changeShippingCost(); return false;">
						<?php foreach($shippingcosts as $cost): ?>
						   <option name="shippingMethod<?php echo $cost->shipping_method_id; ?>" Value="<?php echo $cost->shipping_method_id; ?>"><?php echo $cost->name; ?></option>

						<? endforeach; ?>		
					</select>
					<label for="date_request">Request Date </label>
					<input type="date" name="requesteddate" id="requesteddate" value="<?php echo $requesteddate; ?>" onFocus="if(getElementById('popupInfo').style.display=='block'){showhideBox('popupInfo');submitPressed = 0;}">
					<img src="/env/images/mcb/calendar-icon.png" alt="pick date" class="date-picker" onClick="javascript:$('#requesteddate').focus();" ><br>
					<button class="orange btn btn-thin" onClick="on_submit_validation();">Continue</button>

			</span>
		</div>
</form>
		<div class="clear large-space"></div>
	</div>
	<!-- End Content -->

<?
// echo "<pre>";
// print_r($user);
// echo "</pre>";

?>

<script type="text/javascript">
var checking_email = false;

//You should create the validator only after the definition of the HTML form
var frmvalidator  = new Validator("checkoutform");

document.forms['checkoutform'].onsubmit = function(){};

frmvalidator.EnableOnPageErrorDisplaySingleBox();
frmvalidator.EnableMsgsTogether();
frmvalidator.EnableFocusOnError(false);

frmvalidator.addValidation("billingFirstname","req","Please enter a Billing First Name");
frmvalidator.addValidation("billingFirstname","maxlen=100",	"Max length for FirstName is 100");
frmvalidator.addValidation("billingFirstname","alpha_s","Name can contain alphabetic chars only");
frmvalidator.addValidation("billingLastname","req","Please enter a Billing Last Name");
frmvalidator.addValidation("billingLastname","maxlen=100","For LastName, Max length is 100");
frmvalidator.addValidation("userEmail","req", "You must enter an email address");
frmvalidator.addValidation("userEmail","email", "You did not enter a valid email address");

<?			if (!$user) { ?>
frmvalidator.addValidation("userPassword","req", "You must enter a password");
frmvalidator.addValidation("userPassword","minlen=8", "Password must be at least 8 characters.");
frmvalidator.addValidation("userPassword","alnum", "Password must be at least 8 alpha-numerical characters (no symbols or spaces).");
frmvalidator.addValidation("confpassword","eqelmnt=userPassword", "The confirmed password is not same as password");
<?			} ?>

frmvalidator.addValidation("billingAddress1","maxlen=100", "Billing Address too long");
frmvalidator.addValidation("billingAddress1","req", "Please Enter a billing address");

frmvalidator.addValidation("billingCity","maxlen=100", "Billing City too long");
frmvalidator.addValidation("billingCity","req", "Please Enter a billing city");

frmvalidator.addValidation("billingState","dontselect=000", "Please select a billing state");
//frmvalidator.addValidation("billingCountry","dontselect=000", "Please select a country");


//frmvalidator.addValidation("billingZip","req", "Please Enter a billing zip");
//frmvalidator.addValidation("billingZip","regexp=^[0-9]{5}([\-][0-9]{4})?$", "You did not enter a valid billing zip code");


frmvalidator.addValidation("billingPhone1","numeric", "The phone number must be only numbers");
frmvalidator.addValidation("billingPhone1","req", "Please enter a phone number");


frmvalidator.addValidation("billingPhone2","numeric", "The secondary phone number must be only numbers");


frmvalidator.addValidation("shippingFirstname","req","Please enter a Shipping First Name");
frmvalidator.addValidation("shippingFirstname","maxlen=100",	"Max length for FirstName is 100");
frmvalidator.addValidation("shippingFirstname","alpha_s","Name can contain alphabetic chars only");

frmvalidator.addValidation("shippingLastname","req","Please enter a Shipping Last Name");
frmvalidator.addValidation("shippingLastname","maxlen=100","For LastName, Max length is 100");

frmvalidator.addValidation("shippingAddress1","maxlen=100", "Shipping Address too long");
frmvalidator.addValidation("shippingAddress1","req", "Please Enter a shipping address");
frmvalidator.addValidation("shippingCity","maxlen=100", "Shipping City is too long");
frmvalidator.addValidation("shippingCity","req", "Please Enter a shipping city");
frmvalidator.addValidation("shippingState","dontselect=000", "Please select a shipping state");
//frmvalidator.addValidation("shippingCountry","dontselect=000", "Please select a country");

//frmvalidator.addValidation("shippingZip","regexp=^[0-9]{5}([\-][0-9]{4})?$", "You did not enter a valid shipping zip code");
//frmvalidator.addValidation("shippingZip","req", "Please Enter a shipping zip");
//frmvalidator.setAddnlValidationFunction(DoSZipValidation);

//frmvalidator.addValidation("requesteddate","req", "The requested date is required.");

frmvalidator.setAddnlValidationFunction(DoBZipValidation);


function DoBZipValidation() {
	var billingCorrect = 0;
	var shippingCorrect = 0;
	var frm = document.forms["checkoutform"];
	var reUS = new RegExp("^[0-9]{5}([\-][0-9]{4})?$");
	var reCA = new RegExp("^[ABCEGHJKLMNPRSTVXY][0-9][ABCEGHJKLMNPRSTVWXYZ]( )?[0-9][ABCEGHJKLMNPRSTVWXYZ][0-9]$");
	//^[ABCEGHJKLMNPRSTVXY]{1}\d{1}[A-Z]{1}()?\d{1}[A-Z]{1}\d{1}$
	var error = '';


	if(frm.billingCountry.selectedIndex == 1) {
		
		if (frm.billingZip.value.match(reUS)) {
			billingCorrect = 1;
		} else {
			sfm_show_error_msg('Validation Billing Zip for US Failed!');
			error = 'Validation Billing Zip for US Failed!';
			billingCorrect = 0;
			//return false;
		}
	} else if(frm.billingCountry.selectedIndex == 2) {
		if (frm.billingZip.value.match(reCA)) {
			billingCorrect = 1;
		} else {
			sfm_show_error_msg('Validation Billing Zip for CA Failed!');
			error = 'Validation Billing Zip for CA Failed!';
			billingCorrect = 0;
			//return false;
		}
	} else {
		sfm_show_error_msg('Please select a billing country');
		error = 'Please select a billing country';
		billingCorrect = 0;
		//return false;

	}


	if(frm.shippingCountry.selectedIndex == 1) {
		//var re = new RegExp("^[0-9]{5}([\-][0-9]{4})?$");
		if (frm.shippingZip.value.match(reUS)) {
			shippingCorrect = 1;
		} else {
			sfm_show_error_msg('Validation Shipping Zip for US Failed!');
			error = 'Validation Shipping Zip for US Failed!';
			shippingCorrect = 0;
			//return false;
		}
	} else if(frm.shippingCountry.selectedIndex == 2) {
		if (frm.shippingZip.value.match(reCA)) {
			shippingCorrect = 1;
		} else {
			sfm_show_error_msg('Validation Shipping Zip for CA Failed!');
			error = 'Validation Shipping Zip for CA Failed!';
			shippingCorrect = 0;
			//return false;
		}
	} else {
		sfm_show_error_msg('Please select a Shipping country');
		error = 'Please select a Shipping country';
		shippingCorrect = 0;
		//return false;

	}


	if(billingCorrect == 1 && shippingCorrect == 1) {

		return true;
	} else {
		document.getElementById('checkoutform_errorloc').style.visibility = 'visible';
		document.getElementById('checkoutform_errorloc').style.display = 'block';
		document.getElementById('checkoutform_errorloc').innerHTML = error;
		return false;
	}

}

function on_submit_validation() {
	if (checking_email != false)
		return;
	
	var validation_res = form_submit_handler.call(document.forms['checkoutform']);
	if (!validation_res)
		return;
	
<?	if (!$user || $user->id == 0) { ?>
	$('.checking_email').html('Checking email address ...')
						.show();
						
	checking_email = true;
	$.getJSON('/customers/check_email/'+$('#userEmail').val(), function(data)
	{
		checking_email = false;
		
		if (data.status == 'OK') {
			$('#checkoutform').submit();
			$('.checking_email').hide();
		} else {
			$('.checking_email').html('The email address is already registered. You may already have an account if you registered on our other site, MyChocolateCoins.com - if so you can use the same password to login above.');
		}
	});
	return;
<?	} else { ?>
	$('#checkoutform').submit();
<?	} ?>
};


</script>
<?
// echo "<pre>";
// print_r($_SESSION);
// echo $user->user_shipping_info->firstname;
// echo "</pre>";