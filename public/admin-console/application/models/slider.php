<?php defined('SYSPATH') or die('No direct script access.');

class Silder_Model extends ORM{

 
    /**
	 * Gets the most recent testimonial
	 *
	 * @return array
	 */
	public function getSlides($id) {
		$db = new Database;
		$slides= $db->query("SELECT * FROM silder WHERE id = '$id' ORDER BY id DESC");
		return $slides;  
	}
  



}

