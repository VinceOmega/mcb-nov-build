<?php defined('SYSPATH') or die('No direct script access.');


class Testimonials_Controller extends Base_Controller {

	public $tableCols = array('sites','name', 'location', 'headline', 'description');

	public $fields = array(
		'name' => array(
			'title' => 'Name',
			'width'=> '400',
			'type' => 'text',
			'index' => 'testimonials.name'
		),
		'location' => array(
			'title' => 'Location',
			'type' => 'text'
		),
		'headline' => array(
			'title' => 'Headline',
			'type' => 'text'
		),
		'description' => array(
			'title' => 'Description',
			'type' => 'text'
		),
		'sites' => array(
			'title' => 'Sites',
			'type' => 'select',
			'options' => 'sites',
			'index' => 'sites_testimonials.site_id',
			'stype' => 'select'
		)
	);
	public $objectName = 'testimonials';
	public $title = 'Testimonials List - ';

	public function getQuery(){
		$db = new Database();
		return $db->select('testimonials.id, testimonials.name, testimonials.location, testimonials.headline, testimonials.description, GROUP_CONCAT(sites.shortname) as sites')
                        ->from('testimonials')
                        ->join('sites_testimonials', 'sites_testimonials.testimonial_id', 'testimonials.id', 'left')
                        ->join('sites', 'sites.id', 'sites_testimonials.site_id', 'left')
						->groupby('testimonials.id');
	}
	
	public function edit(){
		$argumentarray = Router::$arguments;
		$id = $argumentarray[0];
		$testimonials = new Testimonial_Model;
		
		if (!isset($id)){
			throw new Exception('Id required');
		}
		
		if (isset($_POST['save'])){
			$post = new Validation(array_merge($_POST, $_FILES));
			
			$post->add_rules('testimonialName', 'required');
                        $post->add_rules('testimonialSites', 'required');
			
			if (!$post->validate()) {
			   $errors = $post->errors('form_errors');
			   foreach ($errors as $error) {
				   echo '<p class="error">' . $error . '</p>';
			   }
			}
			
			else {
			
				$id = $argumentarray[0];	
				$testimonials = new Testimonial_Model;
				$testimonial = ORM::factory('testimonial')->where('id', $id)->find();
		
				$testimonial->name = $post->testimonialName;
				$testimonial->location = $post->testimonialLocation;
				$testimonial->headline = $post->testimonialHeadline;
				$testimonial->description = $post->testimonialDescription;

				$testimonial->save();
				
				if (!empty($post->testimonialSites)){
					$st = ORM::factory('sites_testimonial')
							->where('testimonial_id', $id)
							->notin('site_id', $post->testimonialSites)
							->delete_all();
					
					foreach($post->testimonialSites as $site){	
						$st = ORM::factory('sites_testimonial')
								->where('testimonial_id', $id)
								->where('site_id', $site)
								->find();
						if($st->id == 0){
							$st->testimonial_id = $id;
							$st->site_id = $site;
							$st->save();
						}
					}
				}
			}
		}
		
		$this->_renderView();
	}
	
	public function add(){
		$argumentarray = Router::$arguments;
		$testimonials = new Testimonial_Model;
		$id = $testimonials->getNextID();
		
		if (isset($_POST['save']))	{
			$post = new Validation(array_merge($_POST, $_FILES));            			  
			$post->pre_filter('trim', 'testimonialName', 'testimonialDescription');
			
			$post->add_rules('testimonialName', 'required');
			
			if (!$post->validate()) {
			   $errors = $post->errors('form_errors');
			   foreach ($errors as $error) {
				   echo '<p class="error">' . $error . '</p>';
			   }
			}
			
			else {
				//$id = $argumentarray[0];	
				$testimonials = new Testimonial_Model;
				$testimonial = ORM::factory('testimonial');
				
				$testimonial->name = $post->testimonialName;
				$testimonial->location = $post->testimonialLocation;
				$testimonial->headline = $post->testimonialHeadline;
				$testimonial->description = $post->testimonialDescription;
				

				$testimonial->save();
				
				
				if (!empty($post->testimonialSites)){
											
					foreach($post->testimonialSites as $site_id){	
						$sc = ORM::factory('sites_testimonial')
								->where('testimonial_id', $testimonial->id)
								->where('site_id', $site_id)
								->find();
						
						if($sc->id == 0){
							$sc->testimonial_id = $testimonial->id;
							$sc->site_id = $site_id;
							$sc->save();
						}
					}
				}
				
				url::redirect('/testimonials/edit/' . $testimonial->id);
			
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
		
		
		$testimonials = new Testimonial_Model;
		$testimonial = ORM::factory('testimonial')->where('id', $id)->find();
		
		// call custom method to let descandent classes do something when deleting
		$this->customBeforeDelete($testimonial);
		$testimonial->delete();
		$this->customAfterDelete($testimonial);
		
		url::redirect('/testimonials/');
	}
	
	
	
	public function _renderView(){
		$view = new View('admin');
		 
		$view->header  = new View('header');
		$view->content = new View('testimonial_content');
		$view->footer  = new View('footer');
		 
		$view->header->title     = 'Product >> Add >> Edit';     // string for variable $title in view header.php
		$view->content->heading  = 'Heading of your page'; // string for variable $heading in view content.php
		 
		$view->render(TRUE);
	}
		

	
	
}