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
		var the_js_months = 
		{ 
			"01" : "January", 
			"02" : "February", 
			"03": "March", 
			"04": "April", 
			"05": "May", 
			"06": "June", 
			"07": "July", 
			"08": "August", 
			"09": "September", 
			"10": "October", 
			"11": "November", 
			"12": "December"
		};
		var the_fr_months = 
		{ 
			"01" : "janvier", 
			"02" : "février", 
			"03": "mars", 
			"04": "avril", 
			"05": "mai", 
			"06": "juin", 
			"07": "juillet", 
			"08": "aout", 
			"09": "septembre", 
			"10": "octobre", 
			"11": "novembre", 
			"12": "décembre"
		};
		var the_fr_days = 
		[
			"Dimanche",
			"Lundi",
			"Mardi",
			"Mercredi",
			"Jeudi",
			"Vendredi",
			"Samedi"
		];
		$.get( "/courses/"+valeur+"/seances", function( data ) {
			$('#seance').children().remove();
			for( var i = 0; i < data.length; i++ ) {
				var the_date = data[i].start_hours,
					the_year = data[i].start_hours.substring(0, 4),
					the_month = data[i].start_hours.substring(5, 7),
					the_day = data[i].start_hours.substring(8, 10),
					the_hours = data[i].start_hours.substring(11, 13),
					the_end_hours = data[i].end_hours.substring(11, 13),
					the_minutes = data[i].start_hours.substring(14, 16),
					the_end_minutes = data[i].end_hours.substring(14, 16),
					the_jdDate = new Date( the_js_months[the_month] + " " + the_day + ", " + the_year + " " + the_hours + ":" + the_minutes + ":00" ),
					the_number_day = the_jdDate.getDay();
                $('#seance')
                    .append('<option value="'+data[i].id+'">'+"Séance du " + the_fr_days[the_number_day] + " " + the_day + " " + the_fr_months[the_month] + " " + the_year + " de " + the_hours + "h" + the_minutes + " à " + the_end_hours + "h" + the_end_minutes+'</option>');
                $('#seance').fadeIn();
			}
		});
	} );


	// CALENDAR :
	$(document).ready(function() {
		var currentLangCode = 'fr';

		// build the language selector's options
		$.each($.fullCalendar.langs, function(langCode) {
			$('#lang-selector').append(
				$('<option/>')
					.attr('value', langCode)
					.prop('selected', langCode == currentLangCode)
					.text(langCode)
			);
		});

		// rerender the calendar when the selected option changes
		$('#lang-selector').on('change', function() {
			if (this.value) {
				currentLangCode = this.value;
				$('#calendar').fullCalendar('destroy');
				renderCalendar();
			}
		});

		function renderCalendar() {
			$('#calendar').fullCalendar({
				defaultView: 'agendaWeek',
				allDaySlot: false,
				minTime: "07:00:00",
				maxTime: "18:00:00",
				height: "auto",
				header: {
					left: 'prev,next today',
					center: 'title',
					right: ''
				},
				slotLabelFormat: 'H:mm',
				defaultDate: '2015-12-12',
				lang: currentLangCode,
				buttonIcons: false, // show the prev/next text
				weekNumbers: true,
				editable: true, // IF STUDENT = FALSE & IF TEACHER = TRUE
				eventLimit: true, // allow "more" link when too many events
				events: [
					{
						id: 999,
						title: 'Repeating Event',
						start: '2015-12-09T16:12:00',
						end: '2015-12-09T17:00:00'
					}
				]
			});
		}

		renderCalendar();
	});

} );