<?php defined('SYSPATH') OR die('No direct access allowed.');


class Sites_occasion_Model extends ORM {

	protected $belongs_to = array(
		'site' => array(), 
		'occasion' => array()
	);
}