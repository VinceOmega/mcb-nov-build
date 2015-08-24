<?php defined('SYSPATH') or die('No direct script access.');


class Packagings_Controller extends Base_Controller {

	public $tableCols = array('name', 'in_use','coins_amount', 'status');

	public $fields = array(
		'name' => array(
			'title' => 'Name',
			'type' => 'text',
			'required' => true,
			'mask' => false,
			'index' => 'packagings.name'
		),
		'status' => array(
			'title' => 'Status',
			'type' => 'text',
			'required' => true,
			'mask' => false,
			'index' => 'packagings.status'
		),
		'in_use' => array(
			'title' => 'Used in',
			'type' => 'text',
			'required' => true,
		),
		'coins_amount' => array(
			'title' => 'Coins amout',
			'type' => 'text',
			'required' => true,
			'align' => 'right',
		),
	);
	public $objectName = 'packagings';
	public $title = 'Packagings List - ';

	public function getQuery(){
		$db = new Database();
		return $db->select('packagings.id, packagings.name,packagings.status, CONCAT(count(*),\' product(s)\') as in_use,coins_amount')
				  ->from('packagings')
				  ->join('products_packagings', 'products_packagings.packaging_id', 'packagings.id', 'left')
				  ->groupby('packagings.id');
	}
	
	public function edit(){

		if (isset($_POST['save'])){
			$post = new Validation(array_merge($_POST, $_FILES));            			  //********  TO DO: trim for shipping info     **************/
			$post->pre_filter('trim', 'packagingName');
			
			$post->add_rules('packagingName', 'required');
			$post->add_rules('packagingProducts', 'required');
			$post->add_rules('coins_amount', 'required');
			
			if (!$post->validate()) {
			   $errors = $post->errors('form_errors');
			   foreach ($errors as $error) {
				   echo '<p class="error">' . $error . '</p>';
			   }
			}
			
			else {
				$id = $this->uri->segment(3);			
				$packaging = ORM::factory('packaging')->find($id);
		
				$packaging->name = $post->packagingName;
				$packaging->description = $post->packagingDescription;
				$packaging->status = $post->packagingStatus;
				$packaging->coins_amount = $post->coins_amount;
				$packaging->image_alt = $post->image_alt;
				
				if (!empty($_FILES['image']['name'])){
					// uses Kohana upload helper
					$_FILES = Validation::factory($_FILES)
						->add_rules('image', 'upload::valid', 'upload::type[gif,jpg,jpeg,png]', 'upload::size[2M]');
					 
					if ($_FILES->validate())
					{
						// Temporary file name
						$dat = time();
						$filename = upload::save('image', basename($_FILES['image']['tmp_name']));
						$file = $dat.'-'.basename($_FILES['image']['name']);	
						// Resize, sharpen, and save the image
						Image::factory($filename)
							//->resize(200, 200, Image::WIDTH)
							->save(DOCROOT.'../../env/packaging_images/'. $file, FALSE);
					 
						// Remove the temporary file
						unlink($filename);
					 
						
						$packaging->image = $file;
					}
					else	
					   $errors = $_FILES->errors('form_user');	
				}
				
				$packaging->save();
				
				//products
				$pp = ORM::factory('products_packaging')
						->where('packaging_id', $id)
						->notin('product_id',$post->packagingProducts)
						->delete_all();
				if (!empty($post->packagingProducts)){
					foreach($post->packagingProducts as $productId){	
						$pp = ORM::factory('products_packaging')
								->where('product_id',$productId)
								->where('packaging_id',$packaging->id)
								->find();
						
						if ($pp->id == 0) {
							$pp->product_id = $productId;
							$pp->packaging_id = $packaging->id;
							$pp->save();
						}
					}
				}
				
				
				//costs
				$pc = ORM::factory('packaging_cost')
						->where('packagingID', $id)
						->delete_all();
				if (isset($post->cost_qty_start))
				{
					foreach ($post->cost_qty_start as $index => $qty_start)
					{
						if ($qty_start != '' && $post->cost_price[$index] != '')
						{
							$pc = ORM::factory('packaging_cost');
							$pc->packagingID = $packaging->id;
							$pc->qty_start = $qty_start;
							$pc->qty_end = $post->cost_qty_end[$index];
							$pc->price = $post->cost_price[$index];
							$pc->save();
						}
					}
				}
				
				//options
				if (isset($post->options)) 
				{
					foreach ($post->options['name'] as $index => $name)
					{
						$po = FALSE;
						$delete = FALSE;
						if ($post->options['id'][$index] != '')
						{
							$po = ORM::factory('packagingoption',$post->options['id'][$index]);
							if ($post->options['deleted'][$index] == 1)
								$delete = TRUE;
						}
						else if ($name != '')
						{
							if ($post->options['deleted'][$index] == 1)
								continue;
							$po = ORM::factory('packagingoption');
							$po->packaging_id = $packaging->id;
						}
						if ($delete)
						{
							$po->delete();
						}
						else if ($po)
						{
							$po->name = $name;
							$po->values = $post->options['values'][$index];
							$po->mandatory = $post->options['mandatory'][$index];
							$po->save();
						}
						
					}
				}
			}
		}
		
		$this->_renderView();
	}
	
	
	public function add(){
		if (isset($_POST['save']))	{
			$post = new Validation(array_merge($_POST, $_FILES));            			  
			$post->pre_filter('trim', 'packagingName');
			
			$post->add_rules('packagingName', 'required');
			$post->add_rules('packagingProducts', 'required');
			$post->add_rules('coins_amount', 'required');
			
			if (!$post->validate()) {
			   $errors = $post->errors('form_errors');
			   foreach ($errors as $error) {
				   echo '<p class="error">' . $error . '</p>';
			   }
			}
			
			else {
				$id = $this->uri->segment(3);			
				$packaging = ORM::factory('packaging')->find($id);
				
				$packaging->name = $post->packagingName;
				$packaging->description = $post->packagingDescription;
				$packaging->status = $post->packagingStatus;
				$packaging->coins_amount = $post->coins_amount;
				
				if (!empty($_FILES['image']['name'])){
					// uses Kohana upload helper
					$_FILES = Validation::factory($_FILES)
						->add_rules('image', 'upload::valid', 'upload::type[gif,jpg,jpeg,png]', 'upload::size[2M]');
					 
					if ($_FILES->validate())
					{
						// Temporary file name
						$filename = upload::save('image', basename($_FILES['image']['tmp_name']));
						$file = basename($_FILES['image']['name']);
						
						// Resize, sharpen, and save the image
						Image::factory($filename)
							//->resize(200, 200, Image::WIDTH)
							->save(DOCROOT.'../../env/packaging_images/'. $file);
					 
						// Remove the temporary file
						unlink($filename);
						
						$packaging->image_alt = $post->image_alt;
						$packaging->image = $file;
					}
					else	
					   $errors = $_FILES->errors('form_user');	
				}
				
				$packaging->save();

				//products
				if (!empty($post->packagingProducts)){
					foreach($post->packagingProducts as $productId){	
						$pp = ORM::factory('products_packaging');
						$pp->product_id = $productId;
						$pp->packaging_id = $packaging->id;
						$pp->save();
					}
				}
				
				//costs
				if (isset($post->cost_qty_start)) 
				{
					foreach ($post->cost_qty_start as $index => $qty_start)
					{
						if ($qty_start != '' && $post->cost_price[$index] != '')
						{
							$pc = ORM::factory('packaging_cost');
							$pc->packagingID = $packaging->id;
							$pc->qty_start = $qty_start;
							$pc->qty_end = $post->cost_qty_end[$index];
							$pc->price = $post->cost_price[$index];
							$pc->save();
						}
					}
				}
				
				//options
				if (isset($post->options)) 
				{
					foreach ($post->options['name'] as $index => $name)
					{
						if ($name != '')
						{
							if ($post->options['deleted'][$index] == 1)
								continue;
							$po = ORM::factory('packagingoption');
							$po->packaging_id = $packaging->id;
							$po->name = $name;
							$po->values = $post->options['values'][$index];
							$po->mandatory = $post->options['mandatory'][$index];
							$po->save();
						}
					}
				}
				
				url::redirect('/packagings/edit/' . $packaging->id);
			}
		}
		$this->_renderView();
	}
	
	public function customBeforeDelete($row) {
		parent::customBeforeDelete($row);
		
		ORM::factory('products_packaging')->where('packaging_id', $row->id)->delete_all();
		ORM::factory('packaging_cost')->where('packagingID', $row->id)->delete_all();
	}
	
	public function _renderView(){
		$view = new View('admin');
		 
		$view->header  = new View('header');
		$view->content = new View('packaging_content');
		$view->footer  = new View('footer');
		 
		$view->header->title     = 'Packaging >> Add >> Edit';     // string for variable $title in view header.php
		$view->content->heading  = 'Heading of your page'; // string for variable $heading in view content.php
		 
		$view->render(TRUE);
	}
}