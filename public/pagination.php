<?
foreach($_REQUEST as $k => $v){
		$$k = $v;
}


// print_r($_REQUEST);

// echo $ust; echo "<br>"; echo $ost;

$username = 'mch_user';
$password = 'Jmc88$w3pk';

$db = new mysqli('localhost', $username, $password, 'mch');
		if($db->connect_errno){
			printf("Connect failed: %s\n", $db->connect_error);
			exit();
		}


$uquery = $db->query("SELECT o.id, ob.order_id, ob.product_id, o.user_id, image 
							FROM orders as o 
							LEFT JOIN orders_baskets as ob 
							ON o.id = ob.order_id 
							LEFT JOIN products as p 
							ON p.id = ob.product_id 
							LEFT JOIN products_descriptions as pd
							ON pd.id = p.products_description_id 
							WHERE o.user_id = 26
							ORDER BY o.id DESC LIMIT $ust, 10");
// var_dump($uquery);
// die();

while($row = mysqli_fetch_assoc($uquery)){
	echo "<pre>";
	print_r($row);
	echo "</pre><br>";
}
$oquery = $db->query("SELECT * FROM user_designs WHERE userid = 26 ORDER BY id DESC LIMIT $ost, 10");


while($row = mysqli_fetch_assoc($oquery)){
	echo "<pre>";
	print_r($row);
	echo "</pre><br>";
}