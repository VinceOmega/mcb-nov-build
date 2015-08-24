<?php defined('SYSPATH') OR die('No direct access allowed.');

//class Products_description_Model extends ORM {}

class Product_info extends ORM {

	public function find($id=NULL){
		$p = parent::find($id);
		
//		$p->shipping_info = (empty($p->shipping_info))? array() : unserialize($p->shipping_info);
		$p->attributes = (empty($p->attributes))? array() : unserialize($p->attributes);
		$p->options = (empty($p->options))? array() : unserialize($p->options);
		$p->tax_ids = (empty($p->tax_ids))? array() : unserialize($p->tax_ids);
		
		return $p;
	}		
}


class Product_Model extends Product_info {
	
	protected $has_and_belongs_to_many = array(
		'categories_products' => 'categories',
		'products_packagings' => 'packagings',
	);
	protected $has_many = array(
		'configurator_files',
		'gngoptions',
	);
	protected $has_one = array(
		'products_description', 
		'products_type', 
		'products_inventory'
	);
	
	protected $load_with = array('products_description');
	private $_prices = NULL;
	
	/**
	 *
	 * @var \Configurator_file_Model[]
	 */
	protected $_configurator_files = NULL;

	/**
	 * Gets an array of all products
	 *
	 * @return array
	 */
	public function getProducts() {
		$db = new Database;
		return $db->query('SELECT products.name, products.price, products_descriptions.* FROM products LEFT JOIN products_descriptions ON products.products_description_id = products_descriptions.id ORDER BY id ASC');  
	}

	/**
	 * Gets an array of all products for current site
	 *
	 * @return array
	 */
	public function getProductsForSite($homepage = FALSE) {
		$db = new Database;
		$prodsForSite = $this->getAllForSite();
		$ids = array_keys($prodsForSite);
		$homepageWhere = $homepage == FALSE ? '' :  ' AND products.homepage = 1 ';
		return $db->query('SELECT products.name, products.price, products_descriptions.*, products.id, products.unit, products.coins_per_bag, products.bars_per_box FROM products LEFT JOIN products_descriptions ON products.products_description_id = products_descriptions.id WHERE products.id IN ('.implode(',',$ids).') '.$homepageWhere.' ORDER BY products.id ASC');
	}
	 /**
	 * Gets an array of all products for homepage
	 *
	 * @return array
	 */
	public function getHomepageProducts() {
		$db = new Database;
		$productsIds = array();
		$products = $this->getAllForSite();
		foreach ($products as $p)
			$productsIds[] = $p->id;
		if (!$productsIds)
			return array();
		return $db->query('SELECT products.id,meta_title,description, short_description, products.name, products.price, products_descriptions.image,products_descriptions.title_url, products_descriptions.image_alt, kind, unit, coins_per_bag, bars_per_box
						   FROM products 
						   LEFT JOIN products_descriptions 
							ON products.products_description_id = products_descriptions.id 
						   WHERE products.homepage = 1 AND products.id IN ('.implode(',',$productsIds).')
						   ORDER BY id ASC');  
	}
  
	/**
	 * Gets a single product
	 *
	 * @return array
	 */
	public function getProductByID($id) {
		$db = new Database;
		$product = $db->query('SELECT * FROM products WHERE id = '.$id.'');
		return $product[0];
	}

	public function getCostByID($id, $qty) {
		$db = new Database;
		$cost = $db->query('SELECT * FROM product_costs WHERE productID = '.$id.' AND qty_start <= '.$qty.' AND qty_end >= '.$qty.'');
		return $cost[0];
	}
	
	public function getNextID() {
		$db = new Database;
		$product = $db->query('SELECT id FROM products ORDER BY id DESC');
		$next = $product[0]->id + 1;
		return $next;
	}
	
	public function getAllForSite() {
		$products = array();
		foreach (My_Template_Controller::getCurrentSite()->categories as $category) {
			foreach ($category->products as $product) {
				if (!isset($products[ $product->id ])) {
					$products[ $product->id ] = $product;
				}
			}
		}
		return $products;
	}
	
	public function getPrices() {
		if (NULL == $this->_prices)
			$this->_prices = ORM::factory('product_cost')->getCostsByProduct($this->id);
		return $this->_prices;
	}
	
	public function getPriceStartingAt() {
		$pc = $this->getPrices();
		if (count($pc) < 1)
			return 0;
		$minPrice = false;
		foreach ($pc as $price) {
			if (false === $minPrice || $price->price < $minPrice)
				$minPrice = $price->price;
		}
		return $minPrice;
	}
	
	public function getUnitPriceForAmount($amount) {
		$maxPriceRange = NULL;
		foreach ($this->getPrices() as $price) {
			if ($price->qty_start <= $amount && $amount <= $price->qty_end)
				return $price;
			
			if ($price->qty_end == 0)
				$maxPriceRange = $price;
		}
		return $maxPriceRange;
	}
	
	/**
	 * 
	 * @param string $type	Options: Configurator_file_Model::TYPE_#### constants
	 * @return \Configurator_file_Model
	 */
	public function getConfiguratorFile($type)
	{
//		var_dump($this->id);
		if (NULL === $this->_configurator_files)
			$this->_configurator_files = $this->configurator_files;
//		var_dump($this->configurator_files);
		foreach ($this->_configurator_files as $conf_file) {
			if ($conf_file->type == $type)
				return $conf_file;
		}
		return FALSE;
	}
}

//class Products_type_Model extends Product_info {}


