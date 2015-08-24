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
	function deleteRecord(){
		var id = jQuery('#grid').getGridParam('selrow');
		if (null == id) {
			alert('Choose a product to delete.');
			return;
		}
		
		if (confirm("Are you sure you want to delete this record?"))
			document.location.href='/admin-console/'+name+'/delete/?id=' + id;
	}
</script>
<button onClick="document.location.href='/admin-console/products/add'; return false;">Add</button>
<button onClick="editProduct(); return false;">Edit</button>
<button onClick="deleteRecord(); return false;">Delete</button>