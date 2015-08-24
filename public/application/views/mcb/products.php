   <? if (!isset($argstwo)) $argstwo = ""; ?>
      <? if (!isset($argsone)) $argsone = ""; ?>

    <div id="content" class="products row">
    <!-- Right 2 Col -->
        <div class="2-col row col-md-12">
            <h2>Products</h2>
			<!-- header -->
                <div class="col-md-3 left-col">
                            <ul>          
                                
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
          
                    <li><a href="<?=$link?>"><?=$title?></a></li>

<?
                }
?>


                                
                                    </ul>
                </div>
                    
                    <div class="right-col col-md-9">
                        <div class="row product-display col-md-12">
                          
                                  
             <?php 
                if (isset($products)  && count($products) > 0)
                {
                    foreach($products as $product)
                    {
                        if ($productListType == Products_Controller::LIST_TYPE_NORMAL)
                        {
            ?>
                              

                                        <div class="product-info-box col-md-4 rnd-10-black row">
                                              <img src="/env/product_images/<?php echo $product->products_description->image; ?>" alt="gifts" width="200"><br>
                                                            <h4><?php echo $product->name; ?></h4><br>
                                                            <p><?php echo $product->products_description->short_description ;?></p>
                                                            <img src="/env/images/mcb/tag.png" alt="gifts"><span class="price">$<?php echo money_format('%.2n', $product->price); ?></span>
                                                            <br>
                                                            <button class="rnd btn btn-thin orange" data-href="/products/show/<?php echo $product->products_description->title_url; ?>">Get Started</button>    
                                        </div>
                                            

<?
                        }
                        else
                        {
?>
                               


                                    <div class="product-info-box col-md-4 rnd-10-black row">
                                              <img src="/env/product_images/<?php echo $product->products_description->image; ?>" alt="gifts" width="200"><br>
                                                            <h4><?php echo $product->name; ?></h4><br>
                                                            <p><?php  echo $product->products_description->short_description; ?></p>
                                                            <img src="/env/images/mcb/tag.png" alt="gifts"><span class="price">$<?php echo money_format('%.2n', $product->price); ?></span>
                                                            <br>
                                                            <button class="rnd btn btn-thin orange" data-href="/products/show/<?php echo $product->products_description->title_url; ?>">Get Started</button>    
                                        </div>
                                                
                                                <?
                        }
                    }
                }
                else if($argstwo === 'grab_and_go')
                { ?>
                                                    <?php foreach($productresults as $products):?>
                                                        <? if($products->kind == 'MCB_GNG'){ ?>
                            



                                <div class="product-info-box col-md-4 rnd-10-black row">
                                        <img src="/env/product_images/<?php echo $products->image; ?>" width="100" />
                           
                                                <h4><?php echo $products->name; ?></h4>
                                                 <p><?php echo $products->short_description;  ?></p>
                                                <img src="/env/images/mcb/tag.png" alt="gifts"><span class="price"><?php echo money_format('%.2n', $products->price); ?></span>
                                                            <br>
                                                            <button class="rnd btn btn-thin orange" data-href="/products/show/<?php echo $products->title_url; ?>">Get Started</button>    
                                        
                                </div>

                                                <? } ?>
                                <?php endforeach; ?>
               <? } else { ?>
              <?php foreach($cg as $products):?>
                                                    


                                <div class="product-info-box col-md-4 rnd-10-black row">
                                        <img src="/env/category_images/<?php echo $products->image; ?>" width="100" />
                           
                                                <h4><?php echo $products->name; ?></h4>
                                                 <p><?php echo $products->short_description; ?></p>
                                                <!--<img src="/env/images/mcb/tag.png" alt="gifts"><span class="price"><?php //echo money_format('%.2n', $products->price); ?></span> -->
                                                    <br>
                                                            <button class="rnd btn btn-thin orange" <? if($products->id == 12){ ?> data-href="/products/show/<?php echo $products->title_url; ?>" <? } else { ?> data-href="/products/category/<?php echo $products->title_url; ?>" <? } ?>>Get Started</button>    
                                        
                                </div>

                                <?php endforeach; ?>
<?
                        
                        // else
                        // {

                            // $product = $category->products[2];
                            // echo "<pre>";
                            // print_r($category->products[2]);
                            // echo "</pre>";

?>           
                                 <!--     <div class="product-info-box col-md-4 rnd-10-black row">
                                              <img src="/env/category_images/<?php  echo $category->categories_description->image;  ?>" alt="gifts" width="200"><br>
                                                            <h4><?php echo $category->name; ?></h4><br>
                                                            <p><?php echo substr($category->categories_description->short_description, 0, 300)."...";  ?></p>
                                                             <img src="/env/images/mcb/tag.png" alt="gifts">
                                                            <br>
                                                            <button class="rnd btn btn-thin orange" data-href="/products/category/<? echo $category->categories_description->title_url?>">Get Started</button>    
                                        </div> -->
<?
                   //     }
                    
                }
?>
            

                                        
                        </div>


                    </div> <!-- End right Side -->
                
                 <div class="clear mid-space">
                </div>
        </div> <!-- End 2 Col -->
    </div>
<?php

echo "<pre>";
// if(isset($argsone)) echo $argsone."<br>";
// if(isset($argstwo)) echo $argstwo."<br>"; 
// if(isset($cg)) print_r($cg);
// print_r($products->name);
// print_r($categories->products[0]->name);
foreach($productresults as $products){
 print_r($products); 
}


// foreach($cg as $cat){
//     $id = $cat->id;

//     print_r($cat);
// }
              /*  foreach($categories as $category){
                    if (count($category->products) == 1){
                        $product = $category->products[0];
                        $link = '/products/show/'.$product->products_description->title_url;
                        $title = $product->name;
                    }else{
                        $link = '/products/category/'.$category->categories_description->title_url;
                        $title = $category->name;
                                    }
                        } */
       
                // foreach($categories as $category)
                // {
                //     if (count($category->products) == 1)
                //     {
                //         $product = $category->products[0];
                //         $link = '/products/show/'.$product->products_description->title_url;
                //         $title = $product->name;

                //         echo $link; echo $title;
                //     }
                //     else
                //     {
                //         $link = '/products/category/'.$category->categories_description->title_url;
                //         $title = $category->name;
                //     }
                // }
// }


echo "</pre>";

?>