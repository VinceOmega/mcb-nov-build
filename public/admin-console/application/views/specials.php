<?php 
function bannerForm($name, $path, $config){
	if (isset($config["specials.$name"]) && file_exists(APPPATH.'../../..'.$path.$config["specials.$name"])){
		echo html::image('..'.$path.$config["specials.$name"]).'<br/>';
	}
	$attributes = array('name' => $name, 'class' => 'banner_upload');
	echo form::upload($attributes, $path);
}
if (count($this->msg)) echo '<p>'.join('<br/>', $this->msg).'</p>';
echo form::open_multipart();
?>
<table border="0">
<tr>
	<td>Home page banner</td>
	<td width="80%">
<?php bannerForm('banner1', $this->path, $this->config );?>
	</td>
</tr>
<tr>
	<td>SubPage banner</td>
	<td>
<?php bannerForm('banner2', $this->path, $this->config );?>		
	</td>
</tr>
<tr>
	<td>Specials page main description</td>
	<td>
		<textarea id="description" name="description"><?php echo (isset($this->config['description'])) ? stripslashes($this->config['description']) : '';?></textarea>
	</td>
</tr>
<tr>
	<td colspan="2"><?php echo form::submit('submit', 'Save');?></td>
</tr>

</table>
<?php
echo form::close();
?>
<script type="text/javascript" src="/admin-console/media/js/fckeditor/fckeditor.js"></script>

<script type="text/javascript">
window.onload = function()
{
	// Automatically calculates the editor base path based on the _samples directory.
	// This is usefull only for these samples. A real application should use something like this:
	// oFCKeditor.BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.
	var sBasePath = '/admin-console/media/js/fckeditor/';

	var oFCKeditor = new FCKeditor( 'description' ) ;
	oFCKeditor.Width = '100%' ;
	oFCKeditor.Height = '400' ; 
	oFCKeditor.BasePath	= sBasePath ;
	oFCKeditor.ReplaceTextarea();
}
</script>