<div id="gridContainer">
<table id="grid"></table>
<div id="pager"></div>

<script>

	var colModel = <?php echo $this->colModel();?>;
	name = 'types';
	showGrid('Product Types List', colModel);
	
	function edit(){
		if ((id = jQuery('#grid').getGridParam('selrow'))==null){	
			alert('Choose a product type');
		}else{
			document.location.href='/admin-console/types/edit/' + id;
		}
	}
</script>
<button onClick="document.location.href='/admin-console/types/add'; return false;">Add</button>
<button onClick="edit(); return false;">Edit</button>
<button onClick="deleteItem(); return false;">Delete</button>
</div>
<?php
	echo $this->getForm();
?>