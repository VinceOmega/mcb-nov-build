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
$basket = new Orders_Basket_Model;

if (isset($argumentarray[0])) {
$id = $argumentarray[0];
$basket = $basket->getBasketByID($id);
} else {
$id = $basket->getNextID();
$basket = ORM::factory('orders_basket');
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
		    <h2 id="heading">Customer Designs</h2>
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
				<td><label for="msg_text1">Message Text</label></td>
				<td><input type="text" name="msg_text1" id="msg_text1" class="name" maxlength="255" value="<?php echo $basket->msg_text1; ?>" /></td>
			</tr>
			<tr>
				<td><label for="designpath">Design Path</label></td>
				<td><input type="text" name="designpath" id="designpath" class="name" maxlength="255" value="<?php echo $basket->designpath; ?>" /><br><br>
				<img src="<?php echo $basket->designpath; ?>" /></td>
			</tr>
			<tr>
				<td><label for="img_approved">Image Approved</label></td>
				<td><select name="img_approved" id="img_approved" class="formText" value="<?php echo $basket->img_approved; ?>"  />
				<option name="NotApproved" value="0" <?php if ($basket->img_approved == 0) echo "selected"; ?>>Not Approved</option>
				<option name="Approved" value="1" <?php if ($basket->img_approved == 1) echo "selected"; ?>>Approved</option>
				</select>
				
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

