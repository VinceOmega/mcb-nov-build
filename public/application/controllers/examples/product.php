<?php	class Product_Controller extends Controller {				function index()	{				$order = new Order;		echo 'Grand total is $'. $order->total();		$product = Product::getProductByID(1);				echo $product->name .'<br>';		echo $product->price .'<br>';		echo $product->id .'<br>';		echo $product->products_description->description.'<br>';				/*		$att = $product->aattributes;		foreach($att as $at){			echo $at->name .'<BR>';			$r = $at->where('aattributes_products.product_id' , $product->id)->aattributes_product;			echo $r->aattributes_value_id;									foreach($at->aattributes_values->value as $av){				foreach($av->aattributes_values as $f){					echo $f->value.'<BR>';				}			}						echo '<BR>';		}						$my_at = new Aattribute_Model;		$my_at->name = 'color';		$r = $my_at->where('aattributes_values.value', 'blue')->products;		*/								echo '<BR><BR>';								$cat = $product->categories;		echo 'has '. $product->find_related('categories')->count_all() .' categories<br>';				echo 'has '.$product->like('name', $product->name)->count_all() .' related products<br>';		$relate = $product->like('name', $product->name)->find_all()->as_array();				//print_r($relate);					foreach ($cat as $category){			echo $category->name .'<br>';			//print_r($category->catagories_description->description); 		}		foreach ($product->options as $name=>$options){			echo $name .' = ';			foreach($options as $option){				echo $option .' | ';			}			echo '<BR>';		}		echo 'attributes<BR>';		foreach ($product->attributes as $key=>$value){			echo $key .' = '. $value;			echo '<BR>';		}									$profile = new Profiler;		}}		?>