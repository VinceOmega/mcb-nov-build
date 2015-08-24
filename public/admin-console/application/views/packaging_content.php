<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<?php echo html::script(array (url::base().'media/js/fckeditor/fckeditor.js'), FALSE); ?>
<script type="text/javascript">
window.onload = function()
{
	// Automatically calculates the editor base path based on the _samples directory.
	// This is usefull only for these samples. A real application should use something like this:
	// oFCKeditor.BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.
	var sBasePath = '<?php echo url::base() ?>/media/js/fckeditor/';

	var oFCKeditor = new FCKeditor( 'packagingDescription' ) ;
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
$packaging = ORM::factory('packaging')->find($id);
$packaging_costs = Packaging_Cost::getCostsByPackaging($id);

?>		


<form action="<?php echo url::base() . $this->uri->segment(1). '/' . $this->uri->segment(2) . '/' .$id ?>" method="POST" enctype="multipart/form-data" id="form" >
<div id="mainContent" >




	<div class="box">
		  <div class="left"></div>
		  <div class="right"></div>
		  <div class="heading">
		    <h2 id="heading">Packagings</h2>
		    <span id="buttons">
				<input type="submit" value="Save" name="save" class="css-button" />
				<!--<a onclick="location = '<?php  echo url::base() . $this->uri->segment(1) ?>'" class="button"><span>Cancel</span></a>-->
				<input type="button" onclick="location = '<?php  echo url::base() . $this->uri->segment(1) ?>'" value='Cancel' class="css-button"  />
			</span>
		  </div>
	</div>
	


	<div id="contentLeft">
		<div id="tabs" class="htabs" >
			<a tab="#tab_general"><input type="hidden" name="tab_general" >General</a>
			<a tab="#tab_options"><input type="hidden" name="tab_options" >Options</a>
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
				<td><label for="packagingName">Packaging Name</label></td>
				<td><input type="text" name="packagingName" id="packagingName" class="name" maxlength="255" value="<?php echo htmlspecialchars($packaging->name) ?>" /></td>
			</tr>
			<tr>
				<td><label for="packagingDescription">Description</label></td>
				<td><textarea name="packagingDescription" id="packagingDescription" class="formText"><?php echo $packaging->description; ?></textarea></td>
			</tr>	
			<tr>
				<td><label for="">Products</label></td>
				<td>
					<?php		
						$ppModel = new Products_packaging_Model(1);
						echo $ppModel->getProductsByPackaging($packaging->id);
					?>
				
				</td>
			</tr>
			<tr>
				<td><label for="">Image</label></td>
				<td>
					<?php if($packaging->image) { ?> 
							<img src="/env/packaging_images/<?php echo $packaging->image; ?>" width="300px" /><br />
					<?php } ?>
					<input type="file" name="image" />
				</td>
			</tr>
			<tr>
				<td><label for="">Image alt value</label></td>
				<td>
					<input type="text" id="image_alt" class="formText" name="image_alt" value="<?=$packaging->image_alt?>" />
				</td>
			</tr>
			<tr>
				<td><label for="packagingName">Coins amount</label></td>
				<td><input type="text" name="coins_amount" id="coins_amount" class="formTextDimension" maxlength="255" value="<?php echo ($packaging->coins_amount) ?>" /></td>
			</tr>
			<tr>
				<td><label for="">Costs</label></td>
				<td>
					<span style="font-size:12px;">
						IMPORTANT ABOUT COSTS: 
						<ul style="margin:0px;">
							<li>The first cost range must start with 0 and the last cost range must finish with 0.(i.e.: 0-50, 51-100, 101-0 will generate a 101+ in the last range).</li>
						</ul>
					</span>
					
					<table id="costs_table">
					<colgroup><col width="200" /><col /><col /></colgroup>
					<tr>
						<th style="text-align:left;">Quantity</th>
						<th>Price</th>
					</tr>
	  <?php		
				  if (count($packaging_costs) > 0) {
					  foreach($packaging_costs as $cost) {
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
					  for(var i=0; i< <?=count($packaging_costs)>2?3:5?>; i++)
						  add_more_price_ranges();
				  </script>
					<a href="#" onclick="add_more_price_ranges(); return false;" style="font-size:11px;">Add more price ranges</a>
				</td>
			</tr>
			<tr>
				<td><label for="packagingStatus">Status</label></td>
				<td><!-- product status (0=>'disabled', 1=>'enabled', 2=>'deleted') -->
					
					<select name="packagingStatus" id="packagingStatus" class="formSelect">
						<option value="1" <?php if ($packaging->status == 1) echo "selected=selected"; ?> >Enabled</option>
						<option value="0" <?php if ($packaging->status == 0) echo "selected=selected"; ?> >Disabled</option>
					</select>
				</td>
			</tr>
			</table>
		</div>
		<div id="tab_options">
			<div class="headline">Packaging Options</div>
			<a onclick="addOption();" class="button" style="float:right; "><span>Add Option</span></a>
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
<?			foreach ($packaging->packagingoptions as $option) { ?>
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
					<a onclick="removeOption($(this));" class="button"><span>Remove</span></a>
				</td>
			</tr>
<?			} ?>
			</table>
		</div>
	</div>    	<!-- div id="contentRight" -->
</div>  <!-- div id='mainContent' -->
</form>
<script type="text/javascript">
$.tabs('#tabs a', '<?php echo isset($_GET['selected_tab']) ? '#'.$_GET['selected_tab'] : '#tab_general'?>'); 

function addOption() {
	$('#optionTable').append($('<tr><td><input type="hidden" name="options[id][]" value="" /><input class="deleted" type="hidden" name="options[deleted][]" value="" /><input type="text" name="options[name][]" style="width: 145px;" /></td><td><input type="text" name="options[values][]" style="width: 370px" /></td><td style="font-size:12px"><select name="options[mandatory][]"><option value="0">Optional</option><option value="1">Mandatory</option></select></td><td><a onclick="removeOption($(this));" class="button"><span>Remove</span></a></td></tr>'));
}
function removeOption(link) {
	var table = $(link).parent().parent().parent();
	$(link).parent().parent().hide();
	$(link).parent().parent().find('.deleted').val('1');
}
addOption();
addOption();
addOption();
</script>