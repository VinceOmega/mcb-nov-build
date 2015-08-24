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
class Contact_Controller extends My_Template_Controller {

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
		$this->description = 'Contact MyChocolateCoins.com to create your customized chocolate coins.';
		$this->title = 'Contact MyChocolateCoins.com - Custom Chocolate Coins: Create customized chocolate coins with your own design';
		$this->keywords = 'chocolate hearts, custom chocolate hearts, personalized chocolate hearts, chocolate favors, custom chocolate favors, party favors, personalized chocolate favors, chocolate casino chips, chocolate poker chips, custom chocolate casino chips, casino party favors, wedding favors, personalized wedding favors, baby shower favors, bridal shower favors, chocolate gelt, chocolate gold hearts, chocolate party favors, chocolate candy favors, custom chocolate, custom chocolate poker chips, corporate favors';
	}
	
	protected function setTexts_MCH()
	{
		$this->description = 'Contact MyChocolateHearts.com to create your customized chocolate heart.';
		$this->title = 'Contact MyChocolateHearts.com - Custom Chocolate Hearts: Create customized chocolate hearts with your own design';
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
		// In Kohana, all views are loaded and treated as objects.
		$this->template->content = new View('contact');

		$this->template->metaDescription = $this->description;
		$this->template->metaKeywords = $this->keywords;	
		$this->template->metaTitle = $this->title;

		// You can assign anything variable to a view by using standard OOP
		// methods. In my welcome view, the $title variable will be assigned
		// the value I give it here.
		$this->template->title = $this->title;

		$this->template->content->message = "";

	}
	
	public function submit()
	{
		// In Kohana, all views are loaded and treated as objects.
		$this->template->content = new View('contact');

		$this->template->metaDescription = $this->description;
		$this->template->metaKeywords = $this->keywords;	
		$this->template->metaTitle = $this->title;

		// You can assign anything variable to a view by using standard OOP
		// methods. In my welcome view, the $title variable will be assigned
		// the value I give it here.
		$this->template->title = $this->title;


		$name = $_POST['name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$inquiry = $_POST['inquiry'];

		$recipient = 'freddyfalck@hotmail.com'; 
		$subject = 'My Chocolate Hearts.com Contact Form Submission';


		$body = "<html>\n"; 
		$body .= "<body style=\"font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px; color:#666666;\">\n"; 
		$body .= "Name : ".$name." <br>\n";
		$body .= "Email : ".$email." <br>\n";
		$body .= "Phone : ".$phone." <br><br>\n";
		$body .= $inquiry; 
		$body .= "</body>\n"; 
		$body .= "</html>\n"; 
		
		$headers  = "From: Mychocolatehearts.com Contact Form<webmaster@mychocolatehearts.com> \r\n"; 
		$headers .= "Reply-To: info@mychocolatehearts.com \r\n"; 
		$headers .= "Return-Path: info@mychocolatehearts.com \r\n"; 
		$headers .= "X-Mailer: Kohana \r\n"; 
		$headers .= 'MIME-Version: 1.0' . " \r\n"; 
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . " \r\n"; 
		
		if(mail($recipient, $subject, $body, $headers)) {
			$this->template->content->message = "Your inquiry has been recieved and we will respond to you at our earliest convenience.";
		} else {
			$this->template->content->message = "An error has occured and your inquiry was not successfully received. Please try again or email us directly at info@mychocolatehearts.com.";
		}

		
	

		

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