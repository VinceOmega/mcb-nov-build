<?php defined('SYSPATH') OR die('No direct access allowed.');


class Sites_type_Model extends ORM {
	
	protected $belongs_to = array(
		'site' => array(), 
		'type' => array()
	);
}