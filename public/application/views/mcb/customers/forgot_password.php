<div id="content">
			<div id="section-header">
				<h2 class="curly">Customers - Forgot password?</h2>
			</div><!-- header -->
			<div id="customers_forgot_password_content">
<?				if (FALSE == isset($email_sent)) { ?>
				<form method="POST" action="/customers/forgot_password">
					<?=$errors!=''?'<div class="errors">'.$errors.'</div>':''?>
					Please type your email: <input type="text" name="email" value="<?=$email?>" /><br />
					<input type="submit" value="Send" />
				</form>
<?				} else { ?>
				An email has been sent with instructions on how to reset your password. Please check your email in the next few minutes.
<?				} ?>
			</div>