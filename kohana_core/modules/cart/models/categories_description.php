<?php defined('SYSPATH') OR die('No direct access allowed.');

class Categories_description_Model extends ORM { //Mptt_Model {
	protected $has_one = array('category');
//	protected $load_with = array('category');
	protected $sorting = array('id' => 'ASC'); 
}