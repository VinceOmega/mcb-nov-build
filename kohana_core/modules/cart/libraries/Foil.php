<?php defined('SYSPATH') OR die('No direct access allowed.');

class Foil{

	private static $foil;
	
	function __construct(){
	}
	
	static public function getColorByID($id){
		if(isset($id)){
			$foil = new Foil_color_Model($id);
			
			//http://stackoverflow.com/questions/866589/array-merge-replace (array union operator)
			//$product->tax_ids = (object)($product->tax_ids + $product->products_type->tax_ids);
			//$product->options = (object)($product->options + $product->products_type->options);	
			//$product->attributes = (object)($product->attributes + $product->products_type->attributes);
			//$product->shipping_info = (object)($product->shipping_info + $product->products_type->shipping_info); 
			
			//$product->is_shippable = ($product->is_shippable OR $product->products_type->is_shippable);
	
			return $foil;
		}
	}
	

}

