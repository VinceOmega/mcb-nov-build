<table id="grid"></table>
<div id="pager"></div>
<script>
	var colModel = <?php echo $this->colModel();?>;
	name = 'articles';
	showGrid('Articles', colModel);
	
	function editArticle(){
		if ((id = jQuery('#grid').getGridParam('selrow'))==null){	
			alert('Choose a article');
		}else{
			document.location.href='/admin-console/articles/edit/' + id;
		}
	}
</script>
<button onClick="document.location.href='/admin-console/articles/add'; return false;">Add</button>
<button onClick="editArticle(); return false;">Edit</button>
<button onClick="deleteItem(); return false;">Delete</button>