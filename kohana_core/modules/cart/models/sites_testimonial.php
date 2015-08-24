<?php defined('SYSPATH') OR die('No direct access allowed.');


class Sites_testimonial_Model extends ORM {

	protected $belongs_to = array(
		'site' => array(), 
		'testimonial' => array()
	);
}