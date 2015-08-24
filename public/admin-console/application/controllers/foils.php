<?php defined('SYSPATH') or die('No direct script access.');


class Foils_Controller extends Base_Controller {	
	public $tableCols = array('name', 'hexcode');
	
	public $fields = array(
		'name' => array(
			'title' => 'Foil Name',
			'type' => 'text',
		),
		'hexcode' => array(
			'title' => 'Color Code',
			'type' => 'text',
		)
	);
	
	
	public $objectName = 'foils';
	public $title = 'Foils List - ';	

	public function getQuery(){
		$db = new Database();
		return $db->select('id, name, hexcode')->from('foil_colors');
	}
	

public function edit(){
		$argumentarray = Router::$arguments;
		$id = $argumentarray[0];
		$foils = new Foil_Color_Model;
		
		if (!isset($id)){
			throw new Exception('Id required');
		}
		
		if (isset($_POST['save'])){
			$post = new Validation(array_merge($_POST, $_FILES));
			
			$post->add_rules('foilName', 'required');
			
			if (!$post->validate()) {
			   $errors = $post->errors('form_errors');
			   foreach ($errors as $error) {
				   echo '<p class="error">' . $error . '</p>';
			   }
			}
			
			else {
			
				$id = $argumentarray[0];	
				$foils = new Foil_Color_Model;
				//$foil = $foils->getFoilByID($id);
				$foil = ORM::factory('foil_color')->where('id', $id)->find();
		
				$foil->name = $post->foilName;
				$foil->hexcode = $post->foilHexcode;
			

			

				$foil->save();
			}
		}
		
		$this->_renderView();
	}
	
	public function add(){
		$argumentarray = Router::$arguments;
		//$id = $argumentarray[0];
		
		
		if (isset($_POST['save']))	{
			$post = new Validation(array_merge($_POST, $_FILES));            			  
			$post->pre_filter('trim', 'foilName', 'foilHexcode');
			
			$post->add_rules('foilName', 'required');
			$post->add_rules('foilHexcode', 'required');
			
			if (!$post->validate()) {
			   $errors = $post->errors('form_errors');
			   foreach ($errors as $error) {
				   echo '<p class="error">' . $error . '</p>';
			   }
			}
			
			else {
				//$id = $argumentarray[0];	
				$foils = new Foil_Color_Model;
				$foil = ORM::factory('foil_color');
				
				$foil->name = $post->foilName;
				$foil->hexcode = $post->foilHexcode;
				
				

				try {

					$foil->save();
					$foils = new Foil_Color_Model;
					$id = $foils->getNextID();
					url::redirect('/foils/edit/' . $foil->id);
				
				} catch (Exception $ex) {
					echo 'There was an error adding this foil: '. $ex->getMessage();
					//url::redirect('/foils/');
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
		
		
		$foils = new Foil_Color_Model;
		$foil = ORM::factory('foil_color')->where('id', $id)->find();
		
		// call custom method to let descandent classes do something when deleting
		$this->customBeforeDelete($foil);
		$foil->delete();
		$this->customAfterDelete($foil);
		
		url::redirect('/foils/');
	}
	
	
	
	public function _renderView(){
		$view = new View('admin');
		 
		$view->header  = new View('header');
		$view->content = new View('foil_content');
		$view->footer  = new View('footer');
		 
		$view->header->title     = 'Foil >> Add >> Edit';     // string for variable $title in view header.php
		$view->content->heading  = 'Heading of your page'; // string for variable $heading in view content.php
		 
		$view->render(TRUE);
	}
		

}