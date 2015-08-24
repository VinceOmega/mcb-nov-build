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
class Products_Controller extends My_Template_Controller {
	
	const LIST_TYPE_NORMAL = 1;
	const LIST_TYPE_GnG = 2;

	// Disable this controller when Kohana is set to production mode.
	// See http://docs.kohanaphp.com/installation/deployment for more details.
	const ALLOW_PRODUCTION = FALSE;

	// Set the name of the template to use
	public $template = 'kohana/template';

	public $description = '';
	public $title = '';
	public $keywords = '';
	public $profiler = '';

    public function __construct() {
        parent::__construct();
        
        // include mobile detect class
        require Kohana::find_file('vendor', 'mobiledetect');
    }

	public function index()
	{
		$method = $this->methodNameForSite('index');
		$this->$method();
	}
	
	protected function index_MCC()
	{
		$this->template->content = new View('products');
		
		//detect if in category
		$categoryUrl = FALSE;
		if (isset(Router::$arguments[0]) && Router::$arguments[0] == 'category')
			$categoryUrl = Router::$arguments[1];
		
		//get products
		$products = NULL;
		$productListType = self::LIST_TYPE_NORMAL;
		if (FALSE != $categoryUrl) {
			$cds = ORM::factory('categories_description')->where('title_url',$categoryUrl)->find_all();
			$category = $cds[0]->category;
			$products = $category->products;
			
			if ($categoryUrl == 'grab_and_go')
				$productListType = self::LIST_TYPE_GnG;
		} else {
//			$products = ORM::factory('product')->getAllForSite();
		}
		$this->template->content->products = $products;
		$this->template->content->productListType = $productListType;
		
		//get categories
		$this->template->content->categories = self::getCurrentSite()->categories;

		//set descriptions
		$this->template->metaDescription = 'We offer four unique customized chocolate coins with stylish color wrappers which can be used as a favor for any occasion or event. Call us at 1-866-230-7730. #@';

		$this->template->metaKeywords = 'chocolate coin, chocolate coins, chocolate coin products';

		$this->template->metaTitle = 'Custom Chocolate Coins Products - MyChocolateCoins.com: Customized Foil Chocolate Coins and Full Color Chocolate Coins';

		$this->template->title = 'Chocolate Coins Products';
	}
	
        protected function index_MCH()
	{
//		 In Kohana, all views are loaded and treated as objects.
		$this->template->content = new View('products');
		
		$db=new Database;
		
                $productListType = self::LIST_TYPE_NORMAL;
                
                $gng_category;
                $products = array();
                foreach (self::getCurrentSite()->categories as $category) 
                {
                    if($category->categories_description->title_url == 'grab_and_go')
                        $gng_category = $category;
                    else
                    {
                        foreach ($category->products as $product)
                        {
                            $products[] = $product;
                        }
                    }
                }
//              //========================================================================
                $categoryUrl = FALSE;
		if (isset(Router::$arguments[0]) && Router::$arguments[0] == 'category')
			$categoryUrl = Router::$arguments[1];
                
                $gng_products = array();
		if (FALSE != $categoryUrl) 
                {
			$products_by_category = $gng_category->products;
                        foreach ($products_by_category as $product) 
                        {
                            $costs = $this->getCostsByProductOrderDesc($product->id)->as_array();
                            $product->price = $costs[0]->price;
                            $gng_products[] = $product;
                        }
			
			if ($categoryUrl == 'grab_and_go')
				$productListType = self::LIST_TYPE_GnG;
		}
//              //========================================================================
                
		$this->template->content->gng_products = $gng_products;
                
		$this->template->content->products = $products;
                
                $this->template->content->gng_category = $gng_category;
                
                $this->template->content->productListType = $productListType;

		$this->template->metaDescription = 'We offer four unique customized chocolate hearts with stylish color wrappers which can be used as a favor for any occasion or event. Call us at 1-866-230-7730. #@';

		$this->template->metaKeywords = 'chocolate heart, chocolate hearts, chocolate heart products';

		$this->template->metaTitle = 'Custom Chocolate Hearts Products - MyChocolateHearts.com: Customized Foil Chocolate Hearts and Full Color Chocolate Hearts';

		$this->template->title = 'Chocolate Heart Products';

	}

	  protected function index_MCB()
	{
//		 In Kohana, all views are loaded and treated as objects.
		$this->template->content = new View('products');

		$db=new Database;
        $resultall = $db->query("SELECT products.*, products_descriptions.*  FROM products LEFT JOIN products_descriptions ON products.products_description_id = products_descriptions.id
        	WHERE kind = 'MCB_GNG' OR kind = 'MCB'");

         $getcategories = $db->query("SELECT DISTINCT categories.id, count( * ) as cnt, categories.name, categories.categories_description_id, products.id, categories_products.*, categories_descriptions.* FROM products 
        	LEFT JOIN categories_products ON categories_products.product_id = products.id
        	LEFT JOIN categories ON categories_products.category_id = categories.id
        	LEFT JOIN categories_descriptions ON categories_descriptions.id = categories.categories_description_id
        	WHERE kind = 'MCB_GNG' OR kind = 'MCB'
        	GROUP BY categories.id DESC");
        
		
		//detect if in category
		$categoryUrl = FALSE;
		if (isset(Router::$arguments[0]) && Router::$arguments[0] === 'category')
			$categoryUrl = Router::$arguments[1];
		
		//get products
		$products = NULL;
		$productListType = self::LIST_TYPE_NORMAL;
		if ($categoryUrl  != false) {
			$cds = ORM::factory('categories_description')->where('title_url',$categoryUrl)->find_all();
			$category = $cds[0]->category;
			$products = $category->products;
			
			if ($categoryUrl === 'grab_and_go')
				$productListType = self::LIST_TYPE_GnG;
		} else {
//		$products = ORM::factory('product')->getAllForSite();

		}
	if(isset(Router::$arguments[0]) && isset(Router::$arguments[1])){
		$this->template->content->argsone = Router::$arguments[0];
		$this->template->content->argstwo = Router::$arguments[1];
		
	}
	if (isset(Router::$arguments[0]) && Router::$arguments[0] === 'category'){
		$this->template->content->cg = $category;
	}
		$this->template->content->products = $products;
		$this->template->content->productListType = $productListType;
		$this->template->content->productresults = $resultall;
		$this->template->content->cg = $getcategories;

		//get categories
		$this->template->content->categories = self::getCurrentSite()->categories;

		$this->template->metaDescription = 'We offer four unique customized chocolate bars with stylish color wrappers which can be used as a favor for any occasion or event. Call us at 1-866-230-7730. #@';

		$this->template->metaKeywords = 'chocolate bar, chocolate bars, chocolate bars products';

		$this->template->metaTitle = 'Custom Chocolate Bars Products - MyChocolateBars.com: Customized Foil Chocolate Bars and Full Color Chocolate Bars';

		$this->template->title = 'Chocolate Bars Products';

	}


	// public function category(){
	// 			// In Kohana, all views are loaded and treated as objects.
	// 	$this->template->content = new View('product_page');
	// 	$productarray = Router::$arguments;
	// 	$productname = $productarray[0];

	// 	$this->template->metaDescription='';
	// 	$this->template->metaKeywords='';
	// 	$this->template->metaTitle = '';

	// 	$db=new Database;

	// 	echo "This is my catgory son";
	// }

	public function show()
	{
		// In Kohana, all views are loaded and treated as objects.
		$this->template->content = new View('product_page');
		$productarray = Router::$arguments;
		$productname = $productarray[0];

		$this->template->metaDescription='';
		$this->template->metaKeywords='';
		$this->template->metaTitle = '';

		$db=new Database;

		//get categories
		$this->template->content->categories = self::getCurrentSite()->categories;
                
                $gng_category;
                $result_category = array();
                foreach (self::getCurrentSite()->categories as $category) 
                {
                    if($category->categories_description->title_url == 'grab_and_go')
                        $gng_category = $category;
                    else
                        $result_category[] = $category;
                }
                $this->template->content->categories = $result_category;

                $this->template->content->gng_category = $gng_category;

		//get products
		$method = $this->methodNameForSite('_getProducts');
                $this->template->content->productresults = $this->$method();
		
                
		//get product
		$result = $db->query('SELECT products_descriptions.*, products.*  FROM products_descriptions LEFT JOIN products ON products_descriptions.id = products.products_description_id WHERE products_descriptions.title_url = \''.$productname.'\'');
		$this->template->content->product = $result[0];
                
                if($result[0]->kind == 'MCH_GNG')
                {
                    $gng_products = $gng_category->products;
                    $this->template->content->productresults = $gng_products;
                }

                // if($result[0]->kind == 'MCB_GNG')
                // {
                //     $gng_products = $gng_category->products;
                //     $this->template->content->productresults = $gng_products;
                // }
                    
                
		$productid = $result[0]->id;
		
		$this->template->content->gngoptions = ORM::factory('product',$productid)->gngoptions;

		$this->template->metaDescription = $result[0]->meta_description;
		$this->template->metaKeywords = $result[0]->meta_keywords;
		$this->template->metaTitle = $result[0]->meta_title;
		$this->template->title = $result[0]->meta_title;

		$result = $db->query('SELECT * FROM product_costs WHERE productID = '.$productid.' ORDER BY qty_start ASC');
        $this->template->content->productcosts = $result;

		//get the most recently created hearts of each product type
		$recentDesigns = $db->query('	
								SELECT
									ob.designpath,
									ob.rate,
									ob.qty
								FROM orders o
								INNER JOIN orders_baskets ob
									ON o.id = ob.order_id
								WHERE 
									ob.product_id = '.$productid.' AND
									o.site_id = '.self::getCurrentSite()->id.' AND
									o.statusID IN (1,2,4,5) AND
									o.can_share = 1 AND
									ob.designpath IS NOT NULL
								ORDER BY rand()
								LIMIT 6');
		$this->template->content->recentDesigns = $recentDesigns;
                
	}
	
	protected function _getProducts_MCH()
	{
		$productsForSite = ORM::factory('product')->getAllForSite();
		$productsIds = array();
		foreach ($productsForSite as $product)
			$productsIds[] = $product->id;
		
		$db = new Database;
                $resultall =
                $db->query("SELECT products_descriptions.*,products.* 
                            FROM products 
                            LEFT JOIN products_descriptions 
                            ON products.products_description_id = products_descriptions.id 
                            WHERE products.id IN (".implode(',',$productsIds).")
                            AND products.kind != 'MCH_GNG'");
		foreach ($resultall as $product)
			$product->price = ORM::factory ('product')->find($product->id)->getPriceStartingAt();
		
		return $resultall;
	}
	
	protected function _getProducts_MCC()
	{
		$productsForSite = ORM::factory('product')->getAllForSite();
		$productsIds = array();
		foreach ($productsForSite as $product)
			$productsIds[] = $product->id;
		
		$db = new Database;
		$resultall = $db->query('SELECT products_descriptions.*,products.* FROM products LEFT JOIN products_descriptions ON products.products_description_id = products_descriptions.id WHERE products.id IN ('.implode(',',$productsIds).') AND products.kind = "MCC_GNG" ORDER BY RAND() LIMIT 3');
		foreach ($resultall as $product)
			$product->price = ORM::factory ('product')->find($product->id)->getPriceStartingAt();
		
		return $resultall;
	}

	protected function _getProducts_MCB()
	{
		
		$productsForSite = ORM::factory('product')->getAllForSite();
		$productsIds = array();

		foreach ($productsForSite as $product)
			$productsIds[] = $product->id;
		
		$db = new Database;
		$resultall = $db->query('SELECT products_descriptions.*,products.* FROM products LEFT JOIN products_descriptions ON products.products_description_id = products_descriptions.id WHERE products.id IN ('.implode(',',$productsIds).') AND products.kind = "MCB_GNG" ORDER BY RAND() LIMIT 3');
		foreach ($resultall as $product)
			$product->price = ORM::factory ('product')->find($product->id)->getPriceStartingAt();
		
		return $resultall;
	}

	public function build()
	{
		$db = new Database;
		
		$productarray = Router::$arguments;
		$productname = $productarray[0];
		
		$product = $db->query('SELECT products_descriptions.*, products.*  FROM products_descriptions LEFT JOIN products ON products_descriptions.id = products.products_description_id WHERE products_descriptions.title_url = \''.$productname.'\'');
		
		$this->template->metaDescription = $product[0]->meta_description;
		$this->template->metaKeywords = $product[0]->meta_keywords;
		$this->template->metaTitle = $product[0]->meta_title;
		$this->template->title = $product[0]->meta_title;
		
		$method = $this->methodNameForSite('build');
		$this->$method($product[0]);
	}
	
	protected function build_MCH($product)
	{
		$this->template->content = new View('product_builder');
    
		$this->template->content->product = $product;
	}
	
	protected function build_MCC($_product)
	{
		$this->template->content = new View('product_builder_mcc');
		
		$product = ORM::factory('product')
						->where('products.id',$_product->id)
						->find();

		$this->template->content->xmlHeader = $product->getConfiguratorFile(Configurator_file_Model::TYPE_HEADER)->file;
		$this->template->content->xmlContent = $product->getConfiguratorFile(Configurator_file_Model::TYPE_CONTENT)->file;
	}

	protected function build_MCB($_product)
	{

		$db = new Database;

		
		$this->template->content = new View('product_builder_mcb');
		$productarray = Router::$arguments;
		$productname = $productarray[0];
		
		$products = $db->query('SELECT products_descriptions.*, products.*  FROM products_descriptions LEFT JOIN products ON products_descriptions.id = products.products_description_id WHERE products_descriptions.title_url = \''.$productname.'\'');
		
		
		$product = ORM::factory('product')
						->where('products.id',$_product->id)
						->find();


		$category = $db->query("SELECT cps.* FROM categories_products as cps WHERE product_id = '$_product->id'");

		$this->template->content->products = $products[0];
		$this->template->content->productname = $productarray[0];
		$this->template->content->category = $category[0];
		// $this->template->content->xmlHeader = $product->getConfiguratorFile(Configurator_file_Model::TYPE_HEADER)->file;
		// $this->template->content->xmlContent = $product->getConfiguratorFile(Configurator_file_Model::TYPE_CONTENT)->file;
	}


	// public function save(){
		
	// }




	public function wrapper(){
		$db = new Database;
		
		$productarray = Router::$arguments;
		$productname = $productarray[0];
		
		$product = $db->query('SELECT products_descriptions.*, products.*  FROM products_descriptions LEFT JOIN products ON products_descriptions.id = products.products_description_id WHERE products_descriptions.title_url = \''.$productname.'\'');
		
		$this->template->metaDescription = $product[0]->meta_description;
		$this->template->metaKeywords = $product[0]->meta_keywords;
		$this->template->metaTitle = $product[0]->meta_title;
		$this->template->title = $product[0]->meta_title;
		
		$method = $this->methodNameForSite('wrapper');
		$this->$method($product[0]);
	}

	protected function wrapper_MCH($product)
	{
		$this->template->content = new View('wrapper_builder');
    
		$this->template->content->product = $product;
	}
	
	protected function wrapper_MCC($_product)
	{
		$this->template->content = new View('wrapper_builder_mcc');
		
		$product = ORM::factory('product')
						->where('products.id',$_product->id)
						->find();

		// $this->template->content->xmlHeader = $product->getConfiguratorFile(Configurator_file_Model::TYPE_HEADER)->file;
		// $this->template->content->xmlContent = $product->getConfiguratorFile(Configurator_file_Model::TYPE_CONTENT)->file;
	}

	protected function wrapper_MCB($_product)
	{

		$db = new Database;

		
		$this->template->content = new View('wrapper_builder_mcb');
		$productarray = Router::$arguments;
		$productname = $productarray[0];
		
		$products = $db->query('SELECT products_descriptions.*, products.*  FROM products_descriptions LEFT JOIN products ON products_descriptions.id = products.products_description_id WHERE products_descriptions.title_url = \''.$productname.'\'');
		
		
		$product = ORM::factory('product')
						->where('products.id',$_product->id)
						->find();

		$category = $db->query("SELECT cps.* FROM categories_products as cps WHERE product_id = '$_product->id'");

		$this->template->content->products = $products[0];
		$this->template->content->user = FALSE;
		$this->template->content->category = $category[0];

		if (User_Model::logged_in()) {
			$user = User_Model::logged_user();
			$this->template->content->user = $user;
		}
		// $this->template->content->xmlHeader = $product->getConfiguratorFile(Configurator_file_Model::TYPE_HEADER)->file;
		// $this->template->content->xmlContent = $product->getConfiguratorFile(Configurator_file_Model::TYPE_CONTENT)->file;
	}

	public function afterbuild()
	{
		// In Kohana, all views are loaded and treated as objects.
		//$this->template->content = new View('shopping_cart');


		$db=new Database;
		//echo session_id();
	

		$postvars = $_POST;
		

		$flavorID = 1;
		$style_id = 1;

		//var_dump($postvars);

		$quantity = (int)($postvars['quantity']);

		//echo '<br><br><br>Quantity: '.$quantity.'<br>';

		if($postvars['choco_flavor'] == "undefined") {

			$flavorID = 1;

		} else {

			$result = $db->query('SELECT * FROM flavors WHERE name LIKE \'%'.$postvars['choco_flavor'].'%\'');
			if($result) {
				$flavorID = $result[0]->id;
			} else {
				$flavorID = 1;
			}

		}
       
		if($postvars['foilcolor'] == "undefined") {

			$foilID = 1;

		} else {

			$result = $db->query('SELECT * FROM foil_colors WHERE name LIKE \'%'.$postvars['foilcolor'].'%\'');
			if($result) {
				$foilID = $result[0]->id;
			} else {
				$foilID = 1;
			}

		}


		if($postvars['choco_style'] == "undefined") {
			$style_id = 1;
		} else if($postvars['choco_style'] == 'Heart Favour') {
			$style_id = 1;
		} else if($postvars['choco_style'] == 'Lollipop') {
			$style_id = 2;
		}

		//echo '<br><br><br>Foils: '.print_r($result).'<br>';
		

		$result = $db->query('SELECT * FROM product_costs WHERE productID = '.$postvars['choco_id'].' AND qty_start <= '.$quantity.' AND qty_end >= '.$quantity.'');
		if($result->count() > 0) {
			$costeach = $result[0]->price;
		} else {
			$result = $db->query('SELECT * FROM product_costs WHERE productID = '.$postvars['choco_id'].' AND qty_end = 0');
			$costeach = $result[0]->price;
		}
		
		//echo '<br><br><br>Costs Result: '.print_r($result[0]).'<br>';
		
        $costeach = (double)$result[0]->price;

		$total = (double)$costeach * (double)$quantity;

		$text1 = '';
		$text2 = '';
		$text1font = '';
		$text2font = '';
		$text1size = '';
		$text2size = '';
		$text1color = '';
		$text2color = '';
		$designcolor = '';
		$clippath = '';



		if(!empty($postvars['choco_text1']))
			$text1 = $postvars['choco_text1'];
		else 
			$text1 = 'NULL';

		if(!empty($postvars['choco_text2']))
			$text2 = $postvars['choco_text2'];
		else 
			$text2 = 'NULL';

		if(!empty($postvars['choco_text1font']))
			$text1font = $postvars['choco_text1font'];
		else 
			$text1font = 'NULL';

		if(!empty($postvars['choco_text2font']))
			$text2font = $postvars['choco_text2font'];
		else 
			$text2font = 'NULL';

		if(!empty($postvars['choco_text1size']))
			$text1size = $postvars['choco_text1size'];
		else 
			$text1size = 'NULL';

		if(!empty($postvars['choco_text2size']))
			$text2size = $postvars['choco_text2size'];
		else 
			$text2size = 'NULL';

		if(!empty($postvars['choco_text1color'])) 
			$text1color = $postvars['choco_text1color'];
		else 
			$text1color = 'NULL';

		if(!empty($postvars['choco_text2color']))
			$text2color = $postvars['choco_text2color'];
		else 
			$text2color = 'NULL';

		if(!empty($postvars['designcolor']))
			$designcolor = $postvars['designcolor'];
		else 
			$designcolor = 'NULL';

		if(!empty($postvars['img']))
			$clippath = $postvars['img'];
		else 
			$clippath = 'NULL';

		if(!empty($postvars['width']))
			$width = $postvars['width'];
		else 
			$width = 'NULL';

		if(!empty($postvars['height']))
			$height = $postvars['height'];
		else 
			$height = 'NULL';

		$design_path = '';
		$clip_path="";
		$dat = time();
		if($postvars['choco_id'] != 1) {
			$clip_path = $postvars['urlname'];
			$clip_path2= $clip_path;
			$chocolate_name = $_POST['choco_name'];
			$flavor = $_POST['choco_flavor'];
			$style = $_POST['choco_style'];
			$text1_message = $_POST['choco_text1'];
			$text1_font = $_POST['choco_text1font'];
			$text1_size = $_POST['choco_text1size'];
			$text1_color = $_POST['choco_text1color'];
			$text2_message = $_POST['choco_text2'];
			$text2_font = $_POST['choco_text2font'];
			$text2_size = $_POST['choco_text2size'];
			$text2_color = $_POST['choco_text2color'];
			//$clip_path = $_POST['urlname'];
			//$clip_path2= $clip_path;
			//$qty = $quantity; //to addd
			//$foil_color=@$_POST['foilcolor'];
			$mch_name= $chocolate_name;// to add

			$file_type=preg_match('/[\w]+$/',$clip_path,$a);
			$check_clip=preg_match('/clip/',$clip_path);
			if($file_type&&!$check_clip){
			 $urlname2=time().".".$a[0];
			 $clip_path2="/var/www/mch-new/env/files/".$urlname2;
			 //copy($clip_path,$clip_path2);
			 //unlink($clip_path); 
			 }
			//If GD library is not installed, say sorry
			//$handle = fopen("12.jpeg", 'w+');
			if($chocolate_name!="Foiled Chocolate Hearts") {
			if(!function_exists("imagecreate")) die("Sorry, you need GD library to run this example");
			//Capture Post data
			$data = explode(",", $postvars['img']);
			$width = $postvars['width'];
			$height = $postvars['height'];
			//Allocate image
			$image=(function_exists("imagecreatetruecolor"))?imagecreatetruecolor( $width ,$height ):imagecreate( $width ,$height );
			imagefill($image, 0, 0, 0xFFFFFF);
			//Copy pixels
			$i = 0;
			for($x=0; $x<=$width; $x++){
				for($y=0; $y<=$height; $y++){
					//$r = hexdec("0x".substr( $data[$i] , 2, -1 ));
					//$g = hexdec("0x".substr( $data[$i] , 4 , -1 ));
					//$b = hexdec("0x".substr( $data[$i++] , 6 ,-1 ));
				//	$color = imagecolorallocate($image, $r, $g, $b);
					//$color = "0x".$data[$i++];
					$color=base_convert($data[$i++],16,10);
					imagesetpixel ($image,$x,$y,$color); } }
			//Output image and clean
			//	header( "Content-type: image/jpeg" );
			

			$design_path="/var/www/mch/env/chocolate_designs/cho"."$dat".".png";
			//touch("/env/file.txt");
			//touch("/env/chocolate_designs/file.txt");
			//touch($design_path);
			//chmod($design_path, 0777);
			$test=imagepng($image,$design_path);
			//fwrite($handle,$test);
			imagedestroy($image);	

			$design_path = substr($design_path, 12);
			}
		}
		if(empty($clip_path) || $clip_path == null)
			$clip_path = "";
		
		$trans = 'MCH'.$dat.'';

		
		
		$resultO = $db->query('SELECT id, trans_id, order_total FROM orders WHERE sessionID = \''.$this->session->id().'\' AND statusID = 1');
		$rows = count($resultO);


		if($rows < 1) {
			$result = $db->query('INSERT INTO orders (sessionID, trans_id, statusID, customer_ip, date_created, date_modified, site_id) VALUES (\''.$this->session->id().'\', \''.$trans.'\', 1, \''.$_SERVER['REMOTE_ADDR'].'\', '.$dat.', '.$dat.', '.My_Template_Controller::getCurrentSite()->id.')');
			$orderid = mysql_insert_id();
			
			// Total stays the same as it was set before (qty * unit price)
			$order_total = $total;

		} else {
			$orderid = $resultO[0]->id;

			$result = $db->query('SELECT SUM(orders_baskets.subtotal) as total FROM orders_baskets WHERE orders_baskets.order_id = '.$orderid.'');
			if($result) {
				$order_total = (double)$result[0]->total + (double)$total;
			} 


		}
		
		$text1 = str_replace("'", '', $text1);
		$text2 = str_replace("'", '', $text2);
		

		// INSERT order into the basket (orders_baskets)
		$result = $db->query('INSERT INTO orders_baskets (order_id, product_id, flavor_id, foil_id, msg_text1, msg_text2, msg_text1font, msg_text2font, msg_text1size, msg_text2size, msg_text1color, msg_text2color, style_id, clippath, designpath, design_color, qty, rate, subtotal) VALUES ('.$orderid.', '.$postvars['choco_id'].', '.$flavorID.', '.$foilID.', \''.$text1.'\', \''.$text2.'\', \''.$text1font.'\', \''.$text2font.'\', '.$text1size.', '.$text2size.', \''.$text1color.'\', \''.$text2color.'\', '.$style_id.', \''.$clip_path.'\', \''.$design_path.'\', \''.$designcolor.'\', '.$quantity.', '.$costeach.', '.$total.')'.'');
		$basketId = $result->insert_id();
		
		if($order_total >= 2000) {
			$result = $db->query('SELECT shipping_rates.price, shipping_rates.shipping_method_id, shipping_rates.id, shipping_methods.name FROM shipping_rates LEFT JOIN shipping_methods ON shipping_methods.id  = shipping_rates.shipping_method_id WHERE prc_end = 0 ORDER BY shipping_rates.price ASC');
			$lowestshippingcost = $result[0]->price;
		} else {
			$result = $db->query('SELECT shipping_rates.price, shipping_rates.shipping_method_id, shipping_rates.id, shipping_methods.name FROM shipping_rates LEFT JOIN shipping_methods ON shipping_methods.id  = shipping_rates.shipping_method_id WHERE prc_start <= '.$order_total.' AND prc_end >= '.$order_total.' ORDER BY shipping_rates.price ASC');
			$lowestshippingcost = $result[0]->price;
		}
        
        

		$result = $db->query('UPDATE orders SET subtotal = '.$order_total.', order_total = '.$order_total.', shipping_total = '.$lowestshippingcost.' WHERE orders.id = '.$orderid.'');
		

		if (My_Template_Controller::getCurrentSite()->packaging == 1)
			url::redirect('/shopping_cart/selectPackaging/?basketId='.$basketId);
		else
			url::redirect('/shopping_cart/');
	}

	public function afterbuild_dynamic()
	{
		$data = json_decode($_POST['data'], TRUE);
		
		$order = ORM::factory('order')->getCurrentOrder();
		
		$basket = ORM::factory('orders_basket');
		$basket->order_id = $order->id;
		$basket->product_id = $_GET['id'];
		
		//flavor
		if (isset($data['chocolate']) && isset($data['chocolate']['data']))
			$basket->flavor_id = $data['chocolate']['data'];
		else
			$basket->flavor_id = 1;
		//style
		$basket->style_id = isset($data['style_id'])? $data['style_id'] : 1;
		
		$basket->save();
		
		$__SIDES_SETUP = array();
		
		/* preview */
		$filename = 'basket'.$basket->id.'-preview.png';
		$pathUrl = '/env/chocolate_designs/';
		$path = '..'.$pathUrl;
		$basket->designpath = $pathUrl.$this->_processBase64($data['preview'], $path, $filename);

		/* perspectives */
		$first = TRUE;
		foreach ($data['perspectives'] as $perspective) {
			
			$sideName = $perspective['description'];
			
			if ($first) {
				$first = FALSE;
				/* foil colors */
				if (isset($perspective['color'])) {
					foreach ($perspective['color'] as $colorKey => $color) {
						if ($color['color'] == 'none')
							continue;

						$data = ORM::factory('orders_baskets_data')->find(0);
						$data->orders_basket_id = $basket->id;
						$data->side = 'All';
						$data->type = 'Foil';
						$data->name = (ucfirst(str_replace('Color', '', $colorKey))).' Foil Color';

						$colors = explode(',',$color['color']);
						$normalHex = array();
						foreach ($colors as $flashHex)
							$normalHex[] = substr(trim($flashHex),2);
						$data->data = array(
							'name'	=> $color['data'],
							'color'	=> implode(',',$normalHex),
						);
						$data->save();
					}
				}	
				/* image background */
				if (isset($perspective['image'])) {
					$data = ORM::factory('orders_baskets_data')->find(0);
					$data->orders_basket_id = $basket->id;
					$data->side = 'All';
					$data->type = 'BGImage';
					$data->name = 'Background Image';

					$data->data = array(
						'file'	=> $perspective['image']['image'],
					);
					$data->save();
				}
			}
			
			/* items */
			foreach ($perspective['items'] as $item) {
				
				/* text */
				if ($item['name'] == 'textLine') {
					
					if ($item['text'] == '')
						continue;
					
					$__SIDES_SETUP[] = $sideName;
						
					$text = ORM::factory('orders_baskets_text')->find(0);
					$text->orders_basket_id = $basket->id;
					$text->side =	$sideName;
					$text->name =	$sideName.' '.$item['description'];
					$text->text =	$item['text'];
					$text->size =	$item['size'];
					if(isset($item['color']) && is_array($item['color'])) {
						if (isset($item['color']['color']))
							$text->color_hex = $item['color']['color'];
						if (isset($item['color']['name']))
							$text->color_hex = $item['color']['name'];
					}
					if ($text->color_hex == '')
						$text->color_hex = '000000';
					if ($text->color_name == '')
						$text->color_name = 'Black (Default)';
					$text->font =	$item['font'];
					if (isset($item['x']))
						$text->position = 'X: '.$item['x'].' | Y: '.$item['y'];
					if (isset($item['rotation']))
						$text->rotation = $item['rotation'];
					$text->save();
					
				/* image */
				} else if ($item['name'] == 'editableImage') {
					
					if (FALSE === isset($item['image']))
						continue;
					
					$__SIDES_SETUP[] = $sideName;
					
					$image = ORM::factory('orders_baskets_image')->find(0);
					$image->orders_basket_id = $basket->id;
					$image->side =		$sideName;
					$image->name =		$item['description'];
					if ($item['image']['type'] == 'file')
						$image->file = $item['image']['image'];
					else {
						$filename = 'basket'.$basket->id.'-'.
										str_replace(' ', '_', $sideName.'-'.$item['description']).'.png';
						$pathUrl = '/env/chocolate_designs/uploaded_images/';
						$path = '..'.$pathUrl;
						$fullpath = $pathUrl.$this->_processBase64($item['image']['image'], 
																$path, 
																$filename);
						$image->file = $fullpath;
						$basket->clippath = $fullpath;
					}
					if (isset($item['x']))
						$image->position = 'X: '.$item['x'].' | Y: '.$item['y'];
					if (isset($item['rotation']))
						$image->rotation = $item['rotation'];
					$image->height =	$item['height'];
					$image->width =		$item['width'];
					$image->save();
				}
			}
		}
		
		$__SIDES_SETUP = array_unique($__SIDES_SETUP);
		if (count($__SIDES_SETUP) > 1)
			$basket->second_side_fee = 29.00;
		$basket->save();
		
		if (My_Template_Controller::getCurrentSite()->packaging == 1)
			url::redirect('/shopping_cart/selectPackaging/?basketId='.$basket->id);
		else
			url::redirect('/shopping_cart/');
	}
	
	protected function _processBase64($dataBase64,$path,$filename)
	{
		$data = base64_decode($dataBase64);
		file_put_contents($path.$filename, $data);

		return $filename;
	}

	public function __call($method, $arguments)
	{
		// Disable auto-rendering
		$this->profiler = new Profiler;
		$this->auto_render = FALSE;

		// By defining a __call method, all pages routed to this controller
		// that result in 404 errors will be handled by this method, instead of
		// being displayed as "Page Not Found" errors.
		echo 'This text is generated by __call. If you expected the index page, you need to use: welcome/index/'.substr(Router::$current_uri, 8);
	}
        
        private function getCostsByProductOrderDesc($id)
        {
            $db = new Database;
            return $db->query('SELECT * FROM product_costs WHERE productID = '.$id.' ORDER BY qty_start DESC');     
        }

} // End Welcome Controller