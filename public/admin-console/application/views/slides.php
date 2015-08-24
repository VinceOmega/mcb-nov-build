<table id="grid"></table>
<div id="pager"></div>
<script>
	var colModel = <?php echo $this->colModel();?>;
	console.log(colModel);
	name = 'slides';
	showGrid('Slideshow', colModel);
	
	function editSlide(){
		var id = jQuery('#grid').getGridParam('selrow');
		if (id == null){	
			alert('Choose a slide');
		}else{
			document.location.href='/admin-console/slides/edit/' + id;
			//alert(id);
		}
	}
	function deleteRecord(){
		var id = jQuery('#grid').getGridParam('selrow');
		if (null == id) {
			alert('Choose a slide to delete.');
			return;
		}
		
		if (confirm("Are you sure you want to delete this record?"))
			document.location.href='/admin-console/'+name+'/delete/?id=' + id;
	}
</script>
<button onClick="document.location.href='/admin-console/slides/add'; return false;">Add</button>
<button onClick="editSlide(); return false;">Edit</button>
<button onClick="deleteRecord(); return false;">Delete</button>