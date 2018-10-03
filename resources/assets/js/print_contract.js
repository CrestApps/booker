$(function(){
	
	$('.print-button').click(function(e){
		e.preventDefault();

		var id = $(this).data('target-print');
		$('.print-containers').addClass('hidden');
		$(id).removeClass('hidden'); //.addClass('visible-print-block');

		$(id).print();
	})

});