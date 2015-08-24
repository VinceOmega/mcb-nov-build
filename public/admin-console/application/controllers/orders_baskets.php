<?php defined('SYSPATH') or die('No direct script access.');


class Orders_Baskets_Controller extends Base_Controller {	

// fields for table
	public $tableCols = array('shortname','msg_text1', 'designpath', 'img_approved');
	
	public $fields = array(
		'shortname' => array(
			'title' => 'Site',
			'type' => 'select',
			'options' => array('sites', 'id', 'shortname'),
			'index' => 'orders.site_id',
			'stype' => 'select'
		),
		'order_id' => array(
			'title' => 'order_id Name',
			'type' => 'text',
			'required' => true,
			'mask' => false
		),
		'product_id' => array(
			'title' => 'product_id',
			'type' => 'text',
			'required' => false,
			'mask' => false
		),			
		'flavor_id' => array(
			'title' => 'flavor_id',
			'type' => 'text',
			'required' => true,
			'mask' => false
		),	
		'foil_id' => array(
			'title' => 'foil_id',
			'type' => 'text',
			'required' => false,
			'mask' => false
		),
		'msg_text1' => array(
			'title' => 'msg_text1',
			'type' => 'text',
			'required' => false,
			'mask' => false,
			'align' => 'left'
		),			
		'designpath' => array(
			'title' => 'designpath',
			'type' => 'text',
			'required' => false,
			'align' => 'right'
		),		
		'img_approved' => array(
			'title' => 'Image Approved',
			'type'  => 'select',
			'index' => 'img_approved',
			'options' => 'approvedStatuses',
			'stype' => 'select'
		),		
	);
	
	public $approvedStatuses = array(
		'0' => 'Not Approved',
		'1' => 'Approved'
	);

	public $objectName = 'orders_baskets';
	public $title = 'Orders Baskets - ';
		
	public function getQuery(){
		$db = new Database();
		return $db->select('sites.shortname, orders_baskets.id, orders_baskets.msg_text1, orders_baskets.designpath, approvedStatuses.name as img_approved')->from('orders_baskets')
			->join('products', 'products.id', 'orders_baskets.img_approved', 'left')
			->join('orders', 'orders.id', 'orders_baskets.order_id', 'left')
			->join('sites', 'sites.id', 'orders.site_id', 'left')
			->join('approvedStatuses', 'approvedStatuses.id', 'orders_baskets.img_approved', 'left')
			->where('orders.id IS NOT NULL')
			->where('orders_baskets.product_id != 1')
			->where('orders_baskets.designpath != ""')
			->where('orders_baskets.designpath IS NOT NULL');
	}

	public function edit(){

		if (isset($_POST['save'])){
			$post = new Validation(array_merge($_POST, $_FILES));            			  //********  TO DO: trim for shipping info     **************/
			$post->pre_filter('trim', 'msg_text1', 'designpath', 'img_approved');
			
			$post->add_rules('msg_text1', 'required');
			$post->add_rules('designpath', 'required', 'numeric');
			$post->add_rules('img_approved', 'numeric');
			
			if (!$post->validate()) {
			   $errors = $post->errors('form_errors');
			   foreach ($errors as $error) {
				   echo '<p class="error">' . $error . '</p>';
			   }
			}
			
			else {
				$id = $this->uri->segment(3);			
				$basket = ORM::factory('orders_basket')->find($id);
		
				$basket->msg_text1 = $post->msg_text1;
				$basket->designpath = $post->designpath;
				$basket->img_approved = $post->img_approved;
			
			
				$basket->save();
																		/*************** TO DO: delete more than one category ****************/
				
			}
		}
		
		$this->_renderView();
	}
	

}