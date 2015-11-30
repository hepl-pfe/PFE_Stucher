jQuery( function($) {
	
	$( '#datepicker' ).datepicker(
		{
			dateFormat: 'yy-mm-dd',
			minDate: 0,
		}
	);


	$('#start_hours').timepicker(
	 {
	 	hourMin: 7,
	 	hourMax: 17,
	 }
	);
	$('#end_hours').timepicker(
	 {
	 	hourMin: 7,
	 	hourMax: 17,
	 }
	);
} );