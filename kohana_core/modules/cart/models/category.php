<?php defined('SYSPATH') OR die('No direct access allowed.');

//class categories_description_Model extends ORM {
//	protected $has_one = array('categories');
//}

class Category_Model extends Mptt_Model {
	protected $has_one = array(
		'categories_description'
	);
	
	protected $load_with = array('categories_description');
	
	protected $has_and_belongs_to_many = array(
		'categories_products' => 'products',
		'sites_categories' => 'sites'
	);

	protected $children = 'categories'; // ORM_Tree needs this
//	protected $sorting = array('lft' => 'ASC'); // nested sets are sorted by the left value	
	protected $sorting = array('lvl' => 'ASC','order'=>'ASC'); 
	
	public function get_descendants_chk($categories){
		$out = '<ul style="list-style-type:none; padding:0">';

		$allCategories = $this->find_all();
		foreach ($allCategories as $node)
		{
			if (in_array($node->id,  $categories))
				$check = 'checked=checked';
			else
				$check ='';
			
				$sitesShortnames = array();
				foreach ($node->sites as $site) {
					$sitesShortnames[] = $site->shortname;
				}

			$out .= '<li><input type="checkbox" value='.$node->id.' id='.$node->id.' name="productCategories[]" '. $check.' /><label for="'.$node->id.'">' . $node->name .'</label>(ID: '.$node->id.' | Sites: '.implode(',',$sitesShortnames).')</li>';
			
		}
		$out .= '
		</ul>';
		
		return $out;
	}
}
