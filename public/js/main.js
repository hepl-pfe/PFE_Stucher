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

	// AJAX

	$("#course").change( function(){
		var select = document.getElementById("course");
		var selected = document.getElementById("course").selectedIndex;
		var valeur = select[selected].value;
		$.get( "/courses/"+valeur+"/seances", function( data ) {
			$('#seance').children().remove();
			for( var i = 0; i < data.length; i++ ) {
                $('#seance')
                    .append('<option value="'+data[i].id+'">'+data[i].id+'</option>');
                $('#seance').fadeIn();
			}
		});
	} );

} );