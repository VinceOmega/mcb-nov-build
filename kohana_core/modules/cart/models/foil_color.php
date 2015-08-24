<?php defined('SYSPATH') OR die('No direct access allowed.');

class Foil_color_Model extends ORM {
	
	 /**
	 * Gets an array of all product costs
	 *
	 * @return array
	 */
	public function getColorByID($id) {
		$db = new Database;
		return $db->query('SELECT * FROM foil_colors WHERE id = '.$id.'');     
	}
  


}

