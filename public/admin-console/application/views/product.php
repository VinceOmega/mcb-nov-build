<table id="grid"></table>
<div id="pager"></div>
<script>
	var colModel = <?php echo $this->colModel();?>;
	name = 'products';
	showGrid('Products', colModel);
	
	function editProduct(){
		if ((id = jQuery('#grid').getGridParam('selrow'))==null){	
			alert('Choose a product');
		}else{
			document.location.href='/admin-console/products/edit/' + id;
			//alert(id);
		}
	}	
	function deleteProduct(){
		if ((id = jQuery('#grid').getGridParam('selrow'))==null){	
			alert('Choose a product');
		}else{
			var r = confirm("Are you sure you want to delete this record?");
			if (r == true) {
				document.location.href='/admin-console/products/delete/' + id;
			} else {
				
			}
			//alert(id);
		}
	}	
</script>
<button onClick="editProduct(); return false;">Edit</button>
<button onClick="document.location.href='/admin-console/products/add'; return false;">Add</button>
<button onClick="deleteProduct(); return false;">Delete</button>