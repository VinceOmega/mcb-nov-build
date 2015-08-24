<div id="gridContainer">
<table id="grid"></table>
<div id="pager"></div>

<script>

	var colModel = <?php echo $this->colModel();?>;
	name = 'categories';
	showGrid('Categories List', colModel);
	
	function edit(){
		if ((id = jQuery('#grid').getGridParam('selrow'))==null){	
			alert('Choose a category');
		}else{
			document.location.href='/admin-console/categories/edit/' + id;
		}
	}
</script>
<button onClick="document.location.href='/admin-console/categories/add'; return false;">Add</button>
<button onClick="edit(); return false;">Edit</button>
<button onClick="deleteItem(); return false;">Delete</button>
</div>
<?php
	echo $this->getForm();
?>