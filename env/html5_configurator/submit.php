<?
 ini_set('display_errors',1);  error_reporting(E_ALL);
 if(empty($_SESSION)){
 	session_start();
 }

	include 'config.php';
	include 'bar_preview.php';
	include 'wrapper_preview.php';
	

		$db = new mysqli($config['default']['connection']['host'], $config['default']['connection']['user'], $config['default']['connection']['pass'], $config['default']['connection']['database']);
		if($db->connect_errno){
			printf("Connect failed: %s\n", $db->connect_error);
			exit();
		}


		$post = $_POST;
		
		
		// $user = User_Model::logged_user();
		// $session = $_SESSION;
		print_r($post);
	//	print_r($session);
		// die();

		
		if($post['conf_type'] === 'bar'){

// $base = new \Imagick();
// if(isset($post['layer_top']) && $post['layer_top'] != "")
// $layout = new \Imagick('/var/www/mch/'.$post['layer_top']);

$bar_values =  array(
		'base' => $base,
		'layer_top' => $layer_top,
		'layer_top_x' => $layer_top_x,
		'layer_top_y' => $layer_top_y,
		'line_1' => $line_one,
		'line_2' => $line_two,
		'line_3' => $line_three,
		'line_4' => $line_four,
		'line_1_font' => $line_one_font,
		'line_2_font' => $line_two_font,
		'line_3_font' => $line_three_font,
		'line_4_font' => $line_four_font,
		'line_1_size' => $line_one_size,
		'line_2_size' => $line_two_size,
		'line_3_size' => $line_three_size,
		'line_4_size' => $line_four_size,
		'line_1_x' => $line_1_x,
		'line_2_x' => $line_2_x,
		'line_3_x' => $line_3_x,
		'line_4_x' => $line_4_x,
		'line_1_y' => $line_1_y,
		'line_2_y' => $line_2_y,
		'line_3_y' => $line_3_y,
		'line_4_y' => $line_4_y,
		'image_uploaded' => $image_uploaded
	);

$ext = ".".trim(pathinfo($a['base'], PATHINFO_EXTENSION));
$filename_bar = basename($a['base'], $ext);

if($filename_bar === 'combo-1-75' ||
	$filename_bar === 'dark-1-75' ||
	$filename_bar === 'milk-1-75'){
	$barpath = tinyBar($a);
}

if($filename_bar === 'combo-14-8' ||
	$filename_bar === 'dark-14-8' ||
	$filename_bar === 'milk-14-8'){
	$barpath = smallBar($a);
}


if($filename_bar === 'combo-5-2' ||
	$filename_bar === 'dark-5-2' ||
	$filename_bar === 'milk-5-2'){
	$barpath = mediumBar($a);
}


if($filename_bar === 'combo-4-6' ||
	$filename_bar === 'dark-4-6' ||
	$filename_bar === 'milk-4-6'){
	$barpath = largeBar($a);
}


if($filename_bar === 'combo-9-5-8' ||
	$filename_bar === 'dark-9-5-8' ||
	$filename_bar === 'milk-9-5-8'){
	$barpath = kingBar($a);
}


// $img = '/var/www/mch'.$post['base'];
// $size = getimagesize($img);
// $h = ($size[0])/3;
// $w = ($size[1])/3;
// $h = 100;
// $w = 100;



// $date = date('Y_m_d_H_i_s');
// if(isset($post['layer_top']) && $post['layer_top'] != ""){
// $layout->resizeImage($w, $h, Imagick::FILTER_LANCZOS, 1);
// $base->compositeImage($layout, Imagick::COMPOSITE_OVERLAY, 100, 30);
// }
// $bar = $base->writeImage("/var/www/mch/env/html5_configurator/img/design/$post[sessionid]-$date-output.png");
// $barpath = "env/html5_configurator/img/design/$post[sessionid]-$date-output.png";


		$sql = "INSERT into temp_orders
		SET sessionID = '$post[sessionid]',
			productID = '$post[productsid]',
			flavorID = '$post[bar_type]',
			foilID = 9,
			order_msg_text1 = '$post[line_one]',
			order_msg_text2 = '$post[line_two]',
			order_msg_text3 = '$post[line_three]',
			order_msg_text4 = '$post[line_four]',
			order_msg_font1 = '$post[line_one_font]',
			order_msg_font2 = '$post[line_two_font]',
			order_msg_font3 = '$post[line_three_font]',
			order_msg_font4 = '$post[line_four_font]',
			order_msg_size1 = '$post[line_one_size]',
			order_msg_size2 = '$post[line_two_size]',
			order_msg_size3 = '$post[line_three_size]',
			order_msg_size4 = '$post[line_four_size]',
			styleID = 1,
			order_clip_path = '$post[layer_top]',
			order_bg_path = null,
			order_design_path = '$barpath',
			order_qty = 200,
			order_rate = 1,
			order_total = 200*1,
			added = 0,
			cust_type = '$post[conf_type]'";
			if(!$result = $db->query($sql)){
				printf(mysqli_error($db));
								}
			
			$db->close();
			// session_start();
			$bar = array(
					'productsid' => '$post[productsid]',
					'line_one' => '$post[line_one]',
					'line_two' => '$post[line_two]',
					'line_three' => '$post[line_three]',
					'line_four' => '$post[line_four]',
					'line_one_font' => '$post[line_one_font]',
					'line_two_font' => '$post[line_two_font]',
					'line_three_font' => '$post[line_three_font]',
					'line_four_font' => '$post[line_four_font]',
					'line_one_size' => '$post[line_one_size]',
					'line_two_size' => '$post[line_two_size]',
					'line_three_size' => '$post[line_three_size]',
					'line_four_size' => '$post[line_four_size]',
					'style_top' => '$post[layer_top]',
				);
			$_COOKIE["bar"] = $bar;
			//header("Location:/products/wrapper/$post[productname]");
		return true;
		}

		if($post['conf_type'] === 'wrapper'){

			$a = array(
		'base' => $wrapper,
		'layer_top' => $layer_top,
		'layer_top_x' => $layer_top_x,
		'layer_top_y' => $layer_top_y,
		'line_1' => $line_1,
		'line_2' => $line_2,
		'line_3' => $line_3,
		'line_4' => $line_4,
		'line_1_font' => $line_1_font,
		'line_2_font' => $line_2_font,
		'line_3_font' => $line_3_font,
		'line_4_font' => $line_4_font,
		'line_1_size' => $line_1_size,
		'line_2_size' => $line_2_size,
		'line_3_size' => $line_3_size,
		'line_4_size' => $line_4_size,
		'line_1_x' => $line_1_x,
		'line_2_x' => $line_2_x,
		'line_3_x' => $line_3_x,
		'line_4_x' => $line_4_x,
		'line_1_y' => $line_1_y,
		'line_2_y' => $line_2_y,
		'line_3_y' => $line_3_y,
		'line_4_y' => $line_4_y,
		'image_uploaded' => $image_uploaded,
		'red' => $red,
		'green' => $green,
		'blue' => $blue,
		'red_text' => $red_text,
		'green_text' => $green_text,
		'blue_Text' => $blue_text
	);

$wrapperpath = !$post['wrapper'] ? $post['base'] : $post['wrapper'];
// echo $wrapperpath;
// die();
if(isset($post['layer_top']) && $post['layer_top'] != ""){
$layout = new \Imagick('/var/www/mch/'.$post['layer_top']);
}
$wrapperbase = new \Imagick($wrapperpath);
$mask = new \Imagick("/var/www/mch/env/images/mcb/wrapper.png");
//$wrapperpath = '/var/www/mch'.$post['base'];



$wsize = getimagesize($wrapperpath);

//print_r($size);
// $h = ($size[0])/3;
// $w = ($size[1])/3;
$h = 100;
$w = 100;
if(isset($post['layer_top']) && $post['layer_top'] != ""){
$layout->resizeImage($w, $h, Imagick::FILTER_LANCZOS, 1);
}
$wrapperbase->resizeImage(1020, 210, Imagick::INTERPOLATE_BICUBIC, 1);
if(isset($post['layer_top']) && $post['layer_top'] != ""){
$mask->compositeImage($layout, Imagick::COMPOSITE_OVERLAY, 70, 50);
$wrapperbase->compositeImage($mask, Imagick::COMPOSITE_OVERLAY, 400, 0);
}
$date = date('Y_m_d_H_i_s');
$wrapperbase->writeImage("/var/www/mch/env/html5_configurator/img/design/$post[sessionid]-$date-output2.png");
$wrapperpath = "env/html5_configurator/img/design/$post[sessionid]-$date-output2.png";
		$sql = "INSERT into temp_orders
		SET sessionID = '$post[sessionid]',
			productID = '$post[productsid]',
			flavorID = 'none',
			foilID = 9,
			order_msg_text1 = '$post[line_one]',
			order_msg_text2 = '$post[line_two]',
			order_msg_text3 = '$post[line_three]',
			order_msg_text4 = '$post[line_four]',
			order_msg_font1 = '$post[line_one_font]',
			order_msg_font2 = '$post[line_two_font]',
			order_msg_font3 = '$post[line_three_font]',
			order_msg_font4 = '$post[line_four_font]',
			order_msg_size1 = '$post[line_one_size]',
			order_msg_size2 = '$post[line_two_size]',
			order_msg_size3 = '$post[line_three_size]',
			order_msg_size4 = '$post[line_four_size]',
			styleID = 1,
			order_clip_path = '$post[layer_top]',
			order_bg_path = '$post[wrapper]',
			order_design_path = '$wrapperpath',
			order_qty = 0,
			order_rate = 1,
			order_total = 0*1,
			added = 0,
			cust_type = '$post[conf_type]'";

			// session_start();
			$wrapper = array(
					'productsid' => '$post[productsid]',
					'line_one' => '$post[line_one]',
					'line_two' => '$post[line_two]',
					'line_three' => '$post[line_three]',
					'line_four' => '$post[line_four]',
					'line_one_font' => '$post[line_one_font]',
					'line_two_font' => '$post[line_two_font]',
					'line_three_font' => '$post[line_three_font]',
					'line_four_font' => '$post[line_four_font]',
					'line_one_size' => '$post[line_one_size]',
					'line_two_size' => '$post[line_two_size]',
					'line_three_size' => '$post[line_three_size]',
					'line_four_size' => '$post[line_four_size]',
					'style_top' => '$post[layer_top]',
				);
			$_COOKIE["wrapper"] = $wrapper;

			if(!$result = $db->query($sql)){
				printf(mysqli_error($db));
	
							}
			$sql = "SELECT id, 
			sessionID, 
			productID, 
			flavorID, 
			foilID, 
			styleID, 
			order_clip_path, 
			order_bg_path, 
			order_design_path, 
			order_qty, 
			order_rate, 
			order_total, 
			cust_type  
			FROM temp_orders 
			WHERE sessionID = '$post[sessionid]'  
			AND cust_type = 'bar'
			ORDER BY id DESC LIMIT 1";
			if(!$result = $db->query($sql)){
				printf(mysqli_error($db));
			}
			$row = array();
			while($rows = mysqli_fetch_assoc($result)){
				$row[] = $rows;
			}

			foreach($row[0] as $key => $value){
				$$key = $value;
				echo $value."</br>";
			}
				echo "bar info"."</br>";
				 print_r($row);
				$id = $row[0]['id'];

					$sql = "SELECT id 
					FROM temp_orders 
					WHERE cust_type = 'wrapper' 
					AND sessionID = '$post[sessionid]'
					ORDER BY id DESC LIMIT 1";
			if(!$result = $db->query($sql)){
				printf(mysqli_error($db));
			}
		
			$roww = array();
			while($rows = mysqli_fetch_assoc($result)){
				$roww[] = $rows;
			}

				echo "wrapper info"."</br>";
				 print_r($roww);
				$wid = $roww[0]['id'];
			
		

			// $sql = "SELECT MAX(id) FROM orders WHERE sessionID = '$post[sessionid]' AND user_id = '$post[userid]'";
					
			// 		if(!$result = $db->query($sql)){
		 // 				printf(mysqli_error($db));
	
		 // 					}

			// 	$rowr = array();
			// while($rows = mysqli_fetch_assoc($result)){
			// 	$rowr[] = $rows;
			// }
			// 	echo "orders info"."</br>";
			// 	print_r($rowr);
			// 	$orderid = $rowr[0]['MAX(id)'];





		 	$sql = "SELECT id, sessionID, productID, flavorID, foilID, styleID, order_msg_text1, order_msg_text2, order_msg_text3, order_msg_text4, order_msg_font1, order_msg_font2, order_msg_font3, order_msg_font4, order_msg_size1, order_msg_size2, order_msg_size3, order_msg_size4, order_msg_color1, order_msg_color2, order_msg_color3, order_msg_color4, order_clip_path, order_bg_path, order_design_path, order_qty, order_rate, order_total, cust_type  FROM temp_orders WHERE cust_type = 'bar' AND sessionID = '$post[sessionid]' ORDER BY id DESC LIMIT 1";
			if(!$result = $db->query($sql)){
				printf(mysqli_error($db));
			}

			$row = array();
			while($rows = mysqli_fetch_assoc($result)){
				$row[] = $rows;
			}
				$bar = array();
			foreach($row[0] as $key => $value){
				$bar["$key"] = $value;
			}
				echo "bar". "<br>";
				 print_r($bar);
				 echo "<br>";
				$id = $row[0]['id'];

				$sql = "SELECT sessionID, id FROM `orders` WHERE sessionID = '$post[sessionid]' LIMIT 1";

					if(!$result = $db->query($sql)){
						printf(mysqli_error($db));
					}

				$id_row[] = array();

				while($rows = mysqli_fetch_assoc($result)){
					$id_row[] = $rows;
				}

				print_r($id_row);


				if($id_row[1]['id'] != null && $id_row[1]['id'] != ""){

					$orderid = $id_row[1]['id'];

				} else {

					$sql = "SELECT sessionID, id FROM `orders` WHERE sessionID = '$post[sessionid]' ORDER BY id DESC LIMIT 1";

					if(!$result = $db->query($sql)){
						printf(mysqli_error($db));
					}

						$id_row[] = array();

				while($rows = mysqli_fetch_assoc($result)){
					$id_row[] = $rows;
				
				}

					$orderid = $id_row[1]['id'];
					$orderid++;

				// print_r($id_row);



				}

					$mcbtransid = "MCB".rand(1000000000, 9999999999);

					$sql = "INSERT into orders
					SET sessionID = '$post[sessionid]',
					user_id = '$post[userid]',
					statusID = 1,
					trans_id = '$mcbtransid'";

					if(!$result = $db->query($sql)){
		 				printf(mysqli_error($db));
	
		 					}



			echo "<pre>";
			echo "$orderid"."<br>";
			echo "$productID"."<br>";
			echo "$flavorID"."<br>";
			echo "$foilID"."<br>";
			echo "$wid"."<br>";
			echo "$styleID"."<br>";
			echo "$order_clip_path"."<br>";
			echo "$order_design_path"."<br>";
			echo "$order_rate"."<br>";
			echo "$order_qty"."<br>";
			echo "$cust_type";
			echo "</pre>";
			print_r($bar);		
			// die();
			
		
			$sql = "INSERT into orders_baskets
					SET order_id = '$orderid',
					product_id = '$bar[productID]',
					flavor_id = '$bar[flavorID]',
					foil_id = '$bar[foilID]',
					packaging_id = '$wid',
					style_id = '$bar[styleID]',
					clippath = '$bar[order_clip_path]',
					designpath = '$bar[order_design_path]',
					wrapperpath = '$wrapperpath',
					rate = '$bar[order_rate]',
					qty = '$bar[order_qty]',
					packaging_rate = 0.00,
					packaging_qty = 0,
					options = null,
					subtotal = '$bar[order_rate]'*'$bar[order_qty]',
					img_approved = 1,
					second_side_fee = 0.00,
					basket_with_fee = 0,
					cust_type = 'bar'";

					if(!$result = $db->query($sql)){
		 		printf(mysqli_error($db));
	
		 					}

					$sql = "SELECT id, sessionID, productID, flavorID, foilID, styleID, order_msg_text1, order_msg_text2, order_msg_text3, order_msg_text4, order_msg_font1, order_msg_font2, order_msg_font3, order_msg_font4, order_msg_size1, order_msg_size2, order_msg_size3, order_msg_size4, order_msg_color1, order_msg_color2, order_msg_color3, order_msg_color4, order_clip_path, order_bg_path, order_design_path, order_qty, order_rate, order_total, cust_type FROM temp_orders WHERE cust_type = 'wrapper' AND sessionID = '$post[sessionid]' ORDER BY id DESC LIMIT 1";
			if(!$result = $db->query($sql)){
				printf(mysqli_error($db));
			}
		
			$roww = array();
			while($rows = mysqli_fetch_assoc($result)){
				$roww[] = $rows;
			}

				echo "wrapper". "<br>";
				$wrapper = array();

			foreach($roww[0] as $key => $value){
				$wrapper["$key"] = $value;
			}



				 print_r($wrapper);
				$wid = $roww[0]['id'];
			

		 		
$sql = "UPDATE user_designs
					SET userid = '$post[userid]',
					statusid = 1,
					productid = '$bar[productID]',
					flavorid = '$bar[flavorID]',
					foilid = '$bar[foilID]',
					packageid = '$wid',
					styleid = '$bar[styleID]',
					clippath = '$bar[order_clip_path]',
					designpath = '$bar[order_design_path]',
					designcolor = null,
					wrapper_clippath = '$wrapper[order_clip_path]',
					wrapper_designpath = '$wrapper[order_design_path]',
					wrapper_designcolor = null,
					text1 = '$bar[order_msg_text1]',
					text2 = '$bar[order_msg_text2]',
					text3 = '$bar[order_msg_text3]',
					text4 = '$bar[order_msg_text4]',
					textsize1 = '$bar[order_msg_size1]',
					textsize2 = '$bar[order_msg_size2]',
					textsize3 = '$bar[order_msg_size3]',
					textsize4 = '$bar[order_msg_size4]',
					textfont1 = '$bar[order_msg_font1]',
					textfont2 = '$bar[order_msg_font2]',
					textfont3 = '$bar[order_msg_font3]',
					textfont4 = '$bar[order_msg_font4]',
					textcolor1 = '$bar[order_msg_color1]',
					textcolor2 = '$bar[order_msg_color2]',
					textcolor3 = '$bar[order_msg_color3]',
					textcolor4 = '$bar[order_msg_color4]',
					wrapper_text1 = '$wrapper[order_msg_text1]',
					wrapper_text2 = '$wrapper[order_msg_text2]',
					wrapper_text3 = '$wrapper[order_msg_text3]',
					wrapper_text4 = '$wrapper[order_msg_text4]',
					wrapper_size1 = '$wrapper[order_msg_size1]',
					wrapper_size2 = '$wrapper[order_msg_size2]',
					wrapper_size3 = '$wrapper[order_msg_size3]',
					wrapper_size4 = '$wrapper[order_msg_size4]',
					wrapper_font1 = '$wrapper[order_msg_font1]',
					wrapper_font2 = '$wrapper[order_msg_font2]',
					wrapper_font3 = '$wrapper[order_msg_font3]',
					wrapper_font4 = '$wrapper[order_msg_font4]',
					wrapper_color1 = '$wrapper[order_msg_color1]',
					wrapper_color2 = '$wrapper[order_msg_color2]',
					wrapper_color3 = '$wrapper[order_msg_color3]',
					wrapper_color4 = '$wrapper[order_msg_color4]',
					rate = '$bar[order_rate]',
					qty = '$bar[order_qty]',
					subtotal = '$bar[order_rate]'*'$bar[order_qty]',
					share = 0,
					cust_type = '$post[conf_type]'
					WHERE order_id = '$orderid'";

					if(!$result = $db->query($sql)){
		 		printf(mysqli_error($db));
	
		 					}


				return true;
		 				
				}
		

				if($post['conf_type'] === 'save'){
		 			

$wrapperpath = !$post['wrapper'] ? $post['base'] : $post['wrapper'];
// echo $wrapperpath;
// die();
if(isset($post['layer_top']) && $post['layer_top'] != ""){
$layout = new \Imagick('/var/www/mch/'.$post['layer_top']);
}
$wrapperbase = new \Imagick($wrapperpath);
$mask = new \Imagick("/var/www/mch/env/images/mcb/wrapper.png");
//$wrapperpath = '/var/www/mch'.$post['base'];



$wsize = getimagesize($wrapperpath);

//print_r($size);
// $h = ($size[0])/3;
// $w = ($size[1])/3;
$h = 100;
$w = 100;
if(isset($post['layer_top']) && $post['layer_top'] != ""){
$layout->resizeImage($w, $h, Imagick::FILTER_LANCZOS, 1);
}
$wrapperbase->resizeImage(1020, 210, Imagick::INTERPOLATE_BICUBIC, 1);
if(isset($post['layer_top']) && $post['layer_top'] != ""){
$mask->compositeImage($layout, Imagick::COMPOSITE_OVERLAY, 70, 50);
$wrapperbase->compositeImage($mask, Imagick::COMPOSITE_OVERLAY, 400, 0);
}
$date = date('Y_m_d_H_i_s');
$wrapperbase->writeImage("/var/www/mch/env/html5_configurator/img/design/$post[sessionid]-$date-output2.png");
$wrapperpath = "env/html5_configurator/img/design/$post[sessionid]-$date-output2.png";
		$sql = "INSERT into temp_orders
		SET sessionID = '$post[sessionid]',
			productID = '$post[productsid]',
			flavorID = 'none',
			foilID = 9,
			order_msg_text1 = '$post[line_one]',
			order_msg_text2 = '$post[line_two]',
			order_msg_text3 = '$post[line_three]',
			order_msg_text4 = '$post[line_four]',
			order_msg_font1 = '$post[line_one_font]',
			order_msg_font2 = '$post[line_two_font]',
			order_msg_font3 = '$post[line_three_font]',
			order_msg_font4 = '$post[line_four_font]',
			order_msg_size1 = '$post[line_one_size]',
			order_msg_size2 = '$post[line_two_size]',
			order_msg_size3 = '$post[line_three_size]',
			order_msg_size4 = '$post[line_four_size]',
			styleID = 1,
			order_clip_path = '$post[layer_top]',
			order_bg_path = '$post[wrapper]',
			order_design_path = '$wrapperpath',
			order_qty = 200,
			order_rate = 1,
			order_total = 200*1,
			added = 0,
			cust_type = '$post[conf_type]'";

			if(!$result = $db->query($sql)){
				printf(mysqli_error($db));
								}

				$sql = "SELECT id, sessionID, productID, flavorID, foilID, styleID, order_msg_text1, order_msg_text2, order_msg_text3, order_msg_text4, order_msg_font1, order_msg_font2, order_msg_font3, order_msg_font4, order_msg_size1, order_msg_size2, order_msg_size3, order_msg_size4, order_msg_color1, order_msg_color2, order_msg_color3, order_msg_color4, order_clip_path, order_bg_path, order_design_path, order_qty, order_rate, order_total, cust_type  FROM temp_orders WHERE cust_type = 'bar' AND sessionID = '$post[sessionid]' ORDER BY id DESC LIMIT 1";
			if(!$result = $db->query($sql)){
				printf(mysqli_error($db));
			}
			$row = array();
			while($rows = mysqli_fetch_assoc($result)){
				$row[] = $rows;
			}
				$bar = array();
			foreach($row[0] as $key => $value){
				$bar["$key"] = $value;
			}
				echo "bar". "<br>";
				 print_r($bar);
				 echo "<br>";
				$id = $row[0]['id'];

					$sql = "SELECT id, sessionID, productID, flavorID, foilID, styleID, order_msg_text1, order_msg_text2, order_msg_text3, order_msg_text4, order_msg_font1, order_msg_font2, order_msg_font3, order_msg_font4, order_msg_size1, order_msg_size2, order_msg_size3, order_msg_size4, order_msg_color1, order_msg_color2, order_msg_color3, order_msg_color4, order_clip_path, order_bg_path, order_design_path, order_qty, order_rate, order_total, cust_type FROM temp_orders WHERE cust_type = 'wrapper' AND sessionID = '$post[sessionid]' ORDER BY id DESC LIMIT 1";
			if(!$result = $db->query($sql)){
				printf(mysqli_error($db));
			}
		
			$roww = array();
			while($rows = mysqli_fetch_assoc($result)){
				$roww[] = $rows;
			}

				echo "wrapper". "<br>";
				$wrapper = array();

			foreach($roww[0] as $key => $value){
				$wrapper["$key"] = $value;
			}



				 print_r($wrapper);
				$wid = $roww[0]['id'];
			
	$sql = "SELECT order_id FROM user_designs WHERE order_id = '$orderid'";
			if(!$result = $db->query($sql)){
		 		printf(mysqli_error($db));
	
		 					}
		 					
		 				$roword = array();
		 		while($rows = mysqli_fetch_assoc($result)){
		 				$roword[] = $rows;
		 		}

 		echo "double check order id: ".$orderid."<br>";
		 		echo "check for order_id in user_designs table: "."<br>";

if(isset($roword[0])){
		 			print_r($roword);
		 			$exist = array();

		 		foreach($roword[0] as $key => $value){
							$exist["$key"] = $value;
						}

		 		
		 			$check_order_id = $exist["order_id"];
		 			}else {
	$check_order_id = "";
}

		 			if($check_order_id === $orderid && $check_order_id != 0){
$sql = "UPDATE user_designs
					SET userid = '$post[userid]',
					statusid = 1,
					productid = '$bar[productID]',
					flavorid = '$bar[flavorID]',
					foilid = '$bar[foilID]',
					packageid = '$wid',
					styleid = '$bar[styleID]',
					clippath = '$bar[order_clip_path]',
					designpath = '$bar[order_design_path]',
					designcolor = null,
					wrapper_clippath = '$wrapper[order_clip_path]',
					wrapper_designpath = '$wrapper[order_design_path]',
					wrapper_designcolor = null,
					text1 = '$bar[order_msg_text1]',
					text2 = '$bar[order_msg_text2]',
					text3 = '$bar[order_msg_text3]',
					text4 = '$bar[order_msg_text4]',
					textsize1 = '$bar[order_msg_size1]',
					textsize2 = '$bar[order_msg_size2]',
					textsize3 = '$bar[order_msg_size3]',
					textsize4 = '$bar[order_msg_size4]',
					textfont1 = '$bar[order_msg_font1]',
					textfont2 = '$bar[order_msg_font2]',
					textfont3 = '$bar[order_msg_font3]',
					textfont4 = '$bar[order_msg_font4]',
					textcolor1 = '$bar[order_msg_color1]',
					textcolor2 = '$bar[order_msg_color2]',
					textcolor3 = '$bar[order_msg_color3]',
					textcolor4 = '$bar[order_msg_color4]',
					wrapper_text1 = '$wrapper[order_msg_text1]',
					wrapper_text2 = '$wrapper[order_msg_text2]',
					wrapper_text3 = '$wrapper[order_msg_text3]',
					wrapper_text4 = '$wrapper[order_msg_text4]',
					wrapper_size1 = '$wrapper[order_msg_size1]',
					wrapper_size2 = '$wrapper[order_msg_size2]',
					wrapper_size3 = '$wrapper[order_msg_size3]',
					wrapper_size4 = '$wrapper[order_msg_size4]',
					wrapper_font1 = '$wrapper[order_msg_font1]',
					wrapper_font2 = '$wrapper[order_msg_font2]',
					wrapper_font3 = '$wrapper[order_msg_font3]',
					wrapper_font4 = '$wrapper[order_msg_font4]',
					wrapper_color1 = '$wrapper[order_msg_color1]',
					wrapper_color2 = '$wrapper[order_msg_color2]',
					wrapper_color3 = '$wrapper[order_msg_color3]',
					wrapper_color4 = '$wrapper[order_msg_color4]',
					rate = '$bar[order_rate]',
					qty = '$bar[order_qty]',
					subtotal = '$bar[order_rate]'*'$bar[order_qty]',
					share = 0,
					cust_type = '$post[conf_type]'
					WHERE order_id = '$orderid'";

					if(!$result = $db->query($sql)){
		 		printf(mysqli_error($db));
	
		 					}
echo "updated";

				return true;
		 				
		} else {
			
			$sql = "INSERT into user_designs
					SET userid = '$post[userid]',
					order_id = '$orderid',
					statusid = 1,
					productid = '$bar[productID]',
					flavorid = '$bar[flavorID]',
					foilid = '$bar[foilID]',
					packageid = '$wid',
					styleid = '$bar[styleID]',
					clippath = '$bar[order_clip_path]',
					designpath = '$bar[order_design_path]',
					designcolor = null,
					wrapper_clippath = '$wrapper[order_clip_path]',
					wrapper_designpath = '$wrapper[order_design_path]',
					wrapper_designcolor = null,
					text1 = '$bar[order_msg_text1]',
					text2 = '$bar[order_msg_text2]',
					text3 = '$bar[order_msg_text3]',
					text4 = '$bar[order_msg_text4]',
					textsize1 = '$bar[order_msg_size1]',
					textsize2 = '$bar[order_msg_size2]',
					textsize3 = '$bar[order_msg_size3]',
					textsize4 = '$bar[order_msg_size4]',
					textfont1 = '$bar[order_msg_font1]',
					textfont2 = '$bar[order_msg_font2]',
					textfont3 = '$bar[order_msg_font3]',
					textfont4 = '$bar[order_msg_font4]',
					textcolor1 = '$bar[order_msg_color1]',
					textcolor2 = '$bar[order_msg_color2]',
					textcolor3 = '$bar[order_msg_color3]',
					textcolor4 = '$bar[order_msg_color4]',
					wrapper_text1 = '$wrapper[order_msg_text1]',
					wrapper_text2 = '$wrapper[order_msg_text2]',
					wrapper_text3 = '$wrapper[order_msg_text3]',
					wrapper_text4 = '$wrapper[order_msg_text4]',
					wrapper_size1 = '$wrapper[order_msg_size1]',
					wrapper_size2 = '$wrapper[order_msg_size2]',
					wrapper_size3 = '$wrapper[order_msg_size3]',
					wrapper_size4 = '$wrapper[order_msg_size4]',
					wrapper_font1 = '$wrapper[order_msg_font1]',
					wrapper_font2 = '$wrapper[order_msg_font2]',
					wrapper_font3 = '$wrapper[order_msg_font3]',
					wrapper_font4 = '$wrapper[order_msg_font4]',
					wrapper_color1 = '$wrapper[order_msg_color1]',
					wrapper_color2 = '$wrapper[order_msg_color2]',
					wrapper_color3 = '$wrapper[order_msg_color3]',
					wrapper_color4 = '$wrapper[order_msg_color4]',
					rate = '$bar[order_rate]',
					qty = '$bar[order_qty]',
					subtotal = '$bar[order_rate]'*'$bar[order_qty]',
					share = 0,
					cust_type = '$post[conf_type]'";

					if(!$result = $db->query($sql)){
		 		printf(mysqli_error($db));
	
		 					}
echo "record created";

				return true;
					}
			//header("Location:/shopping_cart");
				}