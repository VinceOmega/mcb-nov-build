<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<?php echo html::script(array (url::base().'media/js/fckeditor/fckeditor.js'), FALSE); ?>
<script type="text/javascript">
window.onload = function()
{
	var sBasePath = '<?php echo url::base() ?>/media/js/fckeditor/';

	var oFCKeditor = new FCKeditor( 'short_description' ) ;
	oFCKeditor.Width = '100%' ;
	oFCKeditor.Height = '512' ; 
	oFCKeditor.BasePath	= sBasePath ;
	oFCKeditor.ReplaceTextarea() ;	
	
	var oFCKeditor = new FCKeditor( 'content' ) ;
	oFCKeditor.Width = '100%' ;
	oFCKeditor.Height = '300' ; 
	oFCKeditor.BasePath	= sBasePath ;
	oFCKeditor.ReplaceTextarea() ;	
}
</script>

<form action="<?php echo url::base() . $this->uri->segment(1). '/' . $this->uri->segment(2) .($article->id!=0?'/'.$article->id:'')?>" method="POST" enctype="multipart/form-data" id="form" >
<div id="mainContent" >

	<div class="box">
		  <div class="left"></div>
		  <div class="right"></div>
		  <div class="heading">
		    <h2 id="heading">Articles</h2>
		    <span id="buttons">
				<input type="submit" value="Save" name="save" class="css-button" />
				<input type="button" onclick="location = '<?php  echo url::base() . $this->uri->segment(1) ?>'" value='Cancel' class="css-button"  />
			</span>
		  </div>
	</div>
	
	<div id="contentLeft">
		<div id="tabs" class="htabs" >
			<a tab="#tab_general" id="general_tab">General</a>
			<a tab="#tab_meta_infromation">Meta Information</a>
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
				<td>Title</td>
				<td><input type="text" name="article[title]" id="title" class="name" maxlength="255" value="<?=htmlspecialchars($article->title)?>" /></td>
			</tr>	
			<tr>
				<td>Short Description</td>
				<td><textarea name="article[short_description]" id="short_description" class="formText" cols="80" rows="25"><?=$article->short_description?></textarea></td>
			</tr>	
			<tr>
				<td>Full article content</td>
				<td><textarea name="article[content]" id="content" class="formText" cols="80" rows="25"><?=$article->content?></textarea></td>
			</tr>
			<tr>
				<td>Active</td>
				<td>
					<select name="article[active]" id="active" class="formSelect">
						<option <?=$article->active=='Yes'?'selected':''?>>Yes</option>
						<option <?=$article->active=='No' ?'selected':''?>>No </option>
					</select>
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
			  		<td>Meta Title</td>
					<td><textarea id="meta_title" class="name" name="article[meta_title]"><?=html::specialchars($article->meta_title, FALSE)?></textarea></td>
			  </tr>
			  <tr>
					<td>Description</td>
					<td><textarea id="meta_description" class="name" name="article[meta_description]" ><?=$article->meta_description?></textarea></td>
			  </tr>
			   <tr>
					<td>Keywords</td>
					<td><textarea id="meta_keywords" class="name" name="article[meta_keywords]" ><?=$article->meta_keywords?></textarea></td>
			  </tr>
			  <tr>
			  		<td>URL</td>
					<td><input id="url" type="text" class="name" name="article[url]" maxlength="255" value="<?=html::specialchars($article->url, FALSE); ?>" /></td>
			  </tr>
			  </table>
		 </div>   <!-- div id="tab_meta_infromation" -->
	</div>    	<!-- div id="contentRight" -->
</div>  <!-- div id='mainContent' -->
</form>
<script type="text/javascript"><!--
$.tabs('#tabs a', '<?php echo isset($_GET['selected_tab']) ? '#'.$_GET['selected_tab'] : '#tab_general'?>'); 
//--></script>