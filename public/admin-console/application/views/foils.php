<table id="grid"></table>
<div id="pager"></div>
<script>
	var colModel = <?php echo $this->colModel();?>;
	name = 'foils';
	showGrid('Foils', colModel);
	
	function editFoil(){
		if ((id = jQuery('#grid').getGridParam('selrow'))==null){	
			alert('Choose a foil');
		}else{
			document.location.href='/admin-console/foils/edit/' + id;
			//alert(id);
		}
	}	
	function deleteFoil(){
		if ((id = jQuery('#grid').getGridParam('selrow'))==null){	
			alert('Choose a foil');
		}else{
			var r = confirm("Are you sure you want to delete this record?");
			if (r == true) {
				document.location.href='/admin-console/foils/delete/' + id;
			} else {
				
			}
			//alert(id);
		}
	}	
</script>
<button onClick="editFoil(); return false;">Edit</button>
<button onClick="document.location.href='/admin-console/foils/add'; return false;">Add</button>
<button onClick="deleteFoil(); return false;">Delete</button>