<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>


<?php echo html::script(array (url::base().'media/js/fckeditor/fckeditor.js'), FALSE); ?>
<script type="text/javascript">
window.onload = function()
{
	// Automatically calculates the editor base path based on the _samples directory.
	// This is usefull only for these samples. A real application should use something like this:
	// oFCKeditor.BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.
	var sBasePath = '<?php echo url::base() ?>/media/js/fckeditor/';

	var oFCKeditor = new FCKeditor( 'categoryDescription' ) ;
	oFCKeditor.Width = '100%' ;
	oFCKeditor.Height = '512' ; 
	oFCKeditor.BasePath	= sBasePath ;
	oFCKeditor.ReplaceTextarea() ;	
	
	var oFCKeditor = new FCKeditor( 'categoryShortDescription' ) ;
	oFCKeditor.Width = '100%' ;
	oFCKeditor.Height = '300' ; 
	oFCKeditor.BasePath	= sBasePath ;
	oFCKeditor.ReplaceTextarea() ;	
	
}
</script>

<?php 
$id = $this->uri->segment(3);
$category = Category::getCategoryById($id);
$categories = ORM::factory('category')->find_all();
$products = Category::getProductsByCategory($id);
?>		

<form action="<?php echo url::base() . $this->uri->segment(1). '/' . $this->uri->segment(2) . '/' .$id ?>" method="POST" enctype="multipart/form-data" id="form" >

<div id="mainContent" >
	<div class="box">
		  <div class="left"></div>
		  <div class="right"></div>
		  <div class="heading"><h2 id="heading">Category</h2>
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
				<td><label for="categoryName">Name</label></td>
				<td><input type="text" name="categoryName" id="categoryName" class="formText" value="<?php echo html::specialchars($category->name); ?>" /></td>
			</tr>
			<tr>
				<td><label for="categoryDescription">Description</label></td>
				<td><textarea name="categoryDescription" id="categoryDescription" class="formText"><?php echo $category->categories_description->description ?></textarea></td>
			</tr>					
			<tr>
				<td><label for="categoryShortDescription">Short Description</label></td>
				<td><textarea name="categoryShortDescription" id="categoryShortDescription" class="formText"><?php echo $category->categories_description->short_description ?></textarea></td>
			</tr>			
			
			<tr>
				<td><label for="categoryParent">Parent category</label></td>
				<td>
					<select name="categoryParent" id="categoryParent" class="formSelect">
						<option value='0'></option>
						<?php 
						foreach ($categories as $_category){
							$sel = '';
							$disable = '';
							
							if ($_category->id == $category->parent_id)
								$sel = 'selected=selected';
							
							if ($_category->id == $category->id)	
								$disable = 'disabled';							
				
							echo '<option value="'.$_category->id.'" '.$sel. $disable .'>'.$_category->name.'</option>';
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
				<td><input type="text" id="image_alt" class="formText" name="image_alt" value="<?php echo $category->categories_description->image_alt;  ?>" /></td>
			</tr>	
			
			<tr>
				<td><label for="categoryName">Order</label></td>
				<td><input type="text" name="categoryOrder" id="categoryOrder" class="formText" value="<?php echo html::specialchars($category->order); ?>" /></td>
			</tr>
			<tr>
				  <td><?php if( $category->categories_description->image) { ?> 
							<img src="/env/category_images/<?php echo  $category->categories_description->image; ?>" />
					  <?php } 
						else echo '&nbsp;';
						?>
						
				  </td>
				  <td></td>
			</tr>		
			
			<tr>
				<td>Sites</td>
				<td>
				<?php		
					$siteModel = new Site_Model(1);
					echo $siteModel->get_descendants_chk($category->sites,'categorySites');
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
				<td><input id="metaTitle" type="text" class="formText" name="metaTitle" value="<?php echo html::specialchars($category->categories_description->meta_title, FALSE) ?>" /></td>
			</tr>
			<tr>
				<td><label for="metaDescription">Description</label></td>
				<td><textarea id="metaDescription" class="formText" name="metaDescription"><?php echo $category->categories_description->meta_description ?></textarea></td>
			</tr>
			<tr>
				<td><label for="metaKeywords">Keywords</label></td>
				<td><textarea id="metaKeywords" class="formText" name="metaKeywords"><?php echo $category->categories_description->meta_keywords?></textarea></td>
			</tr>
			<tr>
				<td><label for="metaUrl">URL</label></td>
				<td><input id="metaUrl" type="text" class="formText" name="metaUrl" value="<?php echo html::specialchars($category->categories_description->title_url, FALSE) ?>" /></td>
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
