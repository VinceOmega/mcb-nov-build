<?php defined('SYSPATH') or die('No direct script access.');


class Events_Controller extends Base_Controller {	

// fields for table
	public $tableCols = array('site_id','name', 'description');
	
	public $fields = array(
		'name' => array(
			'title' => 'Event Name',
			'type' => 'text',
			'required' => true,
			'mask' => false
		),
		'description' => array(
			'title' => 'Description',
			'type' => 'text',
			'required' => false,
			'mask' => false
		),			
		'email_title' => array(
			'title' => 'Email Title',
			'type' => 'text',
			'required' => true,
			'mask' => false
		),	
		'email_body' => array(
			'title' => 'Email Body',
			'type' => 'wysiwyg',
			'required' => true,
			'mask' => false
		),
		'condition' => array(
			'title' => 'Condition',
			'type' => 'text',
			'required' => false,
			'mask' => false
		),	
		'interval' => array(
			'title' => 'Time interval (days)',
			'type' => 'text',
			'required' => false,
			'mask' => '^\d+$'
		),		
		'site_id' => array(
			'title' => 'Site',
			'type' => 'select',
			'required' => false,
			'mask' => '^\d+$',
			'options' => 'sites',
			'index' => 'site_id',
			'stype' => 'select'
		)		
	);
	
	public $objectName = 'events';
	public $title = 'Events List - ';
		
	public function getQuery(){
		$db = new Database();
		return $db->select('e.id, e.name, e.description, e.email_title, e.email_body, e.interval, e.condition, e.last_executed, s.name AS site_id')
                        ->from('events AS e')
                        ->join('sites AS s', 's.id', 'e.site_id', 'left');
	}
}