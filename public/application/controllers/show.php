<?php


var_dump($_POST);


$db=new Database;
		//echo session_id();


		$postvars = $_POST;
		//print_r($postvars);

		$result = $db->query('SELECT * FROM flavors WHERE name LIKE \'%'.$postvars['choco_flavor'].'%\'');
		//print_r($result);
        $flavorID = $result[0]->id;

		$result = $db->query('SELECT * FROM foil_colors WHERE name LIKE \'%'.$postvars['foilcolor'].'%\'');
		//print_r($result);
        $foilID = $result[0]->id;

		$result = $db->query('SELECT * FROM product_costs WHERE productID = '.$postvars['choco_id'].' AND qty_start <= '.$postvars['quantity'].' AND qty_end >= '.$postvars['quantity'].'');
        $costeach = $result[0]->price;

		$total = $costeach * $postvars['quantity'];

		$text1 = '';
		$text2 = '';
		$text1font = '';
		$text2font = '';
		$text1size = '';
		$text2size = '';
		$text1color = '';
		$text2color = '';
		$clippath = '';



		if(!empty($postvars['choco_text1']))
			$text1 = $postvars['choco_text1'];
		else 
			$text1 = 'NULL';

		if(!empty($postvars['choco_text2']))
			$text2 = $postvars['choco_text2'];
		else 
			$text2 = 'NULL';

		if(!empty($postvars['choco_text1font']))
			$text1font = $postvars['choco_text1font'];
		else 
			$text1font = 'NULL';

		if(!empty($postvars['choco_text2font']))
			$text2font = $postvars['choco_text2font'];
		else 
			$text2font = 'NULL';

		if(!empty($postvars['choco_text1size']))
			$text1size = $postvars['choco_text1size'];
		else 
			$text1size = 'NULL';

		if(!empty($postvars['choco_text2size']))
			$text2size = $postvars['choco_text2size'];
		else 
			$text2size = 'NULL';

		if(!empty($postvars['choco_text1color'])) 
			$text1color = $postvars['choco_text1color'];
		else 
			$text1color = 'NULL';

		if(!empty($postvars['choco_text2color']))
			$text2color = $postvars['choco_text2color'];
		else 
			$text2color = 'NULL';

		if(!empty($postvars['img']))
			$clippath = $postvars['img'];
		else 
			$clippath = 'NULL';

		if(!empty($postvars['width']))
			$width = $postvars['width'];
		else 
			$width = 'NULL';

		if(!empty($postvars['height']))
			$height = $postvars['height'];
		else 
			$height = 'NULL';

		
		$clip_path = $postvars['urlname'];
		$clip_path2= $clip_path;
		$chocolate_name = $_POST['choco_name'];
		$flavor = $_POST['choco_flavor'];
		$style = $_POST['choco_style'];
		$text1_message = $_POST['choco_text1'];
		$text1_font = $_POST['choco_text1font'];
		$text1_size = $_POST['choco_text1size'];
		$text1_color = $_POST['choco_text1color'];
		$text2_message = $_POST['choco_text2'];
		$text2_font = $_POST['choco_text2font'];
		$text2_size = $_POST['choco_text2size'];
		$text2_color = $_POST['choco_text2color'];
		$clip_path = $_POST['urlname'];
		$clip_path2= $clip_path;
		$qty = $_POST['quantity']; //to addd
		$foil_color=@$_POST['foilcolor'];
		$mch_name= $chocolate_name;// to add

		$file_type=preg_match('/[\w]+$/',$clip_path,$a);
		$check_clip=preg_match('/clip/',$clip_path);
		if($file_type&&!$check_clip){
		 $urlname2=time().".".$a[0];
		 $clip_path2="/chocolates/files/".$urlname2;
		 copy($clip_path,$clip_path2);
		 unlink($clip_path);  }
		//If GD library is not installed, say sorry
		//$handle = fopen("12.jpeg", 'w+');
		if($chocolate_name!="Foiled Chocolate Hearts") {
		if(!function_exists("imagecreate")) die("Sorry, you need GD library to run this example");
		//Capture Post data
		$data = explode(",", $postvars['img']);
		$width = $postvars['width'];
		$height = $postvars['height'];
		//Allocate image
		$image=(function_exists("imagecreatetruecolor"))?imagecreatetruecolor( $width ,$height ):imagecreate( $width ,$height );
		imagefill($image, 0, 0, 0xFFFFFF);
		//Copy pixels
		$i = 0;
		for($x=0; $x<=$width; $x++){
			for($y=0; $y<=$height; $y++){
				//$r = hexdec("0x".substr( $data[$i] , 2, -1 ));
				//$g = hexdec("0x".substr( $data[$i] , 4 , -1 ));
				//$b = hexdec("0x".substr( $data[$i++] , 6 ,-1 ));
			//	$color = imagecolorallocate($image, $r, $g, $b);
				//$color = "0x".$data[$i++];
				$color=base_convert($data[$i++],16,10);
				imagesetpixel ($image,$x,$y,$color); } }
		//Output image and clean
		//	header( "Content-type: image/jpeg" );
		$dat= time();
		$design_path="/chocolates/chocolate_designs/cho"."$dat".".png";
		$test=imagepng($image,$design_path);
		//fwrite($handle,$test);
		imagedestroy($image);	
		}



		$result = $db->query('INSERT INTO temp_orders (sessionID, productID, flavorID, foilID, order_msg_text1, order_msg_text2, order_msg_font1, order_msg_font2, order_msg_size1, order_msg_size2, order_msg_color1, order_msg_color2, order_clip_path, order_qty, order_rate, order_total, added) VALUES (\''.$this->session->id().'\', '.$postvars['choco_id'].', '.$flavorID.', '.$foilID.', \''.$text1.'\', \''.$text2.'\', \''.$text1font.'\', \''.$text2font.'\', '.$text1size.', '.$text2size.', \''.$text1color.'\', \''.$text2color.'\', \''.$design_path.'\', '.$postvars['quantity'].', '.$costeach.', '.$total.', 0)'.'');
		

		url::redirect('/shopping_cart/');
		
	?>