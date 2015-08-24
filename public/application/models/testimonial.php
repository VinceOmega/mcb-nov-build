<?php defined('SYSPATH') or die('No direct script access.');

class Testimonial_Model extends ORM{

 
    /**
	 * Gets the most recent testimonial
	 *
	 * @return array
	 */
	public function getLatestTestimonial() {
		$db = new Database;
		$testimonial = $db->query('SELECT * FROM testimonials ORDER BY id DESC LIMIT 1');
		return $testimonial[0];  
	}
  



}

