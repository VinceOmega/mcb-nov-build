                <div id="content">
			<div id="section-header">
				<h2 class="curly">Products</h2>
			</div><!-- header -->
                        <div id="sidebar" class="pink-top grey-border left"
                             <?=($productListType == Products_Controller::LIST_TYPE_GnG)? 'style="width: 221px;"': ''?>>
                                <?foreach ($products as $product):?>
                                    <div class="sidebar-link">
                                        <a href="<?='/products/show/'.$product->products_description->title_url?>">
                                            <?=$product->name;?>
                                        </a>
                                    </div>
                                    <div class="grey-bar"></div>                            
                                <? endforeach;?>
                            <? if(isset($gng_category)):?>
                            <div class="sidebar-link">
                                <a href="<?='/products/category/'.$gng_category->categories_description->title_url?>">
                                    <?=$gng_category->name;?>
                                </a>
                            </div>
                            <div class="grey-bar"></div>
                            <? endif;?>
			</div><!-- sidebar -->
                            <div id="products" class="right" 
                                 <?=($productListType == Products_Controller::LIST_TYPE_GnG)? 'style="width:71%;"': ''?>>
			
                                    <? if($productListType == Products_Controller::LIST_TYPE_NORMAL):?>
                                        <?php foreach($products as $product):?>

                                            <div class="box grey-border left pink-corner">
                                                    <img src="/env/product_images/<?php echo $product->products_description->image; ?>" width="100" />
                                                    <div class="product-details">
                                                            <h3 class="curly"><?php echo $product->name; ?></h3>
                                                            <p><?php echo $product->products_description->short_description; ?></p>
                                                            <span class="price">Starting at <?php echo money_format('%.2n', $product->price).' per '.substr($product->unit, 0, strlen($product->unit)-1) ?></span>
                                                            <a href="/products/show/<?php echo $product->products_description->title_url; ?>">
                                                                <img src="/env/images/<?=My_Template_Controller::getViewPrefix()?>/get_started_button.png" /></a>
                                                    </div><!-- product-deatils -->
                                            </div><!-- box -->

                                        <?php endforeach; ?>
                                            
                                        <? if(isset($gng_category)):?>
                                            <div class="box grey-border left pink-corner">
                                                <img src="/env/category_images/<?php echo $gng_category->categories_description->image; ?>" width="100" />
                                                <div class="product-details">
                                                        <h3 class="curly"><?php echo $gng_category->name; ?></h3>
                                                        <p><?php echo $gng_category->categories_description->short_description; ?></p>
                                                        <a href="/products/category/<? echo $gng_category->categories_description->title_url?>"><img src="/env/images/<?=My_Template_Controller::getViewPrefix()?>/get_started_button.png" /></a>
                                                </div><!-- product-deatils -->
                                            </div><!-- box -->
                                        <? endif;?>
                                            
                                    <? else:?>
                                        <? foreach ($gng_products as $product):?>
                                            <div class="box_gng grey-border left pink-corner">
                                                <div class="box_gng_image">
                                                    <img src="/env/product_images/<?php echo $product->products_description->image; ?>" width="100" alt="Chocolate Gold Dollars (Bag of 460)">
                                                </div>
                                                <div class="gng-product-details">
                                                    <h3 class="curly"><?php echo $product->name; ?></h3>
                                                    <p></p>
                                                    <span class="price">Starting at <?php echo money_format('%.2n', $product->price).' per '.substr($product->unit, 0, strlen($product->unit)-1) ?></span>
                                                </div><!-- product-deatils -->
                                                <a href="/products/show/<?php echo $product->products_description->title_url; ?>">
                                                    <img src="/env/images/mch/mch_order_here.png">
                                                </a>
                                            </div><!-- box -->
                                        <? endforeach;?>
                                    <? endif?>
                                        
                                        
                                    <? if($productListType == Products_Controller::LIST_TYPE_NORMAL):?>
                                    <? endif?>

                            </div><!-- products -->
                        
                        <div class="spacer"></div>
		