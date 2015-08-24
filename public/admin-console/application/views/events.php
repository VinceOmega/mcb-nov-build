<script type="text/javascript" src="media/js/fckeditor/fckeditor.js"></script>
<div id="gridContainer">
<table id="grid"></table>
<div id="pager"></div>

<script>
	var colModel = <?php echo $this->colModel();?>;
	name = 'events';
	showGrid('Events List', colModel);
</script>
<button onClick="addItem(); return false;">Add</button>
<button onClick="editItem(); return false;">Edit</button>
<button onClick="deleteItem(); return false;">Delete</button>
</div>
<?php
	echo $this->getForm();
?>