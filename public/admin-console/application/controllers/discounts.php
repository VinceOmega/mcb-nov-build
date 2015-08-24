<?php defined('SYSPATH') or die('No direct script access.');

class Discounts_Controller extends Base_Controller {	

// fields for table
	public $tableCols = array('name', 'type');
	
	public $fields = array(
		'name' => array(
			'title' => 'Discount Name',
			'type' => 'text',
			'required' => true,
			'mask' => false
		),
		'percent' => array(
			'title' => 'Discount (%)',
			'type' => 'text',
			'required' => false,
			'mask' => '^[0-9\.]*$'
		),			
		'amount' => array(
			'title' => 'Discount ($)',
			'type' => 'text',
			'required' => false,
			'mask' => '^[0-9\.]*$'
		),	
		'shipping_percent' => array(
			'title' => 'Shipping Discount (%)',
			'type' => 'text',
			'required' => false,
			'mask' => '^[0-9\.]*$'
		),			
		
		'effective_from' => array(
			'title' => 'Discount action starts',
			'type' => 'date',
		),
		'effective_to' => array(
			'title' => 'Discount action ends',
			'type' => 'date',
		),
		'type' => array(
			'title' => 'Type',
			'type' => 'select',
			'required' => false,
			'mask' => '^\d+$',
			'options' => 'discounts_types',
			'index' => 'type_id',
			'stype' => 'select'
		),			
		'condition' => array(
			'title' => 'Condition',
			'type' => 'text',
			'description' => '%total% - Total order\'s payment amount, %code% - discount code, and %amount% - amount of product in cart'
		),
		'description' => array(
			'title' => 'Description',
			'type' => 'wysiwyg',
		)
		
	);
	
	public $objectName = 'discounts';
	public $title = 'Discounts List - ';
		
	public function getQuery(){
		$db = new Database();
		return $db->select('discounts.id', 'discounts.name', 'discounts_types.name as type')
			->from('discounts')
			->join('discounts_types', 'discounts_types.id', 'discounts.type_id', 'left');
	}		
	
	public function customBeforeSave(&$row){
		if ($row->effective_from=='') $row->effective_from = '0000:00:00';
		if ($row->effective_to=='') $row->effective_to = '0000:00:00';
	}
	
	public function customize(){
		$id = $this->uri->segment(3);
		if (!$id || isset($_POST['cancel'])) url::redirect('discounts');
		$db = new Database();
		if (isset($_POST['submit'])){
			$db->delete('discounts_objects', array('discount_id' => $id));
			if(isset($_POST['objects'])){
				foreach ($_POST['objects'] as $object_id){
					$db->insert('discounts_objects', array('discount_id'=>$id, 'object_id'=>$object_id));
				}
			}
			url::redirect('discounts');
		}
		$this->discount = ORM::factory('discount')->where('id', $id)->find();

		$type = ORM::factory('discounts_type', $this->discount->type_id);
		if($type->table==''){
			url::redirect('discounts/?msg='.urlencode('You can not costumize that type of discount'));
		}

		$list = $this->getList($type->table, 'id', $type->name_field);

		$rows = $db->select('object_id')->from('discounts_objects')->where('discount_id='.$id)->get();
//var_dump($rows); die();		
		$values = array();
		foreach ($rows as $row){
			$values[] = $row->object_id;
		}

		$this->select = form::dropdown(array('name' => 'objects[]', 'multiple' => 'multiple', 'size' => 20), $list, $values);

		
		$view = new View('admin');
		 
		$view->header  = new View('header');
		$view->content = new View('discount_customize');
		$view->footer  = new View('footer');
		 
		$view->header->title     = 'Discount >> Manage ';     // string for variable $title in view header.php
		$view->content->heading  = 'Manage discount action'; // string for variable $heading in view content.php
		 
		$view->render(TRUE);
	}
	
	function customBeforeDelete($row){
		$db = new Database();
		$db->delete('discounts_objects', array('discount_id' => $row->id));
	}
}