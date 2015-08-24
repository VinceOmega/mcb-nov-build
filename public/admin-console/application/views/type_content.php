<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<?php echo html::script(array (url::base().'media/js/fckeditor/fckeditor.js'), FALSE); ?>
<script type="text/javascript">
window.onload = function()
{
	// Automatically calculates the editor base path based on the _samples directory.
	// This is usefull only for these samples. A real application should use something like this:
	// oFCKeditor.BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.
	var sBasePath = '<?php echo url::base() ?>/media/js/fckeditor/';

	var oFCKeditor = new FCKeditor( 'typeDescription' ) ;
	oFCKeditor.Width = '100%' ;
	oFCKeditor.Height = '400' ; 
	oFCKeditor.BasePath	= sBasePath ;
	oFCKeditor.ReplaceTextarea() ;	
	
	
	var oFCKeditor = new FCKeditor( 'typeShortDescription' ) ;
	oFCKeditor.Width = '100%' ;
	oFCKeditor.Height = '300' ; 
	oFCKeditor.BasePath	= sBasePath ;
	oFCKeditor.ReplaceTextarea() ;	

}
</script>

<?php 
$id = $this->uri->segment(3);

$p_type = ORM::factory('products_type')->where('id', $id)->find();
$categories = Category::getAll();
$products = Category::getProductsByCategory($id);

?>		

<form action="<?php echo url::base() . $this->uri->segment(1). '/' . $this->uri->segment(2) . '/' .$id ?>" method="POST" enctype="multipart/form-data" id="form" >

<div id="mainContent" >
	<div class="box">
		  <div class="left"></div>
		  <div class="right"></div>
		  <div class="heading"><h2 id="heading">Product type</h2>
			  <span id="buttons">
				<input type="submit" name="save" value="Save" class="css-button">
				<input type="button" onclick="location = '<?php  echo url::base() . $this->uri->segment(1) ?>'" value='Cancel' class="css-button"  />
			  </span>
		  </div>
	</div>
	
	<div id="contentLeft">
		<div id="tabs" class="htabs" >
			<a tab="#tab_general">General</a>
			<a tab="#tab_meta_infromation">Meta Information</a>
			<!--<a tab="#tab_category_products">Category Products</a>-->
		</div>
 	</div>
		
	<div id="contentRight">
		<div id="tab_general">
			<div class="headline">General Information</div>
			<table>
			<colgroup>
				<col width="150" />
				<col width="500" />
			</colgroup>
			<tr>
				<td><label for="typeName">Name</label></td>
				<td><input type="text" name="typeName" id="typeName" class="formText" value="<?php echo html::specialchars($p_type->name); ?>" /></td>
			</tr>
			<tr>
				<td><label for="typeDescription">Description</label></td>
				<td><textarea name="typeDescription" id="typeDescription" class="formText"><?php echo $p_type->products_types_description->description ?></textarea></td>
			</tr>	
			
			<tr>
				<td><label for="typeShortDescription">Short Description</label></td>
				<td><textarea name="typeShortDescription" id="typeShortDescription" class="formText"><?php echo $p_type->products_types_description->short_description ?></textarea></td>
			</tr>	
			
			<tr>
				<td><label for="category">Category</label></td>
				<td>
					<select name="category" id="category" class="formSelect">
						<option value='0'></option>
						<?php 
						foreach ($categories as $key=>$value){
							$sel = '';
							
							if ($key == $p_type->category_id)
								$sel = 'selected=selected';					
				
							echo '<option value="'.$key.'" '.$sel .'>'.$value.'</option>';
						} 
						?>
					</select>
				</td>
			</tr>

					
			
			<tr>
				<td><label for="image">Image</label></td>
				<td><input type="file" name="image" id="image" class="formText" /></td>
			</tr>
			
			<tr>
				<td><label for="image_alt">Image alt value</label></td>
				<td><input type="text" id="image_alt" class="formText" name="image_alt" value="<?php echo $p_type->products_types_description->image_alt;  ?>" /></td>
			</tr>	
						
			<tr>
				<td></td>
				 <td><?php if( $p_type->products_types_description->image) { ?> 
							<img src="/env/product_type_images/<?php echo  $p_type->products_types_description->image; ?>" />
					  <?php } 
						else echo '&nbsp;';
						?>
						
				  </td>
			
			</tr>	

			<tr>
				<td><label for="video">Video file name:</label></td>
				<td><input type="text" id="video" class="formText" name="video" value="<?php echo $p_type->products_types_description->video;  ?>" /></td>
			</tr>				
			
			<tr>
				<td>Sites</td>
				<td>
				<?php		
					$siteModel = new Site_Model(1);
					echo $siteModel->get_descendants_chk($p_type->sites,'productTypeSites');
				?>
				</td>
			</tr>
			
		
			</table>
		</div>  <!-- div id="tab_general" -->  
			 
		<div id="tab_meta_infromation">
			<div class="headline">Meta Information</div>
			<table>
			<colgroup>
				<col width="150" />
				<col  />
			</colgroup>
			<tr>
				<td><label for="metaTitle">Meta Title</label></td>
				<td><input id="metaTitle" type="text" class="formText" name="metaTitle" value="<?php echo html::specialchars($p_type->products_types_description->meta_title) ?>" /></td>
			</tr>
			<tr>
				<td><label for="metaDescription">Description</label></td>
				<td><textarea id="metaDescription" class="formText" name="metaDescription"><?php echo $p_type->products_types_description->meta_description ?></textarea></td>
			</tr>
			<tr>
				<td><label for="metaKeywords">Keywords</label></td>
				<td><textarea id="metaKeywords" class="formText" name="metaKeywords"><?php echo $p_type->products_types_description->meta_keywords?></textarea></td>
			</tr>
			<tr>
				<td><label for="metaUrl">URL</label></td>
				<td><input id="metaUrl" type="text" class="formText" name="metaUrl" value="<?php echo html::specialchars($p_type->products_types_description->title_url) ?>" /></td>
			</tr>
			</table>
		 </div>   <!-- div id="tab_meta_infromation" -->
<!--			 
		 <div id="tab_category_products">
			<div class="headline">Category Products</div>
			<table class="list">
				<col  width="35" />
				<col  width="20" />
				<col  width="20"/>
				<col  width="20" />
          	    <col  width="100" />
			<tr>
				<th><input type="checkbox" id="" onClick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></th>
				<th>ID</th>
				<th>Product Name</th>
				<th>Price</th>
				<th>Product Description</th>
			</tr>
			<?php	
				foreach($products as $pr){
				$product = Product::getProductByID($pr->id);
				echo 	'<tr>
							<td class="centered"><input type="checkbox" id="" name="selected[]" /></td>
							<td align="right">'. $product->id .'</td>
							<td>'. $product->name.'</td>
							<td align="right">'. '$'. number_format($product->price, 2).'</td>
							<td>'. $product->products_description->description.'</td>
						</tr>';
				}
			?>
			
			
			</table>		
		 </div>  -->
		 
		 
	</div>    
</div>  

</form>

<script type="text/javascript"><!--
$.tabs('#tabs a', '<?php echo isset($_POST['selected_tab']) ? $_POST['selected_tab'] : '#tab_general'?>'); 
//--></script>

