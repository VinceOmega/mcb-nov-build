<?php defined('SYSPATH') or die('No direct script access.');


class Customer_designs_Controller extends Base_Controller {

	public $tableCols = array('shortname','msg_text1', 'designpath', 'img_approved');

	public $fields = array(
		
		'shortname' => array(
			'title' => 'Site',
			'type' => 'select',
			'options' => array('sites', 'id', 'shortname'),
			'index' => 'orders.site_id',
			'stype' => 'select'
		),
		'msg_text1' => array(
			'title' => 'Message Text 1',
			'type' => 'text',
			'required' => true,
			'mask' => false,
			'price' => true,
			'align' => 'right'
		),
		'designpath' => array(
			'title' => 'Design Path',
			'type' => 'text',
			'required' => true,
			'mask' => false
		),
		'img_approved' => array(
			'title' => 'Image Approved',
			'type'  => 'select',
			'index' => 'img_approved',
			'options' => 'approvedStatuses',
			'stype' => 'select'
		)
	);

	public $approvedStatuses = array(
		'0' => 'Not Approved',
		'1' => 'Approved'
	);


	public $objectName = 'orders_baskets';
	public $title = 'Customer Designs - ';

	public function getQuery(){
		$db = new Database();
		return $db->select('sites.shortname, orders_baskets.id, orders_baskets.msg_text1, orders_baskets.designpath, approvedStatuses.name as img_approved')->from('orders_baskets')
			->join('products', 'products.id', 'orders_baskets.img_approved', 'left')
			->join('orders', 'orders.id', 'orders_baskets.order_id', 'left')
			->join('sites', 'sites.id', 'orders.site_id', 'left')
			->join('approvedStatuses', 'approvedStatuses.id', 'orders_baskets.img_approved', 'left')
			->where('orders_baskets.product_id != 1')
			->where('orders_baskets.designpath != ""')
			->where('orders_baskets.designpath IS NOT NULL');
	}
	
	public function edit(){

		if (isset($_POST['save'])){
			$post = new Validation(array_merge($_POST, $_FILES));            			  //********  TO DO: trim for shipping info     **************/
			$post->pre_filter('trim', 'msg_text1', 'designpath', 'img_approved');
			
			$post->add_rules('msg_text1', 'required');
			$post->add_rules('designpath', 'required');
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
	
	
	public function add(){
		if (isset($_POST['save']))	{
			
			$post->pre_filter('trim', 'msg_text1', 'designpath', 'img_approved');
			
			$post->add_rules('msg_text1', 'required');
			$post->add_rules('designpath', 'required');
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
				url::redirect('/customer_designs/edit/' . $product->id);
			}
		}
		$this->_renderView();
	}
	
	public function _renderView(){
		$view = new View('admin');
		 
		$view->header  = new View('header');
		$view->content = new View('orders_basket_content');
		$view->footer  = new View('footer');
		 
		$view->header->title     = 'Customer Designs >> Add >> Edit';     // string for variable $title in view header.php
		$view->content->heading  = 'Heading of your page'; // string for variable $heading in view content.php
		 
		$view->render(TRUE);
	}
	
	public function getProductPrice(){
		if (!isset($_GET['id'])){
			throw new Exception('Product ID required');
		}
		$product = ORM::factory('product', (int)$_GET['id']);
		die( sprintf ("%6.2f", $product->price) );
	}
}