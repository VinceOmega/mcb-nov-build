<?php defined('SYSPATH') or die('No direct script access.');

class Address_Controller extends My_Template_Controller {
	public $template = 'kohana/template';
    
	public function __construct() {
		parent::__construct();
		$this->session = Session::instance();

		if (Auth::instance()->logged_in())
		{
			// Set the current user
			$this->user = $_SESSION['auth_user'];
		}
	}
	
	public function index() {

		$this->template->title = 'Address';
        $this->template->metaDescription = '';

		$this->template->content = View::factory('address')
			->bind('shipping_errors', $shipping_errors)
			->bind('billing_errors', $billing_errors)
			->bind('post_shipping', $post_shipping)
			->bind('post_billing', $post_billing)
			->bind('post', $post)
			->bind('$_POST', $_POST)
			->bind('postdata', $postdata)
			->bind('form', $form)
			->bind('error', $error)
			->bind('other', $other)
			->bind('account_errors', $account_errors)
			->bind('password_error', $password_error)
			->bind('p', $this->cart)
			->bind('cart', $this->cart);
	
		$this->cart = (isset($_POST['ses'])) ?  new Basket($_POST['ses']) : new Basket;
		$this->cart->save();
				
		if ($this->cart->isEmpty())
			url::redirect('/cart');   
		
		if (isset($_POST['discount_code'])){
			$this->session->set('discount_code', $_POST['discount_code']);
			unset($_POST['discount_code']);
		}
		
		$error = '';
		if (!isset($_POST['submit'])){
			$form = array(
				'billing_firstname' => '',
				'billing_mi' => '',
				'billing_lastname' => '',
				'billing_company' => '',
				'billing_address1' => '',
				'billing_address2' => '',
				'billing_city' => '',
				'billing_state' => '',
				'billing_zip' => '',
				'billing_country' => '',
				'billing_telephone' => '',
				'billing_email' => '',
			
				'shipping_firstname' => '',
				'shipping_mi' => '',
				'shipping_lastname' => '',
				'shipping_company' => '',
				'shipping_address1' => '',
				'shipping_address2' => '',
				'shipping_city' => '',
				'shipping_state' => '',
				'shipping_zip' => '',
				'shipping_country' => '',
				'shipping_telephone' => '',
				'shipping_email' => '',
				
				'create_account' => '',
				'password' => '',
				'confirm_password' => '',
				
				'different_shipping' => '',
				'newsletter' => '',
				'comment' => ''
			);											
		}
									
		$form['billing_firstname'] = $this->session->get('billing_firstname');
		$form['billing_mi'] = $this->session->get('billing_mi');
		$form['billing_lastname'] = $this->session->get('billing_lastname');
		$form['billing_address1'] = $this->session->get('billing_address1');
		$form['billing_address2'] = $this->session->get('billing_address2');
		$form['billing_company'] = $this->session->get('billing_company');
		$form['billing_city'] = $this->session->get('billing_city');
		$form['billing_state'] = $this->session->get('billing_state');
		$form['billing_zip'] = $this->session->get('billing_zip');
		$form['billing_country'] = $this->session->get('billing_country');
		$form['billing_email'] = $this->session->get('billing_email');
		$form['billing_telephone'] = $this->session->get('billing_telephone');	
		
		$form['password'] = '';
		$form['confirm_password'] = '';
		
		$form['different_shipping'] = $this->session->get('different_shipping');	
		
		if (isset($_POST['submit'])) {
			$valid = false;
			$post = new Validation($_POST);            	
			$postdata = new Validation($_POST);      
			$post_pass = new Validation($_POST);      			
			$post->pre_filter('trim');
			
			$post->add_rules('billing_firstname', 'required', 'length[2,127]');
			$post->add_rules('billing_lastname', 'required', 'length[2,127]');
			$post->add_rules('billing_address1', 'required', 'length[4,127]');
			$post->add_rules('billing_city', 'required', 'length[2,127]');
			
			switch($post['billing_country']){
				case 'US':
					$post->add_rules('billing_zip', 'required', 'valid::zip');
					$post->add_rules('billing_state', 'required');					
				break;
				case 'CA':
					$post->add_rules('billing_zip', 'required');
					$post->add_rules('billing_state', 'required');
				break;
			}
			
			$post->add_rules('billing_country', 'required');
			$post->add_rules('billing_telephone', 'required', 'valid::phone');
			$post->add_rules('billing_email', 'required', 'valid::email');
			
			//$post_pass->add_rules('password', 'length[5,42]');
			//$post_pass->add_rules('confirm_password', 'matches[password]');
		
			
			if (isset($postdata['different_shipping']) AND $postdata['different_shipping']== 'on') {
				$postdata->add_rules('shipping_firstname', 'required', 'length[2,127]');
				$postdata->add_rules('shipping_lastname', 'required', 'length[2,127]');
				$postdata->add_rules('shipping_address1', 'required', 'length[2,127]');
				$postdata->add_rules('shipping_city', 'required', 'length[2,127]');
				
				switch($post['shipping_country']){
					case 'US':
						$postdata->add_rules('shipping_zip', 'required', 'valid::zip');
						$postdata->add_rules('shipping_state', 'required');					
					break;
					case 'CA':
						$postdata->add_rules('shipping_zip', 'required');
						$postdata->add_rules('shipping_state', 'required');
					break;
				}
				
				$postdata->add_rules('shipping_country', 'required');
				//$postdata->add_rules('shipping_telephone', 'required', 'valid::phone');
				//$postdata->add_rules('shipping_email', 'required', 'valid::email');
				
				if ( !$postdata->validate() ) {
				   $shipping_errors = $postdata->errors('form_errors');
				}
			}
			
			if (isset($_POST['different_shipping']) AND $_POST['different_shipping'] == 'on') {
				$this->session->set('shipping_firstname', $postdata['shipping_firstname']);
				$this->session->set('shipping_mi', $postdata['shipping_mi']);
				$this->session->set('shipping_lastname',  $postdata['shipping_lastname']);
				$this->session->set('shipping_address1', $postdata['shipping_address1']);
				$this->session->set('shipping_address2', $postdata['shipping_address2']);
				$this->session->set('shipping_city', $postdata['shipping_city']);
				$this->session->set('shipping_state', isset($postdata['shipping_state']) ? $postdata['shipping_state'] : $postdata['state']);
				$this->session->set('shipping_zip', $postdata['shipping_zip']);
				$this->session->set('shipping_country', $postdata['shipping_country']);
				//$this->session->set('shipping_telephone', $postdata['shipping_telephone']);
				//$this->session->set('shipping_email', $postdata['shipping_email']);
				$this->session->set('different_shipping', $_POST['different_shipping']);
				$this->session->set('shipping_company', $_POST['shipping_company']);
			}
			else {
				$this->session->set('shipping_firstname', $post['billing_firstname']);
				$this->session->set('shipping_mi', $post['billing_mi']);
				$this->session->set('shipping_lastname',  $post['billing_lastname']);
				$this->session->set('shipping_address1', $post['billing_address1']);
				$this->session->set('shipping_address2', $post['billing_address2']);
				$this->session->set('shipping_city', $post['billing_city']);
				$this->session->set('shipping_state', isset($post['billing_state']) ? $post['billing_state'] : $post['state']);
				$this->session->set('shipping_zip', $post['billing_zip']);
				$this->session->set('shipping_country', $post['billing_country']);
				//$this->session->set('shipping_telephone', $post['billing_telephone']);
				//$this->session->set('shipping_email', $post['billing_email']);		
				$this->session->set('shipping_company', $_POST['billing_company']);
			}
			
			if (isset($postdata['newsletter']) AND $postdata['newsletter']== 'on') {
				//subscribe to newsletter
				
				include "Snoopy.class.php";
				$snoopy = new Snoopy;
				$submit_url = "http://www.gimmail.com/box.php";
				$submit_vars["email"] = $_POST['billing_email'];
				$submit_vars["p"] = "51";
				$submit_vars["nlbox[1]"] = "71";
				$submit_vars["funcml"] = "add";

				$snoopy->submit($submit_url, $submit_vars);				
			}
			
			$form = $post->as_array();
			$form = $postdata->as_array();
			if ( !$post->validate() ) {
			   $billing_errors = $post->errors('form_errors');
			}
						
			$this->session->set('shipping_method', $postdata['shipping_method']);
			
			$this->session->set('billing_firstname', $post['billing_firstname']);
			$this->session->set('billing_mi', $post['billing_mi']);
			$this->session->set('billing_lastname',  $post['billing_lastname']);
			$this->session->set('billing_address1', $post['billing_address1']);
			$this->session->set('billing_address2', $post['billing_address2']);
			$this->session->set('billing_city', $post['billing_city']);
			$this->session->set('billing_state', isset($post['billing_state']) ? $post['billing_state'] : $post['state']);
			$this->session->set('billing_zip', $post['billing_zip']);
			$this->session->set('billing_country', $post['billing_country']);
			$this->session->set('billing_telephone', $post['billing_telephone']);
			$this->session->set('billing_email', $post['billing_email']);
			$this->session->set('billing_company', $post['billing_company']);

			$this->session->set('comment', $post['comment']);
			
	
			if ($post->validate() AND $postdata->validate()){
				$valid = true;
			
				//create an account
				//if (isset($_POST['create_account']) AND $_POST['create_account'] == 'on'){
				if (true){
				/*
					if ( !$post_pass->validate() ) {
					   $password_error = $post_pass->errors('form_errors');
					}	
				*/
					//if ( $post_pass->validate() ) {
					if ( true ) {
				
						$p = array();
						$p['firstname'] = $_POST['billing_firstname'];
						$p['lastname'] = $_POST['billing_lastname'];
						$p['email'] = $_POST['billing_email'];
						$p['telephone'] = $_POST['billing_telephone'];
						$p['company'] = $_POST['billing_company'];
						$p['password'] = '';//$_POST['password'];
						$p['password_confirm'] = '';//$_POST['confirm_password'];
									
						// Create a new user
						$user = ORM::factory('user')->where('email="'.$p['email'].'"')->find();

						// Give the user login privileges
						$user->add(ORM::factory('role', 'login'));

						// Validate and save the new user
						if ($user->validate($p, TRUE))
						{
							// Log in now
							Auth::instance()->login($user, $p['password']);
						}
						
						$account_errors = $p->errors('form_user');
						if (count($account_errors)==1 && isset($account_errors['email']) && $account_errors['email']=='A user account already exists with this email.'){
						// existing user, save his/her actual data
							$user->firstname = $p['firstname'];
							$user->lastname = $p['lastname'];
							$user->telephone = $p['telephone'];
							$user->company = $p['company'];
							$user->save();
							$account_errors = false;
						}
					
					
						if (!$account_errors) {
						
							$user_detail = ($user->users_detail_id) ? ORM::factory('users_detail')->where('id='.$user->users_detail_id)->find() : ORM::factory('users_detail');
							$user_detail->billing_first_name = $post['billing_firstname'];
							$user_detail->billing_last_name = $post['billing_lastname'];
							$user_detail->billing_address1 = $post['billing_address1'];
							$user_detail->billing_address2 = $post['billing_address2'];
							$user_detail->billing_city = $post['billing_city'];
							$user_detail->billing_state = isset($post['billing_state']) ? $post['billing_state'] : $post['state'];
							$user_detail->billing_zip = $post['billing_zip'];
							$user_detail->billing_country = $post['billing_country'];
							$user_detail->billing_telephone = $post['billing_telephone'];
							$user_detail->billing_email = $post['billing_email'];
							$user_detail->billing_company = $post['billing_company'];
							
							if (isset($_POST['different_shipping']) AND $_POST['different_shipping'] == 'on') {
								$user_detail->shipping_first_name = $postdata['shipping_firstname'];
								$user_detail->shipping_last_name = $postdata['shipping_lastname'];
								$user_detail->shipping_address1 = $postdata['shipping_address1'];
								$user_detail->shipping_address2 = $postdata['shipping_address2'];
								$user_detail->shipping_city = $postdata['shipping_city'];
								$user_detail->shipping_state = isset($post['shipping_state']) ? $post['shipping_state'] : $post['state'];
								$user_detail->shipping_zip = $postdata['shipping_zip'];
								$user_detail->shipping_country = $postdata['shipping_country'];
								//$user_detail->shipping_telephone = $postdata['shipping_telephone'];
								//$user_detail->shipping_email = $postdata['shipping_email'];
								$user_detail->shipping_company = $postdata['shipping_company'];
							}
							else {
								$user_detail->shipping_first_name = $post['billing_firstname'];
								$user_detail->shipping_last_name = $post['billing_lastname'];
								$user_detail->shipping_address1 = $post['billing_address1'];
								$user_detail->shipping_address2 = $post['billing_address2'];
								$user_detail->shipping_city = $post['billing_city'];
								$user_detail->shipping_state = isset($post['billing_state']) ? $post['billing_state'] : $post['state'];
								$user_detail->shipping_zip = $post['billing_zip'];
								$user_detail->shipping_country = $post['billing_country'];
								//$user_detail->shipping_telephone = $post['billing_telephone'];
								//$user_detail->shipping_email = $post['billing_email'];			
								$user_detail->shipping_company = $postdata['billing_company'];
							}
								
							$user_detail->save();
							
							$user->users_detail_id = $user_detail->id;
							$user->save();
							$valid = true;
						}
						else 
							//$valid = false;
							$valid = true;
					}
					else
						$valid = false;
				}
			}
			if ($valid)
				url::redirect('/checkout');
		}	
	}
}
