<?php defined('SYSPATH') OR die('No direct access allowed.');

class Packaging_Cost{

	private static $packaging;
	
	function __construct(){
	}
	
	static public function getCostsByPackaging($id){
		$packaging_costs = ORM::factory('packaging_cost')->where('packagingID', $id)->orderby('qty_start', 'ASC')->find_all();
		return $packaging_costs;
	}
}