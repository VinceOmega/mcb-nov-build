<?php defined('SYSPATH') or die('No direct script access.');

class Cart_Controller extends My_Template_Controller {
	public $template = 'kohana/template';

	public function __construct(){
		parent::__construct();
		$this->session = Session::instance();
	}

	public function index() {
        $this->template->title = 'Cart';
        $this->template->metaDescription = '';
        $this->template->content = View::factory('cart')
					   ->bind('p', $this->cart);
		$this->cart = $this->session->get('Basket');
		$cart = new Basket;
		
		$this->additionalInfo = array();
		
		if ($cart->size() > 0){
			$products = array();
			foreach($cart->items() as $index=>$item){
				$products[] = $item->id;
			}
			$db = new Database();
			$rows = $db->query('SELECT d.description FROM discounts d JOIN discounts_objects AS do ON (do.discount_id=d.id) WHERE d.effective_from <= now() AND d.effective_to >= now() AND d.type_id=1 AND do.object_id IN ('.join(',', $products).')');
			foreach ($rows as $row){
				$this->additionalInfo[] = $row->description;
			}
		}
		
		if (isset($_POST['update'])){
			foreach($cart->items() as $index=>$item){ 
				//update quntities
				if ($item->qty != $_POST['quantity'][$index]){
					$item->qty = $_POST['quantity'][$index];		
					$cart->update($item);
				}
				
				//delete products
				if (isset($_POST['delete'][$index]) AND $_POST['delete'][$index] == 'on'){
					$item->qty = 0;		
					$cart->update($item);
				}
			}
			$this->cart = $this->session->get('Basket');
		}
    }
	
	 public function add() {	
		$this->template->title = 'Cart :: Add';
		$this->template->metaDescription = '';
        $this->template->content = View::factory('cart')
						->bind('cart', $cart);
						
		$p_id = $_POST['p_id'];
		$this->cart = $this->session->get('Basket');
		$cart = new Basket;
		
		$item = new Item;
		$item->id = $p_id;
		$cart->add($item);
		
		url::redirect('/cart');
    }

}
