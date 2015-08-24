<?php defined('SYSPATH') or die('No direct script access.');


class Occasions_Controller extends Base_Controller {

	public $tableCols = array('sites','name', 'headline');

	public $fields = array(
		'name' => array(
			'title' => 'Name',
			'width'=> '400',
			'type' => 'text',
			'index' => 'occasions.name'
		),
		'headline' => array(
			'title' => 'Headline',
			'type' => 'text'
		),
		'sites' => array(
			'title' => 'Sites',
			'type' => 'select',
			'options' => 'sites',
			'index' => 'sites_occasions.site_id',
			'stype' => 'select'
		)

	);
	public $objectName = 'occasions';
	public $title = 'Occasions List - ';

	public function getQuery(){
		$db = new Database();
		return $db->select('occasions.id, occasions.name, occasions.headline, occasions_descriptions.description, occasions_descriptions.short_description, GROUP_CONCAT(sites.shortname) as sites')
                       ->from('occasions')
                       ->join('occasions_descriptions', 'occasions.occasions_description_id', 'occasions_descriptions.id')
                        
                       ->join('sites_occasions', 'sites_occasions.occasion_id', 'occasions.id', 'left')
                       ->join('sites', 'sites.id', 'sites_occasions.site_id', 'left')
                       ->groupby('occasions.id');
	}
	
	public function edit(){

		if (isset($_POST['save'])){
			$post = new Validation(array_merge($_POST, $_FILES));
			
			$post->add_rules('occasionName', 'required');
                        $post->add_rules('occasionSites', 'required');
			
			if (!$post->validate()) {
			   $errors = $post->errors('form_errors');
			   foreach ($errors as $error) {
				   echo '<p class="error">' . $error . '</p>';
			   }
			}
			
			else {
				$id = $this->uri->segment(3);			
				$occasion = ORM::factory('occasion')->find($id);
		
				$occasion->name = $post->occasionName;
				$occasion->headline = $post->occasionHeadline;
				//$occasion->description = $post->occasionDescription;

				if ($occasion->occasions_description_id)
					$desc = ORM::factory('occasions_description')->find($occasion->occasions_description_id);
				else 
					$desc = ORM::factory('occasions_description');

				//print_r($post);
			
				$desc->description = $post->occasionDescription;
				$desc->title_url = $post->metaUrl;
				$desc->short_description = $post->occasionShortDescription;
				$desc->meta_description  = $post->metaDescription;
				$desc->meta_keywords  = $post->metaKeywords;
				$desc->meta_title = $post->metaTitle;				
				$desc->image_alt = $post->image_alt;
				$desc->save();
				
				$occasion->occasions_description_id = $desc->id;

			
        
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
		

				$occasion->save();
				
				if (!empty($post->occasionSites)){
					$so = ORM::factory('sites_occasion')
							->where('occasion_id', $id)
							->notin('site_id', $post->occasionSites)
							->delete_all();
					
					foreach($post->occasionSites as $site){	
						$so = ORM::factory('sites_occasion')
								->where('occasion_id', $id)
								->where('site_id', $site)
								->find();
						
						if($so->id == 0){
							$so->occasion_id = $id;
							$so->site_id = $site;
							$so->save();
						}
					}
				}
			}
		}
		
		$this->_renderView();
	}
	
	public function add(){
		$argumentarray = Router::$arguments;
		$occasions = new Occasion_Model;
		$id = $occasions->getNextID();
		
		if (isset($_POST['save']))	{
			$post = new Validation(array_merge($_POST, $_FILES));            			  
			$post->pre_filter('trim', 'occasionName', 'occasionHeadline', 'occasionDescription');
			
			$post->add_rules('occasionName', 'required');
			$post->add_rules('occasionHeadline', 'required');
			
			if (!$post->validate()) {
			   $errors = $post->errors('form_errors');
			   foreach ($errors as $error) {
				   echo '<p class="error">' . $error . '</p>';
			   }
			}
			
			else {
				//$id = $argumentarray[0];	
				$occasions = new Occasion_Model;
				$occasion = ORM::factory('occasion');
				
				$occasion->name = $post->occasionName;
				$occasion->headline = $post->occasionHeadline;
				//$occasion->description = $post->occasionDescription;
				
        if ($occasion->occasions_description_id)
					$desc = ORM::factory('occasions_description')->find($occasion->occasions_description_id);
				else 
					$desc = ORM::factory('occasions_description');
			
				$desc->description = $post->occasionDescription;
				$desc->title_url = $post->metaUrl;
				$desc->short_description = $post->occasionShortDescription;
				$desc->meta_description  = $post->metaDescription;
				$desc->meta_keywords  = $post->metaKeywords;
				$desc->meta_title = $post->metaTitle;				
				$desc->image_alt = $post->image_alt;
				$desc->save();
				
				$occasion->occasions_description_id = $desc->id;
        
        
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

				$occasion->save();
				
				if (!empty($post->occasionSites)){
											
					foreach($post->occasionSites as $site_id){	
						$sc = ORM::factory('sites_occasion')
								->where('occasion_id', $occasion->id)
								->where('site_id', $site_id)
								->find();
						
						if($sc->id == 0){
							$sc->occasion_id = $occasion->id;
							$sc->site_id = $site_id;
							$sc->save();
						}
					}
				}
				
				
				url::redirect('/occasions/edit/' . $occasion->id);
			
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
		
		
		$occasions = new Occasion_Model;
		$occasion = ORM::factory('occasion')->find($id);
		
		// call custom method to let descandent classes do something when deleting
		$this->customBeforeDelete($occasion);
		$occasion->delete();
		$this->customAfterDelete($occasion);
		
		url::redirect('/occasions/');
	}
	
	
	
	public function _renderView(){
		$view = new View('admin');
		 
		$view->header  = new View('header');
		$view->content = new View('occasion_content');
		$view->footer  = new View('footer');
		 
		$view->header->title     = 'Product >> Add >> Edit';     // string for variable $title in view header.php
		$view->content->heading  = 'Heading of your page'; // string for variable $heading in view content.php
		 
		$view->render(TRUE);
	}
		

	
	
}