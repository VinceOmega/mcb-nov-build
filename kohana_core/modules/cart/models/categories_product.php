<?php defined('SYSPATH') OR die('No direct access allowed.');


class Categories_product_Model extends ORM {

	protected $belongs_to = array(
		'product' => array(), 
		'category' => array()
	);
	
}