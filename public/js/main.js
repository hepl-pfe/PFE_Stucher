jQuery( function($) {
	// GÉRER LA PÉRIODE
	/*$( '#datepicker_start' ).datepicker(
		{
			language: 'fr',
			dateFormat: 'yy-mm-dd',
			minDate: 0,
		}
	);

	$( '#datepicker_end' ).datepicker(
		{
			language: 'fr',
			dateFormat: 'yy-mm-dd',
			minDate: 0,
		}
	);


	$('#start_hours').timepicker(
	 {
	 	language: 'fr',
	 	step: 15,
	 	'minTime': '7:00am',
	 	'maxTime': '5:00pm'
	 }
	);
	$('#end_hours').timepicker(
	 {
	 	language: 'fr',
	 	step: 15,
		'maxTime': '71:3amm',
		'maxTime': '75:3apm'
	 }
	);*/

	// // AJAX

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
		$.get( "/course/"+valeur+"/seance", function( data ) {
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


	///////////
	// UnChecked the button checked on click on the PageContainer
	///////////
	$('.pageContainer').click(function(e) {
		if ( $('#menuToggle')['0'].checked == true ) {
			$('#menuToggle')['0'].checked = false;
		}
		if ( $('#dd_moreButton')['0'].checked == true ) {
			$('.menuToggle').click(function() {
				$('#dd_moreButton')['0'].checked = false;
			} );
			if( ( (e.target).parentNode ).className != 'dd_moreButton' ) {
				$('#dd_moreButton')['0'].checked = false;
			}
		}
		if ( $('#dd_moreButton')['0'].checked == false ) {
			//console.log(e);
			if (e.target.className == "dd_moreButton--button") {
				//console.log('ok');
			}
		}
	});

	///////////
	// reduce the active shutter & show when an anchor isset
	///////////
	$('.shutterTitle--works, .shutterTitle--tests').addClass( 'reduce' );

	// < show when an anchor isset
	if( window.location.hash ) {
		var hash = window.location.hash.substring(1);
		if($.inArray( hash, shutters ) ) {
			$('#'+hash).toggleClass( 'reduce' );
		}
		// hash found
	} else {
		// No hash found
	}

	var shutters = [];

	$('.shutterTitle').each(function() {
		if( $(this).attr('id') != 'comments' ) {
			shutters.push( $(this).attr('id') );
		}
	});

	// show when an anchor isset >

	$('.shutterTitle').click(function(e) {;
		$(e.target).toggleClass( 'reduce' );
	});
	$('.shutterTitle span').click(function(e) {;
		$(e.target.parentNode).toggleClass( 'reduce' );
	});

	///////////
	// automatic send comment on enter touch
	///////////
	$('.comment__box--textarea').keypress( function(e){
		if (e.shiftKey) {
			// Aucune action si shit est enfoncé
		} else {
			if(e.keyCode == 13 ) {
				e.preventDefault();
				$( this).parents( 'form').submit();
			}
		}
	} );

	///////////
	// change the preview image
	///////////
	// À AMÉLIORER
	/*$('#image').change( function(e){
		readPath(this);
		//$('.box__profilImage').attr( 'src',  );
	} );

	function readPath(input) {
		if ( input.files && input.files[0] ) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('.box__profilImage').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}*/



	///////////
	// HomePage
	///////////
	$(function() {
		$('a[href*="#"]:not([href="#"])').click(function() {
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
				if (target.length) {
					$('html, body').animate({
						scrollTop: target.offset().top
					}, 1000);
					return false;
				}
			}
		});
	});


} );