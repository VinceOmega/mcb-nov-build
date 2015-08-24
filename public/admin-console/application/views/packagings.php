<table id="grid"></table>
<div id="pager"></div>
<script>
	var colModel = <?php echo $this->colModel();?>;
	name = 'packagings';
	showGrid('Packagings', colModel);
	
	function editPackaging(){
		if ((id = jQuery('#grid').getGridParam('selrow'))==null){	
			alert('Choose a packaging');
		}else{
			document.location.href='/admin-console/packagings/edit/' + id;
			//alert(id);
		}
	}
	function deleteRecord(){
		var id = jQuery('#grid').getGridParam('selrow');
		if (null == id) {
			alert('Choose a packaging to delete.');
			return;
		}
		
		if (confirm("Are you sure you want to delete this record?"))
			document.location.href='/admin-console/'+name+'/delete/?id=' + id;
	}
</script>
<button onClick="document.location.href='/admin-console/packagings/add'; return false;">Add</button>
<button onClick="editPackaging(); return false;">Edit</button>
<button onClick="deleteRecord(); return false;">Delete</button>