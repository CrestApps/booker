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
	$('#total_override').on('keyup change', function(e){
		updateTotals();
	});

	// Clear out the selected primary driver
	$('#clear_auto_complete').on('click', function(){
		$('#primary_driver').autocomplete('close');
		$('#primary_driver').val('').prop('disabled', false);
		$('#clear_auto_complete').addClass('hidden');
	});

	// Add new customer
	$('#add_new_customer').on('click', function(){
		// set the add_customer_dialog_type to primary driver
		// show the dialog
		$('#add_customer_dialog_type').val('primary_driver');
		$('#add_customer_dialog').modal('show');
	});

	// Add additional driver
	$('#add_additional_drive').on('click', function(){
		// set the add_customer_dialog_type to additional driver
		// show the dialog
		$('#add_customer_dialog_type').val('additional_driver');
		$('#add_customer_dialog').modal('show');
	});

	// Remove additional driver
	$(document).on('click', '.remove-additional-driver', function(){
		$(this).closest('li').remove();
	});

	// Auto-complete primary driver
	$('#primary_driver').autocomplete({
	    source: function( request, response ) {
	    	searchCustomer(request.term, response);
	    },
	    minLength: 1,
	    select: function( event, ui ) {
	    	event.preventDefault();

	      	form.find('#primary_driver_id').val(ui.item.value);
	      	$('#primary_driver').val(ui.item.label).prop('disabled', true);
	      	$('#clear_auto_complete').removeClass('hidden');
	    }
    });

	// Auto-complete additional driver
	$('#additional_driver').autocomplete({
	    source: function( request, response ) {
	    	searchCustomer(request.term, response);
	    },
	    minLength: 1,
	    select: function( event, ui ) {
	    	event.preventDefault();
	    	var driver = makeDriverItem(ui.item.label, ui.item.value)
	    	$('#additional_driver').val('');
			$('#additional_driver_container').append(driver);
	    }
    });

	// submit the dialog to create a new customer
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

			if($('#add_customer_dialog_type').val() === 'additional_driver'){
				// At this point we know that the user is trying to add an additional driver
				var driver = makeDriverItem(response.data.data.fullname, response.data.data.id)

				$('#additional_driver_container').append(driver);
			} else {
				// At this point we know that the user is trying to add/change primary driver
				// Set the new created record as the primary driver
				$('#primary_driver').data('ui-autocomplete')._trigger('select', 'autocompleteselect', { 
					item: { 
						value: response.data.data.id, 
						label: response.data.data.fullname
					}
				});
			}

			// Close the new customer dialog
			$('#add_customer_dialog').modal('hide');
			resetAddCustomerDialog();
			
		}).catch(error => {
			$('#customer_dialog_error_placeholder').text('Something unexpected happen while trying to get the selected vehicle info!')
												   .removeClass('hidden');
		    console.log(error);
		});		
	});

	// Resets the create_customer_form
	function resetAddCustomerDialog()
	{
		$('#create_customer_form')[0].reset();
		$('#customer_dialog_error_placeholder').text('').addClass('hidden');
	}
	// Creates an item for additional driver
	function makeDriverItem(name, id)
	{
		var newDriver = $('<li class="list-group-item list-group-item-info pt-5 pb-5 clearfix">' + 
                  name +
                  '   <div class="btn btn-xs btn-danger pull-right remove-additional-driver">' +
                  '       <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>' +
                  '   </div>' +
                  '   <input type="hidden" name="additional_drivers[]" value="' + id + '">' +
                  '</li>');

		return newDriver;
	}
	// Make an AJAX call to the customer search api
	// when the request is successfully returned, the
	// found customers are passed to the callback function
	function searchCustomer(term, callback)
	{
		$.ajax({
        	url: route('api.customers.customer.find', { 'term': term }),
        	dataType: "jsonp",
        	data: {
            	term: term
        	},
        	success: function( request ) {
	          	if(request.status !== 'success') {
	          		return;
	          	}

	          	callback(request.data);		          	
            }
        });
	}

	// Resets all the reservation total
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