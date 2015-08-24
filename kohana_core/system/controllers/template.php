<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Allows a template to be automatically loaded and displayed. Display can be
 * dynamically turned off in the controller methods, and the template file
 * can be overloaded.
 *
 * To use it, declare your controller to extend this class:
 * `class Your_Controller extends Template_Controller`
 *
 * $Id: template.php 3769 2008-12-15 00:48:56Z zombor $
 *
 * @package    Core
 * @author     Kohana Team
 * @copyright  (c) 2007-2008 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
abstract class Template_Controller extends Controller {

	// Template view name
	public $template = 'template';
  

	// Default to do auto-rendering
	public $auto_render = TRUE;

	/**
	 * Template loading and setup routine.
	 */
	public function __construct()
	{
		parent::__construct();
		
		$this->session = Session::instance();
    
		// Load the template
		$this->template = new View($this->template);
		$this->template->header = new View('header');
		$this->template->footer = new View('footer');
		
		// An array of links to display. Assiging variables to views is completely
		// asyncronous. Variables can be set in any order, and can be any type
		// of data, including objects. This sets the links for both the header and
		// the footer together (rather than creating a global_array for them both
		// to access an individual object).
		$this->template->header->links = array
		(
			'Home'     => '/',
			'Products' => '/products',
			'Shopping Cart'         => '/shopping_cart',
			'FAQ'       => '/faq',
			'About Us'        => '/about',
			'Contact Us'        => '/contact',
			
		);
		
	
			
		
		$this->template->footer->links = array
		(
			'Home'     => '/',
			'Products' => '/products',
			'Shopping Cart'         => '/shopping_cart',
			'FAQ'       => '/faq',
			'About Us'        => '/about',
			'Contact Us'        => '/contact',
			'Policies and Terms'        => '/policies_and_terms',
		);
		

		if ($this->auto_render == TRUE)
		{
			// Render the template immediately after the controller method
			Event::add('system.post_controller', array($this, '_render'));
	}
	}

	/**
	 * Render the loaded template.
	 */
	public function _render()
	{
		if ($this->auto_render == TRUE)
		{
			// Render the template when the class is destroyed
			$this->template->render(TRUE);
		}
	}

} // End Template_Controller