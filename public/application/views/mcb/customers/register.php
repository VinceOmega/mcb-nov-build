<div id="content" class="register row">
	<!-- 2 Col Begin -->
	<div class="2-col col-md-12">
		<!-- Begin Left Side -->
			<div class="col-md-3 left-col">
				<h3>Customer - Login</h3>
					<form action="" name="login" method="post" class="rnd-10">
						<input name="email" placeholder=" Email*" type="email" required><br>
						<input name="password" placeholder=" Password*" type="password" required><br>
						<input name="signin"  value="Sign In" type="submit" class="btn rnd orange">&nbsp;<input name="remember" value="0" type="checkbox">Remember Me<br>
						<a href="#" alt="forgot-password" class="reset-pwd">Forgot Password?</a>
					</form>
			</div>
			<div class="col-md-9 right-col">
				<h3>Or fill in this form</h3>
				<form action="" name="signup" method="post" class="rnd-10 row">
					<!-- Form Left Col Start -->
						<div class="col-md-6 left-col">
							<h4>Billing Address</h4>
							<input name="email" placeholder=" Email*" type="email" required><br>
							<input name="password" placeholder=" Password*" type="password" required><br>
							<span class="eg">(At least 8 characters)</span><br>
							<input name="confirm" placeholder="Confirm Password*" type="password" required><br>
							<input name="first_name" placeholder=" First Name*" type="text" required><br>
							<input name="last_name" placeholder=" Last Name*" type="text" required><br>
							<input name="company" placeholder=" Company" type="text"><br>
							<input name="address_1" placeholder=" Address Line 1*" type="text" required><br>
							<input name="address_2" placeholder=" Address Line 2" type="text"><br>
							<input name="city" placeholder=" City*" type="text" required>&nbsp;
					<?php		
		foreach ($formFields['billing'] as $field)
		{ 

			if ($field->db_name == 'state')
			{
?>
			
			
				<select name="state" id="<?=$field->formName?>" placeholder=" State/Province*" required>
					<option value="000">Select a state*</option>
				<?php 
					foreach($states as $state) {
						$selected = ($state->abbr == $field->value) ? 'selected' : '';
						echo '<option name="'.$state->abbr.'" value="'.$state->abbr.'" '.$selected.'>'.$state->name.'</option>';
					}
				
			
				
				?>
				</select><br>


					<!-- 		<select name="state" placeholder=" State/Province*" required>
									<option value="AL">AL</option>
									<option value="AK">AK</option>
									<option value="AZ">AZ</option>
									<option value="AR">AR</option>
									<option value="CA">CA</option>
									<option value="CO">CO</option>
									<option value="CT">CT</option>
									<option value="DE">DE</option>
									<option value="FL">FL</option>
									<option value="GA">GA</option>
									<option value="HI">HI</option>
									<option value="ID">ID</option>
									<option value="IL">IL</option>
									<option value="IN">IN</option>
									<option value="IA">IA</option>
									<option value="KS">KS</option>
									<option value="KY">KY</option>
									<option value="LA">LA</option>
									<option value="ME">ME</option>
									<option value="MD">MD</option>
									<option value="MA">MA</option>
									<option value="MI">MI</option>
									<option value="MN">MN</option>
									<option value="MS">MS</option>
									<option value="MO">MO</option>
									<option value="MT">MT</option>
									<option value="NE">NE</option>
									<option value="NV">NV</option>
									<option value="NH">NH</option>
									<option value="NJ">NJ</option>
									<option value="NM">NM</option>
									<option value="NY">NY</option>
									<option value="NC">NC</option>
									<option value="ND">ND</option>
									<option value="OH">OH</option>
									<option value="OK">OK</option>
									<option value="OR">OR</option>
									<option value="PA">PA</option>
									<option value="RI">RI</option>
									<option value="SC">SC</option>
									<option value="SD">SD</option>
									<option value="TN">TN</option>
									<option value="TX">TX</option>
									<option value="UT">UT</option>
									<option value="VT">VT</option>
									<option value="VA">VA</option>
									<option value="WA">WA</option>
									<option value="WV">WV</option>
									<option value="WI">WI</option>
									<option value="WY">WY</option>
									<option value="AS">AS</option>
									<option value="DC">DC</option>
									<option value="FM">FM</option>
									<option value="GU">GU</option>
									<option value="MH">MH</option>
									<option value="MP">MP</option>
									<option value="PW">PW</option>
									<option value="PR">PR</option>
									<option value="VI">VI</option>
									<option value="AE">AE</option>
									<option value="AA">AA</option>
									<option value="AE">AE</option>
									<option value="AP">AP</option>
							</select> --><br>
							<input name="zip" placeholder=" Zip Code*" type="text" required> &nbsp;
						<!-- 	<select name="country" placeholder=" Country*" required>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
							</select> -->
<?php
			}else if ($field->db_name == 'country'){

			
?>
			
			
				<select name="country" id="<?=$field->formName?>" placeholder=" Country*" required>
					<option value="000">Select a country*</option>
					<option name="US" value="US" <?=($field->value == 'US')?'selected':''?>>United States</option>
					<option name="CA" value="CA" <?=($field->value == 'CA')?'selected':''?>>Canada</option>
				</select>

			
			
<? } } ?>
							<input name="phone" placeholder=" Phone*" type="phone" required> &nbsp; <input name="second_phone" placeholder=" Secondary Phone" type="phone">
							<span class="eg">(Numbers only)</span>
						</div>
						<!-- End Form Left Col -->
						<!-- Begin Form Right Col -->
						<div class="col-md-6 right-col">
							<h4>Shipping Address</h4>
							<input type="checkbox" name="s_billing" value=""><span>Same As Billing Address</span><br><br>
							<input name="s_first_name" placeholder=" First Name*" type="text"><br>
							<input name="s_last_name" placeholder=" Last Name*" type="text"><br>
								
							<br>
							<input name="s_company" placeholder=" Company" type="text"><br>
							<input name="s_address_1" placeholder=" Address Line 1*" type="text"><br>
							<input name="s_address_2" placeholder=" Address Line 2" type="text"><br>
							<input name="s_city" placeholder=" City*" type="text">&nbsp;
					<?php		
		foreach ($formFields['billing'] as $field)
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
				</select><br>
						
							<!-- <select name="s_state" placeholder=" State/Province*" class="">
									<option value="AL">AL</option>
									<option value="AK">AK</option>
									<option value="AZ">AZ</option>
									<option value="AR">AR</option>
									<option value="CA">CA</option>
									<option value="CO">CO</option>
									<option value="CT">CT</option>
									<option value="DE">DE</option>
									<option value="FL">FL</option>
									<option value="GA">GA</option>
									<option value="HI">HI</option>
									<option value="ID">ID</option>
									<option value="IL">IL</option>
									<option value="IN">IN</option>
									<option value="IA">IA</option>
									<option value="KS">KS</option>
									<option value="KY">KY</option>
									<option value="LA">LA</option>
									<option value="ME">ME</option>
									<option value="MD">MD</option>
									<option value="MA">MA</option>
									<option value="MI">MI</option>
									<option value="MN">MN</option>
									<option value="MS">MS</option>
									<option value="MO">MO</option>
									<option value="MT">MT</option>
									<option value="NE">NE</option>
									<option value="NV">NV</option>
									<option value="NH">NH</option>
									<option value="NJ">NJ</option>
									<option value="NM">NM</option>
									<option value="NY">NY</option>
									<option value="NC">NC</option>
									<option value="ND">ND</option>
									<option value="OH">OH</option>
									<option value="OK">OK</option>
									<option value="OR">OR</option>
									<option value="PA">PA</option>
									<option value="RI">RI</option>
									<option value="SC">SC</option>
									<option value="SD">SD</option>
									<option value="TN">TN</option>
									<option value="TX">TX</option>
									<option value="UT">UT</option>
									<option value="VT">VT</option>
									<option value="VA">VA</option>
									<option value="WA">WA</option>
									<option value="WV">WV</option>
									<option value="WI">WI</option>
									<option value="WY">WY</option>
									<option value="AS">AS</option>
									<option value="DC">DC</option>
									<option value="FM">FM</option>
									<option value="GU">GU</option>
									<option value="MH">MH</option>
									<option value="MP">MP</option>
									<option value="PW">PW</option>
									<option value="PR">PR</option>
									<option value="VI">VI</option>
									<option value="AE">AE</option>
									<option value="AA">AA</option>
									<option value="AE">AE</option>
									<option value="AP">AP</option>
							</select> --><br>
							<input name="s_zip" placeholder=" Zip Code*" type="text"> &nbsp;
						<!-- 	<select name="s_country" placeholder=" Country*">
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
							</select> -->
							<?php
			}else if ($field->db_name == 'country'){

			
?>
			
			
				<select name="s_country" id="<?=$field->formName?>" placeholder=" Country*" required>
					<option value="000">Select a country*</option>
					<option name="US" value="US" <?=($field->value == 'US')?'selected':''?>>United States</option>
					<option name="CA" value="CA" <?=($field->value == 'CA')?'selected':''?>>Canada</option>
				</select><br>

			
			
<? } } ?>
							<input type="checkbox" name="email_updates" value=""> <span>Yes sign me up for email updates</span> <br>
							<input type="checkbox" name="share" value=""> <span>Share my creation with other users on MyChocolateBars.com</span> <br>
							<input type="submit" name="save" value="Save" class="btn orange rnd">
						</div>
						<!-- End Form Right Col -->
				</form>
			</div>
			<!-- End Left Side -->
			<div class="clear large-space"></div>
	</div>
	<!-- End 2 Col -->
</div>