<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<?php
	$id = $this->uri->segment(3);
	$slide = ORM::factory('slide', $id);
	$site_val = $slide->site_id;
?>

<form action="<?php echo url::base() . $this->uri->segment(1) . '/' . $this->uri->segment(2) . '/' . $id ?>" method="POST" enctype="multipart/form-data" id="form" >
	<div id="mainContent" >
		<div class="box">
			<div class="left"></div>
			<div class="right"></div>
			<div class="heading">
				<h2 id="heading">Slideshow</h2>
				<span id="buttons">
					<input type="submit" value="Save" name="save" class="css-button" />
					<input type="button" onclick="location = '<?=url::base().$this->uri->segment(1)?>';" value='Cancel' class="css-button"  />
				</span>
			</div>
		</div>
		<div id="contentLeft">
			<div id="tabs" class="htabs" >
				<a tab="#tab_general" id="general_tab"><input type="hidden" name="tab_general" >General</a>
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
						<td>Image
						</td>
						<td>
<?						if ($slide->image) { ?> 
							<img src="/env/images/mcc/slideshow/<?=$slide->image?>" width="300px" /><br />
<? } ?>
							<input type="file" name="image" /> 
							Width: 590px, Height: 453px
						</td>
					</tr>	
					<tr>
						<td>Image alt value</td>
						<td>
							<input type="text" class="formText" name="image_alt" value="<?=$slide->image_alt?>" />
						</td>
					</tr>
					<tr>
						<td>Url (optional)</td>
						<td>
							<input type="text" name="url" maxlength="255" value="<?=$slide->url?>" />
							Start with: 'http://'
						</td>
					</tr>
					<tr>
						<td>Order</td>
						<td>
							<input type="text" name="order" value="<?=$slide->order?>" />
						</td>
					</tr>
					<tr>
						<td>Site</td>
						<td>
							<select name="site_id">
								<option value="1" <?php if($slide->site_id === '1') echo "selected='selected'";?>>MCH</option>
								<option value="2" <?php if($slide->site_id === '2') echo "selected='selected'";?>>MCC</option>
								<option value="3" <?php if($slide->site_id === '3') echo "selected='selected'";?>>MCB</option>
							</select>
						</td>
					</tr>
				</table>
			</div>
		</div>
</form>