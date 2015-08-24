<table id="grid"></table>
<div id="pager"></div>
<script>
	var colModel = <?php echo $this->colModel();?>;
	name = 'orders';
	showGrid('Orders List', colModel, {sidx:'order_id',sord:'desc'});
	
	function editOrder(){
		if ((id = jQuery('#grid').getGridParam('selrow'))==null){	
			alert('Choose an order');
			return false;
		}else{
			//alert('/admin-console/orders/edit/' + id);
			document.location.href='/admin-console/orders/edit/' + id;
		}
	}	
</script>
<button onClick="editOrder(); return false;">Details</button>