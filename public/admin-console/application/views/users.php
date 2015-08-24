<table id="grid"></table>
<div id="pager"></div>
<script>
function showGridCustomers(caption, colModel, param){
	jQuery("#grid").jqGrid(
		{ 
			url:'/admin-console/'+name+'/view/?'+param, 
			datatype: "json", 
            colModel :colModel,
			rowNum:20, 
			rowList:[10,20,30], 
			pager: '#pager', 
			sortname: 'date_registered', 
			viewrecords: true, 
			sortorder: "desc", 
			forceFit: true,
			caption:caption,
			height: 450
		}
	); 

    $(window).resize(function(e) {
        $("#grid").jqGrid("setGridWidth", 1000);
    }).resize();	
	//jQuery("#grid").jqGrid('navGrid','#pager',{edit:false,add:false,del:false}); 
	jQuery("#grid").jqGrid('filterToolbar',{ searchOnEnter : false });	
	
}

	var colModel = <?php echo $this->colModel();?>;
	name = 'users';
	showGridCustomers('Customers', colModel, 'users');
	
	function editCustomer(){
		if ((id = jQuery('#grid').getGridParam('selrow'))==null){	
			alert('Choose a customer');
		}else{
			document.location.href='/admin-console/users/edit/' + id;
		}
	}
</script>
<button onClick="editCustomer(); return false;">Edit</button>
<button onClick="document.location.href='/admin-console/users/edit'; return false;">Add</button>