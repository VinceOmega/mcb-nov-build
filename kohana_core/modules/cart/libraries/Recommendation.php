<?php defined('SYSPATH') OR die('No direct access allowed.');

class Recommendation{
/*
	Get ids of products which people buy along with the product $id
*/
	public function getProducts($id, $limit = 3){
		$db = new Database();
		$rows = $db->query('SELECT  p.id, p.name, p.price, pd.description, pd.image, pd.image_alt, pd.title_url, count(ob1.id) as `count` FROM orders_baskets ob1
			JOIN orders_baskets ob2 ON ob2.`order_id`=ob1.order_id
			JOIN products AS p ON (p.id=ob1.product_id)
			LEFT JOIN products_descriptions AS pd ON (pd.id=p.products_description_id)
			WHERE ob2.product_id='.$id.' AND ob1.product_id<>'.$id.'
			GROUP BY ob1.product_id
			ORDER BY `count` DESC
			LIMIT '.$limit);			
		return $rows;
	}
}