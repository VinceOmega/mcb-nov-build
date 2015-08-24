

            <div id="content">
			<div id="section-header">
				<h2 class="curly">Products</h2>
			</div><!-- header -->
			<div id="breadcrumbs">
				<a href="/">Home</a> > <span><?=$product->name?></span>
			</div>
                        
                        
                        <div id="sidebar" class="pink-top grey-border left">
				<?php foreach($categories  as $category):?>
                                    <?foreach ($category->products as $product_sidebar):?>
				<div class="sidebar-link">
					<a href="/products/show/<?php echo $product_sidebar->products_description->title_url; ?>" title="<?php echo $product_sidebar->name; ?>">
                                            <?php echo $product_sidebar->name; ?>
                                        </a>
				</div>
				<div class="grey-bar"></div>
                                    <?php endforeach; ?>
				<?php endforeach; ?>
                                
                                <? if(isset($gng_category)):?>
                                <div class="sidebar-link">
                                    <a href="<?='/products/category/'.$gng_category->categories_description->title_url?>">
                                        <?=$gng_category->name;?>
                                    </a>
                                </div>
                                <div class="grey-bar"></div>
                                <? endif;?>
			</div><!-- sidebar -->
                        
			<div id="products" class="right">
				<h2 class="curly" style="margin-bottom: 15px;"><?php echo $product->name; ?></h2>
				<div id="product-info" class="square grey-border left">
				<a href="/env/product_images/<?php echo $product->image; ?>" class="highslide" id="hsimage" onclick="return hs.expand(this)" border="0" style="border:0px;">
				<img src="/env/product_images/<?php echo $product->image; ?>" alt="<?php echo $product->image_alt ?>" width="250" border="0" style="border:0px;" /></a>
					<!--<img src="/env/product_images/<?php echo $product->image; ?>" ALT="<?php echo $product->image_alt ?>" width="250" />-->
					<a class="enlarge" onClick="return document.getElementById('hsimage').onclick()"><img src="/env/images/enlarge.png" />Click to enlarge</a>
				</div><!-- square -->
				<div class="product-tabs right">
					<div class="tab-feature">                         
						<div class="tabs tabs-bottom">
							<ul>
								<li><a href="#details" title="Details" >Details</a></li>
								<li><a href="#price" title="Price">Price</a></li>
								<li><a href="#production_time" title="Production Time">Production Time</a></li>
							</ul>
							<div id="details" style="background-color:#FFFFFF;">
								<p>Details</p>
								<p class="detailtext" style="background-color:#FFFFFF;"><?php echo $product->description; ?></p>
								
							</div><!-- tabs-1 -->
							<div id="price" width="400">
							<table border="0">
							  <colgroup>
									<col width="150" />
									<col  />
								</colgroup>
							  <tr>
								<th style="text-align:left;" colspan="2">Price based on Quantity</th>
								
							  </tr>

								<?php $c=0; 
								$color='#EEEEEE';

								//foreach($productcosts as $costs):?>
								
								<tr style="padding-bottom:5px;">
									<?php if($c == 0) {
												$color='#DDDDDD';
											} else {
												$c = -1;
												$color='#BBBBBB';
											}
										?>
									<?php //if($costs->qty_end == 0): ?>
										<td style="background-color:<?php //echo $color; ?>;"><label for="productDimensionsL" style="font-weight:normal; text-align:center;"><?php // echo ''.$costs->qty_start.'+: '; ?></label></td>
										<td style="background-color:<?php //echo $color; ?>;"><strong><?php //echo ''.money_format('%.2n', $costs->price).''; ?></strong></td>
									<?php // else: ?>
										<td style="background-color:<?php //echo $color; ?>;"><label for="productDimensionsL" style="font-weight:normal; text-align:center;"><?php // echo $costs->qty_start.' - '.$costs->qty_end.': '; ?></label></td>
										<td style="background-color:<?php //echo $color; ?>;"><strong><?php //echo money_format('%.2n', $costs->price); ?></strong></td>
				   
									<?php //endif; ?>


								</tr>
								<?php $c++; ?>
								<?php //endforeach; ?>
							</table>
							</div><!-- tabs-2-->
							<div id="production_time">
								<?php echo $product->production_times; ?>
              
									<!--
										<p>Production Time:</p>
										<p class="detailtext">2-3 business days does not include shipping time</p>
										<p class="detailtext">RUSH ORDERS AVAILABLE</p>
										<p class="detailtext">call 1-866-230-7730</p>

										-->
							
                </div><!-- tabs-3 -->
              
						</div><!-- tabs div -->
					</div><!-- tab-feature div -->
				</div><!-- product-tabs -->
	
<?		if ($product->kind == 'MCB_GNG') { ?>
				<form id="bagsForm" method="POST" action="http://<?=$_SERVER['SERVER_NAME']?>/shopping_cart/addGnG/<?=$product->id?>">
				<!--<form id="bagsForm" method="POST" action="https://<? //$_SERVER['SERVER_NAME']?>/shopping_cart/addGnG/<?=$product->id?>">-->
					<button type="submit" onclick="if(! check_amount()) return false;"><img src="/env/images/mch/mch_add_to_cart.png" /></button>
					Amount: 
					<a href="#" class="less">-</a>
					<input type="text" value="200" name="bags" id="bagsAmount"
						   onkeydown="return isNumberKey(event);"
						   onkeyup="recalculateAmounts();"/>
					<a href="#" class="more">+</a>
					<br />
                        <div id="popupInfo" style="top: 260px; left: 300px; width: 500px; height: 210px; position: absolute; background-color: rgb(255, 255, 255); border-style: solid; border-color: rgb(255, 202, 210); bottom: -50px; margin: 30px 0px 0px 60px; padding: 10px; display: none; visibility: visible;">
                                <div id="close_button" onclick="hideErrorBlock()"  style="text-align: right">
                                    <img src="/env/images/close_button.png" alt="" />
                                </div>
				<div id="tooSoonHead"><h3>Quantity Error</h3></div>
				<div class="clear pink-bar"></div>
				<div id="tooSoonText"><p>The minimum quantity of this product is 200</p></div>
			</div>
<?			
			if ($gngoptions)
			{
				foreach ($gngoptions as $option)
				{
					$opt_list = explode('#',$option->values);
?>
					<div class="gngOption">
						<label><?=$option->name?></label>
						<select name="options[<?=$option->id?>]">
<?						foreach ($opt_list as $_opt) { ?>
							<option><?=$_opt?></option>
<?						} ?>
						</select>
					</div>
<?
				}
			}
?>
					Total: <span id="bagsTotal"></span>
				</form>
				
<?		} else { ?>
                                
        <a href="/products/build/<?php echo $product->title_url; ?>"><img style="margin-top: 10px;" class="right" src="/env/images/<?=My_Template_Controller::getViewPrefix()?>/get_started_button.png" alt="Get Started"/></a> 
<?              }?>        
				<div class="clear"></div>
				<?php if($product->id != 1 AND $product->kind != 'MCB_GNG'): ?>
					<h4 class="curly">Recently Ordered</h4>
					<div id="recently" class="grey-border pink-corner">
<?						if (isset($recentDesigns[0])) { ?>
						<img class="left" src="<?=$recentDesigns[0]->designpath?>" />
<?						} else { ?>
						<img class="left" src="/env/images/merry_christmas.png" />
<?						} ?>
<?						if (isset($recentDesigns[1])) { ?>
						<img class="left" src="<?=$recentDesigns[1]->designpath?>" />
<?						} else { ?>
						<img class="left" src="/env/images/happy_anniversary.png" />
<?						} ?>
<?						if (isset($recentDesigns[2])) { ?>
						<img class="left" src="<?=$recentDesigns[2]->designpath?>" />
<?						} else { ?>
						<img class="left" src="/env/images/congrat_jason.png" />
<?						} ?>
					</div><!-- recently -->
				<?php else: ?>
					
				<?php endif; ?>
				


				<h2 class="curly">Other Products</h2>
        
				<div id="other" class="grey-border pink-corner">
             
              <?
                $product_count = count($productresults);
                $products = $productresults;
            ?>
            <? $used_indexes = array();?>                        
            <?php for ($index = 0; $index < 3; $index++):?>
                <? 
                    $rand_index = rand(0, $product_count-1);
                    if(in_array($rand_index, $used_indexes))
                    {
                        $index--;
                        continue;
                    }
                    else
                        $used_indexes[] = $rand_index;
                ?>
                <?php if($products[$rand_index]->name != $product->name): ?>
                    <? if($product->kind == 'MCB_GNG'):?>
                        <a href="/products/show/<?php echo $products[$rand_index]->products_description->title_url; ?>">
                            <img src="/env/product_images/<?php echo $products[$rand_index]->products_description->image; ?>" 
                                 alt="<?php echo $products[$rand_index]->products_description->image_alt ?>" width="100" /></a>
                    <? else:?>
                        <a href="/products/show/<?php echo $products[$rand_index]->title_url; ?>">
                            <img src="/env/product_images/<?php echo $products[$rand_index]->image; ?>" 
                                 alt="<?php echo $products[$rand_index]->image_alt ?>" width="100" /></a>
                    <? endif?>
                <?php else: ?>
                    <?php $index--?>
                <?php endif;?>
            <?php endfor; ?>
				
          
          
          
          
				</div><!-- other -->
			</div><!-- products -->
			<div class="spacer"></div>
<script type="text/javascript">
	
<?
$pricesArray = array();
foreach (ORM::factory('product',$product->id)->getPrices() as $cost) {
	$pricesArray[] = array(
		'start' => intval($cost->qty_start),
		'end'	=> intval($cost->qty_end),
		'price'	=> floatval($cost->price)
	);
}
$pricesJson = json_encode($pricesArray);
echo 'var prices = '.$pricesJson.';'; 
?>

function money_format(price)
{
	return '$ '+(Math.round(price*100)/100).toFixed( 2 );
}

function isNumberKey(evt)
{
   var charCode = (evt.which) ? evt.which : event.keyCode
   return charCode <= 57 && charCode != 32;
}

function moreLessPicker(amount, input)
{
	var value = parseInt(input.val());
	if (value<1)
		return;
	input.val(value + amount);
	if (input.val() == 0)
		input.val(1);
	
	recalculateAmounts();
}

function recalculateTotalCoinsAmount()
{
	coins_total_amount = $('#bagsAmount').val();
}

function recalculateAmounts()
{
	recalculateTotalCoinsAmount();
	
	var bagsAmount = $('#bagsAmount').val();
	var bagsUnitPrice = getUnitPriceForAmount(bagsAmount,prices);
	var bagsTotal = bagsAmount * bagsUnitPrice;

	$('#bagsTotal').html(money_format(bagsTotal))
}

function getUnitPriceForAmount(amount, prices)
{
	prices = eval(prices);
	var minStart = false;
	for (var i=0; i<prices.length; i++) {
		var price = prices[i];
		if (amount >= price.start && 
			(amount <= price.end || price.end == 0)) {
			return parseFloat(price.price);
		}
		if (price.start < minStart.start || minStart == false)
			minStart = price;
	}
	return parseFloat(minStart.price);
}

function check_amount() {
    var amount = $('#bagsAmount').val();
    if(amount < 200) {
        $('#popupInfo').css('display', 'block');
        return false;
    }
    else
        return true;
}

function hideErrorBlock() {
    $('#popupInfo').css('display', 'none');
}

var coins_total_amount = 0;

$('#bagsForm a.less').click(function(){
	moreLessPicker(-1,$('#bagsAmount'));
	return false;
});
$('#bagsForm a.more').click(function(){
	moreLessPicker( 1,$('#bagsAmount'));
	return false;
});

<? if ($product->kind == 'MCC_GNG') { ?>
recalculateAmounts();
<? } ?>
	
$('div#recently').tabs({ fx: { opacity: 'toggle'} }).tabs("rotate", 3000, true);

</script>
       <?php
       ini_set('display_errors',1);  error_reporting(E_ALL);
           	echo "<pre>";  
           	print_r(var_dump(get_defined_vars()));
           	echo "</pre>";
           ?>