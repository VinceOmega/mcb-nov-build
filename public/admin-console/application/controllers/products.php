<?php defined('SYSPATH') or die('No direct script access.');


class Products_Controller extends Base_Controller {

	public $tableCols = array('kind','name', 'status', 'categories');

	public $fields = array(
		'name' => array(
			'title' => 'Name',
			'width'=> '400',
			'type' => 'text',
			'required' => true,
			'mask' => false,
			'index' => 'products.name'
		),
		'status' => array(
			'title' => 'Status',
			'type' => 'text',
			'required' => true,
			'mask' => false,
			'index' => 'products.status'
		),
		'categories' => array(
			'title' => 'Categories',
			'type' => 'select',
			'options' => 'categories',
			'index' => 'categories_products.category_id',
			'stype' => 'select'
		),
		'kind' => array(
			'title' => 'Kind',
			'type' => 'text',
		)
	);
	public $objectName = 'products';
	public $title = 'Products List - ';

	public function getQuery(){
		$db = new Database();
		return $db->select('products.id, products.name, products.status, products.kind,  GROUP_CONCAT(DISTINCT categories.name) as categories')->from('products')
			->join('categories_products', 'categories_products.product_id', 'products.id', 'left')
			->join('categories', 'categories.id', 'categories_products.category_id', 'left')
				
			->groupby('products.id');
	}
	
	public function edit(){

		if (isset($_POST['save'])){
			$post = new Validation(array_merge($_POST, $_FILES));            			  //********  TO DO: trim for shipping info     **************/
			$post->pre_filter('trim', 'productName', 'productDescription', 'productPrice', 'productQuantity', 'metaTitle', 'metaDescription', 'metaKeywords', 'metaUrl');
			
			$post->add_rules('productName', 'required');
			$post->add_rules('productQuantity', 'numeric');
			$post->add_rules('productCategories', 'required');
			$post->add_rules('productKind', 'required');
			
			if (!$post->validate()) {
			   $errors = $post->errors('form_errors');
			   foreach ($errors as $error) {
				   echo '<p class="error">' . $error . '</p>';
			   }
			}
			
			else {
				$id = $this->uri->segment(3);		
				$product = ORM::factory('product')->find($id);
		
				$product->name = $post->productName;
				$product->size = $post->productSize;
				$product->status = $post->productStatus;
				$product->products_type_id = $post->productType;
				$product->homepage = isset($post->productHomepage) && $post->productHomepage == 1 ? 1 : 0;
				
				$product->kind = $post->productKind;
				$product->unit = $post->productUnit;

				if($post->productKind == 'MCC_GNG'){
				$product->coins_per_bag = $post->productCoinsPerBag;
				}

				if($post->productKind == 'MCB_GNG'){
				$product->bars_per_box = $post->productBarsPerBox;
				}
				
				if ($post->productKind == 'MCC_GNG') {
					$product->flavor_id = $post->productFlavorId;
					$product->foil_id = $post->productFoilId;
				}
				
				if ($product->products_description_id)
					$desc = ORM::factory('products_description')->find($product->products_description_id);
				else 
					$desc = ORM::factory('products_description');
			
				$desc->description = $post->productDescription;
				$desc->title_url = $post->metaUrl;
				$desc->short_description = $post->productShortDescription;
				$desc->production_times = $post->productProductionTimes;
				$desc->meta_description  = $post->metaDescription;
				$desc->meta_keywords  = $post->metaKeywords;
				$desc->meta_title = $post->metaTitle;				
				$desc->image_alt = $post->image_alt;
				$desc->save();
				
				$product->products_description_id = $desc->id;
				
				if (!empty($_FILES['image']['name'])){
					// uses Kohana upload helper
					$_FILES = Validation::factory($_FILES)
						->add_rules('image', 'upload::valid', 'upload::type[gif,jpg,jpeg,png]', 'upload::size[2M]');
					 
					if ($_FILES->validate())
					{
						// Temporary file name
						$dat = time();
						$filename = upload::save('image', basename($_FILES['image']['tmp_name']));
						$file = $dat.'-'.basename($_FILES['image']['name']);	
						// Resize, sharpen, and save the image
						Image::factory($filename)
							//->resize(200, 200, Image::WIDTH)
							->save(DOCROOT.'../../env/product_images/'. $file, FALSE);
					 
						// Remove the temporary file
						unlink($filename);
					 
						 $desc->image = $file;
						 $desc->save();
					}
					else	
					   $errors = $_FILES->errors('form_user');	
				}
				if ($product->products_inventory_id)
					$qty = ORM::factory('products_inventory')->find($product->products_inventory_id);
				else 
					$qty = ORM::factory('products_inventory');
				$qty->on_hand = $post->productQuantity;
				$qty->save();
				$product->products_inventory_id = $qty->id;

				//$measurement = new Validation($post->shipping_info);    	
				//$product->size = $post->size;    	
				
				
				
//				foreach($post->shipping_info as $key => $n){
//					//$measurement->add_rules($key, 'numeric');
//				}
//				if (!$measurement->validate()) {
//				   $errors = $measurement->errors('form_errors');
//				   foreach ($errors as $error) {
//					   echo '<p class="error">' . $error . '</p>';
//				   }
//				}
//				//$product->shipping_info = serialize($post->shipping_info);		
//				
//
//				$u = array();
//				if (isset($_POST['shipping_info'])){
//					foreach($_POST['shipping_info'] as $ops){
//						$b ='';
//						if (isset($ops['shipping_info'])){
//						foreach ($ops['shipping_info'] as $op){
//							$b[] = $op['name'];		
//						}
//						$u[$ops['name']] = $b;
//						}
//					}
//				}
//				$shipInfo = serialize($u);
//				$product->shipping_info = $shipInfo;		

				$v = array();
				if (isset($_POST['product_option'])){
					foreach($_POST['product_option'] as $ops){
						$b ='';
						if (isset($ops['options'])){
						foreach ($ops['options'] as $op){
							$b[] = $op['name'];		
						}
						$v[$ops['name']] = $b;
						}
					}
				}
				$options = serialize($v);	
				$product->options = $options;
				
				$m = array();
				if (isset($_POST['product_attr'])){
					foreach($_POST['product_attr'] as $ops){
						$b ='';
						if (isset($ops['attributes'])){
						foreach ($ops['attributes'] as $op){
							$b[] = $op['name'];		
						}
						$m[$ops['name']] = $b;
						}
					}
				}
				$attributes = serialize($m);
				$product->attributes =  $attributes;
			
				$taxId = array(0 => $post->productTaxClass);
				$product->tax_ids = serialize($taxId);								/*************** TO DO: more than one tax class ???? ****************/
		
				$product->save();
				
																		/*************** TO DO: delete more than one category ****************/
				if (!empty($post->productCategories)){
					$cat = ORM::factory('categories_product')
							->where('product_id', $id)
							->notin('category_id', $post->productCategories)
							->delete_all();
					foreach($post->productCategories as $category){	
						$cat = ORM::factory('categories_product')->where('product_id', $id)->where('category_id', $category)->find();
						if($cat->id == 0){
							$cat->product_id = $id;
							$cat->category_id = $category;
							$cat->save();
						}
					}
				}
				
				//product costs
				$pc = ORM::factory('product_cost')
						->where('productID', $id)
						->delete_all();
				if (isset($post->cost_qty_start)) {
					foreach ($post->cost_qty_start as $index => $qty_start)
					{
						if ($qty_start != '' && $post->cost_price[$index] != '')
						{
							$pc = ORM::factory('product_cost');
							$pc->productID = $product->id;
							$pc->qty_start = $qty_start;
							$pc->qty_end = $post->cost_qty_end[$index];
							$pc->price = $post->cost_price[$index];
							$pc->save();
						}
					}
				}
				
				//packagings
				if (!empty($post->productPackagings)){
					$pp = ORM::factory('products_packaging')
						->where('product_id', $product->id)
						->notin('packaging_id',$post->productPackagings)
						->delete_all();
					
					foreach($post->productPackagings as $packagingId) {	
						$pp = ORM::factory('products_packaging')
								->where('product_id',$product->id)
								->where('packaging_id',$packagingId)
								->find();
						
						if ($pp->id == 0) {
							$pp->product_id = $product->id;
							$pp->packaging_id = $packagingId;
							$pp->save();
						}
					}
				}
				
				//options
				if (isset($post->options)) 
				{
					foreach ($post->options['name'] as $index => $name)
					{
						$po = FALSE;
						$delete = FALSE;
						if ($post->options['id'][$index] != '')
						{
							$po = ORM::factory('gngoption',$post->options['id'][$index]);
							if ($post->options['deleted'][$index] == 1)
								$delete = TRUE;
						}
						else if ($name != '')
						{
							if ($post->options['deleted'][$index] == 1)
								continue;
							$po = ORM::factory('gngoption');
							$po->product_id = $product->id;
						}
						if ($delete)
						{
							$po->delete();
						}
						else if ($po)
						{
							$po->name = $name;
							$po->values = $post->options['values'][$index];
							$po->mandatory = $post->options['mandatory'][$index];
							$po->save();
						}
					}
				}
			}
		}
		
		$this->_renderView();
	}
	
	
	public function add(){
		if (isset($_POST['save']))	{
			$post = new Validation(array_merge($_POST, $_FILES));            			  
			$post->pre_filter('trim', 'productName', 'productDescription', 'productPrice', 'productQuantity', 'metaTitle', 'metaDescription', 'metaKeywords', 'metaUrl');
			
			$post->add_rules('productName', 'required');
			$post->add_rules('productQuantity', 'numeric');
			$post->add_rules('productCategories', 'required');
			$post->add_rules('productKind', 'required');
			
			if (!$post->validate()) {
			   $errors = $post->errors('form_errors');
			   foreach ($errors as $error) {
				   echo '<p class="error">' . $error . '</p>';
			   }
			}
			
			else {
				$id = $this->uri->segment(3);			
				$product = ORM::factory('product')->find($id);
				
				$product->name = $post->productName;
				//$product->name2 = $post->productPicName;
				
				$product->size = $post->productSize;
				$product->status = $post->productStatus;
				$product->products_type_id = $post->productType;
				$product->homepage = isset($post->productHomepage) && $post->productHomepage == 1 ? 1 : 0;
				$product->kind = $post->productKind;
				$product->unit = $post->productUnit;
				if ($post->productKind === 'MCB_GNG' OR $post->productKind === 'MCB') {
				$product->bars_per_box = $post->productBarsPerBox;
				} else {
					$product->coins_per_bag = $post->productCoinsPerBag;
				}
				if ($post->productKind == 'MCC_GNG') {
					$product->flavor_id = $post->productFlavorId;
					$product->foil_id = $post->productFoilId;
				}
                                
                                if ($post->productKind == 'MCH_GNG') {
					$product->flavor_id = $post->productFlavorId;
					$product->foil_id = $post->productFoilId;
				}
                                
				if ($product->products_description_id)
					$desc = ORM::factory('products_description')->find($product->products_description_id);
				else 
					$desc = ORM::factory('products_description');
			
				
				$desc->short_description = $post->productShortDescription;
				$desc->description = $post->productDescription;
				$desc->production_times = $post->productProductionTimes;
				$desc->meta_title = $post->metaTitle;
				$desc->meta_description  = $post->metaDescription;
				$desc->meta_keywords  = $post->metaKeywords;
				$desc->title_url = $post->metaUrl;
				$desc->image_alt = $post->image_alt;
				
				$desc->save();
				$product->products_description_id = $desc->id;
				
				if (!empty($_FILES['image']['name'])){
					// uses Kohana upload helper
					$_FILES = Validation::factory($_FILES)
						->add_rules('image', 'upload::valid', 'upload::type[gif,jpg,jpeg,png]', 'upload::size[2M]');
					 
					if ($_FILES->validate())
					{
						// Temporary file name
						$filename = upload::save('image', basename($_FILES['image']['tmp_name']));
						$file = basename($_FILES['image']['name']);
						
						// Resize, sharpen, and save the image
						Image::factory($filename)
							//->resize(200, 200, Image::WIDTH)
							->save(DOCROOT.'../../env/product_images/'. $file);
					 
						// Remove the temporary file
						unlink($filename);
					
						 $desc->image = $file;
						 $desc->save();
					}
					else	
					   $errors = $_FILES->errors('form_user');	
				}
				

				if ($product->products_inventory_id)
					$qty = ORM::factory('products_inventory')->find($product->products_inventory_id);
				else 
					$qty = ORM::factory('products_inventory');
							
				$qty->on_hand = $post->productQuantity;
				$qty->save();
				$product->products_inventory_id  = $qty->id;
				
//				$measurement = new Validation($post->shipping_info);    	
//				foreach($post->shipping_info as $key => $n){
//					//$measurement->add_rules($key, 'numeric');
//				}
//				if (!$measurement->validate()) {
//				   $errors = $measurement->errors('form_errors');
//				   foreach ($errors as $error) {
//					   echo '<p class="error">' . $error . '</p>';
//				   }
//				}
//				$product->shipping_info = serialize($post->shipping_info);		
				
				$v = array();
				if (isset($_POST['product_option'])){
					foreach($_POST['product_option'] as $ops){
						$b ='';
						if (isset($ops['options'])){
						foreach ($ops['options'] as $op){
							$b[] = $op['name'];		
						}
						$v[$ops['name']] = $b;
						}
					}
				}
				$options = serialize($v);	
				$product->options = $options;
				
				$m = array();
				if (isset($_POST['product_attr'])){
					foreach($_POST['product_attr'] as $ops){
						$b ='';
						if (isset($ops['attributes'])){
						foreach ($ops['attributes'] as $op){
							$b[] = $op['name'];		
						}
						$m[$ops['name']] = $b;
						}
					}
				}
				$attributes = serialize($m);
				$product->attributes =  $attributes;

				$taxId = array(0 => $post->productTaxClass);
				$product->tax_ids = serialize($taxId);								
			
				$product->save();
				
				//header("Location: " . url::base() . $this->uri->segment(1).'/edit/' ." $product->id");
				if (!empty($post->productCategories)){
					$cat = ORM::factory('categories_product')->where('product_id', $id)->notin('category_id', $post->productCategories)->find();
					$cat->delete();	
											
					foreach($post->productCategories as $category){	
						$cat = ORM::factory('categories_product')->where('product_id', $id)->where('category_id', $category)->find();
						if($cat->id == 0){
							$cat->product_id = $product->id;
							$cat->category_id = $category;
							$cat->save();
						}
					}
				}
				
				//product costs
				foreach ($post->cost_qty_start as $index => $qty_start)
				{
					if ($qty_start != '' && $post->cost_price[$index] != '')
					{
						$pc = ORM::factory('product_cost');
						$pc->productID = $product->id;
						$pc->qty_start = $qty_start;
						$pc->qty_end = $post->cost_qty_end[$index];
						$pc->price = $post->cost_price[$index];
						$pc->save();
					}
				}
				
				//packagings
				if (!empty($post->productPackagings)){
					foreach($post->productPackagings as $packagingId) {	
						$pp = ORM::factory('products_packaging');
						$pp->product_id = $product->id;
						$pp->packaging_id = $packagingId;
						$pp->save();
					}
				}
				
				//options
				if (isset($post->options)) 
				{
					foreach ($post->options['name'] as $index => $name)
					{
						if ($name != '')
						{
							if ($post->options['deleted'][$index] == 1)
								continue;
							$po = ORM::factory('gngoption');
							$po->product_id = $product->id;
							$po->name = $name;
							$po->values = $post->options['values'][$index];
							$po->mandatory = $post->options['mandatory'][$index];
							$po->save();
						}
					}
				}
				
				url::redirect('/products/edit/' . $product->id);
			}
		}
		$this->_renderView();
	}
	
	public function customBeforeDelete($row) {
		parent::customBeforeDelete($row);
		
		ORM::factory('categories_product')->where('product_id', $row->id)->delete_all();
		ORM::factory('product_cost')->where('productID', $row->id)->delete_all();
		ORM::factory('products_packaging')->where('product_id', $row->id)->delete_all();
	}
	
	public function _renderView(){
		$view = new View('admin');
		 
		$view->header  = new View('header');
		$view->content = new View('product_content');
		$view->footer  = new View('footer');
		 
		$view->header->title     = 'Product >> Add >> Edit';     // string for variable $title in view header.php
		$view->content->heading  = 'Heading of your page'; // string for variable $heading in view content.php
		 
		$view->render(TRUE);
	}
	
	public function getProductPrice(){
		if (!isset($_GET['id'])){
			throw new Exception('Product ID required');
		}
		$product = ORM::factory('product', (int)$_GET['id']);
		die( sprintf ("%6.2f", $product->price) );
	}
}
