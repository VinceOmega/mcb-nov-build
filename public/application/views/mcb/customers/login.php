<div id="content">
			<div id="section-header">
				<h2 class="curly">Customers - Login</h2>
			</div><!-- header -->
			<div id="customers_login_content">
				<form method="POST" action="/customers/login<?=isset($_GET['redirect'])?'?redirect='.$_GET['redirect']:''?>">
					<?=$errors!=''?'<div class="errors">'.$errors.'</div>':''?>
					Email: <input type="text" name="email" value="<?=$email?>" /><br />
					Password: <input type="password" name="password" />
					<input type="hidden" name="redirect" value="<?=isset($_GET['redirect'])?urldecode($_GET['redirect']):''?>" />
					<br />
					<input type="submit" value="Sign in" />
				</form>
				<a href="/customers/forgot_password">Forgot password?</a>
			</div>