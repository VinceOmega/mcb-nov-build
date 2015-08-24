<table id="grid"></table>
<div id="pager"></div>
<script>
	var colModel = <?php echo $this->colModel();?>;
	name = 'testimonials';
	showGrid('Testimonials', colModel);
	
	function editTestimonial(){
		if ((id = jQuery('#grid').getGridParam('selrow'))==null){	
			alert('Choose a testimonial');
		}else{
			document.location.href='/admin-console/testimonials/edit/' + id;
			//alert(id);
		}
	}	
	function deleteTestimonial(){
		if ((id = jQuery('#grid').getGridParam('selrow'))==null){	
			alert('Choose a testimonial');
		}else{
			var r = confirm("Are you sure you want to delete this record?");
			if (r == true) {
				document.location.href='/admin-console/testimonials/delete/' + id;
			} else {
				
			}
			//alert(id);
		}
	}	
</script>
<button onClick="editTestimonial(); return false;">Edit</button>
<button onClick="document.location.href='/admin-console/testimonials/add'; return false;">Add</button>
<button onClick="deleteTestimonial(); return false;">Delete</button>