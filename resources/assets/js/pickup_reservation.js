$(function(){

	var form = $('#pickup_reservation_form');	

	if(form.length === 0){
		return;
	}
	
	// Find the payment methods container
	var container = form.find('.payment-methods-container').first();

	/**
	* Handle add new payment method
	*/
	form.find('#add_payment_method').click(function(e){
		e.preventDefault();
		var rows = container.find('.row');

		// Get the content of the next block
		var content = getContent(container.find('.row').first().clone().prop('outerHTML'), rows.length);

		// create the next block
		container.append(content);

		// Find the last payment method, aka the newly added method
		var newBlock = container.find('.row').last();

		// Show the remove-button for the newly added payment method
		newBlock.find('.remove-button').removeClass('hidden');
	});

	/**
	* Handle the remove button
	*/
	$(document).on('click','.remove-button', function(e){
		e.preventDefault();
		if(container.find('.row').length <= 1) {
			// prevent removing when only one block is available
			return;
		}

		// remove current block
		$(this).closest('.row').remove();

		// Fix the array indexes for each block to ensure the is no duplicates
		$.each(container.find('.row'), function (i, item) {
            var block = $(item);

			// get the updated content with the correct indexes
			// this step will cause all inputs to lose the selected values
            var newContent = getContent(block.prop('outerHTML'), i);

            // Create a new block with the updated indexes
            var updatedBlock = $(newContent);

            // Set the previous values to ensure the values are not lost in the transition
            updatedBlock.find(':input.payment-method').val(block.find(':input.payment-method').val());
			updatedBlock.find(':input.payment-amount').val(block.find(':input.payment-amount').val());
			updatedBlock.find(':input.payment-method-due-date').val(block.find(':input.payment-method-due-date').val());

			// Replace the content of the block with the correct index
			block.replaceWith(updatedBlock);
        });		
	});

	/**
	* Handle change of payment method
	* Show the due-date input only for credit and check methods
	*/
	$(document).on('change','.payment-method', function(e) {
		var menu = $(this);
		var selectedValue = menu.val();
		var row = menu.closest('.row');
		var dueDate = row.find('.payment-method-due-date');

		if(selectedValue === 'credit' || selectedValue === 'check') {
			// dueDate menu should only show up and be required 
			// when credit or check are selected
			dueDate.removeClass('hidden');
			dueDate.attr('required', true);
		} else {
			dueDate.addClass('hidden');
			dueDate.attr('required', false);
		}
	}).change();

	/**
	* Handle change of payment method
	* Show the due-date input only for credit and check methods
	*/
	$(document).on('change','.payment-amount', function(e) {
		var menu = $(this);
		var colelctedAmount = 0;

		// Sum the colected amount
		$.each(container.find('.payment-amount'), function(_i, input){
			colelctedAmount += Number(input.value);
		});

		var balanceInput = form.find('#remaining_balance');

		// find the total of the reservation
		var amountDue = Number(balanceInput.data('due'));

		balanceInput.val((amountDue - colelctedAmount).toFixed(2));
	}).change();


});