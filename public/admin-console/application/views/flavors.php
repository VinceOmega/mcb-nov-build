<table id="grid"></table>
<div id="pager"></div>
<script>
	var colModel = <?php echo $this->colModel();?>;
	name = 'flavors';
	showGrid('Flavors', colModel);
	
	function editFlavor(){
		if ((id = jQuery('#grid').getGridParam('selrow'))==null){	
			alert('Choose a flavor');
		}else{
			document.location.href='/admin-console/flavors/edit/' + id;
			//alert(id);
		}
	}	
	function deleteFlavor(){
		if ((id = jQuery('#grid').getGridParam('selrow'))==null){	
			alert('Choose a flavor');
		}else{
			var r = confirm("Are you sure you want to delete this record?");
			if (r == true) {
				document.location.href='/admin-console/flavors/delete/' + id;
			} else {
				
			}
			//alert(id);
		}
	}	
</script>
<button onClick="editFlavor(); return false;">Edit</button>
<button onClick="document.location.href='/admin-console/flavors/add'; return false;">Add</button>
<button onClick="deleteFlavor(); return false;">Delete</button>