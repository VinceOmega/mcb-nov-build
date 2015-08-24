
		<div id="content">
			<div id="section-header">
				<h2 class="curly">Products</h2>
			</div><!-- header -->
			<div id="sidebar" class="grey-top grey-border left" style="<?=$productListType == Products_Controller::LIST_TYPE_GnG?'width:25%;':''?>">
			
<?php			
				foreach($categories as $category)
				{
					if (count($category->products) == 1)
					{
						$product = $category->products[0];
						$link = '/products/show/'.$product->products_description->title_url;
						$title = $product->name;
					}
					else
					{
						$link = '/products/category/'.$category->categories_description->title_url;
						$title = $category->name;
					}
?>
				<div class="sidebar-link">
					<a href="<?=$link?>"><?=$title?></a>
				</div>
				<div class="grey-bar"></div>
<?
				}
?>
			</div><!-- sidebar -->
			<div id="products" class="right" style="<?=$productListType == Products_Controller::LIST_TYPE_GnG?'width:71%;':''?>"">
			
				<?php 
				if (isset($products) && count($products) > 0)
				{
					foreach($products as $product)
					{
						if ($productListType == Products_Controller::LIST_TYPE_NORMAL)
						{
?>
				<div class="box grey-border left grey-corner">
					<img src="/env/product_images/<?php echo $product->products_description->image; ?>" width="100" alt="<?php echo $product->products_description->image_alt; ?>" />
					<div class="product-details">
						<h3 class="curly"><?php echo $product->name; ?></h3>
						<p><?php echo $product->products_description->short_description; ?></p>
						<span class="price">Starting at <?php echo money_format('%.2n', $product->getPriceStartingAt()).' per '.inflector::singular($product->unit); ?></span>
						<a href="/products/show/<?php echo $product->products_description->title_url; ?>"><img src="/env/images/<?=My_Template_Controller::getViewPrefix()?>/get_started_button.png" /></a>
					</div><!-- product-deatils -->
				</div><!-- box -->
<?
						}
						else
						{
?>
				<div class="box_gng grey-border left grey-corner">
					<img src="/env/product_images/<?php echo $product->products_description->image; ?>" width="100" alt="<?php echo $product->products_description->image_alt; ?>" />
					<div class="product-details">
						<h3 class="curly"><?php echo $product->name; ?></h3>
						<p><?php echo $product->products_description->short_description; ?></p>
						<span class="price">Starting at <?php echo money_format('%.2n', $product->getPriceStartingAt()).' per '.inflector::singular($product->unit); ?></span>
					</div><!-- product-deatils -->
					<a href="/products/show/<?php echo $product->products_description->title_url; ?>"><img src="/env/images/<?=My_Template_Controller::getViewPrefix()?>/mcc_order_here.png" /></a>
				</div><!-- box -->
<?
						}
					}
				}
				else
				{
					foreach($categories as $category)
					{
						if (count($category->products) == 1)
						{
							$product = $category->products[0];
?>
				<div class="box grey-border left grey-corner">
					<img src="/env/product_images/<?php echo $product->products_description->image; ?>" width="100" alt="<?php echo $product->products_description->image_alt; ?>" />
					<div class="product-details">
						<h3 class="curly"><?php echo $product->name; ?></h3>
						<p><?php echo $product->products_description->short_description; ?></p>
						<span class="price">Starting at <?php echo money_format('%.2n', $product->getPriceStartingAt()).' per '.inflector::singular($product->unit); ?></span>
						<a href="/products/show/<?php echo $product->products_description->title_url; ?>"><img src="/env/images/<?=My_Template_Controller::getViewPrefix()?>/get_started_button.png" /></a>
					</div><!-- product-deatils -->
				</div><!-- box -->
<?
						}
						else
						{
?>
				<div class="box grey-border left grey-corner">
					<img src="/env/category_images/<?php echo $category->categories_description->image; ?>" width="100" alt="<?=$category->categories_description->image_alt?>" />
					<div class="product-details">
						<h3 class="curly"><?php echo $category->name; ?></h3>
						<p><?php echo $category->categories_description->short_description; ?></p>
						<a href="/products/category/<?php echo $category->categories_description->title_url; ?>"><img src="/env/images/<?=My_Template_Controller::getViewPrefix()?>/get_started_button.png" /></a>
					</div><!-- product-deatils -->
				</div><!-- box -->
<?	
						}
					}
				}
?>
			
			</div><!-- products -->
			<div class="spacer"></div>
		