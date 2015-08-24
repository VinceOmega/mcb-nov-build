<script type="text/javascript" src="media/js/fckeditor/fckeditor.js"></script>
<script type="text/javascript" src="media/js/ui.datepicker.js"></script>

<div id="gridContainer">
<table id="grid"></table>
<div id="pager"></div>

<script>
	var colModel = <?php echo $this->colModel();?>;
	name = 'discounts';
	showGrid('Discounts List', colModel);
	function customize(){
		if ((id = jQuery('#grid').getGridParam('selrow'))==null){	
			alert('Choose a discount');
		}else{
			document.location.href='/admin-console/discounts/customize/' + id;
		}
	}	
	
</script>
<button onClick="customize(); return false;">Customize</button>
<button onClick="addItem(); return false;">Add</button>
<button onClick="editItem(); return false;">Edit</button>
<button onClick="deleteItem(); return false;">Delete</button>
</div>
<?php
	echo $this->getForm();
	if ($this->msg) echo '<script>alert(\''.$this->msg.'\');</script>';
?>