jQuery( function($) {
	// GÉRER LA PÉRIODE
	$( '#datepicker_start' ).datepicker(
		{
			dateFormat: 'yy-mm-dd',
			minDate: 0,
		}
	);

	$( '#datepicker_end' ).datepicker(
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