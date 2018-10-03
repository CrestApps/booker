
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import 'jquery-ui/ui/widgets/autocomplete.js';

window.validator = require('jquery-validation');
window.moment = require('moment-timezone');
window.datetimepicker = require('../../../bower_components/eonasdan-bootstrap-datetimepicker/src/js/bootstrap-datetimepicker.js');
window.print = require('../../../bower_components/jQuery.print/dist/jQuery.print.min.js');


require('./settings');
require('./helpers');
require('./global_setters');
require('./add_reservation');
require('./pickup_reservation');
require('./create_maintenance_records');
require('./credits');
require('./print_contract')

$(function(){

    // add the flip class when the language is right-to-left
    var dir = $('html').first().data('dir') || 'ltr';
    if(dir == 'rtl') {
        $('.pull-right, .pull-left').addClass('flip');
    }

    $('#GlobalLanguagesMenu').change(function() {
        $('#GlobalLanguagesForm').submit();
    });

    // Add required attribute for every control with the required class
    $('form').each(function(index, item){
        var form = $(item);
        form.validate();

        form.find(':input.required').each(function(i, inp){
            var input = $(inp);
            input.attr('required', true);
        });
    });

    // sends the uploaded file file to the fielselect event
    $(document).on('change', ':file', function() {
        var input = $(this);
        var label = input.val().replace(/\\/g, '/').replace(/.*\//, '');

        input.trigger('fileselect', [label]);
    });

    // Set the label of the uploaded file
    $(':file').on('fileselect', function(event, label) {
        $(this).closest('.uploaded-file-group').find('.uploaded-file-name').val(label);
    });
    
    // Deals with the upload file in edit mode
    $(document).on('change', '.custom-delete-file:checkbox', function(e){
        var self = $(this);
        var container = self.closest('.input-width-input');
        var display = container.find('.custom-delete-file-name');
        var flag = container.find('.custom-delete-flag:checkbox');

        if (self.is(':checked')) {
            display.wrapInner('<del></del>');
            flag.prop('checked', true);
        } else {
            var del = display.find('del').first();
            if (del.is('del')) {
                flag.prop('checked', false);
                del.contents().unwrap();
            }
        }
    }).change();
    /*
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    */

    $('#globalLogOut').click(function(e){
    	e.preventDefault();
		$('#globalLogOutForm').submit();
    });
});