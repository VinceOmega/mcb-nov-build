<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Default Kohana controller. This controller should NOT be used in production.
 * It is for demonstration purposes only!
 *
 * @package    Core
 * @author     Kohana Team
 * @copyright  (c) 2007-2008 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
class Orders_Controller extends My_Template_Controller {

	// Disable this controller when Kohana is set to production mode.
	// See http://docs.kohanaphp.com/installation/deployment for more details.
	const ALLOW_PRODUCTION = FALSE;

	// Set the name of the template to use
	public $template = 'kohana/template';

	public $description = '';
	public $title = '';
	public $keywords = '';

	public function index()
	{
		// In Kohana, all views are loaded and treated as objects.
		$this->template->content = new View('orders');
		
		//$this->session = Session::instance();
		//echo 'Current session ID: ' . $this->session->id();
		
		$db=new Database;
        $resultall = $db->query('SELECT temp_orders.*, products.name as productname, products.image as productimage FROM temp_orders LEFT JOIN products ON temp_orders.productID = products.id WHERE temp_orders.sessionid = \''.$this->session->id().'\'');
        $this->template->content->itemsresults = $resultall;

		// You can assign anything variable to a view by using standard OOP
		// methods. In my welcome view, the $title variable will be assigned
		// the value I give it here.
		$this->template->title = 'My Chocolate Hearts';

		

	}

	public function view() {
		// In Kohana, all views are loaded and treated as objects.
		$this->template->content = new View('order_page');

		$orderarray = Router::$arguments;
		$orderid = $orderarray[0];
		
		//$this->session = Session::instance();
		//echo 'Current session ID: ' . $this->session->id();
		
		$db=new Database;

		$oresult = $db->query('SELECT orders.id, 
			orders.trans_id, 
			orders_baskets.*, 
			products.name as productname, 
			products_descriptions.image as productimage, 
			products.kind, 
			products_descriptions.title_url, 
			products_descriptions.description, 
			products_descriptions.meta_description, 
			products_descriptions.meta_keywords, 
			products_descriptions.meta_title FROM orders INNER JOIN orders_baskets ON orders.id = orders_baskets.order_id LEFT JOIN products ON orders_baskets.product_id = products.id LEFT JOIN products_descriptions ON products_descriptions.id = products.id WHERE orders.sessionID = \''.session_id().'\' AND orders.statusID IN (1,3)');
        $this->template->content->orderresults = $oresult;
		//$orderid = $result[0]->id;

		$result = $db->query('SELECT products.name as productname, products.products_description_id as products_description_id, products.kind, products_descriptions.title_url, products_descriptions.description, products_descriptions.meta_description, products_descriptions.meta_keywords, products_descriptions.meta_title, products_descriptions.image as productimage, flavors.name as flavorname, foil_colors.name as foilcolor, orders_baskets.*  
							FROM orders_baskets LEFT JOIN products ON orders_baskets.product_id = products.id LEFT JOIN products_descriptions ON products.products_description_id = products_descriptions.id 
							LEFT JOIN flavors ON orders_baskets.flavor_id = flavors.id 
							LEFT JOIN foil_colors ON orders_baskets.foil_id = foil_colors.id 
							WHERE orders_baskets.order_id = '.$orderid.'');
        $this->template->content->order = $result;

		$this->template->metaDescription = $oresult[0]->meta_description;
		$this->template->metaKeywords = $oresult[0]->meta_keywords;
		$this->template->metaTitle = $oresult[0]->meta_title;

		// You can assign anything variable to a view by using standard OOP
		// methods. In my welcome view, the $title variable will be assigned
		// the value I give it here.
		$this->template->title = $oresult[0]->meta_title;
	}

	public function edit() {
		// In Kohana, all views are loaded and treated as objects.
		$this->template->content = new View('order_edit');

		$orderarray = Router::$arguments;
		$orderid = $orderarray[0];

		if($_POST) {

			
			$text1 = $_POST["text1"];
			$text1 = str_replace("'", '', $text1);

			$db=new Database;


			$result = $db->query('UPDATE orders_baskets SET msg_text1 = \''.$text1.'\' WHERE id = '.$orderid.'');





			url::redirect('/shopping_cart/');


		} else {
		
		//$this->session = Session::instance();
			//echo 'Current session ID: ' . $this->session->id();
			
			$db=new Database;

			
			$result = $db->query('SELECT orders.id, orders.trans_id, orders_baskets.*, products.name as productname FROM orders INNER JOIN orders_baskets ON orders.id = orders_baskets.order_id LEFT JOIN products ON orders_baskets.product_id = products.id WHERE orders.sessionID = \''.session_id().'\'');
			$this->template->content->orderresults = $result;
			//$orderid = $result[0]->id;

			$result = $db->query('SELECT products.name as productname, products_descriptions.image as productimage, products.products_description_id as products_description_id, products_descriptions.meta_description,products_descriptions.meta_title, products_descriptions.meta_keywords, flavors.name as flavorname, foil_colors.name as foilcolor, orders_baskets.*  FROM orders_baskets LEFT JOIN products ON orders_baskets.product_id = products.id LEFT JOIN products_descriptions ON products.products_description_id = products_descriptions.id LEFT JOIN flavors ON orders_baskets.flavor_id = flavors.id LEFT JOIN foil_colors ON orders_baskets.foil_id = foil_colors.id WHERE orders_baskets.id = '.$orderid.'');
			$this->template->content->order = $result[0];

			$this->template->metaDescription = $result[0]->meta_description;
			$this->template->metaKeywords = $result[0]->meta_keywords;
			$this->template->metaTitle = $result[0]->meta_title;

			// You can assign anything variable to a view by using standard OOP
			// methods. In my welcome view, the $title variable will be assigned
			// the value I give it here.
			$this->template->title = $result[0]->meta_title;

		}

		


	

		

	}

	public function remove() {

		$orderarray = Router::$arguments;
		$orderid = $orderarray[0];
		
		$basket = ORM::factory('orders_basket',$orderid);
		if ($basket->id != 0) {
			if ($basket->second_side_fee != 0) {
				$_otherBaskets = ORM::factory('orders_basket')
										->where('basket_with_fee',$basket->id)
										->find_all();
				if (count($_otherBaskets) > 0) {
					$first = TRUE;
					$newIdWithFee = NULL;
					foreach ($_otherBaskets as $_otherBasket) {
						if (TRUE === $first) {
							$_otherBasket->second_side_fee = $basket->second_side_fee;
							$_otherBasket->basket_with_fee = 0;
							$newIdWithFee = $_otherBasket->id;
							$first = FALSE;
						} else {
							$_otherBasket->basket_with_fee = $newIdWithFee;
						}
						$_otherBasket->save();
					}
				}
				
			}
			$basket->delete();
		}

		url::redirect('/shopping_cart/');
	}

	public function order_again()
	{
		$id = uri::segment(3);
		$prevorder = ORM::factory('order',$id);
		if ($prevorder->id == 0 ||
			$prevorder->user_id != User_Model::logged_user()->id || 
			$prevorder->site_id != self::getCurrentSite()->id)
			url::redirect('/customers/my_account');
		
		$order = ORM::factory('order')->getCurrentOrder();
		$_has_fee = FALSE;
		foreach ($prevorder->orders_baskets as $prevorders_basket) {
			//basic orders_basket
			$orders_basket = $prevorders_basket->cloneThis();
			$orders_basket->order_id = $order->id;
			$orders_basket->save();
			if ($orders_basket->second_side_fee != 0)
				$_has_fee = $orders_basket->id;
			
			//orders_baskets_images
			foreach ($prevorders_basket->orders_baskets_images as $prev) {
				$new = $prev->cloneThis();
				$new->orders_basket_id = $orders_basket->id;
				$new->save();
			}
			//orders_baskets_texts
			foreach ($prevorders_basket->orders_baskets_texts as $prev) {
				$new = $prev->cloneThis();
				$new->orders_basket_id = $orders_basket->id;
				$new->save();
			}
			//orders_baskets_datas
			foreach ($prevorders_basket->orders_baskets_datas as $prev) {
				$new = $prev->cloneThis();
				$new->orders_basket_id = $orders_basket->id;
				$new->save();
			}
		}
		if (FALSE !== $_has_fee) {
			foreach ($order->orders_baskets as $orders_basket)
				if ($orders_basket->id != $_has_fee) {
					$orders_basket->basket_with_fee = $_has_fee;
					$orders_basket->save();
				}
		}
		
		url::redirect('/shopping_cart');
	}


	public function __call($method, $arguments)
	{
		// Disable auto-rendering
		$this->auto_render = FALSE;

		// By defining a __call method, all pages routed to this controller
		// that result in 404 errors will be handled by this method, instead of
		// being displayed as "Page Not Found" errors.
		echo 'This text is generated by __call. If you expected the index page, you need to use: welcome/index/'.substr(Router::$current_uri, 8);
	}

} // End Welcome Controller