<?php defined('SYSPATH') or die('No direct script access.');


class Flavors_Controller extends Base_Controller {	
	public $tableCols = array('name', 'description');
	
	public $fields = array(
		'name' => array(
			'title' => 'Flavor Name',
			'type' => 'text',
		),
		'description' => array(
			'title' => 'Description',
			'type' => 'text',
		)
	);
	
	
	public $objectName = 'flavors';
	public $title = 'Flavors List - ';	

	public function getQuery(){
		$db = new Database();
		return $db->select('id, name, description')->from('flavors');
	}
	

public function edit(){
		$argumentarray = Router::$arguments;
		$id = $argumentarray[0];
		$flavors = new Flavor_Model;
		
		if (!isset($id)){
			throw new Exception('Id required');
		}
		
		if (isset($_POST['save'])){
			$post = new Validation(array_merge($_POST, $_FILES));
			
			$post->add_rules('flavorName', 'required');
			
			if (!$post->validate()) {
			   $errors = $post->errors('form_errors');
			   foreach ($errors as $error) {
				   echo '<p class="error">' . $error . '</p>';
			   }
			}
			
			else {
			
				$id = $argumentarray[0];	
				$flavors = new Flavor_Model;
				//$flavor = $flavors->getFlavorByID($id);
				$flavor = ORM::factory('flavor')->where('id', $id)->find();
		
				$flavor->name = $post->flavorName;
				$flavor->description = $post->flavorDescription;
			

			

				$flavor->save();
			}
		}
		
		$this->_renderView();
	}
	
	public function add(){
		$argumentarray = Router::$arguments;
		//$id = $argumentarray[0];
		
		//$id = $flavors->getNextID();
		
		if (isset($_POST['save']))	{
			$post = new Validation(array_merge($_POST, $_FILES));            			  
			$post->pre_filter('trim', 'flavorName', 'flavorDescription');
			
			$post->add_rules('flavorName', 'required');
			$post->add_rules('flavorDescription', 'required');
			
			if (!$post->validate()) {
			   $errors = $post->errors('form_errors');
			   foreach ($errors as $error) {
				   echo '<p class="error">' . $error . '</p>';
			   }
			}
			
			else {
				//$id = $argumentarray[0];	
				$flavors = new Flavor_Model;
				$flavor = ORM::factory('flavor');
				
				$flavor->name = $post->flavorName;
				$flavor->description = $post->flavorDescription;
				
				

				try {

					$flavor->save();
					$flavors = new Flavor_Model;
					$id = $flavors->getNextID();
					url::redirect('/flavors/edit/' . $flavor->id);
				
				} catch (Exception $ex) {
					echo 'There was an error adding this flavor: '. $ex->getMessage();
					//url::redirect('/flavors/');
				}
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
		
		
		$flavors = new Flavor_Model;
		$flavor = ORM::factory('flavor')->where('id', $id)->find();
		
		// call custom method to let descandent classes do something when deleting
		$this->customBeforeDelete($flavor);
		$flavor->delete();
		$this->customAfterDelete($flavor);
		
		url::redirect('/flavors/');
	}
	
	
	
	public function _renderView(){
		$view = new View('admin');
		 
		$view->header  = new View('header');
		$view->content = new View('flavor_content');
		$view->footer  = new View('footer');
		 
		$view->header->title     = 'Flavor >> Add >> Edit';     // string for variable $title in view header.php
		$view->content->heading  = 'Heading of your page'; // string for variable $heading in view content.php
		 
		$view->render(TRUE);
	}
		

}