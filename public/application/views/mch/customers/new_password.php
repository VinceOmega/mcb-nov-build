<div id="content">
			<div id="section-header">
				<h2 class="curly">Customers - New password</h2>
			</div><!-- header -->
			<div id="customers_new_password_content">
<?			if (isset($link_expired)) { ?>
				Sorry, this link has already expired.
<?			} else if (FALSE == isset($password_changed)) { ?>
				<form method="POST" action="/customers/new_password?hash=<?=$_GET['hash']?>">
					Type your new password: <input type="password" name="new_password" />
					<span style="color:red;"><?=isset($errors['new_password'])?$errors['new_password']:''?></span>
					<br />
					Repeat your new password: <input type="password" name="new_password_again" />
					<span style="color:red;"><?=isset($errors['new_password_again'])?$errors['new_password_again']:''?></span>
					<br />
					<input type="submit" value="Save new password" />
				</form>
<?			} else { ?>
				Your password has successfully been changed. You may now login with your new password.<br />
				<form method="POST" action="/customers/login">
					Email: <input type="text" name="email" /><br />
					Password: <input type="password" name="password" />
					<br />
					<input type="submit" value="Sign in" />
				</form>
<?			} ?>
			</div>