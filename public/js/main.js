jQuery( function($) {
	
	$( '#datepicker' ).datepicker(
		{
			dateFormat: 'yy-mm-dd',
			minDate: 0
		}
	);

	$.timepicker.regional['fr']
	$('#start_hours').timepicker(
	 {
	 	timeFormat: 'hh:mm',
	 	hourMin: 8,
	 	hourMax: 16,
	 }
	);
	$('#end_hours').timepicker(
	 {
	 	timeFormat: 'hh:mm',
	 	hourMin: 8,
	 	hourMax: 16,
	 }
	);
} );