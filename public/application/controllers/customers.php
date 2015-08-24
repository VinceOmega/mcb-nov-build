<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Default Kohana controller. This controller should NOT be used in production.
 * It is for demonstration purposes only!
 *
 * @package    Core
 * @author     Kohana Team
 * @copyright  (c) 2007-2008 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
class Customers_Controller extends My_Template_Controller {

	// Disable this controller when Kohana is set to production mode.
	// See http://docs.kohanaphp.com/installation/deployment for more details.
	const ALLOW_PRODUCTION = FALSE;

	// Set the name of the template to use
	public $template = 'kohana/template';

	public $description = '';
	public $title = '';
	public $keywords = '';
	
	public function __construct() {
		parent::__construct();
		
		//set texts
		$method = $this->methodNameForSite('setTexts');
		$this->$method();
	}
	
	protected function setTexts_MCC()
	{
		$this->description = '';
		$this->title = 'Customers - MyChocolateCoins.com';
		$this->keywords = 'chocolate hearts, custom chocolate hearts, personalized chocolate hearts, chocolate favors, custom chocolate favors, party favors, personalized chocolate favors, chocolate casino chips, chocolate poker chips, custom chocolate casino chips, casino party favors, wedding favors, personalized wedding favors, baby shower favors, bridal shower favors, chocolate gelt, chocolate gold hearts, chocolate party favors, chocolate candy favors, custom chocolate, custom chocolate poker chips, corporate favors';
	}
	
	protected function setTexts_MCH()
	{
		$this->description = '';
		$this->title = 'Customers - MyChocolateHearts.com';
		$this->keywords = 'chocolate hearts, custom chocolate hearts, personalized chocolate hearts, chocolate favors, custom chocolate favors, party favors, personalized chocolate favors, chocolate casino chips, chocolate poker chips, custom chocolate casino chips, casino party favors, wedding favors, personalized wedding favors, baby shower favors, bridal shower favors, chocolate gelt, chocolate gold hearts, chocolate party favors, chocolate candy favors, custom chocolate, custom chocolate poker chips, corporate favors';
	}

	protected function setTexts_MCB()
	{
		$this->description = 'Create your very own custom chocolate bars with your own text and images, or use our stock images';
		$this->title = 'Custom Chocolate Hearts - MyChocolateHearts.com: Create customized chocolate bars with your own design';
		$this->keywords = 'chocolate bars, custom chocolate bars, personalized chocolate bars, chocolate favors, custom chocolate favors, party favors, personalized chocolate favors, chocolate casino chips, chocolate poker chips, custom chocolate casino chips, casino party favors, wedding favors, personalized wedding favors, baby shower favors, bridal shower favors, chocolate gelt, chocolate gold hearts, chocolate party favors, chocolate candy favors, custom chocolate, custom chocolate poker chips, corporate favors';
	}


	public function index()
	{
		if (User_Model::logged_in()) {
			url::current();

		} else {
			url::redirect('/customers/login');
		}
	}

	public function login()
	{
		if (User_Model::logged_in()) {
			url::redirect(url::current());
			return;
		}
		
		$this->template->content = new View('customers/login');
		$this->template->content->email = '';
		$this->template->content->password = '';
		$this->template->content->errors = '';

		if (request::method()=='post')
		{
			$post = new Validation($_POST);
			$post->add_rules('email', 'email');
			$post->add_rules('password', 'required');

			if ($post->validate()) {
				if (ORM::factory('user')->login($post->email, $post->password)) {
					if (isset($post->redirect))
						url::redirect($post->redirect);
					url::redirect($_SERVER['HTTP_REFERER']);
				} else {
					$this->template->content->email = $post->email;
					$this->template->content->errors = 'Invalid email and/or password.';
				}
			} else {
				$this->template->content->errors = 'Email and password are required.';
			}
		}
		
		$this->template->metaDescription = $this->description;
		$this->template->metaKeywords = $this->keywords;	
		$this->template->metaTitle = $this->title;
		$this->template->title = $this->title;
	}
	
	public function forgot_password ()
	{
		if (User_Model::logged_in()) {
			url::redirect('/customers/my_account');
			return;
		}
		
		$this->template->content = new View('customers/forgot_password');
		$this->template->content->email = '';
		$this->template->content->errors = '';
			
		if (request::method()=='post')
		{
			$post = new Validation($_POST);
			$post->add_rules('email', 'required');
			
			$this->template->content->email = $post->email;
			
			if ($post->validate()) {
				$user = ORM::factory('user')->where('email',$post->email)->find();
				if ($user->id != 0)
				{
					$user->password_recovery_hash = md5((string)$user);
					$user->save();
					$this->template->content->email_sent = TRUE;
					
					$url = 'http://'.$_SERVER['SERVER_NAME'].'/customers/new_password?hash='.$user->password_recovery_hash;
					Autoresponder::sendEmail('user.forgot_password', $user->email, $user,
						array(
							'here_link' => '<a href="'.$url.'">here</a>',
							'url' => $url,
						)
					);
				} else {
					$this->template->content->errors = 'The email doesn\'t exists in our database.';
				}
			} else {
				$this->template->content->errors = 'Email is required.';
			}
		}
		
		$this->template->metaDescription = $this->description;
		$this->template->metaKeywords = $this->keywords;	
		$this->template->metaTitle = $this->title;
		$this->template->title = $this->title;
	}
	
	public function my_account()
	{
		if (FALSE == User_Model::logged_in()) {
			url::redirect('/customers/login?redirect=/customers/my_account');
			return;
		}

		$ust = 1;
		$ost = 1;
		$get = "";
		if(!empty($_GET) && isset($_GET['ust'])){

			$get = $_GET;
			$ust = $get['ust'];
			$ost = $get['ost'];

			} 

		$db = new Database;
		
		$this->template->metaDescription = $this->description;
		$this->template->metaKeywords = $this->keywords;	
		$this->template->metaTitle = $this->title;
		$this->template->title = $this->title;

		
		
		$this->template->content = new View('customers/my_account');
		$this->template->content->errors = array();
		
		$user = User_Model::logged_user();
		$this->template->content->user = $user;
		
		$orders = ORM::factory('order')
							->where('statusID',2)
							->where('user_id',$user->id)
							->where('site_id',self::getCurrentSite()->id)
							->orderBy('id','DESC')
							->find_all();
		$this->template->content->orders = $orders;

		$result = $db->query("SELECT  o.id, ob.order_id, ob.product_id, o.user_id, image 
							FROM orders as o 
							LEFT JOIN orders_baskets as ob 
							ON o.id = ob.order_id 
							LEFT JOIN products as p 
							ON p.id = ob.product_id 
							LEFT JOIN products_descriptions as pd
							ON pd.id = p.products_description_id 
							WHERE o.user_id = $user->id
							ORDER BY o.id DESC LIMIT $ust, 10");
		
		// $this->template->content->rows = mysql_num_rows($result);
		$this->template->content->ust = $ust;
		$this->template->content->baskets = $result; 

				$result = $db->query("SELECT COUNT(o.id), o.id, ob.order_id, ob.product_id, o.user_id, image 
							FROM orders as o 
							LEFT JOIN orders_baskets as ob 
							ON o.id = ob.order_id 
							LEFT JOIN products as p 
							ON p.id = ob.product_id 
							LEFT JOIN products_descriptions as pd
							ON pd.id = p.products_description_id 
							WHERE o.user_id = $user->id");

		$this->template->content->bcount = $result;

		$sql = "SELECT * FROM user_designs WHERE userid = $user->id ORDER BY id DESC LIMIT $ost, 10";
			if(!$results = $db->query($sql)){
		 		printf(mysqli_error($db));
	
		 					}

		$this->template->content->ost = $ost;
		$this->template->content->designs = $results;

$sql = "SELECT *, COUNT(*) FROM user_designs WHERE userid = $user->id";
			if(!$results = $db->query($sql)){
		 		printf(mysqli_error($db));
	
		 					}


		$this->template->content->dcount = $results;
		
		$personal_info_fields = User_Model::getFormFields();
		foreach ($personal_info_fields as $section => &$fields) {
			foreach ($fields as &$field) {
				if (isset($_POST[ $field->formName ]))
					$field->value = $_POST[$field->formName];
				else {
					switch ($section) {
						case 'user':	
							$field->value = $user->{$field->db_name};
							break;
						case 'billing':	
							$field->value = $user->user_billing_info->{$field->db_name};
							break;
						case 'shipping':
							$field->value = $user->user_shipping_info->{$field->db_name};
							break;
					}
				}
			}
		}
		unset($fields);
		unset($field);
		$this->template->content->personal_info_fields = $personal_info_fields;
		$this->template->content->countries = ORM::factory('country')->find_all();
		$this->template->content->states = ORM::factory('state')->find_all();
		
		if (request::method() == 'post')
		{
			if (isset($_GET['edit_info']))
			{
				$post = new Validation($_POST);
				foreach ($personal_info_fields as $section => $fields) {
					foreach ($fields as $field) {
						if ($field->required)
							$post->add_rules($field->formName, 'required');
					}
				}
				
				if ($post->validate()) {
					foreach ($personal_info_fields['user'] as $field)
						$user->{$field->db_name} = $field->value;
					$user->save();
					
					foreach ($personal_info_fields['shipping'] as $field)
						$user->user_shipping_info->{$field->db_name} = $field->value;
					$user->user_shipping_info->save();
					
					foreach ($personal_info_fields['billing'] as $field)
						$user->user_billing_info->{$field->db_name} = $field->value;
					$user->user_billing_info->save();
					
					$this->template->content->general_message = 'Info succesfully updated.';
				} else {
					$errors = array();
					foreach ($post->errors() as $field => $error)
					{
						$msg = ucfirst($error);
						switch ($error) {
							case 'required': break;
						}
						$errors[$field] = $msg;
					}
					$this->template->content->errors = $errors;
				}
			}
			elseif (isset($_GET['change_password']))
			{
				$post = new Validation($_POST);

				$post->add_rules('old_password', 'required');
				$post->add_rules('new_password', 'required', 'length[6,999]', 'matches[new_password_again]');
				$post->add_rules('new_password_again', 'required');
			
				if ($post->validate()) {
					if (md5($post->old_password) == $user->password) {

						$user->password = $post->new_password;
						$user->save();
						$this->template->content->general_message = 'Password succesfully updated.';
					} else {
						$this->template->content->errors['old_password'] = 'Current password doesn\'t match.';
					}
				} else {
					$errors = array();
					foreach ($post->errors() as $field => $error)
					{
						$msg = ucfirst($error);
						switch ($error) {
							case 'required': break;
							case 'length': $msg = 'The password must be at least 8 characters'; break;
							case 'matches': $msg = 'Passwords don\'t match'; break;
						}
						$errors[$field] = $msg;
					}
					$this->template->content->errors = $errors;
				}
			}
		}
	}
	
	public function new_password()
	{
		$this->template->content = new View('customers/new_password');
		$this->template->content->errors = '';
		$this->template->metaDescription = $this->description;
		$this->template->metaKeywords = $this->keywords;	
		$this->template->metaTitle = $this->title;
		$this->template->title = $this->title;
		
		
		$user = $this->tempalte = ORM::factory('user')
					->where('password_recovery_hash',$_GET['hash'])
					->find();
		$this->template->content->user = $user;
		
		if ($user->id == 0) {
			$this->template->content->link_expired = TRUE;
			return;
		}
		
		if (request::method() == 'post')
		{
			$post = new Validation($_POST);
			$post->add_rules('new_password', 'required', 'length[6,999]', 'matches[new_password_again]');
			$post->add_rules('new_password_again', 'required');

			if ($post->validate()) {
				$user->password = $post->new_password;
				$user->password_recovery_hash = '';
				$user->save();
				$this->template->content->password_changed = TRUE;
			} else {
				$errors = array();
				foreach ($post->errors() as $field => $error) {
					$msg = ucfirst($error);
					switch ($error) {
						case 'required': break;
						case 'length': $msg = 'The password must be at least 8 characters'; break;
						case 'matches': $msg = 'Passwords don\'t match'; break;
					}
					$errors[$field] = $msg;
				}
				$this->template->content->errors = $errors;
			}
		}
	}
	
	public function logout()
	{
		if (User_Model::logged_in())
			User_Model::logged_user()->logout();
		
		url::redirect('/');
	}
	
	public function check_email()
	{
		$user = ORM::factory('user')
						->where('email',uri::segment(3))
						->find_all();
		
		$result = array('status'=> count($user) > 0 ? 'ERROR' : 'OK');
		exit (json_encode($result));
	}

	public function register(){

		if (User_Model::logged_in()) {
			url::redirect('/customers/my_account');
		} 
		$this->template->content = new View('customers/register');
		$this->template->metaDescription = $this->description;
		$this->template->metaKeywords = $this->keywords;	
		$this->template->metaTitle = $this->title;
		$this->template->title = $this->title;

		$formFields = User_Model::getFormFields();
		if (User_Model::logged_in()) {
			$user = User_Model::logged_user();
			$this->template->content->user = $user;

			foreach ($formFields as $section => &$fields) {
				if ($section == 'user') continue;

				foreach ($fields as &$field) {
					switch ($field->form) {
						case 'billing':	
							$field->value = $user->user_billing_info->{$field->db_name};
							break;
						case 'shipping':
							$field->value = $user->user_shipping_info->{$field->db_name};
							break;
					}
				}
			}
		}
		$this->template->content->formFields = $formFields;
		$this->template->content->countries = ORM::factory('country')->find_all();
		$this->template->content->states = ORM::factory('state')->find_all();


		if (request::method() === 'post')
		{
			$post = new Validation($_POST);
			$post->add_rules('email', 'email');
			$post->add_rules('password', 'required');
			$post->add_rules('first_name', 'required');
			$post->add_rules('last_name', 'required');
			$post->add_rules('address_1', 'required');
			$post->add_rules('city', 'required');
			$post->add_rules('state', 'required');
			$post->add_rules('zip', 'required');
			$post->add_rules('country', 'required');
			$post->add_rules('phone', 'required');

			if ($post->validate()) {
				$db = new Database;
				//$auth = _Auth::factory();
				$user = ORM::factory('user');
				$user->email = $post->email;
				$user->password = $post->password;
				$user->firstname = $post->first_name;
				$user->lastname = $post->last_name;
				$user->company = $post->company;
				$user->address1 = $post->address_1;
				$user->address2 = $post->address_2;
				$user->city = $post->city;
				$user->state = $post->state;
				$user->zip = $post->zip;
				$user->country = $post->country;
				$user->phone1 = $post->phone;
				$user->phone2 = $post->second_phone;
				$user->save();
				
				unset($user);
				$id = $db->query("SELECT id
								  FROM users
								  WHERE email = '$post->email'");
				//print_r(mysql_fetch);
				foreach($id as $keys => $value){
				//	echo 'Key: '. $keys."<br>";
					if(is_object($value)){
						foreach($value as $vkeys => $vvalue){
				//			echo 'VKeys: '.$vkeys."<br>";
				//			echo 'VValue: '.$vvalue."<br>";
								if($vkeys == 'id'){
									$id = $vvalue;
								}
						}
					}else{
				//	echo 'Value: '.$value."<br>";
					}
				}			
				//die();

				if(!$post->address_2){
					$post->address_2 = "none";
				}

				if(!$post->second_phone){
					$post->second_phone = "none";
				}

			$billing = $db->query(
							"INSERT into user_billing_infos
							SET user_id = '$id', 
							firstname = '$post->first_name',
							lastname = '$post->last_name',
							company = '$post->company',
							address1 = '$post->address_1',
							address2 = '$post->address_2',
							city = '$post->city',
							state = '$post->state',
							zip = '$post->zip',
							country = '$post->country',
							phone1 = '$post->phone',
							phone2 = '$post->second_phone'
							"

					);

				//$results = $db->excute();



				// $user = ORM::factory('user_billing_infos');
				// $user->email = $post->email;
				// $user->password = md5($post->password);
				// $user->firstname = $post->first_name;
				// $user->lastname = $post->last_name;
				// $user->company = $post->company;
				// $user->address1 = $post->address_1;
				// $user->address2 = $post->address_2;
				// $user->city = $post->city;
				// $user->state = $post->state;
				// $user->zip = $post->zip;
				// $user->country = $post->country;
				// $user->phone1 = $post->phone;
				// $user->phone2 = $post->second_phone;
				// $user->save();
				// unset($user);
				if($post->s_billing === '1'){

					$shipping = $db->query("INSERT INTO user_shipping_infos
							SET user_id = '$id',
							firstname = '$post->first_name',
							lastname = '$post->last_name',
							company = '$post->company',
							address1 = '$post->address_1',
							address2 = '$post->address_2',
							city = '$post->city',
							state = '$post->state',
							zip = '$post->zip',
							country = '$post->country',
							phone1 = '$post->phone',
							phone2 = '$post->second_phone'
							"

					);


				//$results2 = $db->excute();

					// $user = ORM::factory('user_shipping_infos');
					// $user->firstname = $post->s_first_name;
					// $user->lastname = $post->s_last_name;
					// $user->company = $post->s_company;
					// $user->address1 = $post->s_address_1;
					// $user->address2 = $post->s_address_2;
					// $user->city = $post->s_city;
					// $user->state = $post->s_state;
					// $user->zip = $post->s_zip;
					// $user->country = $post->s_country;

				}
				
				url::redirect('/customers/login');
			}
		}
	}
	
	public function __call($method, $arguments)
	{
		// Disable auto-rendering
		$this->auto_render = FALSE;

		// By defining a __call method, all pages routed to this controller
		// that result in 404 errors will be handled by this method, instead of
		// being displayed as "Page Not Found" errors.
		echo 'This text is generated by __call. If you expected the index page, you need to use: welcome/index/'.substr(Router::$current_uri, 8);
	}

} // End Welcome Controller