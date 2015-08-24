<?php defined('SYSPATH') or die('No direct script access.');



class Sites_Controller extends Base_Controller {


// fields for table
	public $tableCols = array('name', 'shortname', 'url', 'email');
	
	public $fields = array(
		'name' => array(
			'title' => 'Name',
			'type' => 'text',
			'required' => true,
			'mask' => false
		),
		'shortname' => array(
			'title' => 'Shortname',
			'type' => 'text',
			'required' => true,
			'mask' => false,
			'width' => 90
		),
		'url' => array(
			'title' => 'URL',
			'type' => 'text',
			'required' => true,
			'mask' => false
		),
		'email' => array(
			'title' => 'E-mail',
			'type' => 'text',
			'required' => false,
			'mask' => false
		),
	);
	
	public $objectName = 'sites';
	public $title = 'Sites List - ';


//	public function getQuery(){
//		$db = new Database();
//		return $db->select('categories.id', 'categories.name', 'categories.parent_id', 'categories_descriptions.description', 'parent.name as parent')
//			->from('categories')
//			->join('categories_descriptions', 'categories_descriptions.id', 'categories.categories_description_id', 'left')
//			->join('categories as parent', 'parent.id', 'categories.parent_id', 'left');
//	}
	
//old code
//	public function edit(){
//		if (isset($_POST['save'])){
//
//			$post = new Validation(array_merge($_POST, $_FILES));            			 
//			$post->pre_filter('trim', 'categoryName', 'categoryDescription', 'metaTitle', 'metaDescription', 'metaKeywords', 'metaUrl');
//			
//			$post->add_rules('categoryName', 'required');
//					
//			if (!$post->validate()) {
//			   $errors = $post->errors('form_errors');
//			   foreach ($errors as $error) {
//				   echo '<p class="error">' . $error . '</p>';
//			   }
//			}
//			else {
//				$id = $this->uri->segment(3);			
//				$category = ORM::factory('category')->find($id);
//				
//				$category->name = $post->categoryName;
//				//$category->status = $post->categoryStatus;
//				$category->parent_id = $post->categoryParent;
//					
//				if ($category->categories_description_id)
//					$cat_desc = ORM::factory('categories_description')->find($category->categories_description_id);
//				else 
//					$cat_desc = ORM::factory('categories_description');	
//					
//				$cat_desc->description = $post->categoryDescription;
//				$cat_desc->short_description = $post->categoryShortDescription;
//				$cat_desc->meta_title = $post->metaTitle;
//				$cat_desc->meta_description = $post->metaDescription;
//				$cat_desc->meta_keywords = $post->metaKeywords;
//				$cat_desc->title_url = $post->metaUrl;
//				$cat_desc->image_alt = $post->image_alt;
//				
//				if (!empty($_FILES['image']['name'])){
//					// uses Kohana upload helper
//					$_FILES = Validation::factory($_FILES)
//						->add_rules('image', 'upload::valid', 'upload::type[gif,jpg,jpeg,png]', 'upload::size[2M]');
//						
//					if ($_FILES->validate())
//					{
//						// Temporary file name
//						$dat = time();
//						$filename = upload::save('image', basename($_FILES['image']['tmp_name']));
//						$file = $dat.'-'.basename($_FILES['image']['name']);	
//						// Resize, sharpen, and save the image
//						Image::factory($filename)
//							//->resize(200, 200, Image::WIDTH)
//							->save(DOCROOT.'../../env/category_images/'. $file);
//					 
//						// Remove the temporary file
//						unlink($filename);
//					
//						 $cat_desc->image = $file;
//						 $cat_desc->save();
//					}
//					else	
//					   $errors = $_FILES->errors('form_user');	
//				}
//			}
//				
//			$cat_desc->save();
//			$category->categories_description_id = $cat_desc->id;
//			$category->save();
//		}
//		$this->_renderView();
//	}
//	
//	public function add(){
//		if (isset($_POST['save'])){
//
//			$post = new Validation(array_merge($_POST, $_FILES));            			 
//			$post->pre_filter('trim', 'categoryName', 'categoryDescription', 'metaTitle', 'metaDescription', 'metaKeywords', 'metaUrl');
//			
//			$post->add_rules('categoryName', 'required');
//					
//			if (!$post->validate()) {
//			   $errors = $post->errors('form_errors');
//			   foreach ($errors as $error) {
//				   echo '<p class="error">' . $error . '</p>';
//			   }
//			}
//			else {
//				$id = $this->uri->segment(3);			
//				$category = ORM::factory('category')->find($id);
//				
//				$category->name = $post->categoryName;
//				//$category->status = $post->categoryStatus;
//				$category->parent_id = $post->categoryParent;
//								
//				if ($category->categories_description_id)
//					$cat_desc = ORM::factory('categories_description')->find($category->categories_description_id);
//				else 
//					$cat_desc = ORM::factory('categories_description');	
//				
//				$cat_desc->short_description = $post->categoryShortDescription;
//				$cat_desc->description = $post->categoryDescription;
//				$cat_desc->meta_title = $post->metaTitle;
//				$cat_desc->meta_description = $post->metaDescription;
//				$cat_desc->meta_keywords = $post->metaKeywords;
//				$cat_desc->title_url = $post->metaUrl;
//				$cat_desc->image_alt = $post->image_alt;
//
//				if (!empty($_FILES['image']['name'])){
//					if ($_FILES->validate())
//					{
//						// Temporary file name
//						$filename = upload::save('image', basename($_FILES['image']['tmp_name']));
//						$file = basename($_FILES['image']['name']);
//						
//						// Resize, sharpen, and save the image
//						Image::factory($filename)
//							//->resize(200, 200, Image::WIDTH)
//							->save(DOCROOT.'../../env/category_images/'. $file);
//					 
//						// Remove the temporary file
//						unlink($filename);
//					
//						 $cat_desc->image = $file;
//						 $cat_desc->save();
//					}
//					else	
//					   $errors = $_FILES->errors('form_user');	
//				}
//
//				$cat_desc->save();
//				$category->categories_description_id = $cat_desc->id;
//				$category->save();
//				url::redirect('/categories/edit/' . $category->id);
//	
//			}
//		}
//		$this->_renderView();
//	}
//	
//	function _renderView(){
//		$view = new View('admin');
//		 
//		$view->header  = new View('header');
//		$view->content = new View('category_content');
//		$view->footer  = new View('footer');
//		 
//		$view->header->title     = 'Category >> Add >> Edit';     // string for variable $title in view header.php
//		$view->content->heading  = 'Heading of your page'; // string for variable $heading in view content.php
//		 
//		$view->render(TRUE);
//	}	
}