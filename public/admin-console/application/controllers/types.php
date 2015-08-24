<?php defined('SYSPATH') or die('No direct script access.');



class Types_Controller extends Base_Controller {

	public $tableCols = array('sites','name', 'category');
	
	public $fields = array(
		'name' => array(
			'title' => 'Name',
			'type' => 'text',
			'required' => true,
			'mask' => false,
			'index' => 'products_types.name'
		),
		'category' => array(
			'title' => 'Category',
			'type' => 'select',
			'required' => false,
			'mask' => '^\d+$',
			'options' => 'categories',
			'index' => 'products_types.category_id',
			'stype' => 'select'
		),
		'sites' => array(
			'title' => 'Sites',
			'type' => 'select',
			'options' => 'sites',
			'index' => 'sites_types.site_id',
			'stype' => 'select'
		)
	);
	
	public $objectName = 'products_types';
	public $title = 'Product types - ';


	public function getQuery(){
		$db = new Database();
		return $db->select('products_types.id', 'products_types.name', 'products_types.products_types_description_id', 'categories.name as category', 'GROUP_CONCAT(sites.shortname) as sites')
			->from('products_types')
			->join('categories', 'categories.id', 'products_types.category_id', 'left')
                        
                        ->join('sites_types', 'sites_types.products_type_id', 'products_types.id', 'left')
                        ->join('sites', 'sites.id', 'sites_types.site_id', 'left')
                        ->groupby('products_types.id')
				;
	}	
	
	public function edit(){
		if (isset($_POST['save'])){

			$post = new Validation(array_merge($_POST, $_FILES));            			 
			$post->pre_filter('trim', 'typeName', 'typeDescription', 'typeShortDescription', 'metaTitle', 'metaDescription', 'metaKeywords');
			
			$post->add_rules('typeName', 'required');
                        $post->add_rules('productTypeSites', 'required');
					
			if (!$post->validate()) {
			   $errors = $post->errors('form_errors');
			   foreach ($errors as $error) {
				   echo '<p class="error">' . $error . '</p>';
			   }
			}
			else {
				$id = $this->uri->segment(3);			
				$type = ORM::factory('products_type')->find($id);
				
				$type->name = $post->typeName;
				$type->category_id = $post->category;
										
				$type_desc = ORM::factory('products_types_description')->where('id', $type->products_types_description_id)->find();
				$type_desc->short_description = $post->typeShortDescription;
				$type_desc->description = $post->typeDescription;
				$type_desc->meta_title = $post->metaTitle;		
				$type_desc->meta_description = $post->metaDescription;
				$type_desc->meta_keywords = $post->metaKeywords;
				$type_desc->title_url = $post->metaUrl;
				$type_desc->image_alt = $post->image_alt;
				$type_desc->video = $post->video;
				
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
							->save(DOCROOT.'../../env/product_type_images/'. $file);
					 
						// Remove the temporary file
						unlink($filename);
					
						 $type_desc->image = $file;
						 $type_desc->save();
					}
					else	
					   $errors = $_FILES->errors('form_user');	
				}
				
				$type_desc->save();
				$type->products_types_description_id = $type_desc->id;
				$type->save();
				
				if (!empty($post->productTypeSites)){
					$stp = ORM::factory('sites_types')
							->where('products_type_id', $id)
							->notin('site_id', $post->productTypeSites)
							->delete_all();

					foreach($post->productTypeSites as $site){	
						$stp = ORM::factory('sites_types')
								->where('typproducts_type_ide_id', $id)
								->where('site_id', $site)
								->find();
						
						if($stp->id == 0){
							$stp->products_type_id = $id;
							$stp->site_id = $site;
							$stp->save();
						}
					}
				}
			
			}
		}
		$this->_renderView();
	}
	
	public function add(){
		if (isset($_POST['save'])){

			$post = new Validation(array_merge($_POST, $_FILES));            			 
			$post->pre_filter('trim', 'typeName', 'typeDescription', 'typeShortDescription', 'metaTitle', 'metaDescription', 'metaKeywords');
			
			$post->add_rules('typeName', 'required');
					
			if (!$post->validate()) {
			   $errors = $post->errors('form_errors');
			   foreach ($errors as $error) {
				   echo '<p class="error">' . $error . '</p>';
			   }
			}
			else {
				$id = $this->uri->segment(3);			
				$type = ORM::factory('products_type')->find($id);
				
				$type->name = $post->typeName;
				$type->category_id = $post->category;
										
				$type_desc = ORM::factory('products_types_description')->where('id', $type->products_types_description_id)->find();
				$type_desc->short_description = $post->typeShortDescription;
				$type_desc->description = $post->typeDescription;
				$type_desc->meta_title = $post->metaTitle;		
				$type_desc->meta_description = $post->metaDescription;
				$type_desc->meta_keywords = $post->metaKeywords;
				$type_desc->title_url = $post->metaUrl;
				$type_desc->image_alt = $post->image_alt;
				$type_desc->video = $post->video;
				
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
							->save(DOCROOT.'../../env/product_type_images/'. $file);
					 
						// Remove the temporary file
						unlink($filename);
					
						 $type_desc->image = $file;
						 $type_desc->save();
					}
					else	
					   $errors = $_FILES->errors('form_user');	
				}
				
				$type_desc->save();
				$type->products_types_description_id = $type_desc->id;
				$type->save();
				
				if (!empty($post->productTypeSites)){
											
					foreach($post->productTypeSites as $site_id){	
						$sc = ORM::factory('sites_types')
								->where('products_type_id', $type->id)
								->where('site_id', $site_id)
								->find();
						
						if($sc->id == 0){
							$sc->products_type_id = $type->id;
							$sc->site_id = $site_id;
							$sc->save();
						}
					}
				}
				
				
				url::redirect(url::base() . $this->uri->segment(1). '/' . $this->uri->segment(2) . '/' .$type->id);
			}
		}
		
		$this->_renderView();
	}
	
	function _renderView(){
		$view = new View('admin');
		 
		$view->header  = new View('header');
		$view->content = new View('type_content');
		$view->footer  = new View('footer');
		 
		$view->header->title     = 'Product Types >> Add >> Edit ';     // string for variable $title in view header.php
		$view->content->heading  = 'Heading of your page'; // string for variable $heading in view content.php
		 
		$view->render(TRUE);
	}
}


	



