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
class Test_cc_Controller extends My_Template_Controller {

	// Disable this controller when Kohana is set to production mode.
	// See http://docs.kohanaphp.com/installation/deployment for more details.
	const ALLOW_PRODUCTION = FALSE;

	// Set the name of the template to use
	public $template = 'kohana/template';

	public function __construct(){
		exit();
	}
	
	public function index()
	{
		// In Kohana, all views are loaded and treated as objects.
		$this->template->content = new View('test_cc');

		$this->template->metaDescription = 'A new generation of custom chocolate favors is here with our state-of-the-art My Chocolate Hearts customizers. We help you design your own personalized and custom chocolate hearts for any occasion from party to wedding, bridal and baby shower, corporate and many more. Call us toll free at 1-866-230-7730.';
		$this->template->metaKeywords = 'chocolate hearts, custom chocolate hearts, personalized chocolate hearts, chocolate favors, custom chocolate favors, party favors, personalized chocolate favors, chocolate casino chips, chocolate poker chips, custom chocolate casino chips, casino party favors, wedding favors, personalized wedding favors, baby shower favors, bridal shower favors, chocolate gelt, chocolate gold hearts, chocolate party favors, chocolate candy favors, custom chocolate, custom chocolate poker chips, corporate favors';

		
    
    
    
    
    
    
    
    
    
    
    // You can assign anything variable to a view by using standard OOP
		// methods. In my welcome view, the $title variable will be assigned
		// the value I give it here.
		$this->template->title = 'My Chocolate Hearts';

		

	}
  
  
  
  public function test() {
		// In Kohana, all views are loaded and treated as objects.
		$this->template->content = new View('test_cc');

		$this->template->metaDescription = 'A new generation of custom chocolate favors is here with our state-of-the-art My Chocolate Hearts customizers. We help you design your own personalized and custom chocolate hearts for any occasion from party to wedding, bridal and baby shower, corporate and many more. Call us toll free at 1-866-230-7730.';
		$this->template->metaKeywords = 'chocolate hearts, custom chocolate hearts, personalized chocolate hearts, chocolate favors, custom chocolate favors, party favors, personalized chocolate favors, chocolate casino chips, chocolate poker chips, custom chocolate casino chips, casino party favors, wedding favors, personalized wedding favors, baby shower favors, bridal shower favors, chocolate gelt, chocolate gold hearts, chocolate party favors, chocolate candy favors, custom chocolate, custom chocolate poker chips, corporate favors';

		
    $payment = new Payment('Authorize');
    
    $attributes = array('card_num'     => '4222222222222',
								'exp_date'             => '01/13',
								'amount'               => '2.00',
								'ship_to_first_name'   => 'Alexander',
								'ship_to_last_name'    => 'Finger',
								'ship_to_address'      => '600 Unicorn Park Dr.',
								'ship_to_city'         => 'Woburn',
								'ship_to_state'        => 'MA',
								'ship_to_zip'          => '01801',
								'ship_to_country'      => 'USA',
								'first_name'           => 'Alexander',
								'last_name'            => 'Finger',
								'address'              => '600 Unicorn Park Dr.',
								'city'                 => 'Woburn',
								'state'                => 'MA',
								'zip'                  => '01801',
								'country'              => 'USA',
                'x_test_request'       => 'TRUE'
								//'x_invoice_num'        => $this->order->id
								
			);
      
      
    $status = 0;
		$payment->set_fields($attributes);
		$finance_state = 'CHARGING';  
    echo "<pre>";
    var_dump($payment);
    echo "</pre>";  
      
		
    break;
		
    if($payment->process()){
			$finance_state = 'CHARGED';
			$status = 2;
      
      
      echo "<pre>";
      var_dump($payment);
      var_dump($finance_state);
      var_dump($status);
      echo "</pre>";
			//$this->order->save();
			//return true;
		}else{
			$this->order->finance_state = 'DENIED';
			$this->order->status = 3;
			//$this->order->save();
			throw new Exception('Payment operation failed ('.$payment->getLastError().')');
		}
    
    
    
    
    
    
    
    
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

} // End Welcome Controller