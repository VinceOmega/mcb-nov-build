<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<?php echo html::script(array (url::base().'media/js/fckeditor/fckeditor.js'), FALSE); ?>
<script type="text/javascript">

window.onload = function()
{
	// Automatically calculates the editor base path based on the _samples directory.
	// This is usefull only for these samples. A real application should use something like this:
	// oFCKeditor.BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.
	var sBasePath = '<?php echo url::base() ?>/media/js/fckeditor/';

	var oFCKeditor = new FCKeditor( 'occasionDescription' ) ;
	oFCKeditor.Width = '100%' ;
	oFCKeditor.Height = '512' ; 
	oFCKeditor.BasePath	= sBasePath ;
	oFCKeditor.ReplaceTextarea() ;	
	
	var oFCKeditor = new FCKeditor( 'occasionShortDescription' ) ;
	oFCKeditor.Width = '100%' ;
	oFCKeditor.Height = '300' ; 
	oFCKeditor.BasePath	= sBasePath ;
	oFCKeditor.ReplaceTextarea() ;	
	
}
</script>

<?php 
$id = $this->uri->segment(3);
$argumentarray = Router::$arguments;
$occasions = new Occasion_Model;

if (isset($argumentarray[0])) {
$id = $argumentarray[0];
//$occasion = $occasions->getOccasionByID($id);
$occasion = $occasions->find($id);
} else {
$id = $occasions->getNextID();
//$occasion = ORM::factory('occasion');
$occasion = $occasions;

//$descs = new Occasions_description_Model;

//$occasion->occasions_description = $descs;
}
//var_dump($occasion);
//$desc = ORM::factory('occasions_description')->find($occasion->occasions_description_id);


//$occasions_description = ORM::factory('occasions_description')->find($occasion->occasions_description_id);

$i=0;
$j=0;

?>		


<form action="<?php echo url::base() . $this->uri->segment(1). '/' . $this->uri->segment(2) . '/' .$id; ?>" method="POST" enctype="multipart/form-data" id="form" >
<div id="mainContent" >




	<div class="box">
		  <div class="left"></div>
		  <div class="right"></div>
		  <div class="heading">
		    <h2 id="heading">Occasions</h2>
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
			<a tab="#tab_meta_infromation">Meta Information</a>
			<a tab="#tab_image">Image</a>
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
				<td><label for="occasionName">Occasion Name</label></td>
				<td><input type="text" name="occasionName" id="occasionName" class="name" maxlength="255" value="<?php echo $occasion->name; ?>" /></td>
			</tr>
			<tr>
				<td><label for="occasionDescription">Description</label></td>
				<td><textarea name="occasionDescription" id="occasionDescription" class="formText"><?php echo $occasion->description; ?></textarea></td>
			</tr>	
			<tr>
				<td><label for="occasionShortDescription">Short Description</label></td>
				<td><textarea name="occasionShortDescription" id="productShortDescription" class="formText" cols="80" rows="25"><?php echo $occasion->occasions_description->short_description; ?></textarea></td>
			</tr>	
			<tr>
				<td><label for="occasionHeadline">Headline</label></td>
				<td><input type="text" name="occasionHeadline" id="occasionHeadline" class="formText" value="<?php echo $occasion->headline; ?>"  /></td>
			</tr>
			
			<tr>
				<td>Sites</td>
				<td>
				<?php		
					$siteModel = new Site_Model(1);
					echo $siteModel->get_descendants_chk($occasion->sites,'occasionSites');
				?>
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
					<td><textarea id="metaTitle" class="name" name="metaTitle"><?php echo html::specialchars($occasion->occasions_description->meta_title, FALSE); ?></textarea></td>
			  </tr>
			  <tr>
					<td><label for="metaDescription">Description</label></td>
					<td><textarea id="metaDescription" class="name" name="metaDescription" ><?php echo $occasion->occasions_description->meta_description; ?></textarea></td>
			  </tr>
			   <tr>
					<td><label for="metaKeywords">Keywords</label></td>
					<td><textarea id="metaKeywords" class="name" name="metaKeywords" ><?php echo $occasion->occasions_description->meta_keywords; ?></textarea></td>
			  </tr>
			  <tr>
			  		<td><label for="metaUrl">URL</label></td>
					<td><input id="metaUrl" type="text" class="name" name="metaUrl" maxlength="255" value="<?php echo html::specialchars($occasion->occasions_description->title_url, FALSE); ?>" /></td>
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
				  <td><?php if($occasion->occasions_description->image) { ?> 
							<img src="/env/product_images/<?php echo $occasion->occasions_description->image; ?>" />
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
					<td><input type="text" id="image_alt" class="formText" name="image_alt" value="<?php echo $occasion->occasions_description->image_alt;  ?>" /></td>
			    </tr>
							
			</table>
		 </div>   <!-- div id="tab_image" -->
		
		 
	</div>    	<!-- div id="contentRight" -->
</div>  <!-- div id='mainContent' -->
</form>
<script type="text/javascript"><!--
$.tabs('#tabs a', '<?php echo isset($_POST['selected_tab']) ? $_POST['selected_tab'] : '#tab_general'?>'); 
//--></script>

        
