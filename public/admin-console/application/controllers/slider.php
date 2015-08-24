<?php defined('SYSPATH') or die('No direct script access.');


class Slider_Controller extends Base_Controller {

	public $tableCols = array('image_alt','order');

	public $fields = array(
		'image_alt' => array(
			'title' => 'Name',
			'width'=> '400',
			'type' => 'text',
		),
		'order' => array(
			'title' => 'Order',
			'type' => 'text',
		),
	);
	public $objectName = 'slider';
	public $title = 'Slideshow - ';

//	public function getQuery(){
//		$db = new Database();
//		return $db->select('products.id, products.name, products.status, products.kind,  GROUP_CONCAT(DISTINCT categories.name) as categories')->from('products')
//			->join('categories_products', 'categories_products.product_id', 'products.id', 'left')
//			->join('categories', 'categories.id', 'categories_products.category_id', 'left')
//				
//			->groupby('products.id');
//	}
	
	public function edit(){

		if (isset($_POST['save'])){
			$post = new Validation(array_merge($_POST, $_FILES));
			
			if (!$post->validate()) {
			   $errors = $post->errors('form_errors');
			   foreach ($errors as $error) {
				   echo '<p class="error">' . $error . '</p>';
			   }
			}
			
			else {
				$id = $this->uri->segment(3);		
				$slide = ORM::factory('silder')->find($id);
		
				$slide->image_alt = $post->image_alt;
				$slide->order = $post->order;
				$slide->url = $post->url;
				
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
							->save(DOCROOT.'../../env/images/mcb/slideshow/'. $file, FALSE);
					 
						// Remove the temporary file
						unlink($filename);
					 
						$slide->image = $file;
					}
					else	
					   $errors = $_FILES->errors('form_user');	
				}
		
				$slide->save();
			}
		}
		
		$this->_renderView();
	}
	
	
	public function add(){
		if (isset($_POST['save']))	{
			$post = new Validation(array_merge($_POST, $_FILES));            			  

			if (!$post->validate()) {
			   $errors = $post->errors('form_errors');
			   foreach ($errors as $error) {
				   echo '<p class="error">' . $error . '</p>';
			   }
			}
			
			else {
				$id = $this->uri->segment(3);			
				$slide = ORM::factory('silder')->find($id);
				
				$slide->image_alt = $post->image_alt;
				$slide->order = $post->order;
				$slide->url = $post->url;
				
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
							->save(DOCROOT.'../../env/images/mcb/slideshow/'. $file, FALSE);
					 
						// Remove the temporary file
						unlink($filename);
					 
						$slide->image = $file;
					}
					else	
					   $errors = $_FILES->errors('form_user');	
				}
				
				$slide->save();
				
				url::redirect('/slider/edit/'.$slide->id);
			}
		}
		$this->_renderView();
	}
	
	public function _renderView(){
		$view = new View('admin');
		 
		$view->header  = new View('header');
		$view->content = new View('slider_content');
		$view->footer  = new View('footer');
		 
		$view->header->title     = 'Slide >> Add >> Edit';     // string for variable $title in view header.php
		 
		$view->render(TRUE);
	}
	
}