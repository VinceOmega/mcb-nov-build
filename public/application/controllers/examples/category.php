<?php

class Category_Controller extends Controller {
		
	function index()
	{
	
	
	/*
	// adding children //
	$id = 2;
	
	//load catagory with id 4
	$category = new Category_Model($id);
	
	//create root node (our first category)
	//$category = new Category_Model;
	//$category->name = 'category 1';
	//$category->save();

	$category2 = new Category_Model;
	$category2->name = 'first child of category '.$id;
	$category2->add_to($category); // not: $category3->save() !

	$category3 = new Category_Model;
	$category3->name = 'second child of category '.$id;
	$category3->add_to($category); // not: $category3->save() !

	//after each modification to the tree, we need to rebuild it
	$category_r = new Category_Model(1);
	$category_r->rebuild_tree();
	*/
	
	
	
	
	
	
	
	
	// children statistic //
	$category = new Category_Model(1);
	echo $category->name;
	echo '<BR>';
	
	// does the category have any children?
	echo $category->has_children() ? 'Yes' : 'No';
	echo '<BR>';
	echo 'has '. $category->count_children() .' children<BR>';
	echo 'has '. $category->find_related('catagories_description')->count_all() .' catagories_description<BR>';
	
	
	//just returns all the children of the selected catagory
	$children = $category->all_children(true); 	//the param "true" means to include the parent category iteslef as well in the list
	foreach ($children as $node){
		echo $node->name .'<BR>';
		echo 'has '. $node->find_related('products')->count_all() .' products<BR>';
		echo 'has '. $node->find_related('catagories_description')->count_all() .' catagories_description<BR>';
		
		/*
		foreach($node->products as $prod){
			echo $prod->name.'<BR>';
		}
		*/
		
		echo $node->catagories_description->description.'<BR><BR>';
	}
	
	
	
	
	
	
	


	/*
	// deleting nodes //
	//delete category with id 2 and all(!) of its children
	$category_d = new Category_Model(2);
	$done = $category_d->delete();
	var_dump($done);
	*/







	/*
	echo '<link rel="stylesheet" type="text/css" href="http://view.jquery.com/trunk/plugins/treeview/jquery.treeview.css" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://view.jquery.com/trunk/plugins/treeview/jquery.treeview.js"></script>';

	$category = new Category_Model(1);
	//outputs the tree structure in a un-ordered html list
	echo $category->get_descendants_html();

	echo '	
	<script type="text/javascript">
		$(document).ready(function()
		{
			$("#tree").treeview({
				animated:"medium",
				collapsed:true				
			});
		});	
	</script>';
	*/


	
	

	
	/*
	$category = new Category_Model(1);
	
	//returns a recursive array with all the children of the selected category
	$menu = $category->to_array();
	
	echo '<pre>';
	print_r($menu);
	echo '</pre>';
	*/
		
		
		
		
		
		
	/*
	// this could be used for breadcrumbs
	$category = new Category_Model(6);
	$path = $category->get_path();

	foreach ($path as $category){
		echo ' > '.$category->name;
	}
	*/
		
		
		
		
		

	/*
	// Display a list of links
	$category_t = new Category_Model(2);
	$articles = $category_t->select_list('id', 'name', '>');
	 
	foreach ($articles as $id => $name)
	{
		echo html::anchor('articles/'.$id, $name) .'<BR>';
	}
	*/
	
	
		
	$profiler = new Profiler;
	
	}
}