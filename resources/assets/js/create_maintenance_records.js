$(function(){
	
	var wrapper = $('#maintenance_records_create_page,#maintenance_records_edit_page');

	if(!wrapper.length) {
		return;
	}

	$('#payment_method').change(function(){
		var method = $(this).val();

		if(method === 'checks') {
			$('.cash-method').addClass('hidden');
			$('.check-method').removeClass('hidden');
		} else {
			$('.cash-method').removeClass('hidden');
			$('.check-method').addClass('hidden');
		}
	}).change();


	$('#check_count_to_use').change(function(){
		var total = $(this).val();
		var totalExists = $('#checks_container .row').length;

		if(totalExists > total) {
			// At this point we know there are more inputs that we need to capture
			$('#checks_container .row').each(function(index, item){

				if(index > total -1) {
					// At this point we know that the index more than what we need to keep
					// remove the item
					$(item).remove();
				}				
			});

			return;
		}

		var template = $('#checks_container .row').first().clone().find(':input').attr('value', '').end();

		// At this point we know that we need to add more check capture.
		for(i = totalExists; i < total; i++) {

			var content = getContent(template.prop('outerHTML'), i)

			$('#checks_container').append(content);
		}
		
	}).change();
});