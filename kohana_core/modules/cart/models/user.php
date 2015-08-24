<?php defined('SYSPATH') or die('No direct script access.');

class userFormField extends stdClass {
	public $form		= '';
	public $db_name		= '';
	public $name		= '';
	public $required	= '';
	public $value		= '';
	public $comment		= '';
	
	public $formName	= '';
	
	public function __construct($form, $db_name, $name, $required=FALSE, $comment='') {
		$this->form		= $form;
		$this->db_name	= $db_name;
		$this->name		= $name;
		$this->required = $required;
		$this->comment	= $comment;
		
		$this->formName = $form.ucfirst($db_name);
	}
}

class User_Model extends ORM {
	
	protected $has_one = array('user_billing_info','user_shipping_info');
	protected $belongs_to = array('site');
	
	public function __set($key, $value)
	{
		if ($key === 'password')
			$value = md5($value);

		parent::__set($key, $value);
	}
	
	public static function logged_in()
	{
		return Session::instance()->get('user') != NULL;
	}
	
	public static function logged_user()
	{
		if (self::logged_in())
			return Session::instance()->get('user');
		return FALSE;
	}

	public function login($email, $password)
	{
		$user = $this
				->where('email',$email)
				->where('password',md5($password))
				->find();

		if ($user->id != 0)
		{
			Session::instance()->set('user',$user);
			return TRUE;
		}
		else
			return FALSE;
	}
	
	public function forceLogin()
	{
		Session::instance()->set('user',$this);
	}


	public function logout()
	{
		Session::destroy();
	}
	
	public static function getFormFields()
	{
		return array(
			'user' => array(
				new userFormField('user', 'firstname',	'First Name',TRUE),
				new userFormField('user', 'lastname',	'Last Name',TRUE),
				new userFormField('user', 'email',		'Email',TRUE),
				new userFormField('user', 'company',	'Company'),
				new userFormField('user', 'address1',	'Address Line 1', TRUE),
				new userFormField('user', 'address2',	'Address Line 2'),
				new userFormField('user', 'city',		'City', TRUE),
				new userFormField('user', 'state',		'State', TRUE),
				new userFormField('user', 'zip',		'Zip Code', TRUE),
				new userFormField('user', 'country',	'Country', TRUE),
				new userFormField('user', 'phone1',		'Phone',TRUE),
				new userFormField('user', 'phone2',		'Secondary Phone'),
			),
			'shipping' => array(
				new userFormField('shipping', 'firstname',	'First Name',TRUE),
				new userFormField('shipping', 'lastname',	'Last Name',TRUE),
				new userFormField('shipping', 'company',	'Company'),
				new userFormField('shipping', 'address1',	'Address Line 1', TRUE),
				new userFormField('shipping', 'address2',	'Address Line 2'),
				new userFormField('shipping', 'city',		'City', TRUE),
				new userFormField('shipping', 'state',		'State', TRUE),
				new userFormField('shipping', 'zip',		'Zip Code', TRUE),
				new userFormField('shipping', 'country',	'Country', TRUE),
				new userFormField('shipping', 'phone1',		'Phone', FALSE, 'Numbers only'),
				new userFormField('shipping', 'phone2',		'Secondary Phone',FALSE, 'Numbers only'),
			),
			'billing' => array(
				new userFormField('billing', 'firstname',	'First Name',TRUE),
				new userFormField('billing', 'lastname',	'Last Name',TRUE),
				new userFormField('billing', 'company',		'Company'),
				new userFormField('billing', 'address1',	'Address Line 1', TRUE),
				new userFormField('billing', 'address2',	'Address Line 2'),
				new userFormField('billing', 'city',		'City', TRUE),
				new userFormField('billing', 'state',		'State', TRUE),
				new userFormField('billing', 'zip',			'Zip Code', TRUE),
				new userFormField('billing', 'country',		'Country', TRUE),
				new userFormField('billing', 'phone1',		'Phone',TRUE, 'Numbers only'),
				new userFormField('billing', 'phone2',		'Secondary Phone', FALSE, 'Numbers only'),
			)
		);
	}
	
	public function __get($column)
	{
		if ($column == 'user_billing_info' || $column == 'user_shipping_info')
		{
			if (isset($this->related[$column]))
				return $this->related[$column];
			
			$model = ORM::factory($column);
			$model->where('user_id',$this->id);
			$model->orderby('id','DESC');
			return $this->related[$column] = $model->find();
		}
		return parent::__get($column);
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
    /**
	 * Gets an array of all products
	 *
	 * @return array
	 */
	public function getUsers() {
		$db = new Database;
		return $db->query('SELECT * FROM users ORDER BY id ASC');  
	}
  
	/**
	 * Gets a single product
	 *
	 * @return array
	 */
	public function getUserByID($id) {
		$db = new Database;
		$user = $db->query('SELECT * FROM users WHERE id = '.$id.'');
		return $user[0];
	}
	
	public function getNextID() {
		$db = new Database;
		$user = $db->query('SELECT id FROM users ORDER BY id DESC');
		$next = $user[0]->id + 1;
		return $next;
	}

}

