<?php defined('SYSPATH') OR die('No direct access allowed.');


class Orders_Basket_Model extends ORM {

	protected $has_one = array(
		'order', 
		'product', 
		'flavor',
		'packaging'
	);
	protected $has_many = array(
		'orders_baskets_images',
		'orders_baskets_texts',
		'orders_baskets_datas',
		'orders_baskets_gngoptions',
		'orders_baskets_packagingoptions',
	);
	
	public function getTextToShow()
	{
		$texts = array();
		if ($this->msg_text1 != '') {
			$text = ORM::factory('orders_baskets_text');
			$text->text = $this->msg_text1;
			$text->name = 'Text 1';
			$text->font = $this->msg_text1font;
			$text->size = $this->msg_text1size;
			$text->color_name = $this->msg_text1color;
			$texts[] = $text;
		}
		if ($this->msg_text2 != '') {
			$text = ORM::factory('orders_baskets_text');
			$text->text = $this->msg_text2;
			$text->name = 'Text 2';
			$text->font = $this->msg_text2font;
			$text->size = $this->msg_text2size;
			$text->color_name = $this->msg_text2color;
			$texts[] = $text;
		}
		foreach ($this->orders_baskets_texts as $text)
			$texts[] = $text;
		
		return $texts;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function getBasketByID($id) {
		$db = new Database;
		$occasion = $db->query('SELECT id, msg_text1, designpath, img_approved FROM orders_baskets WHERE orders_baskets.id = '.$id.'');
		return $occasion[0];
	}
  
	public function getNextID() {
		$db = new Database;
		$occasion = $db->query('SELECT id FROM orders_baskets ORDER BY id DESC');
		$next = $occasion[0]->id + 1;
		return $next;
	}
  
}