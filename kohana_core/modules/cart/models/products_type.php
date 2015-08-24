<?php defined('SYSPATH') OR die('No direct access allowed.');

class Products_type_Model extends ORM {
	
	protected $has_one = array('category', 'products_types_description');
    
	protected $has_and_belongs_to_many = array(
		'sites_types' => 'sites'
	);
}

