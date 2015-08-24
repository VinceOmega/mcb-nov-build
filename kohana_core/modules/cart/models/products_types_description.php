<?php defined('SYSPATH') OR die('No direct access allowed.');

class Products_types_description_Model extends ORM {
	
	protected $has_one = array('category', 'products_types_description');


	//public function find($id){
	//	$p = parent::find($id);
	//	return $p;
	//}		

}

