<?php defined('SYSPATH') or die('No direct script access.');



class Users_Controller extends Base_Controller {	
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
	
	
	public $objectName = 'users';
	public $title = 'Customers List - ';	
	
	public function getQuery(){
		$db = new Database();
		return $db->select('users.id, sites.shortname, users.firstname, users.lastname, users.email')->from('users')
					->join('sites', 'users.site_id', 'sites.id', 'left');
	}
	
	public function edit(){	
		$id = $this->uri->segment(3);
		$customer = ORM::factory('user')->where('id', $id)->find();
		$this->_renderView();
		
		if (isset($_POST['save'])){
			$post = new Validation($_POST);            		
			$post->pre_filter('trim');
			
			$post->add_rules('email', 'required', 'valid::email')
					->add_rules('firstname', 'required')
					->add_rules('lastname', 'required')
					->add_rules('telephone', 'required', 'valid::phone')
					->add_rules('password', 'length[5,42]')
					->add_rules('password_confirm', 'matches[password]')
					->add_rules('billing_zip', 'valid::zip')
					->add_rules('billing_telephone', 'valid::phone')
					->add_rules('billing_email', 'valid::email')
					->add_rules('shipping_zip', 'valid::zip')
					->add_rules('shipping_telephone', 'valid::phone')
					->add_rules('shipping_email', 'valid::email');

			$customer->firstname = $post->firstname;
			$customer->lastname = $post->lastname;
			$customer->email = $post->email;	
			$customer->telephone = $post->telephone;
			
			$customer->users_detail->billing_address1 = $post->billing_address1; 	
			$customer->users_detail->billing_address2 = $post->billing_address2; 	
			$customer->users_detail->billing_city = $post->billing_city; 					
			$customer->users_detail->billing_state = $post->billing_state; 	
			$customer->users_detail->billing_zip = $post->billing_zip; 	
			$customer->users_detail->billing_country = $post->billing_country; 	
			$customer->users_detail->billing_telephone = $post->billing_telephone; 	
			$customer->users_detail->billing_email = $post->billing_email; 	
			
			$customer->users_detail->shipping_address1 = $post->shipping_address1; 	
			$customer->users_detail->shipping_address2 = $post->shipping_address2; 	
			$customer->users_detail->shipping_city = $post->shipping_city; 					
			$customer->users_detail->shipping_state = $post->shipping_state; 	
			$customer->users_detail->shipping_zip = $post->shipping_zip; 	
			$customer->users_detail->shipping_country = $post->shipping_country; 	
			$customer->users_detail->shipping_telephone = $post->shipping_telephone; 	
			$customer->users_detail->shipping_email = $post->shipping_email; 			
				
			if (!$post->validate()) {
				$errors = $post->errors('form_user');	
				$this->view->content->errors = $errors;			   
			}else {
				$this->view->content->errors = '';
				if(!empty($post->password)) $customer->password = Auth::instance()->hash_password($post->password);
				
				try{
					$customer->save();
				}catch(Exception $e){
					//$this->view->content->errors = array($e->getMessage());
					$this->view->content->errors = array('A user with that email already exists');
				}
			}
		}
		
		$orders = ($customer->id) ? ORM::factory('order')->where('user_id='.$customer->id.' OR email="'.$customer->email.'"')->find_all() : array();
		
		$this->view->content->customer = $customer;
		$this->view->content->orders = $orders;
		
		$this->view->render(TRUE);
	}
	
	
	public function _renderView(){
		$this->view = new View('admin');
		 
		$this->view->header  = new View('header');
		$this->view->content = new View('customer_content');
		$this->view->footer  = new View('footer');
		 
		$this->view->header->title     = 'Customers >> Add >> Edit';     // string for variable $title in view header.php
		$this->view->content->heading  = 'Heading of your page'; // string for variable $heading in view content.php
	}
	
	public function getDetails(){
		$out = '';
		if (isset($_GET['id'])){
			$user = ORM::factory('user', (int)$_GET['id']);
			$shipping = ORM::factory('user_shipping_info')->where('user_id', (int)$_GET['id']);
			$billing = ORM::factory('user_billing_info')->where('user_id', (int)$_GET['id']);
			//$billing = ORM::factory('user_shipping_info', $user->users_detail_id);
			$out = array_merge($user->as_array(), $shipping->as_array(), $billing->as_array());
		}
		if (isset($_GET['name'])){
			$db = new Database();
			$query = $db->query("SELECT u.firstname as firstname, u.lastname as lastname, u.email, u.phone1, us.*, ub.*
				FROM users 
				LEFT JOIN user_shipping_info us ON u.id = us.user_id 
				LEFT JOIN user_billing_infos ub ON u.id = ub.user_id 
				WHERE CONCAT( u.lastname, ' ', u.firstname )='".$_GET['name']."'
				ORDER BY o.date_created DESC LIMIT 1");
			$res = $query->result_array(FALSE);
			$out = $res[0];
		}
		
		header('Content-type: application/json');
		die( json_encode($out ));
	}
	
}