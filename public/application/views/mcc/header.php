	<div id="root">
		<div id="header">
			<h1><a href="http://<?=My_Template_Controller::getCurrentSite()->url?>" title="MyChocolateCoins.com - Custom Chocolate Coins"><img src="/env/images/<?=
My_Template_Controller::getViewPrefix()?>/logo.png" alt="MyChocolateCoins.com - Custom Chocolate Coins"/></a></h1>
			
			
			
			
<?			if (User_Model::logged_in())
			{
				$user = User_Model::logged_user();
	?>
			<div id="login_box" class="logged">
				<a class="logout" href="/customers/logout"><img src="/env/images/login/logout_btn.jpg" /></a>
				Logged in as: <strong><?=$user->firstname.' '.$user->lastname?></strong><br />
				<a href="/customers/my_account" class="my-account">View My Account Details</a><br />
				<div>
					<a href="http://www.facebook.com/pages/My-Chocolate-Coins/260316684083530" target="_blank"><img src="/env/images/facebook.png" /></a>
					<a href="https://twitter.com/ChocolateCoins1" target="_blank"><img src="/env/images/twitter.png" /></a>
					<div class="g-plusone" data-annotation="none"></div>
					<script type="text/javascript">
					(function() {
					  var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
					  po.src = 'https://apis.google.com/js/plusone.js';
					  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
					})();
				  </script>
				</div>
			</div>
<?			} else { ?>
			<div id="login_box" class="login">
				<form method="POST" action="/customers/login">
					<div class="col">
						<img src="/env/images/login/customer_login.jpg" /><br />&nbsp;
					</div>
					<div class="col">
						<input type="text" name="email" value="Type your email." onfocus="if($(this).val()=='Type your email.') $(this).val('');" onblur="if($(this).val()=='') $(this).val('Type your email.');" /><br />
						<input type="password" name="password" placeholder="Type your password." value="********" />
					</div>
					<div class="col" style="margin-left: 5px;">
						<button type="submit"><img src="/env/images/login/sign_in_btn.jpg" /></button><br />
						<a href="/customers/forgot_password"><img src="/env/images/login/forgot_password_btn.jpg" /></a>
					</div><br />
					<div style="float: left;text-align: right;width: 100%; margin-top: 3px;">
						<a href="http://www.facebook.com/pages/My-Chocolate-Coins/260316684083530" target="_blank"><img src="/env/images/facebook.png" /></a>
						<a href="https://twitter.com/ChocolateCoins1" target="_blank"><img src="/env/images/twitter.png" /></a>
						<div class="g-plusone" data-annotation="none"></div>
						<script type="text/javascript">
						(function() {
						  var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
						  po.src = 'https://apis.google.com/js/plusone.js';
						  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
						})();
					  </script>
					</div>
				</form>
			</div>
<?			} ?>
			
			
			
			
		</div><!-- header -->
		
		<div id="upper-nav" style="border-radius: 10px 10px 0px 0px;">
		<?php foreach ($links as $title => $url): ?>
			<?php $alter = ''; if($title == 'Home') $alter = 'MyChocolateCoins.com'; else $alter = $title; $alter = str_replace('Us', 'MyChocolateCoins.com', $alter);?>
			<a class="heart" href="<?php echo $url; ?>" title="<?php echo $alter; ?>"><?php echo $title; ?></a>
		<?php endforeach ?>
		</div><!-- upper-nav -->