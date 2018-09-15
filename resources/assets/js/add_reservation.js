$(function(){

	var form = $('#edit_reservation_form, #create_reservation_form');

	if(form.length == 0) {
		return;
	}

	var isEditView = (form.attr('id') === 'edit_reservation_form');

	if(isEditView) {
		form.find('.selected-vehicle').removeClass('hidden');
		form.find('.selected-data-range').removeClass('hidden');
	}

	var reservedFrom = form.find('#reserved_from');
	var reservedTo = form.find('#reserved_to');
	var vehiclesMenu = form.find('#vehicle_id');
	var totalOverride = form.find('#total_override');
	var totalRent = form.find('#total_rent');
	var totalOwe = form.find('#total_owe');
	var totalTax = form.find('#total_tax');
	var totalDays = form.find('#total_days');
	var rate = form.find('#rate');

	var selectedVehicle = null; // selectedVehicle info object

	reservedFrom.datetimepicker({
		useCurrent: false,
		format: window.dateFormat
	}).on("dp.change", function (e) {
        reservedTo.datetimepicker('minDate', e.date);
		// Update the totals
		updateTotals();
		showTotals();
    });

	reservedTo.datetimepicker({
		useCurrent: false,
		format: window.dateFormat
	}).on("dp.change", function (e) {
        reservedFrom.datetimepicker('maxDate', e.date);
		// Update the totals
		updateTotals();
		showTotals();
    });


    // On vehicle change
    // Display vehicle info and disable the reserved days
	vehiclesMenu.change(function(e){
		var self = $(this);
		selectedVehicle = null;

		if(!isEditView){
			form.find('.selected-vehicle').addClass('hidden');
			resetTotal();
		}

		if(!self.val()) {
			// Hide the selected-vehicle blocks
			return;
		}

		var parent = self.parent();

		// Show/hide the info container
		var infoContainer = parent.find('.info-container:first');

		if(!infoContainer.length) {
			infoContainer = $('<div class="info-container mt-15 mb-0 pt-3 pb-3 alert alert-info hidden"></div>');
			parent.append(infoContainer);
		} else {
			infoContainer.html('').addClass('hidden');
		}

		// Get the vehicle info and display it
		axios.get(route('api.vehicles.vehicle.get_info', { 'vehicleId': self.val() }))
	    .then(response => {

	    	if(response.data.status !== 'success' ) {
	    		// Something went wrong and the system was not able to get the vehicle info
	    		alert(response.data.message);

	    		return;
			}

			// Set the current selected vehicle
			selectedVehicle = response.data.data;

			// Update the totals
			if(!isEditView){
				updateTotals();
				showTotals();
			}

	        var info = '<dl class="dl-horizontal dl-horizontal-condensed">';

        	$.each(response.data.data, function(key, item){
        		if(key == 'reservations' && item.value.length) {
        			//console.log('reserved', item.value);
        			//console.log(reservedFrom.datetimepicker('disabledDates'));
        			// Enable currently disabled dates in the "From" component
        			reservedFrom.datetimepicker('enabledDates', reservedFrom.data("DateTimePicker").disabledDates());

        			// Enable currently disabled dates in the "To" component
        			reservedTo.data("DateTimePicker").enabledDates(reservedTo.data("DateTimePicker").disabledDates());

        			// Disable the reserved dates in the "From" component
        			reservedFrom.data("DateTimePicker").disabledDates(item.value);

        			// Disable the reserved dates in the "To" component
        			reservedTo.data("DateTimePicker").disabledDates(item.value);

        		} else if (item.value) {
        			info += '  <dt>' +  item.title + '</dt><dd>' + item.value +'</dd>';
        		}
        	});

			info +='</dl>';

	        infoContainer.html(info).removeClass('hidden');

	        if(!isEditView){
				// Show the selected-vehicle blocks
				form.find('.selected-vehicle').removeClass('hidden');
			}
		}).catch(error => {
			alert('Something unexpected happen while trying to get the selected vehicle info!');
		    console.log(error)
		});
	}).change();

	// Listen for change on the total_override field
	form.find('#total_override').on('keyup change', function(e){
		updateTotals();
	});

	// Find the matching customer
	$('#primary_driver').autocomplete({
	    source: function( request, response ) {
	        $.ajax({
	        	url: route('api.customers.customer.find', { 'term': request.term }),
	        	dataType: "jsonp",
	        	data: {
	            	term: request.term
	        	},
	        	success: function( request ) {
		          	var data = [{
		          		value: -1,
		          		label: 'Add new customer',
		          	}];

		          	if(request.status === 'success') {
		          		$.merge(data, request.data);
		          	}
		          	
		          	response(data);
	            }
	        });
	    },
	    minLength: 1,
	    select: function( event, ui ) {
	    	event.preventDefault();

	    	if(ui.item.value === -1){
	    		$('#primary_driver').val('');
	    		$('#add_customer_dialog').modal('show');

	    		return;
	    	}

	      	form.find('#primary_driver_id').val(ui.item.value);
	      	$('#primary_driver').val(ui.item.label).prop('disabled', true);
	      	$('#clear_auto_complete').removeClass('hidden');
	    }
    });

	$('#submit_create_customer_form').on('click', function(e){
		e.preventDefault();
		var customerForm = $('#create_customer_form');

		// validate the form
		customerForm.validate();

		if(!customerForm.valid()){
			//At this point we know that the form is not valid, bail out
			return;
		}

		var dataToPost = window.getRequestObject(customerForm.serializeArray());
		$('#customer_dialog_error_placeholder').text('').addClass('hidden');
		// call the service that creates the customer
		axios.post(route('api.customers.customer.store'), dataToPost)
		     .then(response => {

	    	if(response.data.status !== 'success' ) {
	    		$('#customer_dialog_error_placeholder').text(response.data.message)
	    											   .removeClass('hidden');
	    		return;
			}
			// Set the new created record as the primary driver
			$('#primary_driver').data('ui-autocomplete')._trigger('select', 'autocompleteselect', { 
				item: { 
					value: response.data.data.id, 
					label: response.data.data.fullname
				}
			});

			// Close the new customer dialog
			$('#add_customer_dialog').modal('hide');
		}).catch(error => {
			$('#customer_dialog_error_placeholder').text('Something unexpected happen while trying to get the selected vehicle info!')
												   .removeClass('hidden');
		    console.log(error);
		});		
	});

	$('#clear_auto_complete').on('click', function(){
		$('#primary_driver').autocomplete('close');
		$('#primary_driver').val('').prop('disabled', false);
		$('#clear_auto_complete').addClass('hidden');
	});

	function resetTotal()
	{
		rate.val('');
		totalDays.val('');
		totalOverride.val('');
		totalTax.val('');
		totalRent.val('');
		totalOwe.val('');
	}

	// Update all the total on the reservation screen
	function updateTotals()
	{
		var days = getTotalDays();
		var rateAmount = getRate();
		var total = days * rateAmount;
		var override = Number(totalOverride.val());
		var totalDue = total + override;
		var taxAmount = window.taxRate * totalDue;

		rate.val(rateAmount);
		totalDays.val(days);
		totalTax.val(taxAmount);
		totalRent.val(total);
		totalOwe.val(totalDue);
	}

	function getRate()
	{
		if(!selectedVehicle) {
			alert('you must first select a vehicle');

			return;
		}
		//var vehicle = vehiclesMenu.find(':selected').first();
		var days = getTotalDays();
		if(days >= 30) {
			return Number(selectedVehicle['monthly_rate'].value);
		}
		if(days >= 7) {
			return Number(selectedVehicle['weekly_rate'].value);
		}

		return Number(selectedVehicle['daily_rate'].value);
	}

	function getTotalDays()
	{
		var from = reservedFrom.data('DateTimePicker').date();
		var to = reservedTo.data('DateTimePicker').date();

		if(from && to) {
			return to.diff(from, 'days') || 1;
		}

		return 0;
	}

	function showTotals()
	{
		if(getTotalDays() > 0) {
			form.find('.selected-data-range').removeClass('hidden');
		} else {
			form.find('.selected-data-range').addClass('hidden');
		}
	}
});