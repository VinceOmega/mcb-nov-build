<?php defined('SYSPATH') or die('No direct script access.');


class Articles_Controller extends Base_Controller {

	public $tableCols = array('title','url', 'active');

	public $fields = array(
		'title' => array(
			'title' => 'Title',
			'width'=> '400',
			'type' => 'text',
			'required' => true,
			'mask' => false,
		),
		'active' => array(
			'title' => 'Active',
			'type'  => 'text',
		),	
		'url' => array(
			'title' => 'Url',
			'type' => 'text',
			'required' => true,
			'mask' => false,
		)
	);
	public $objectName = 'articles';
	public $title = 'Articles List - ';
	
	public function __construct() {
		if ($_SERVER['PHP_AUTH_USER'] !== 'mch_superadmin')
			url::redirect('/');
		parent::__construct();
	}

	public function edit()
	{
		$id = $this->uri->segment(3);		
		$article = ORM::factory('article')->find($id);
		if ($article->id == 0)
			url::redirect('/articles');
		
		if (isset($_POST['save']))	{
			$post = new Validation(array_merge($_POST, $_FILES));            			  
			
			if (!$post->validate()) {

			}
			else {
				foreach ($post->article as $field => $value) {
					$article->{$field} = $value;
				}
				$article->save();
				
				url::redirect('/articles/edit/' . $article->id);
			}
		}
		$this->_renderView(array(
			'article' => $article,
		));
	}
	
	
	public function add()
	{
		if (isset($_POST['save']))	{
			$post = new Validation(array_merge($_POST, $_FILES));            			  
			
			if (!$post->validate()) {

			}
			else {
				$article = ORM::factory('article')->find(0);
				
				foreach ($post->article as $field => $value) {
					$article->{$field} = $value;
				}
				
				$article->save();
				
				url::redirect('/articles/edit/' . $article->id);
			}
		}
		$this->_renderView(array(
			'article' => ORM::factory('article')->find(0),
		));
	}
	
	public function _renderView($contentData = NULL){
		$view = new View('admin');
		 
		$view->header  = new View('header');
		$view->content = new View('article_content',$contentData);
		$view->footer  = new View('footer');
		 
		$view->header->title     = 'Article >> Add / Edit ';     // string for variable $title in view header.php
		$view->content->heading  = 'Heading of your page'; // string for variable $heading in view content.php
		 
		$view->render(TRUE);
	}
}