<?php defined('SYSPATH') OR die('No direct access allowed.');

//class Occasion_description_Model extends ORM {}

//echo My_Template_Controller::getViewPrefix()."<br>";
//echo My_Template_Controller::getCurrentSite()."<br>";
//mch

class Occasion_info extends ORM {

	public function find($id){
		$p = parent::find($id);
		
		return $p;
	}		
}


class Occasion_Model extends Occasion_info {
	
	protected $has_and_belongs_to_many = array(
		'sites_occasions' => 'sites'
	);
	
	protected $has_one = array('occasions_description', 'occasions_type', 'occasions_inventory');
	
    protected $load_with = array('occasions_description');
	
	 /**
	 * Gets an array of all occasions
	 *
	 * @return array
	 */
	public function getOccasions() {
		$db = new Database;
		return $db->query('SELECT occasions.name, occasions.headline, occasions.occasions_description_id, occasions_descriptions.* FROM occasions LEFT JOIN occasions_descriptions ON occasions.occasions_description_id = occasions_descriptions.id INNER JOIN sites_occasions ON occasions.id = sites_occasions.occasion_id WHERE sites_occasions.site_id = '.My_Template_Controller::getCurrentSite()->id.' ORDER BY occasions.name ASC');     
	}
  
  /**
	 * Gets a single occasion
	 *
	 * @return array
	 */
	public function getOccasionByName($name) {
		$db = new Database;
		
		$occasion = $db->query(
				'SELECT occasions.name, occasions.headline, occasions.occasions_description_id, occasions_descriptions.* 
				 FROM occasions 
				 LEFT JOIN occasions_descriptions 
					ON occasions.occasions_description_id = occasions_descriptions.id  
				 LEFT JOIN sites_occasions so
					ON occasions.id = so.occasion_id
				 	
				 WHERE occasions_descriptions.title_url = \''.$name.'\' AND so.site_id = '.My_Template_Controller::getCurrentSite()->id);
		return $occasion[0];
	}

	public function getNextID() {
		$db = new Database;
		$occasion = $db->query('SELECT id FROM occasions ORDER BY id DESC');
		$next = $occasion[0]->id + 1;
		return $next;
	}

}

//class Occasions_type_Model extends Product_info {}


