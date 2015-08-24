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
class Homepage_Controller extends My_Template_Controller {

	// Disable this controller when Kohana is set to production mode.
	// See http://docs.kohanaphp.com/installation/deployment for more details.
	const ALLOW_PRODUCTION = FALSE;

	// Set the name of the template to use
	public $template = 'kohana/template';

	public $description = '';
	public $title = '';
	public $keywords = '';

	

	public function __construct() {
		parent::__construct();
		
		//set texts
		$method = $this->methodNameForSite('setTexts');
		$this->$method();
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
		$this->description = 'Create your very own custom chocolate bars with your own text and images, or use our stock images';
		$this->title = 'Custom Chocolate Hearts - MyChocolateHearts.com: Create customized chocolate bars with your own design';
		$this->keywords = 'chocolate bars, custom chocolate bars, personalized chocolate bars, chocolate favors, custom chocolate favors, party favors, personalized chocolate favors, chocolate casino chips, chocolate poker chips, custom chocolate casino chips, casino party favors, wedding favors, personalized wedding favors, baby shower favors, bridal shower favors, chocolate gelt, chocolate gold hearts, chocolate party favors, chocolate candy favors, custom chocolate, custom chocolate poker chips, corporate favors';
	}

	public function index()
	{
		$db=new Database;
		// clean up old orders that are a week or older and are 'Pending'
		$dat = time();
		$lastweek = $dat - 604800;
		$result = $db->query('DELETE FROM orders WHERE date_modified < '.$lastweek.' AND statusID = 1');


		// In Kohana, all views are loaded and treated as objects.
		$this->template->content = new View('homepage');
		
		$this->template->metaDescription = $this->description;

		$this->template->metaKeywords = $this->keywords;

		$this->template->metaTitle = $this->title;

		
		// getOccasions and getOccasion($id) is a method defined in Occasion_Model
		$occasions = new Occasion_Model;
		$this->template->content->occasionresults = $occasions->getOccasions();  
		
		// getProducts is a method defined in Product_Model
		$products = new Product_Model;
		$this->template->content->productresults = $products->getHomepageProducts();  
		
		// getLatestTestimonial is a method defined in Testimonial_Model
		$testimonial = new Testimonial_Model;
		$this->template->content->testimonialresult = $testimonial->getLatestTestimonial();  

		// get the most recently created hearts of each product type
		$result = $db->query('SELECT orders.id, orders.can_share, orders_baskets.id, orders_baskets.product_id, orders_baskets.designpath, orders_baskets.msg_text1, orders_baskets.msg_text2, fc.name FROM orders INNER JOIN orders_baskets ON orders.id = orders_baskets.order_id LEFT JOIN foil_colors fc ON fc.id = orders_baskets.foil_id WHERE orders.can_share = 1 AND orders_baskets.designpath != "" AND orders_baskets.img_approved = 1 AND orders.statusID IN (2,4,5) AND orders.site_id = '.My_Template_Controller::getCurrentSite()->id.' ORDER BY order_date DESC LIMIT 4');
		

		$recentForward = array();
		$recentBack = array();
		$i = 0;
		foreach($result as $recent) {
			if($i < 10) {
				$recentForward[$i] = $recent;
			} else {
				$recentBack[$i-10] = $recent;
			}
			$i++;
		}

		$this->template->content->recentHearts = $recentForward;
		$this->template->content->recentHeartsBack = $recentBack;
		//$result = $db->query('SELECT orders.id, orders.can_share, orders_baskets.id, orders_baskets.product_id, orders_baskets.designpath FROM orders INNER JOIN orders_baskets ON orders.id = orders_baskets.order_id WHERE orders.can_share = 1 AND orders_baskets.designpath != "" AND orders_baskets.img_approved = 1 AND orders.statusID IN (2,4,5) ORDER BY order_date ASC LIMIT 10');
		

		
		// You can assign anything variable to a view by using standard OOP
		// methods. In my welcome view, the $title variable will be assigned
		// the value I give it here.
		$this->template->title = $this->title;


		$result = $db->query("SELECT * FROM slides WHERE site_id = '".My_Template_Controller::getCurrentSite()->id."'");
		
		$this->template->content->slides = $result;

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