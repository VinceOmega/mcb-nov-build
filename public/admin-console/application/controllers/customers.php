<?php defined('SYSPATH') or die('No direct script access.');


class Customers_Controller extends Base_Controller {	
	public $tableCols = array('shortname','firstname', 'lastname', 'email');
	
	public $fields = array(
		'shortname' => array(
			'title' => 'Site',
			'type' => 'select',
			'options' => array('sites', 'id', 'shortname'),
			'index' => 'users.site_id',
			'stype' => 'select'
		),
		'firstname' => array(
			'title' => 'First Name',
			'type' => 'text',
		),
		'lastname' => array(
			'title' => 'Last Name',
			'type' => 'text',
		),
		'email' => array(
			'title' => 'Email',
			'type' => 'text',
		)
	);
	
	public $objectName = 'customers';
	public $title = 'Customers List - ';	

	public function getQuery(){
		$db = new Database();
		return $db->select('users.id, sites.shortname, users.firstname, users.lastname, users.email')->from('users')
					->join('sites', 'users.site_id', 'sites.id', 'left');
	}

	public function edit(){
		$argumentarray = Router::$arguments;
		$id = $argumentarray[0];
		$users = new User_Model;
		
		if (!isset($id)){
			throw new Exception('Id required');
		}
		
		if (isset($_POST['save'])){
			$post = new Validation(array_merge($_POST, $_FILES));
			
			$post->pre_filter('trim', 'userFirstName', 'userLastName', 'userEmail', 'userPhone');
			
			$post->add_rules('userFirstName', 'required');
			$post->add_rules('userLastName', 'required');
			$post->add_rules('userEmail', 'required');
			$post->add_rules('userPhone', 'required');
			
			if (!$post->validate()) {
			   $errors = $post->errors('form_errors');
			   foreach ($errors as $error) {
				   echo '<p class="error">' . $error . '</p>';
			   }
			}
			
			else {
			
				$id = $argumentarray[0];	
				$users = new User_Model;
				//$user = $users->getUserByID($id);
				$user = ORM::factory('user')->where('id', $id)->find();
		
				$user->firstname = $post->userFirstName;
				$user->lastname = $post->userLastName;
				$user->email = $post->userEmail;
				$user->phone1 = $post->userPhone;
			

			

				$user->save();
			}
		}
		
		$this->_renderView();
	}
	
	public function add(){
		$argumentarray = Router::$arguments;
		//$id = $argumentarray[0];
		$users = new User_Model;
		$id = $users->getNextID();
		
		if (isset($_POST['save']))	{
			$post = new Validation(array_merge($_POST, $_FILES));            			  
			$post->pre_filter('trim', 'userFirstName', 'userLastName', 'userEmail', 'userPhone');
			
			$post->add_rules('userFirstName', 'required');
			$post->add_rules('userLastName', 'required');
			$post->add_rules('userEmail', 'required');
			$post->add_rules('userPhone', 'required');
			
			if (!$post->validate()) {
			   $errors = $post->errors('form_errors');
			   foreach ($errors as $error) {
				   echo '<p class="error">' . $error . '</p>';
			   }
			}
			
			else {
				//$id = $argumentarray[0];	
				$users = new User_Model;
				$user = ORM::factory('user');
				
				$user->firstname = $post->userFirstName;
				$user->lastname = $post->userLastName;
				$user->email = $post->userEmail;
				$user->phone1 = $post->userPhone;
				$user->site_id = 1;
				
				

				try {

					$user->save();
					url::redirect('/users/edit/' . $user->id);
				
				} catch (Exception $ex) {
					echo 'There was an error adding this user: '. $ex->getMessage();
					//url::redirect('/users/');
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
		
		
		$users = new User_Model;
		$user = ORM::factory('user')->where('id', $id)->find();
		
		// call custom method to let descandent classes do something when deleting
		$this->customBeforeDelete($user);
		$user->delete();
		$this->customAfterDelete($user);
		
		url::redirect('/users/');
	}
	
	
	
	public function _renderView(){
		$view = new View('admin');
		 
		$view->header  = new View('header');
		$view->content = new View('user_content');
		$view->footer  = new View('footer');
		 
		$view->header->title     = 'User >> Add >> Edit';     // string for variable $title in view header.php
		$view->content->heading  = 'Heading of your page'; // string for variable $heading in view content.php
		 
		$view->render(TRUE);
	}
		

}