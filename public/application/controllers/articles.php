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
class Articles_Controller extends My_Template_Controller {

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
		$this->template->content = new View('articles');
		
		$this->template->content->articles = ORM::factory('article')
													->orderBy('id','DESC')
													->where('active','Yes')
													->find_all();

		$this->template->metaDescription = '';
		$this->template->metaKeywords = '';
		$this->template->metaTitle = '';
		$this->template->title = '';
	}
	
	public function show() {
		
		$this->template->content = new View('article');
		
		$url = $this->uri->segment(2);
		$article = ORM::factory('article')
							->where('url',$url)
							->find();
		if ($article->id == 0)
			url::redirect('/articles');
		$this->template->content->article = $article;
		
		$this->template->metaDescription = $article->meta_description;
		$this->template->metaKeywords = $article->meta_keywords;
		$this->template->metaTitle = $article->meta_title;
		$this->template->title = $article->meta_title;
	}
}