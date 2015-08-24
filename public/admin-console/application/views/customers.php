<table id="grid"></table>
<div id="pager"></div>
<script>
	var colModel = <?php echo $this->colModel();?>;
	name = 'users';
	showGrid('Users', colModel);
	
	function editUser(){
		if ((id = jQuery('#grid').getGridParam('selrow'))==null){	
			alert('Choose a user');
		}else{
			document.location.href='/admin-console/customers/edit/' + id;
			//alert(id);
		}
	}	
	function deleteUser(){
		if ((id = jQuery('#grid').getGridParam('selrow'))==null){	
			alert('Choose a user');
		}else{
			var r = confirm("Are you sure you want to delete this record?");
			if (r == true) {
				document.location.href='/admin-console/customers/delete/' + id;
			} else {
				
			}
			//alert(id);
		}
	}	
</script>
<button onClick="editUser(); return false;">Edit</button>
<button onClick="document.location.href='/admin-console/customers/add'; return false;">Add</button>
<button onClick="deleteUser(); return false;">Delete</button>