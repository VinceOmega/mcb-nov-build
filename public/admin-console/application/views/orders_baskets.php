<script type="text/javascript" src="media/js/fckeditor/fckeditor.js"></script>
<div id="gridContainer">
<table id="grid"></table>
<div id="pager"></div>

<script>
	var colModel = <?php echo $this->colModel();?>;
	name = 'orders_baskets';
	showGrid('Customer Designs', colModel);
	
	function editDesign(){
		if ((id = jQuery('#grid').getGridParam('selrow'))==null){	
			alert('Choose a product');
		}else{
			document.location.href='/admin-console/customer_designs/edit/' + id;
			//alert(id);
		}
	}	

	function deleteDesign(){
		if ((id = jQuery('#grid').getGridParam('selrow'))==null){	
			alert('Choose a product');
		}else{
			document.location.href='/admin-console/customer_designs/delete/' + id;
			//alert(id);
		}
	}	
</script>
<button onClick="editDesign(); return false;">Edit</button>
<button onClick="document.location.href='/admin-console/customer_designs/add'; return false;">Add</button>
<button onClick="deleteItem(); return false;">Delete</button>
</div>
<?php
	echo $this->getForm();
?>