<?php defined('SYSPATH') or die('No direct script access.');


class Product_Controller extends Base_Controller {

	public $tableCols = array('name', 'size', 'description');

	public $fields = array(
		'name' => array(
			'title' => 'Name',
			'width'=> '400',
			'type' => 'text'
		),
		'description' => array(
			'title' => 'Description',
			'type' => 'text'
		),
		'size' => array(
			'title' => 'Size',
			'type' => 'text'
		),
		'production_times' => array(
			'title' => 'Production Times',
			'type' => 'select',
			'options' => 'production_times',
			'index' => 'production_times.id',
			'stype' => 'select'
		),
		'image' => array(
			'title' => 'Image',
			'type' => 'image'
		)
	);
	public $objectName = 'products';
	public $title = 'Products List - ';

	public function getQuery(){
		$db = new Database();
		return $db->select('id, name, size, description, image')->from('products');
	}
	
	public function edit(){
		$argumentarray = Router::$arguments;
		$id = $argumentarray[0];
		$products = new Product_Model;
		
		if (!isset($id)){
			throw new Exception('Id required');
		}
		
		if (isset($_POST['save'])){
			$post = new Validation(array_merge($_POST, $_FILES));
			
			$post->add_rules('productName', 'required');
			
			if (!$post->validate()) {
			   $errors = $post->errors('form_errors');
			   foreach ($errors as $error) {
				   echo '<p class="error">' . $error . '</p>';
			   }
			}
			
			else {
			
				$id = $argumentarray[0];	
				$products = new Product_Model;
				//$product = $products->getProductByID($id);
				$product = ORM::factory('product')->where('id', $id)->find();
		
				$product->name = $post->productName;
				$product->size = $post->productSize;
				$product->production_time = $post->productProductionTime;
				$product->description = $post->productDescription;
				//$product->image = $post->productImage;
			
				
				
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
							->save(DOCROOT.'../../env/product_images/'. $file, FALSE);
					 
						// Remove the temporary file
						unlink($filename);
					 
						$product->image = $file;
						 
					}
					else	
					   $errors = $_FILES->errors('form_user');	
				}
				
				
			

				$product->save();
			}
		}
		
		$this->_renderView();
	}
	
	public function add(){
		$argumentarray = Router::$arguments;
		//$id = $argumentarray[0];
		$products = new Product_Model;
		$id = $products->getNextID();
		
		if (isset($_POST['save']))	{
			$post = new Validation(array_merge($_POST, $_FILES));            			  
			$post->pre_filter('trim', 'productName', 'productSize', 'productDescription', 'productImage');
			
			$post->add_rules('productName', 'required');
			$post->add_rules('productDescription', 'required');
			
			if (!$post->validate()) {
			   $errors = $post->errors('form_errors');
			   foreach ($errors as $error) {
				   echo '<p class="error">' . $error . '</p>';
			   }
			}
			
			else {
				//$id = $argumentarray[0];	
				$products = new Product_Model;
				$product = ORM::factory('product');
				
				$product->name = $post->productName;
				$product->size = $post->productSize;
				$product->description = $post->productDescription;
				$product->image = $post->productImage;
				
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
					
						$product->image = $file;
					}
					else	
					   $errors = $_FILES->errors('form_user');	
				}

				$product->save();
				url::redirect('/products/edit/' . $product->id);
			
			}
		}
		$this->_renderView();
	}
	
	public function delete() {
		$argumentarray = Router::$arguments;
		$id = $argumentarray[0];
		
		if (!isset($id)){
			throw new Exception('Id required');
		}
		
		
		$products = new Product_Model;
		$product = ORM::factory('product')->where('id', $id)->find();
		
		// call custom method to let descandent classes do something when deleting
		$this->customBeforeDelete($product);
		$product->delete();
		$this->customAfterDelete($product);
		
		url::redirect('/products/');
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
		
	/*public function edit(){

		if (isset($_POST['save'])){
			$post = new Validation(array_merge($_POST, $_FILES));
			
			$post->add_rules('productName', 'required');
			
			if (!$post->validate()) {
			   $errors = $post->errors('form_errors');
			   foreach ($errors as $error) {
				   echo '<p class="error">' . $error . '</p>';
			   }
			}
			
			else {
				$id = $this->uri->segment(3);		
				$products = new Product_Model;				
				$product = $products->getProductById($id);
		
				$product->name = $post->productName;
				$product->size = $post->productSize;
				$product->description = $post->productDescription;
				$product->image = $post->productImage;

				
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
							->save(DOCROOT.'../../env/product_images/'. $file, FALSE);
					 
						// Remove the temporary file
						unlink($filename);
					 
						 $product->image = $file;
						 //$product->save();
					}
					else	
					   $errors = $_FILES->errors('form_user');	
				}
				
				$product->save();
			}
		} 
		
		$this->_renderView();
	}*/
	
	
}