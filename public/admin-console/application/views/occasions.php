<table id="grid"></table>
<div id="pager"></div>
<script>
	var colModel = <?php echo $this->colModel();?>;
	name = 'occasions';
	showGrid('Occasions', colModel);
	
	function editOccasion(){
		if ((id = jQuery('#grid').getGridParam('selrow'))==null){	
			alert('Choose an occasion');
		}else{
			document.location.href='/admin-console/occasions/edit/' + id;
			//alert(id);
		}
	}	
	function deleteOccasion(){
		if ((id = jQuery('#grid').getGridParam('selrow'))==null){	
			alert('Choose an occasion');
		}else{
			var r = confirm("Are you sure you want to delete this record?");
			if (r == true) {
				document.location.href='/admin-console/occasions/delete/' + id;
			} else {
				
			}
			//alert(id);
		}
	}	
</script>
<button onClick="editOccasion(); return false;">Edit</button>
<button onClick="document.location.href='/admin-console/occasions/add'; return false;">Add</button>
<button onClick="deleteOccasion(); return false;">Delete</button>