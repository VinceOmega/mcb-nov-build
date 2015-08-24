<?php

abstract class My_Template_Controller extends Template_Controller {
	
	static private $_viewPrefix = NULL;
	static private $_site = NULL;
	
	protected $_removeSSL = TRUE;
	
	static public function getViewPrefix() {
		if (NULL == self::$_site) {
			$site = self::getCurrentSite();
			
			if (NULL == self::$_viewPrefix) {
				if (FALSE !== strpos($_SERVER['REQUEST_URI'],'admin-console')) {
					return self::$_viewPrefix = '/';
				}
				
				self::$_viewPrefix = $site->internal;
			}
		}
		if (FALSE !== strpos($_SERVER['REQUEST_URI'],'admin-console')) {
			return self::$_viewPrefix = '/';
		}
		return self::$_viewPrefix;
	}
	
	 
	/**
	 * 
	 * @return \Site_Model
	 */
	static public function getCurrentSite() {
		if (NULL == self::$_site) {
			$results = ORM::factory('site')->where('url',$_SERVER['SERVER_NAME'])->find_all();
			
			if (count($results) != 1) {
				Kohana::log('error','Wrong site configuration on '.__FILE__.' line '.__LINE__);
			}

			self::$_site = $results[0];
			
			if (!self::$_site) {
				Kohana::log('error','Wrong site configuration on '.__FILE__.' line '.__LINE__);
			}
		}
		
		return self::$_site;
	}
	
	public function __construct()
	{
		$this->_removeSSL();
		
		$prefix = self::getViewPrefix();
		
		if (strpos($this->template,'kohana/') === 0)
			$this->template = 'kohana/'.$prefix.'/'.substr($this->template,7);
		
		parent::__construct();
	}
	
	protected function methodNameForSite($method)
	{
//		Kohana::log('error',$method.'_'.strtoupper(self::getViewPrefix()));
		return $method.'_'.strtoupper(self::getViewPrefix());
	}
	
	private final function _removeSSL ()
	{
		if ($this->_removeSSL 
			&& $_SERVER['SERVER_PORT'] != 80
			&& $_SERVER['REQUEST_METHOD'] == 'GET')
		{
			$url = "http://{$_SERVER['SERVER_NAME']}/".url::current(TRUE);
			header ("Location: {$url}");
			exit();
		}
	}
}

?>
