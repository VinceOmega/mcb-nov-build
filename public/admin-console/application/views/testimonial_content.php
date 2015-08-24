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
$argumentarray = Router::$arguments;
$testimonial = new Testimonial_Model;

if (isset($argumentarray[0])) {
$id = $argumentarray[0];
$testimonial = $testimonial->find($id);
} else {
$id = $testimonial->getNextID();
$testimonial = ORM::factory('testimonial');
}

$i=0;
$j=0;

?>		


<form action="<?php echo url::base() . $this->uri->segment(1). '/' . $this->uri->segment(2) . '/' .$id; ?>" method="POST" enctype="multipart/form-data" id="form" >
<div id="mainContent" >




	<div class="box">
		  <div class="left"></div>
		  <div class="right"></div>
		  <div class="heading">
		    <h2 id="heading">Testimonials</h2>
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
				<td><label for="testimonialName">Name</label></td>
				<td><input type="text" name="testimonialName" id="testimonialName" class="name" maxlength="255" value="<?php echo $testimonial->name; ?>" /></td>
			</tr>
			<tr>
				<td><label for="testimonialLocation">Location</label></td>
				<td><input type="text" name="testimonialLocation" id="testimonialLocation" class="name" maxlength="255" value="<?php echo $testimonial->location; ?>" /></td>
			</tr>
			<tr>
				<td><label for="testimonialHeadline">Headline</label></td>
				<td><input type="text" name="testimonialHeadline" id="testimonialHeadline" class="formText" value="<?php echo $testimonial->headline; ?>"  /></td>
			</tr>
			<tr>
				<td><label for="testimonialDescription">Description</label></td>
				<td><textarea name="testimonialDescription" id="testimonialDescription" class="formText"><?php echo $testimonial->description; ?></textarea></td>
			</tr>	
			
			<tr>
				<td>Sites</td>
				<td>
				<?php		
					$siteModel = new Site_Model(1);
					echo $siteModel->get_descendants_chk($testimonial->sites,'testimonialSites');
				?>
				</td>
			</tr>

			</table>
		 </div>  <!-- div id="tab_general" -->
		 
		 
		 
	</div>    	<!-- div id="contentRight" -->
</div>  <!-- div id='mainContent' -->
</form>
<script type="text/javascript"><!--
$.tabs('#tabs a', '<?php echo isset($_POST['selected_tab']) ? $_POST['selected_tab'] : '#tab_general'?>'); 
//--></script>

