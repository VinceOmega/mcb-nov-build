<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<?php echo html::script(array (url::base().'media/js/fckeditor/fckeditor.js'), FALSE); ?>
<script type="text/javascript">
window.onload = function()
{
	// Automatically calculates the editor base path based on the _samples directory.
	// This is usefull only for these samples. A real application should use something like this:
	// oFCKeditor.BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.
	var sBasePath = '<?php echo url::base() ?>/media/js/fckeditor/';

	var oFCKeditor = new FCKeditor( 'productDescription' ) ;
	oFCKeditor.Width = '100%' ;
	oFCKeditor.Height = '512' ; 
	oFCKeditor.BasePath	= sBasePath ;
	oFCKeditor.ReplaceTextarea() ;	
	
	var oFCKeditor = new FCKeditor( 'productShortDescription' ) ;
	oFCKeditor.Width = '100%' ;
	oFCKeditor.Height = '300' ; 
	oFCKeditor.BasePath	= sBasePath ;
	oFCKeditor.ReplaceTextarea() ;	

	var oFCKeditor = new FCKeditor( 'productProductionTimes' ) ;
	oFCKeditor.Width = '100%' ;
	oFCKeditor.Height = '300' ; 
	oFCKeditor.BasePath	= sBasePath ;
	oFCKeditor.ReplaceTextarea() ;	
	
}

function add_more_price_ranges()
{
	$('#costs_table').append('<tr><td>From: <input type="text" name="cost_qty_start[]" class="formTextDimension" value="" />To: <input type="text" name="cost_qty_end[]" class="formTextDimension" value="" /></td><td>$<input type="text" name="cost_price[]" class="formTextDimension" value=""/></td><td><a href="#" onclick="delete_price_range($(this)); return false;" style="font-size:11px;">Delete cost</a></td></tr>');
}

function delete_price_range(delete_link)
{
	delete_link.parent().parent().remove();
}
</script>

<?php 
$id = $this->uri->segment(3);
$product = ORM::factory('product')->where('products.id',$id)->find();
$product_types = Product_Type::getAll();
$product_costs = Product_Cost::getCostsByProduct($id);
$product_tax_classes = Tax::getAll();

$flavors = ORM::factory('flavor')->find_all();
$foil_colors = ORM::factory('foil_color')->find_all();
?>		


<form action="<?php echo url::base() . $this->uri->segment(1). '/' . $this->uri->segment(2) . '/' .$id ?>" method="POST" enctype="multipart/form-data" id="form" >
<div id="mainContent" >




	<div class="box">
		  <div class="left"></div>
		  <div class="right"></div>
		  <div class="heading">
		    <h2 id="heading">Products</h2>
		    <span id="buttons">
				<input type="submit" value="Save" name="save" class="css-button" />
				<!--<a onclick="location = '<?php  echo url::base() . $this->uri->segment(1) ?>'" class="button"><span>Cancel</span></a>-->
				<input type="button" onclick="location = '<?php  echo url::base() . $this->uri->segment(1) ?>'" value='Cancel' class="css-button"  />
			</span>
		  </div>
	</div>
	


	<div id="contentLeft">
		<div id="tabs" class="htabs" >
			<a tab="#tab_general" id="general_tab"><input type="hidden" name="tab_general" >General</a>
			<a tab="#tab_meta_infromation">Meta Information</a>
			<a tab="#tab_image">Image</a>
			<a tab="#tab_shipping">Costs</a>
			<a tab="#tab_custom_options">Custom Options</a>
			<a tab="#tab_attributes">Product Attributes</a>
			<a tab="#tab_options">Options (GnG only)</a>
<?		/*	if ($product->id != 0 && $product->kind == 'MCC_CONF') { ?>
			<a href="#" tab="#xml_generator">Product Configurator</a>
<?			} */?>
		</div> 
 	</div>
		
	<div id="contentRight">
		<div id="tab_general" >
			<div class="headline">General Information</div>
			<table>
			<colgroup>
				<col width="150" />
				<col width="550"/>
			</colgroup>
		
			<tr>
				<td><label for="productName">Product Name</label></td>
				<td><input type="text" name="productName" id="productName" class="name" maxlength="255" value="<?php echo htmlspecialchars($product->name) ?>" /></td>
			</tr>
			<tr>
				<td><label for="productDescription">Description</label></td>
				<td><textarea name="productDescription" id="productDescription" class="formText"><?php echo $product->products_description->description; ?></textarea></td>
			</tr>	
			<tr>
				<td><label for="productShortDescription">Short Description</label></td>
				<td><textarea name="productShortDescription" id="productShortDescription" class="formText" cols="80" rows="25"><?php echo $product->products_description->short_description; ?></textarea></td>
			</tr>	
				<tr>
				<td><label for="productProductionTimes">Production Times</label></td>
				<td><textarea name="productProductionTimes" id="productProductionTimes" class="formText" cols="80" rows="25"><?php echo $product->products_description->production_times; ?></textarea></td>
			</tr>	
			
<!--			<tr>
				<td><label for="productPrice">Price</label></td>
				<td><input type="text" name="productPrice" id="productPrice" class="formText" maxlength="10" value="<?php echo number_format($product->price, 2); ?>"  /></td>
			</tr>-->
			<tr>
				<td><label for="productSize">Size</label></td>
				<td><input type="text" name="productSize" id="productSize" class="formText" value="<?php echo $product->size; ?>"  /></td>
			</tr>
			<tr>
				<td><label for="productTaxClass">Tax Class</label></td>
				<td><select name="productTaxClass" id="productTaxClass" class="formSelect">
						<option value="0"></option>
					<?php			
						
						foreach( $product_tax_classes as $key =>$value){
							if (in_array($key, (array)$product->tax_ids))
								$sel = 'selected=selected';
							else
								$sel ='';
							echo '<option value="'.$key. '" '.$sel.' >'.$value.'</option>';
						}
					?>
					 </select>
				</td>
			</tr>
			<tr>
				<td><label for="productType">Type</label></td>
				<td><select name="productType" id="productType" class="formSelect">
					<option value="0" > </option>
					<?php					
						foreach( $product_types as $key =>$value){
							if ($key == $product->products_type_id)
								$sel = 'selected=selected';
							else
								$sel ='';
							echo '<option value="'.$key. '" ' .$sel. '>'.$value.'</option>';
						}
					?>
					 </select>
				</td>
			</tr>
			<tr>
				<td><label for="productStatus">Status</label></td>
				<td><!-- product status (0=>'disabled', 1=>'enabled', 2=>'deleted') -->
					
					<select name="productStatus" id="productStatus" class="formSelect">
						<option value="1" <?php if ($product->status == 1) echo "selected=selected"; ?> >Enabled</option>
						<option value="0" <?php if ($product->status == 0) echo "selected=selected"; ?> >Disabled</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><label for="productQuantity">Quantity on hand/ Inventory</label></td>
				<td><input type="text" name="productQuantity" id="productQuantity" class="formText" maxlength="10" value="<?php echo $product->products_inventory->on_hand;?>" /></td>
			</tr>
			<tr>
				<td><label for="">Categories</label></td>
				<td>
					<?php		
						$categories = array();
						
						if ($product->categories) 
							foreach ($product->categories as $category)
								$categories[] = $category->id;
													
						$cat = new Category_Model(1);
						//outputs the tree structure in a un-ordered html list
						echo $cat->get_descendants_chk($categories);
					?>
				
				</td>
			</tr>
			
			<tr>
				<td><label for="">Packagings</label></td>
				<td>
					<?php		
						$ppModel = new Products_packaging_Model(1);
						echo $ppModel->getPackagingsByProduct($product->id);
					?>
				
				</td>
			</tr>
			<tr>
				<td><label for="">Bars Groups [MCB only]</label></td>
				<td>
					<input type="checkbox" name="bar_size" value="1"> 14x8 size bars <br>
					<input type="checkbox" name="bar_size" value="2"> 175x175 bars <br>
					<input type="checkbox" name="bar_size" value="3"> 2x5 bars <br>
					<input type="checkbox" name="bar_size" value="4"> 4x6 or 2x3 bars <br>
					<input type="checkbox" name="bar_size" value="5"> 9x5 bars <br>
				</td>
			</tr>
			<tr>
				<td><label for="">Homepage</label></td>
				<td>
					<label>
						<? $checked = ($product->homepage == 1) ? 'checked' : ''; ?>
						<input type="checkbox" name="productHomepage" value="1" <?=$checked?> /> Show in Homepage
					</label>
				</td>
			</tr>
			
			<tr>
				<td><label for="">Kind</label></td>
				<td>
					<fieldset>
						<legend>My Chocolate Hearts</legend>
						<label><input type="radio" name="productKind" <?=$product->kind=='MCH'?'checked':''?> value="MCH" onchange="showFieldsForKind(this.value)" /> Basic configurable product.</label>
                                                <br/>
						<label><input type="radio" name="productKind" <?=$product->kind=='MCH_GNG'?'checked':''?> value="MCH_GNG" onchange="showFieldsForKind(this.value)" /> Grab and Go.</label>
					</fieldset>
					<fieldset>
						<legend>My Chocolate Coins</legend>
						<label><input type="radio" name="productKind" <?=$product->kind=='MCC_CONF'?'checked':''?> value="MCC_CONF" onchange="showFieldsForKind(this.value)" /> With configurator.</label>
						<br />
						<label><input type="radio" name="productKind" <?=$product->kind=='MCC_GNG'?'checked':''?> value="MCC_GNG" onchange="showFieldsForKind(this.value)" /> Grab and Go.</label>
					</fieldset>
					<fieldset>
						<legend>My Chocolate Bars</legend>
						<label><input type="radio" name="productKind" <?=$product->kind=='MCB'?'checked':''?> value="MCB" onchange="showFieldsForKind(this.value)" /> With configurator.</label>
						<br />
						<label><input type="radio" name="productKind" <?=$product->kind=='MCB_GNG'?'checked':''?> value="MCB_GNG" onchange="showFieldsForKind(this.value)" /> Grab and Go.</label>
					</fieldset>
				</td>
			</tr>
			
			<tr class="fieldMCC_GNG" style="display:none">
				<td>
					Flavor<br />
					(Only for Grab and Go)
				</td>
				<td>
					<select name="productFlavorId" class="formSelect">
						<option value=""></option>
						<?php
							foreach ($flavors as $flavor){
								$selected = '';
								if ($flavor->id  == $product->flavor_id)
									$selected = 'selected=selected';
									
								echo '<option value="'.$flavor->id. '" '.$selected. '>'.$flavor->name.'</option>';
							}
						?>
					 </select>
				</td>
			</tr>
			
			<tr class="fieldMCC_GNG" style="display:none">
				<td>
					Foil Color<br />
					(Only for Grab and Go)
				</td>
				<td>
					<select name="productFoilId" class="formSelect">
						<option value=""></option>
						<?php
							foreach ($foil_colors as $foil){
								$selected = '';
								if ($foil->id  == $product->foil_id)
									$selected = 'selected=selected';
									
								echo '<option value="'.$foil->id. '" '.$selected. '>'.$foil->name.'</option>';
							}
						?>
					 </select>
				</td>
			</tr>
			
			
			</table>
		 </div>  <!-- div id="tab_general" -->
			  
			 
		<div id="tab_meta_infromation" >
			  <div class="headline">Meta Information</div>
			  <table>
			  <colgroup>
					<col width="150" />
					<col  />
			  </colgroup>
			  <tr>
			  		<td><label for="metaTitle">Meta Title</label></td>
					<td><textarea id="metaTitle" class="name" name="metaTitle"><?php echo html::specialchars($product->products_description->meta_title, FALSE); ?></textarea></td>
			  </tr>
			  <tr>
					<td><label for="metaDescription">Description</label></td>
					<td><textarea id="metaDescription" class="name" name="metaDescription" ><?php echo $product->products_description->meta_description; ?></textarea></td>
			  </tr>
			   <tr>
					<td><label for="metaKeywords">Keywords</label></td>
					<td><textarea id="metaKeywords" class="name" name="metaKeywords" ><?php echo $product->products_description->meta_keywords; ?></textarea></td>
			  </tr>
			  <tr>
			  		<td><label for="metaUrl">URL</label></td>
					<td><input id="metaUrl" type="text" class="name" name="metaUrl" maxlength="255" value="<?php echo html::specialchars($product->products_description->title_url, FALSE); ?>" /></td>
			  </tr>
			  </table>
		 </div>   <!-- div id="tab_meta_infromation" -->
			 
			 
		 <div id="tab_image" >
			<div class="headline">Product Image</div>		  
			<table id="images" class="list">
			<colgroup>
					<col width="150" />
					<col  />
			</colgroup>
				<tr>
				  <td><?php if($product->products_description->image) { ?> 
							<img src="/env/product_images/<?php echo $product->products_description->image; ?>" width="300px" />
					  <?php } 
						else echo '&nbsp;';
						?>
				  </td>
				  <td>
					<input type="file" name="image" />
				 </td>
				</tr>	
				<tr>
					<td><label for="image_alt">Image alt value</label></td>
					<td><input type="text" id="image_alt" class="formText" name="image_alt" value="<?php echo $product->products_description->image_alt;  ?>" /></td>
			    </tr>
							
			</table>
		 </div>   <!-- div id="tab_image" -->
		 
		 <div id="tab_shipping" >
			  <div class="headline">Costs</div>
			<span style="font-size:12px;">
				IMPORTANT: 
				<ul style="margin:0px;">
					<li>The the last cost range must finish with '0'.</li>
				</ul>
			</span>
			  <strong>Unit:</strong><br />
                          <? if($product->kind=='MCH_GNG' OR $product->kind=='MCH'){?>
                            <label><input type="radio" name="productUnit" value="hearts" <?=$product->unit=='hearts'?'checked':''?> /> Hearts</label>
                          <? }else if($product->kind=='MCC_GNG' OR $product->kind=='MCC'){?>
                            <label><input type="radio" name="productUnit" value="coins" <?=$product->unit=='coins'?'checked':''?> /> Coins</label>
                          <? }else {?>
                            <label><input type="radio" name="productUnit" value="bars" <?=$product->unit=='bars'?'checked':''?> /> Bars</label>
                          <? }?>
              <? if($product->kind=='MCC_GNG' OR $product->kind=='MCC'):?>
			  <label><input type="radio" name="productUnit" value="bags" <?=$product->unit=='bags'?'checked':''?> /> Bags</label>
			  <? else :?>
  			<label><input type="radio" name="productUnit" value="boxes" <?=$product->unit=='boxes'?'checked':''?> /> Boxes</label>
			<label><input type="radio" name="productUnit" value="wrapper" <?=$product->unit=='wrapper'?'checked':''?> /> Wrapper</label>
			<? endif?>
			  <br />
			  <? if($product->kind =='MCC_GNG' OR $product->kind=='MCH'){ ?>
			  <strong>Coins per box (Only for unit:'coins'):</strong>
			   <input type="text" name="productCoinsPerBag" value="<?=$product->coins_per_bag?>" />
			   <?php  } else { ?>
			  <strong>Bars per box (Only for unit:'boxes'):</strong>
			   <input type="text" name="productBarsPerBox" value="<?=$product->bars_per_box?>" />
			   <?php } ?>
			  <br />
			  <table id="costs_table">
			  <colgroup>
					<col width="200" />
					<col  />
					<col  />
				</colgroup>
			  <tr>
				<th style="text-align:left;">Quantity</th>
				<th>Price</th>
			  </tr>
<?php		
			if (count($product_costs) > 0) {
				foreach($product_costs as $cost) {
?>
				  <tr>
					  <td>
						  From: <input type="text" name="cost_qty_start[]" class="formTextDimension" value="<?=$cost->qty_start?>"  
						  />To: <input type="text" name="cost_qty_end[]" class="formTextDimension" value="<?=$cost->qty_end?>"  />
					  </td>
					  <td>
						  $<input type="text" name="cost_price[]" class="formTextDimension" value="<?=$cost->price?>"  />
					  </td>
					  <td>
						  <a href="#" onclick="delete_price_range($(this)); return false;" style="font-size:11px;">Delete cost</a>
					  </td>
				  </tr>
<?
				}
			}
?>
			  </table>
				  <script type="text/javascript">
					  for(var i=0; i< <?=count($product_costs)>2?3:5?>; i++)
						  add_more_price_ranges();
				  </script>
			  <a href="#" onclick="add_more_price_ranges(); return false;" style="font-size:11px;">Add more price ranges</a>
		 </div>   <!-- div id="tab_shipping" -->
		 
		 
		 <div id="tab_custom_options" >
			  <div class="headline">Product Options</div>
				  <div style="width: 200px; float: left;">
					<select id="option" size="15" style="width: 100%;">
					<?php 
						$i = 0;
						$j = 0;
						$product->options = (array)$product->options ;
						foreach ($product->options as $key=>$value){
							echo '<option value="option'.$i.'">'. $key .'</option>';
								if (is_array($value)){
									foreach ($value as $op){
										echo '<option value="option'.$i.'_'.$j.'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.  $op   .'</option>';
										$j++;
									}
									$i++;
								}
						}
					?>		
					</select>
				  </div>
				  <div id="options">
					<div style="border-bottom: 1px solid #DDDDDD; text-align: right; padding-bottom: 10px; margin-bottom: 15px;">
						<a onclick="addOption();" class="button"><span>Add Option</span></a>
					</div>
					<?php
						$i = 0;
						$j = 0;

						foreach ($product->options as $key=>$value){
							$str = <<<DEMO
							<div id="option{$i}" class="option">
								<table class="form">
								<tr>
									<td>Option:</td>
									<td>																 
										<input name="product_option[{$i}][name]" value="{$key}" onkeyup="$('#option option[value=\'option{$i}\']').text(this.value);" type="text">&nbsp;<br/>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<a onclick="addOptionValue('{$i}');" class="button"><span>Add Option Value</span></a>
										<a onclick="removeOption('{$i}');" class="button"><span>Remove</span></a>
									</td>
								</tr>
								</table>
							</div>							
DEMO;
							echo $str;
							if (is_array($value)){
								foreach ($value as $op){						
										$str1 = <<<DEM
										<div id="option{$i}_{$j}" class="option">
											<table class="form">
												<tr>
													<td>Option Value:</td>
													<td>																	   	  
														<input name="product_option[{$i}][options][{$j}][name]" value="{$op}" onkeyup="$('#option option[value=\'option{$i}_{$j}\']').text('     ' + this.value);" type="text">&nbsp;<br/>
													</td>
												</tr>
												<tr>
													<td colspan="2">
														<a onclick="removeOptionValue('{$i}_{$j}');" class="button"><span>Remove</span></a>
													</td>
												</tr>
											</table>
										</div>
DEM;

									echo $str1;	
									$j++;
								}
							}
						$i++; 
						}
					?>
				</div>
			 <!-- </div>-->		  
		 </div>   <!-- div id="tab_custom_options" -->
		 
		 <div id="tab_attributes" >
			  <div class="headline">Product Attributes</div>
			  <!--<div style="width: 100%; display: inline-block; padding-bottom:5px;">-->
				  <div style="width: 200px; float: left;">

					<select id="attr" size="15" style="width: 100%;">
					<?php 
						$i = 0;
						$j = 0;
						$product->attributes = (array)$product->attributes ;
						foreach ($product->attributes as $key=>$value){
							echo '<option value="attr'.$i.'">'. $key .'</option>';
								if (is_array($value)){
									foreach ($value as $op){
										echo '<option value="attr'.$i.'_'.$j.'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $op  .'</option>';
										$j++;
									}
								}
								$i++;
						}
					?>							
					</select>	
				  </div>
				  
				  <div id="attributes" >
					<div style="border-bottom: 1px solid rgb(221, 221, 221); text-align: right; padding-bottom: 10px; margin-bottom: 15px;">
						<a onclick="addAttribute();" class="button"><span>Add Attribute</span></a>
					</div>
						
					<?php
						$i = 0;
						$j = 0;
						
						foreach ($product->attributes as $key=>$value){
						
							$str = <<<DEMO
								<div id="attr{$i}" class="option">
									<table class="form">
										<tr><td>Attribute:</td>
											<td>																 
												<input name="product_attr[{$i}][name]" value="{$key}" onkeyup="$('#attr option[value=\'attr{$i}\']').text(this.value);" type="text">&nbsp;<br/>
											</td>
										</tr>
										<tr><td colspan="2">
												<a onclick="addAttributeValue('{$i}');" class="button"><span>Add Attribute Value</span></a>
												<a onclick="removeAttribut('{$i}');" class="button"><span>Remove</span></a>
											</td>
										</tr>
									</table>
								</div>							
DEMO;
							echo $str;
							if (is_array($value)){		
								foreach ($value as $op){						
									$str1 = <<<DEMO1
									<div id="attr{$i}_{$j}" class="option">
										<table class="form">
											<tr>
												<td>Attribute Value:</td>
												<td>																	   	  
													<input name="product_attr[{$i}][attributes][{$j}][name]" value="{$op}" onkeyup="$('#attr option[value=\'attr{$i}_{$j}\']').text('     ' + this.value);" type="text">&nbsp;<br/>
												</td>
											</tr>
											<tr>
												<td colspan="2">
													<a onclick="removeAttributeValue('{$i}_{$j}');" class="button"><span>Remove</span></a>
												</td>
											</tr>
										</table>
									</div>
DEMO1;

									echo $str1;	
									$j++;
								}
							}	
							$i++; 
						}		
					?>				
			</div> 
		</div>   <!-- div id="tab_attributes" -->
<? /*		if ($product->id != 0 && $product->kind == 'MCC_CONF') { ?>
		<div id="xml_generator">
			<style>
				.xml_generator_shadow {
					position:absolute; 
					top:0; 
					left:0; 
					z-index: 999;
					width:100%;
					height: 1000px;
					background: #000;
					-webkit-opacity: 0.5;
					-moz-opacity: 0.5;
					opacity: 0.5;
					filter:alpha(opacity=50);
				}
				.xml_generator_container {
					position:absolute; 
					top:0; 
					left:0; 
					z-index: 1000;
					width:100%;
					height: 1000px;
				}
			</style>
			<div class="xml_generator_shadow"></div>
			<div class="xml_generator_container">
				<a href="#" onclick="$('#general_tab').trigger('click');" style="display:inline-block;color:#000;background:#fff; position: absolute; right: 10px; top: 10px; padding: 4px 10px;">CLOSE</a>
				<iframe src="/admin-console/products/xml_generator/<?=$product->id?>" style="border:none; width: 1000px; height: 700px; background: #fff; display: block; margin: 20px auto 0;" id="xml_generator_iframe"></iframe>
			</div>
		</div>
<?		}*/ ?>
		<div id="tab_options">
			<div class="headline">GnG Options</div>
			<a onclick="addGnGOption();" class="button" style="float:right; "><span>Add Option</span></a>
			<table id="optionTable">
			<tr>
				<th>Name</th>
				<th>Values</th>
				<th></th>
				<th></th>
			</tr>
			<tr>
				<td></td>
				<td style="font-size:11px; font-weight: normal; text-align: center;">
					Note: Separate the values with "#".
				</td>
				<td></td>
				<td></td>
			</tr>
<?			foreach ($product->gngoptions as $option) { ?>
			<tr>
				<td>
					<input type="hidden" name="options[id][]" value="<?=$option->id?>" />
					<input class="deleted" type="hidden" name="options[deleted][]" value="" />
					<input type="text" name="options[name][]" value="<?=$option->name?>" style="width: 145px;" />
				</td>
				<td>
					<input type="text" name="options[values][]" value="<?=$option->values?>" style="width: 370px" />
				</td>
				<td style="font-size:12px">
					<select name="options[mandatory][]">
						<option value="0">Optional</option>
						<option value="1" <?=$option->mandatory == 1 ?'selected':''?>>Mandatory</option>
					</select>
				</td>
				<td>
					<a onclick="removeGnGOption($(this));" class="button"><span>Remove</span></a>
				</td>
			</tr>
<?			} ?>
			</table>
		</div>
	
	</div>    	<!-- div id="contentRight" -->
</div>  <!-- div id='mainContent' -->
</form>
<script type="text/javascript"><!--
$.tabs('#tabs a', '<?php echo isset($_GET['selected_tab']) ? '#'.$_GET['selected_tab'] : '#tab_general'?>'); 
//--></script>

 
<script type="text/javascript"><!--							 
var option_row = <?php echo $i?>;

function addOption() {	
	html  = '<div id="option' + option_row + '" class="option">';
	html += '<table class="form">';
	html += '<tr>';
	html += '<td>Option:</td>';
	html += '<td>';
	html += '<input type="text" name="product_option[' + option_row + '][name]" value="Option ' + option_row + '" onkeyup="$(\'#option option[value=\\\'option' + option_row + '\\\']\').text(this.value);" />&nbsp;<br />';
	html += '</td>';
	html += '</tr>';
	html += '<tr>';
	html += '<td colspan="2"><a onclick="addOptionValue(\'' + option_row + '\');" class="button"><span>Add Option Value</span></a> <a onclick="removeOption(\'' + option_row + '\');" class="button"><span>Remove</span></a></td>';
	html += '</tr>';
	html += '</table>';
	html += '</div>';
		 
	$('#options').append(html);
	
	$('#option').append('<option value="option' + option_row + '">Option ' + option_row + '</option>');
	$('#option option[value=\'option' + option_row + '\']').attr('selected', 'selected');
	$('#option').trigger('change');

	option_row++;
}

function removeOption(option_row) {
	$('#option option[value=\'option' + option_row + '\']').remove();
	$('#option option[value^=\'option' + option_row + '_\']').remove();
	$('#options div[id=\'option' + option_row + '\']').remove();
	$('#options div[id^=\'option' + option_row + '_\']').remove();
}

var option_value_row = <?php echo $j?>;

function addOptionValue(option_id) {
	html  = '<div id="option' + option_id + '_' + option_value_row + '" class="option">';
	html += '<table class="form">';
	html += '<tr>';
	html += '<td>Option Value:</td>';
	html += '<td>';
	html += '<input type="text" name="product_option[' + option_id + '][options][' + option_value_row + '][name]" value="Option Value ' + option_value_row + '" onkeyup="$(\'#option option[value=\\\'option' + option_id + '_' + option_value_row + '\\\']\').text(\'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\' + this.value);" />&nbsp;<br />';
	html += '</td>';
	html += '</tr>';
	html += '<tr>';		
	html += '<td colspan="2"><a onclick="removeOptionValue(\'' + option_id + '_' + option_value_row + '\');" class="button"><span>Remove</span></a></td>';
	html += '</tr>';
	html += '</table>';
	html += '</div>';
	
	$('#options').append(html);
	
	option = $('#option option[value^=\'option' + option_id + '_\']:last');
	
	if (option.size()) {
		option.after('<option value="option' + option_id + '_' + option_value_row + '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Option Value ' + option_value_row + '</option>');
	} else {
		$('#option option[value=\'option' + option_id + '\']').after('<option value="option' + option_id + '_' + option_value_row + '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Option Value ' + option_value_row + '</option>');
	}
	
	$('#option option[value=\'option' + option_id + '_' + option_value_row + '\']').attr('selected', 'selected');
	
	$('#option').trigger('change');
	
	option_value_row++;
}

function removeOptionValue(option_value_row) {
	$('#option option[value=\'option' + option_value_row + '\']').remove();
	$('#option' + option_value_row).remove();
}
//--></script>

<script type="text/javascript"><!--							 
var attr_row = <?php echo $i?>;

function addAttribute() {	
	html  = '<div id="attr' + attr_row + '" class="option">';
	html += '<table class="form">';
	html += '<tr>';
	html += '<td>Attribute:</td>';
	html += '<td>';
	html += '<input type="text" name="product_attr[' + attr_row + '][name]" value="Attribute ' + attr_row + '" onkeyup="$(\'#attr option[value=\\\'attr' + attr_row + '\\\']\').text(this.value);" />&nbsp;<br />';
	html += '</td>';
	html += '</tr>';
	html += '<tr>';
	html += '<td colspan="2"><a onclick="addAttributeValue(\'' + attr_row + '\');" class="button"><span>Add Attribute Value</span></a> <a onclick="removeAttribut(\'' + attr_row + '\');" class="button"><span>Remove</span></a></td>';
	html += '</tr>';
	html += '</table>';
	html += '</div>';
		 
	$('#attributes').append(html);
	
	$('#attr').append('<option value="attr' + attr_row + '">Attribute ' + attr_row + '</option>');
	$('#attr option[value=\'attr' + attr_row + '\']').attr('selected', 'selected');
	$('#attr').trigger('change');

	attr_row++;
}

function removeAttribut(attr_row) {
	$('#attr option[value=\'attr' + attr_row + '\']').remove();
	$('#attr option[value^=\'attr' + attr_row + '_\']').remove();
	$('#attributes div[id=\'attr' + attr_row + '\']').remove();
	$('#attributes div[id^=\'attr' + attr_row + '_\']').remove();
}

var attr_value_row = <?php echo $j?>;

function addAttributeValue(attr_id) {
	html  = '<div id="attr' + attr_id + '_' + attr_value_row + '" class="option">';
	html += '<table class="form">';
	html += '<tr>';
	html += '<td>Attribute Value:</td>';
	html += '<td>';
	html += '<input type="text" name="product_attr[' + attr_id + '][attributes][' + attr_value_row + '][name]" value="Attribute Value ' + attr_value_row + '" onkeyup="$(\'#attr option[value=\\\'attr' + attr_id + '_' + attr_value_row + '\\\']\').text(\'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\' + this.value);" />&nbsp;<br />';
	html += '</td>';
	html += '</tr>';
	html += '<tr>';		
	html += '<td colspan="2"><a onclick="removeAttributeValue(\'' + attr_id + '_' + attr_value_row + '\');" class="button"><span>Remove</span></a></td>';
	html += '</tr>';
	html += '</table>';
	html += '</div>';
	
	$('#attributes').append(html);
	
	attr = $('#attr option[value^=\'attr' + attr_id + '_\']:last');
	
	if (attr.size()) {
		attr.after('<option value="attr' + attr_id + '_' + attr_value_row + '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Attribute Value ' + attr_value_row + '</option>');
	} else {
		$('#attr option[value=\'attr' + attr_id + '\']').after('<option value="attr' + attr_id + '_' + attr_value_row + '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Attribute Value ' + attr_value_row + '</option>');
	}
	
	$('#attr option[value=\'attr' + attr_id + '_' + attr_value_row + '\']').attr('selected', 'selected');
	
	$('#attr').trigger('change');
	
	attr_value_row++;
}

function removeAttributeValue(attr_value_row) {
	$('#attr option[value=\'attr' + attr_value_row + '\']').remove();
	$('#attr' + attr_value_row).remove();
}

function showFieldsForKind(kind)
{
	//hide all fields
	$('.fieldMCC_GNG, .fieldMCC_CONF, .fieldMCH').hide();
	
	//grab and go
	if (kind == 'MCC_GNG' || kind == 'MCH_GNG')
		$('.fieldMCC_GNG').show();
	
	//mch configurator
	if (kind == 'MCC_CONF')
		$('.fieldMCC_CONF').show();
		
	//mcc configurator
	if (kind == 'MCH')
		$('.fieldMCH').show();
}

<?if(isset($product)) {?>
showFieldsForKind('<?=$product->kind?>');
<?}?>

function addGnGOption() {
	$('#optionTable').append($('<tr><td><input type="hidden" name="options[id][]" value="" /><input class="deleted" type="hidden" name="options[deleted][]" value="" /><input type="text" name="options[name][]" style="width: 145px;" /></td><td><input type="text" name="options[values][]" style="width: 370px" /></td><td style="font-size:12px"><select name="options[mandatory][]"><option value="0">Optional</option><option value="1">Mandatory</option></select></td><td><a onclick="removeGnGOption($(this));" class="button"><span>Remove</span></a></td></tr>'));
}
function removeGnGOption(link) {
	var table = $(link).parent().parent().parent();
	$(link).parent().parent().hide();
	$(link).parent().parent().find('.deleted').val('1');
}
addGnGOption();
addGnGOption();
addGnGOption();

//--></script>

