<?php
	// $db=new Database;
	// 	$order = ORM::factory('order')
	// 					->where('sessionID',$this->session->id())
	// 					->in('statusID',array(1,3))
	// 					->find();
	// 	$order->refreshTotals();
		
	// 	if ($order->id != 0)
	// 	{
	// 		$resultall = $db->query('SELECT orders_baskets.id as id, orders_baskets.qty as qty, orders_baskets.rate as rate, 
	// 			orders_baskets.subtotal as subtotal, orders_baskets.product_id as product_id, orders_baskets.designpath as designpath, 
	// 			products.name as productname, products.kind as kind, products_descriptions.image as productimage, 
	// 			products_descriptions.short_description as productdescription, orders_baskets.packaging_qty, orders_baskets.packaging_rate, 
	// 			orders_baskets.second_side_fee FROM orders_baskets 
	// 			LEFT JOIN products ON orders_baskets.product_id = products.id 
	// 			LEFT JOIN products_descriptions ON products.products_description_id = products_descriptions.id 
	// 			WHERE orders_baskets.order_id = '.$order->id.'');
	// 	} else {
	// 		$resultall = array();
	// 	}


	              $db=new Database;
                $result = $db->query('SELECT id, subtotal FROM orders WHERE sessionID = \''.$this->session->id().'\' AND statusID IN (1,3)');
        $this->template->content->order = $result[0];
                $rows = count($result);
                
                if($rows  > 0)
                        $orderid = $result[0]->id;
                else 
                        $orderid = 0;
     if($orderid != 0){ 
		$packageid = $db->query('SELECT orders_baskets.id as id, orders_baskets.product_id as productid
				FROM orders_baskets 
				LEFT JOIN products ON orders_baskets.product_id = products.id 
				LEFT JOIN products_descriptions ON products.products_description_id = products_descriptions.id
				LEFT JOIN user_designs ON user_designs.productid = products.id 
				WHERE orders_baskets.order_id = '.$orderid.' 
				AND orders_baskets.id = (SELECT DISTINCT MAX(ord.id) FROM orders_baskets as ord WHERE orders_baskets.id = ord.id )');
} else {
	$packageid = array();
}

	

		if ($orderid != 0)
		{
			$resultall = $db->query('SELECT orders_baskets.id as id, orders_baskets.order_id as order_id, orders_baskets.qty as qty, orders_baskets.rate as rate, 
				orders_baskets.subtotal as subtotal, orders_baskets.product_id as product_id, orders_baskets.designpath as designpath, user_designs.wrapper_designpath as wrapperpath,
				products.name as productname, products.kind as kind, products_descriptions.image as productimage, 
				products_descriptions.short_description as productdescription, orders_baskets.packaging_qty, orders_baskets.packaging_rate, 
				orders_baskets.second_side_fee FROM orders_baskets 
				LEFT JOIN products ON orders_baskets.product_id = products.id 
				LEFT JOIN products_descriptions ON products.products_description_id = products_descriptions.id
				LEFT JOIN user_designs ON user_designs.order_id = orders_baskets.order_id 
				WHERE orders_baskets.order_id = '.$orderid.'');
		}else  {
			$resultall = array();
		}

		$itemsresults = $resultall;
		$rows = array();
		$total = "";
		$items = 0;
//echo "<pre>";
//print_r($resultall);
foreach($resultall as $item){

if($item->subtotal){
	 $total = $item->subtotal;
		}
if($item->id){
	$items++;
}

//print_r($item);
}
// echo $total;
// echo $items;

//echo "</pre>";

	
	



?>

<div id="container">
	<!-- Header Start -->
	<header id="header" class="row">
		<div class="col-md-4 col-lg-4 col-sm-4 col-xs-4">
			<a href="http://<?=My_Template_Controller::getCurrentSite()->url?>" title="MyChocolateBars.com - Custom Chocolate Hearts"><img src="/env/images/<?=
My_Template_Controller::getViewPrefix()?>/mcb_logo.png" alt="MyChocolateBars.com - Custom Chocolate Bars" class="logo"/></a></div>
<?			if (User_Model::logged_in())
			{
				$user = User_Model::logged_user();
	?>
<div class="col-md-3 col-lg-3 col-sm-3 col-xs-3">

<?			} else { ?>
<div class="col-md-4 col-lg-4 col-sm-4 col-xs-4">
<? } ?>
				<ul class="social">
					<li><a href="#"><img src="/env/images/mcb/g_plus.png" alt="google+ icon"></a></li>
					<li><a href="#"><img src="/env/images/mcb/linkedin.png" alt="linkedin icon"></a></li>
					<li><a href="#"><img src="/env/images/mcb/facebook.png" alt="facebook icon"></a></li>
					<li><a href="#"><img src="/env/images/mcb/twitter.png" alt="twitter icon"></a></li>
				</ul>
		</div>
<?			if ($items  != 0 | User_Model::logged_in())
			{
				$user = User_Model::logged_user();
	?>
	<? if($user){?>
		<div class="col-md-5 col-lg-5 col-sm-5 col-xs-5 right-side">
		<?} else {?>
		<div class="col-md-4 col-lg-4 col-sm-4 col-xs-4 right-side">
		<? } ?>
			<div class="col-md-7 col-lg-7 col-sm-7 col-xs-7">
				<img src="/env/images/mcb/cust_log_icon.png" alt="Customer Login">Hello, <? if(isset($user->firstname)) echo $user->firstname; else echo "Guest";?> <br>
			<? if($user){ ?>	<a href="/customers/my_account">My Account Details</a> | <a href="/customers/logout"> Sign Out </a> <?} else { ?> <a href="/customers/login">Login</a>&nbsp;|&nbsp;<a href="/customers/register">Register</a> <? } ?>
			</div>
			<div class="col-md-5 col-lg-5 col-sm-5 col-xs-5">
				<span class="cart"><?php if($items){ echo $items; } else{ echo 0 ;}?></span>
				<span class="price">$<?php if($total){ echo money_format('%.2n', $total);} else { echo 0;}?></span>
			</div>
		</div>
<?			} else { ?>
		<div class="col-md-4 col-lg-4 col-xs-4 col-sm-4">
				<img src="/env/images/mcb/cust_log_icon.png" alt="Customer Login">Customer Login<br>
				<form action="/customers/login" method="POST" name="customer_login_form">
					<input type="text" name="email" value="" placeholder="email" required> <input type="submit" name="login" value="Sign In" class="rnd btn orange"><br>
					<input type="password" name="password" value="" placeholder="password" required> <a href="customers/forgot_password" class="reset-pwd">Forgot Password?</a>
					
				</form>

		</div>
<?			} ?>
	</header><!-- header -->
		
<!-- Nav Begin -->
<nav id="navigation" class="rnd-10 rnd-bar brown">
				<ul class="nav">
					<li class="home selected"><a href="/">Home</a></li>
					<li class="products"><a href="/products">Products</a></li>
					<li class="shopping"><a href="/shopping_cart">Shopping Cart</a></li>
					<li class="class"><a href="/faq">FAQ</a></li>
					<li class="about"><a href="/about">About Us</a></li>
					<li class="contact"><a href="/contact">Contact Us</a></li>
				</ul>
			</nav>
<!-- Nav End -->