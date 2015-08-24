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
$flavors = new Flavor_Model;

if (isset($argumentarray[0])) {
$id = $argumentarray[0];
$flavor = $flavors->getFlavorByID($id);
} else {
//
$id = $flavors->getNextID();
$flavor = ORM::factory('flavor');
}

$i=0;
$j=0;

?>		


<form action="<?php if(isset($id)) echo url::base() . $this->uri->segment(1). '/' . $this->uri->segment(2) . '/' .$id; else echo url::base() . $this->uri->segment(1). '/' . $this->uri->segment(2) . '/'; ?>" method="POST" enctype="multipart/form-data" id="form" >
<div id="mainContent" >




	<div class="box">
		  <div class="left"></div>
		  <div class="right"></div>
		  <div class="heading">
		    <h2 id="heading">Flavors</h2>
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
				<td><label for="flavorName">Flavor Name</label></td>
				<td><input type="text" name="flavorName" id="flavorName" class="name" maxlength="255" value="<?php echo $flavor->name; ?>" /></td>
			</tr>
			<tr>
				<td><label for="flavorDescription">Description</label></td>
				<td><textarea name="flavorDescription" id="flavorDescription" class="formText"><?php echo $flavor->description; ?></textarea></td>
			</tr>	

			</table>
		 </div>  <!-- div id="tab_general" -->
		 
		 
		 
	</div>    	<!-- div id="contentRight" -->
</div>  <!-- div id='mainContent' -->
</form>
<script type="text/javascript"><!--
$.tabs('#tabs a', '<?php echo isset($_POST['selected_tab']) ? $_POST['selected_tab'] : '#tab_general'?>'); 
//--></script>

