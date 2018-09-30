$(function(){

	//Set the any element with the timezone-id class to current timezone id.
    var timezoneId = $('.timezone-id');
    if(timezoneId.length) {
        timezoneId.val(window.moment.tz.guess());
    }

    //Set the any element with the timezone-id class to current timezone id.
    var timezoneoffset = $('.timezone-offset');
    if(timezoneoffset.length) {
        timezoneoffset.val(moment().utcOffset());
    }
    
    // Set the validator style
    $.validator.setDefaults({
        errorElement: "span",
        errorClass: "help-block",
        ignore: ":hidden:not('.force-validaion'), .ignore",
        highlight: function (element, errorClass, validClass) {
            $(element).closest('.form-group,.error-wrapper').addClass('has-error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).closest('.form-group,.error-wrapper').removeClass('has-error');
        },
        errorPlacement: function (error, element) {
            if (element.parent('.input-group').length) 
            {
                error.insertAfter(element.parent());
            } else if(element.prop('type') === 'checkbox' || element.prop('type') === 'radio')
            {
                error.appendTo(element.closest(':not(input, label, .checkbox, .radio)').first());
            } else 
            {
                error.insertAfter(element);
            }
        }
    });

    // Initilize datetime picker
    $(document).on('focus', '.datetime-picker', function(){
        $(this).datetimepicker({
            format: window.dateTimeFormat,
            useCurrent: false
        });
    });

    // Initilize date picker
    $(document).on('focus', '.date-picker', function(){
        $(this).datetimepicker({
            format: window.dateFormat,
            useCurrent: false
        });
    });

	// Initilize time picker
    $(document).on('focus', '.time-picker', function(){
        $(this).datetimepicker({
            format: window.timeFormatRead,
            useCurrent: false
        });
    });

    // Initilize month picker
    $(document).on('focus', '.month-picker', function(){
        $(this).datetimepicker({
            format: 'MM/YYYY',
            viewMode: 'months',
            useCurrent: false
        });
    });

    // Basic datetime selector using datetime-from and datetime-to classes
    //Start Picker
    $('.datetime-from').datetimepicker({
        format: window.dateTimeFormat,
        useCurrent: false
    }).on("dp.change", function (e) {
        $('.datetime-to').data("DateTimePicker").minDate(e.date);
    });


    $('.datetime-to').datetimepicker({
        format: window.dateTimeFormat,
        useCurrent: false
    }).on("dp.change", function (e) {
        $('.datetime-from').data("DateTimePicker").maxDate(e.date);
    });


    ///// Basic date selector using date-from and date-to classes
    //Start Picker
    $('.date-from').datetimepicker({
        format: window.dateFormat,
        useCurrent: false
    }).on("dp.change", function (e) {
        $('.date-to').data("DateTimePicker").minDate(e.date);
    });


    $('.date-to').datetimepicker({
            format: window.dateFormat,
            useCurrent: false
    }).on("dp.change", function (e) {
        $('.date-from').data("DateTimePicker").maxDate(e.date);
    });

    //Start Picker
    $('.time-from').datetimepicker({
        format: window.timeFormat,
        useCurrent: false
    }).on("dp.change", function (e) {
        $('.time-to').data("DateTimePicker").minDate(e.date);
    });


    $('.time-to').datetimepicker({
            format: window.timeFormat,
            useCurrent: false
    }).on("dp.change", function (e) {
        $('.time-from').data("DateTimePicker").maxDate(e.date);
    });
});
