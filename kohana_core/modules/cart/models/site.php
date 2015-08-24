<?php defined('SYSPATH') OR die('No direct access allowed.');

class Site_Model extends ORM {
    
	protected $has_and_belongs_to_many = array(
		'sites_categories' => 'categories',
		'sites_occasions' => 'occasions',
		'sites_testimonials' => 'testimonials',
		'sites_types' => 'types',
	);
	
	protected $has_many = array(
		'orders'
	);
	
    public function getAll() {
        return self::factory($this->object_name)->find_all();
    }
    
    public function get_descendants_chk($sites, $checkboxName){
        
        $sitesIds = array();
        foreach ($sites as $site)
            $sitesIds[] = $site->id;
        
        $out = '<ul style="list-style-type:none; padding:0">';
        
        $sites = $this->getAll();
        
        foreach ($sites as $site)
        {
            $check ='';
            if (in_array($site->id,  $sitesIds))
                $check = 'checked=checked';
            
            $out .= '<li><label><input type="checkbox" value='.$site->id.' name="'.$checkboxName.'[]" '. $check.' />' . $site->name .'</label>(ID: '.$site->id.')</li>';
        }

        $out .= '</ul>';

        return $out;
    }
}
