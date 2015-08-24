<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<?php echo html::script(array (url::base().'media/js/fckeditor/fckeditor.js'), FALSE); ?>
<script type="text/javascript">
window.onload = function()
{
	// Automatically calculates the editor base path based on the _samples directory.
	// This is usefull only for these samples. A real application should use something like this:
	// oFCKeditor.BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.
	var sBasePath = '<?php echo url::base() ?>/media/js/fckeditor/';

	
}
</script>

<?php 
//$id = $this->uri->segment(3);
$argumentarray = Router::$arguments;
$products = new Product_Model;
$production_times = new Production_Time_Model;
$product_colors = new Product_Color_Model;
$product_flavors = new Product_Flavor_Model;
$product_costs = new Product_Cost_Model;

if (isset($argumentarray[0])) {
$id = $argumentarray[0];
$product = $products->getProductByID($id);
} else {
$id = $products->getNextID();
$product = ORM::factory('product');
}

$i=0;
$j=0;

$times = $production_times->getProductionTimes();
$productcolors = $product_colors->getColorsForProduct($id);
$productflavors = $product_flavors->getFlavorsForProduct($id);
$costs = $product_costs->getCostsForProduct($id);
?>		


<form action="<?php echo url::base() . $this->uri->segment(1). '/' . $this->uri->segment(2) . '/' .$id; ?>" method="POST" enctype="multipart/form-data" id="form" >
<div id="mainContent" >




	<div class="box">
		  <div class="left"></div>
		  <div class="right"></div>
		  <div class="heading">
		    <h2 id="heading">Products</h2>
		    <span id="buttons">
				<input type="submit" value="Save" name="save" class="css-button" />
				<!--<a onclick="location = '<?php  echo url::base() . $this->uri->segment(1); ?>'" class="button"><span>Cancel</span></a>-->
				<input type="button" onclick="location = '<?php  echo url::base() . $this->uri->segment(1); ?>'" value='Cancel' class="css-button"  />
			</span>
		  </div>
	</div>
	
	
	
	<div id="contentLeft">
		<div id="tabs" class="htabs" >
			<a tab="#tab_general"><input type="hidden" name="tab_general" >General</a>
			<a tab="#tab_costs">Costs</a>
			<a tab="#tab_flavors">Flavors</a>
			<a tab="#tab_foils">Foils</a>
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
				<td><input type="text" name="productName" id="productName" class="name" maxlength="255" value="<?php echo $product->name; ?>" /></td>
			</tr>
			<tr>
				<td><label for="productDescription">Description</label></td>
				<td><textarea name="productDescription" id="productDescription" class="formText"><?php echo $product->description; ?></textarea></td>
			</tr>	
			<tr>
				<td><label for="productSize">Size</label></td>
				<td><input type="text" name="productSize" id="productSize" class="formText" value="<?php echo $product->size; ?>"  /></td>
			</tr>
				<tr>
				<td><label for="productProductionTime">ProductionTime</label></td>
				<td><select name="productProductionTime" id="productProductionTime" class="formSelect">
					<option value="0"></option>
					<?php			
						
						foreach($times as $time){
							if ($time->id == $product->production_time)
								$sel = 'selected=selected';
							else
								$sel ='';
							echo '<option value="'.$time->id. '" '.$sel.' >'.$time->days_start.' - '.$time->days_end.' business days</option>';
						}
					?>
					 </select>
				</td>
			</tr>
			<tr>
				<td><label for="productSize">Image</label></td>
				
				<td><input type="file" name="productImage" id="productImage" value="<?php echo $product->image; ?>"></td>
			</tr>
			</table>
		 </div>  <!-- div id="tab_general" -->
		 
		 
		 <div id="tab_costs" >
			  <div class="headline">Costs</div>
			  <table>
			  <colgroup>
					<col width="150" />
					<col width="150" />
					<col  />
			  </colgroup>
			  <tr>
			  		<td><label for="metaTitle">Quantity Start</label></td>
					<td><label for="metaTitle">Quantity End</label></td>
					<td><label for="metaTitle">Price</label></td>
			  </tr>
				<?php
				
			  	foreach($costs as $cost){
				echo '<tr>';
					echo '<td><label for="costQtyStart">'.$cost->qty_start.'</label></td>';
					echo '<td><label for="costQtyEnd">'.$cost->qty_end.'</label></td>';
					echo '<td><label for="costPrice">'.$cost->price.'</label></td>';
				echo '</tr>';
				}?>
			
			  
			  </table>
		 </div>   <!-- div id="tab_costs" -->
		 
		  <div id="tab_foils" >
			  <div class="headline">Foils</div>
			  <table>
			  <colgroup>
					<col width="150" />
					<col  />
			  </colgroup>
			  <tr>
			  		<td><label for="metaTitle">Name</label></td>
					<td><label for="metaTitle">Color</label></td>
			  </tr>
				<?php
				
			  	foreach($productcolors as $productcolorid){
					
				
					$cid = $productcolorid->colorID;
					$colorsmodel = new Foil_Color_Model;
					$color = $colorsmodel->getFoilByID($cid);
					//foreach($colors as $color){
						echo '<tr>';
							echo '<td><label for="flavorName">'.$color->name.'</label></td>';
							echo '<td><label for="flavorColor">'.$color->hexcode.'</label></td>';
						echo '</tr>';
					//}
				}?>
			
			  
			  </table>
		 </div>   <!-- div id="tab_costs" -->
		 
		  <div id="tab_flavors" >
			  <div class="headline">Flavors</div>
			  <table>
			  <colgroup>
					<col width="150" />
					<col  />
			  </colgroup>
			  <tr>
			  		<td><label for="metaTitle">Name</label></td>
					<td><label for="metaTitle">Description</label></td>
			  </tr>
			<?php
				
			  	foreach($productflavors as $productflavorid){
					
				
					$fid = $productflavorid->flavorID;
					$flavorsmodel = new Flavor_Model;
					$flavor = $flavorsmodel->getFlavorByID($fid);
					//foreach($flavors as $flavor){
						echo '<tr>';
							echo '<td><label for="flavorName">'.$flavor->name.'</label></td>';
							echo '<td><label for="flavorDesc">'.$flavor->description.'</label></td>';
						echo '</tr>';
					//}
				}?>
			
			
			  
			  </table>
		 </div>   <!-- div id="tab_costs" -->
		 
		 
	</div>    	<!-- div id="contentRight" -->
</div>  <!-- div id='mainContent' -->
</form>
<script type="text/javascript"><!--
$.tabs('#tabs a', '<?php echo isset($_POST['selected_tab']) ? $_POST['selected_tab'] : '#tab_general'?>'); 
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
//--></script>