$(function(){
	var wrapper = $('#credits_show');

	if(!wrapper.length) {
		return;
	}

	var paymentForm = $('#create_credit_payment_form');
	var paymentDialog = $('#payment_model');
	var paymentDialogTitle = $('#payment_model_title');
	var alertBlock = $('#payment_model_alert');
	var submitButton = $('#create_credit_payment_form_submit');
	
	$('#payment_method').change(function(e){
		e.preventDefault();

		var menu = $(this);
		$('.due_date_block').addClass('hidden');

		if(menu.val() === 'check' && paymentForm.data('request-type') === 'create') {
			// We only need to execute this when the form's type is "create"
			$('.due_date_block').removeClass('hidden');
		}
	});


	$('#create_payment').click(function(e){
		e.preventDefault();
		resetForm();

		paymentForm.data('request-type', 'create');
		paymentForm[0].reset();
		paymentDialogTitle.text(paymentDialogTitle.data('add-title'));

		paymentDialog.modal('show');
	});

	$('.edit-payment').click(function(e){
		e.preventDefault();
		resetForm();
		var button = $(this);
		paymentForm.data('request-type', 'edit');
		paymentForm.find('#amount').val(button.data('amount'));
		paymentForm.find('#payment_method').val(button.data('payment-method'));
		paymentForm.find('#payment_id').val(button.data('payment-id'));
		paymentDialogTitle.text(paymentDialogTitle.data('edit-title'));

		paymentDialog.modal('show');
	});

	submitButton.click(function(e){
		e.preventDefault();

		var button = $(this);

		paymentForm.validate();

		if(!paymentForm.valid()) {
			return;
		}

		var url = route('credit_payments.credit_payment.store');
		var method = 'POST';
		var data = formToData(paymentForm);

		if(paymentForm.data('request-type') === 'edit') {
			url = route('credit_payments.credit_payment.update', { 'id': paymentForm.find('#payment_id') });
			method = 'PATCH';
			data['_method'] = 'PATCH';
		}

		button.attr('disabled', true);
		axios({
		  url: url,
		  method: method,
		  data: formToData(paymentForm)
		})
	    .then(response => {

	    	alertBlock.removeClass('alert-danger alert-success hidden').html(response.data.message);

	    	if(response.data.status !== 'success' ) {
	    		// Something went wrong and the system was not able to get the vehicle info
	    		alertBlock.addClass('alert-danger').html(response.data.message);
	    		button.attr('disabled', false);

	    		return;
			}

			alertBlock.addClass('alert-success').html(response.data.message);
			location.reload();
		});

	});

	function resetForm()
	{
		paymentForm.data('request-type', '');
		paymentForm.find('#amount').val('');
		paymentForm.find('#payment_method').val('');
		paymentForm.find('#payment_id').val('');
		paymentDialogTitle.text('');

		alertBlock.removeClass('alert-success alert-danger').addClass('hidden').html('');
		submitButton.attr('disabled', false);
	}
});