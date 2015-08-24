<?php defined('SYSPATH') OR die('No direct access allowed.');



class Layer_Controller extends Controller {

	// Disable this controller when Kohana is set to production mode.
	// See http://docs.kohanaphp.com/installation/deployment for more details.
	const ALLOW_PRODUCTION = FALSE;

	// Set the name of the template to use
	public $template = 'kohana/template';
	public $description = '';
	public $title = '';
	public $keywords = '';


	public function __construct(){
		parent::__construct();

		$method = $this->methodNameForSite('setTexts');
		$this->method();
	}

		protected function setTexts_MCC()
	{
		$this->description = 'Create your very own custom chocolate coins with your own text and images, or use our stock images';
		$this->title = 'Custom Chocolate Coins - MyChocolateCoins.com: Create customized chocolate coins with your own design';
		$this->keywords = 'chocolate hearts, custom chocolate hearts, personalized chocolate hearts, chocolate favors, custom chocolate favors, party favors, personalized chocolate favors, chocolate casino chips, chocolate poker chips, custom chocolate casino chips, casino party favors, wedding favors, personalized wedding favors, baby shower favors, bridal shower favors, chocolate gelt, chocolate gold hearts, chocolate party favors, chocolate candy favors, custom chocolate, custom chocolate poker chips, corporate favors';
	}
	
	protected function setTexts_MCH()
	{
		$this->description = 'Create your very own custom chocolate hearts with your own text and images, or use our stock images';
		$this->title = 'Custom Chocolate Hearts - MyChocolateHearts.com: Create customized chocolate hearts with your own design';
		$this->keywords = 'chocolate hearts, custom chocolate hearts, personalized chocolate hearts, chocolate favors, custom chocolate favors, party favors, personalized chocolate favors, chocolate casino chips, chocolate poker chips, custom chocolate casino chips, casino party favors, wedding favors, personalized wedding favors, baby shower favors, bridal shower favors, chocolate gelt, chocolate gold hearts, chocolate party favors, chocolate candy favors, custom chocolate, custom chocolate poker chips, corporate favors';
	}

		protected function setTexts_MCB()
	{
		$db = new Database;
		$productarray = Router::$arguments;
		$productname = $productarray[0];
		$post = $_POST;
		$user = User_Model::logged_user();
		$session = $_SESSION;
		$this->description = 'Create your very own custom chocolate bars with your own text and images, or use our stock images';
		$this->title = 'Custom Chocolate Hearts - MyChocolateHearts.com: Create customized chocolate bars with your own design';
		$this->keywords = 'chocolate bars, custom chocolate bars, personalized chocolate bars, chocolate favors, custom chocolate favors, party favors, personalized chocolate favors, chocolate casino chips, chocolate poker chips, custom chocolate casino chips, casino party favors, wedding favors, personalized wedding favors, baby shower favors, bridal shower favors, chocolate gelt, chocolate gold hearts, chocolate party favors, chocolate candy favors, custom chocolate, custom chocolate poker chips, corporate favors';
		// $this->template->content->db = $db;
		// $this->template->content->productname = $productname;
		// $this->template->content->post = $post;
		// $this->template->content->user = $user;
		// $this->template->content->session = $session;



		$temp = ORM::factory('temp_orders');
		if($post->conf_type = 'bar'){

$base = new \Imagick($post->base);
$layout = new \Imagick($post->layer);
$img = $post->base;
$size = getimagesize($img);
// $h = ($size[0])/3;
// $w = ($size[1])/3;
$h = 100;
$w = 100;

$layout->resizeImage($w, $h, Imagick::FILTER_LANCZOS, 1);
$base->compositeImage($layout, Imagick::COMPOSITE_OVERLAY, 100, 30);
$bar = $base->writeImage("/var/www/mch/env/html5_configurator/img/design/output.png");





		$temp->sessionID = $session->session_id;
		$temp->productID = $post->productsid;
		$temp->flavorID = $post->bar_type;
		$temp->foilID = 9;
		$temp->order_msg_text1 = $post->line_one;
		$temp->order_msg_text2 = $post->line_two;
		$temp->order_msg_text3 = $post->line_three;
		$temp->order_msg_text4 = $post->line_four;
		$temp->order_msg_font1 = $post->line_one_font;
		$temp->order_msg_font2 = $post->line_two_font;
		$temp->order_msg_font3 = $post->line_three_font;
		$temp->order_msg_font4 = $post->line_four_font;
		$temp->order_msg_size1 = $post->line_one_size;
		$temp->order_msg_size2 = $post->line_two_size;
		$temp->order_msg_size3 = $post->line_three_size;
		$temp->order_msg_size4 = $post->line_four_size;
		$temp->styleID = 1;
		$temp->order_clip_path = $post->layer_top;
		$temp->order_bg_path = null;
		$temp->order_design_path = $bar;
		$temp->order_qty = 200;
		$temp->order_rate = 1;
		$temp->order_total = 200*1;
		$temp->added = 0;
		$temp->cust_type = $post->conf_type;
			
			header("Location:/products/wrapper/$productname");
		}

		if($post->conf_type = 'wrapper'){


$layout = new \Imagick($post->layer_top);
$wrapperbase = new \Imagick($post->base);
$mask = new \Imagick("/var/www/mch/env/images/mcb/wrapper.png");

$temp = $post->base;
$i = sizeof($wrapper);
$wrapper = substr($temp, 3, $i-1);
$wsize = getimagesize($wrapper);
//print_r($size);
// $h = ($size[0])/3;
// $w = ($size[1])/3;
$h = 100;
$w = 100;

$layout->resizeImage($w, $h, Imagick::FILTER_LANCZOS, 1);
$wrapperbase->resizeImage(1020, 210, Imagick::INTERPOLATE_BICUBIC, 1);
$mask->compositeImage($layout, Imagick::COMPOSITE_OVERLAY, 70, 50);
$wrapperbase->compositeImage($mask, Imagick::COMPOSITE_OVERLAY, 400, 0);
$wrapperbase->writeImage("/var/www/mch/env/html5_configurator/img/design/output2.png");

		$temp->sessionID = $session->session_id;
		$temp->productID = $post->productsid;
		$temp->flavorID = null;
		$temp->foilID = 9;
		$temp->order_msg_text1 = $post->line_one;
		$temp->order_msg_text2 = $post->line_two;
		$temp->order_msg_text3 = $post->line_three;
		$temp->order_msg_text4 = $post->line_four;
		$temp->order_msg_font1 = $post->line_one_font;
		$temp->order_msg_font2 = $post->line_two_font;
		$temp->order_msg_font3 = $post->line_three_font;
		$temp->order_msg_font4 = $post->line_four_font;
		$temp->order_msg_size1 = $post->line_one_size;
		$temp->order_msg_size2 = $post->line_two_size;
		$temp->order_msg_size3 = $post->line_three_size;
		$temp->order_msg_size4 = $post->line_four_size;
		$temp->styleID = 1;
		$temp->order_clip_path = $post->layer_top;
		$temp->order_bg_path = $post->wrapper;
		$temp->order_design_path = $wrapperbase;
		$temp->order_qty = 200;
		$temp->order_rate = 1;
		$temp->order_total = 200*1;
		$temp->added = 0;
		$temp->cust_type = $post->conf_type;
			
			header("Location:/shopping_cart");
				}

			}
	
		
	public function index()
	{
		
		$this->template->content = new View('layer');

		$this->template->metaDescription = 'A new generation of custom chocolate favors is here with our state-of-the-art My Chocolate Hearts customizers. We help you design your own personalized and custom chocolate hearts for any occasion from party to wedding, bridal and baby shower, corporate and many more. Call us toll free at 1-866-230-7730.';
		$this->template->metaKeywords = 'chocolate hearts, custom chocolate hearts, personalized chocolate hearts, chocolate favors, custom chocolate favors, party favors, personalized chocolate favors, chocolate casino chips, chocolate poker chips, custom chocolate casino chips, casino party favors, wedding favors, personalized wedding favors, baby shower favors, bridal shower favors, chocolate gelt, chocolate gold hearts, chocolate party favors, chocolate candy favors, custom chocolate, custom chocolate poker chips, corporate favors';
		$this->template->metaTitle = 'stuff';
    
    // You can assign anything variable to a view by using standard OOP
		// methods. In my welcome view, the $title variable will be assigned
		// the value I give it here.
		$this->template->title = 'My Chocolate Hearts';
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

}