<?php defined('SYSPATH') or die('No direct script access.');

class Testimonial_Model extends ORM{

    protected $has_and_belongs_to_many = array(
		'sites_testimonials' => 'sites'
	);
	
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

	public function getTestimonialByID ($id) {
		$db = new Database;
		$testimonial = $db->query('SELECT * FROM testimonials WHERE id = '.$id.'');
		return $testimonial[0];  
	}
	
		public function getNextID() {
		$db = new Database;
		$occasion = $db->query('SELECT id FROM testimonials ORDER BY id DESC');
		if(!empty($occasion))
			$next = $occasion[0]->id + 1;
		else
			$next = 1;
		return $next;
	}
}

