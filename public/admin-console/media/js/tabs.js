$.tabs = function(selector, start) {
		
	$(selector).each(function(i, element) {
		$($(element).attr('tab')).css('display', 'none');
		
		
		
		$(element).click(function() {
			$('.selected_tab').remove();
			$(selector).each(function(i, element) {
				$(element).removeClass('selected');
				$($(element).attr('tab')).css('display', 'none');
			});
			
			$(this).addClass('selected');			
		
			$($(this).attr('tab')).css('display', 'block');		
			
			//this line will have the selected tab still be selected after submiting a form
			$($(this).attr('tab')).append("<input type='hidden' value='" + ($(this).attr('tab')) +"'  name='selected_tab' class='selected_tab' />");

		});
	});
	
	if (!start) {
		start = $(selector + ':first').attr('tab');
	}

	$(selector + '[tab=\'' + start + '\']').trigger('click');
	
};