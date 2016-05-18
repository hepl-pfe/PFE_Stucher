jQuery( function($) {
	// GÉRER LA PÉRIODE

	$("#dtBox").DateTimePicker( {

		language: "fr",

		dateTimeFormat: "dd-MM-yyyy HH:mm",
		dateFormat: "dd-MM-yyyy",
		timeFormat: "HH:mm",

		shortDayNames: ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"],
		fullDayNames: ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"],
		shortMonthNames: ["jan", "fév", "mar", "avr", "mai", "jun", "jul", "aoû", "sep", "oct", "nov", "déc"],
		fullMonthNames: ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"],

		titleContentDate: "Choisir une date",
		titleContentTime: "Choisir un horaire",
		titleContentDateTime: "Choisir une date et un horaire",

		setButtonContent: "Choisir",
		clearButtonContent: "Effacer",
		formatHumanDate: function(oDate, sMode, sFormat)
		{
			if(sMode === "date")
				return oDate.dayShort + " " + oDate.dd + " " + oDate.month+ " " + oDate.yyyy;
			else if(sMode === "time")
				return oDate.HH + ":" + oDate.mm;
			else if(sMode === "datetime")
				return oDate.dayShort + " " + oDate.dd + " " + oDate.month+ " " + oDate.yyyy + ", " + oDate.HH + ":" + oDate.mm;
		},
		minuteInterval: 10,
		buttonsToDisplay: ["HeaderCloseButton", "SetButton"],
		setValueInTextboxOnEveryClick: true

	} );

	// // AJAX


	$("#course_seance").removeAttr( 'disabled' );

	$("#course_seance").change( function(){
		var select = document.getElementById("course_seance");
		var selected = document.getElementById("course_seance").selectedIndex;
		var valeur = select[selected].value;
		var the_js_months = 
		{ 
			"01" : "January", "02" : "February", "03": "March", "04": "April", "05": "May", "06": "June", "07": "July", "08": "August", "09": "September", "10": "October", "11": "November", "12": "December"
		};
		var the_fr_months = 
		{ 
			"01" : "janvier", "02" : "février", "03": "mars", "04": "avril", "05": "mai", "06": "juin", "07": "juillet", "08": "aout", "09": "septembre", "10": "octobre", "11": "novembre", "12": "décembre"
		};
		var the_fr_days = 
		[
			"Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"
		];
		$.get( "/course/"+valeur+"/seances/ajax", function( data ) {
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
                    .append('<option value="'+data[i].id+'">'+ the_fr_days[the_number_day] + " " + the_day + " " + the_fr_months[the_month] + " " + the_year + " de " + the_hours + "h" + the_minutes + " à " + the_end_hours + "h" + the_end_minutes+'</option>');
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
		$('#'+hash).toggleClass( 'reduce' );
		// hash found
	} else {
		// No hash found
	}

	$('.shutterTitle--comments').removeClass( 'reduce' );

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



	/////////////////////
	///// SWEET ALERT ///
	/////////////////////
	$( '.action__deleteCourse').click( function( e ){
		e.preventDefault();
		var course_url = e.currentTarget.href;

		swal({
			title: "Voulez vous vraiment supprimer ce cours?",
			text: "En supprimant ce cours, vous supprimerez tous les éléments liés à celui-ci (séances, interrogations, devoir, fichiers etc.)",
			showCancelButton: true,
			closeOnConfirm: false,
			confirmButtonText: "Oui, je supprime",
			cancelButtonText: "Non",
			confirmButtonColor: "#ec6c62"
		}, function() {
			$.ajax({
					type: "get",
					url: course_url
			})
			.done(function(data) {
				swal({
					title: "Supprimé!",
					text: "Le cours a correctement été supprimé!",
					type: "success"
				}, function() {
					window.location.href = '/';
				});
			})
			.error(function(data) {
				swal("Oops", "Une erreur s'est produite sur le serveur!", "error");
			});
		});

	} );



	$( '.action__deleteProfil').click( function( e ){
		e.preventDefault();
		var profil_url = e.currentTarget.href;

		swal({
			title: "Voulez vous vraiment supprimer votre compte?",
			text: "En supprimant votre compte, vous supprimerez tous les éléments liés à celui-ci (cours, séances, interrogations, devoir, fichiers etc.)",
			showCancelButton: true,
			closeOnConfirm: false,
			confirmButtonText: "Oui, je supprime",
			cancelButtonText: "Non",
			confirmButtonColor: "#ec6c62"
		}, function() {
			$.ajax({
					type: "get",
					url: profil_url
				})
				.done(function(data) {
					swal({
						title: "Supprimé!",
						text: "Votre compte a correctement été supprimé!",
						type: "success"
					}, function() {
						window.location.href = '/';
					});
				})
				.error(function(data) {
					swal("Oops", "Une erreur s'est produite sur le serveur!", "error");
				});
		});

	} );



	$( '.action__deleteSeance').click( function( e ){
		e.preventDefault();
		var profil_url = e.currentTarget.href;
		var course = e.currentTarget.getAttribute('data-course');

		swal({
			title: "Voulez vous vraiment supprimer Cette séance?",
			text: "En supprimant cette séance, vous supprimerez tous les éléments liés à celle-ci (interrogations, devoir, fichiers etc.)",
			showCancelButton: true,
			closeOnConfirm: false,
			confirmButtonText: "Oui, je supprime",
			cancelButtonText: "Non",
			confirmButtonColor: "#ec6c62"
		}, function() {
			$.ajax({
					type: "get",
					url: profil_url
				})
				.done(function(data) {
					swal({
						title: "Supprimé!",
						text: "La séance a correctement été supprimée!",
						type: "success"
					}, function() {
						window.location.href = '/course/'+course+'/view';
					});
				})
				.error(function(data) {
					swal("Oops", "Une erreur s'est produite sur le serveur!", "error");
				});
		});

	} );




	$( '.action__deleteWork').click( function( e ){
		e.preventDefault();
		var profil_url = e.currentTarget.href;
		var seance = e.currentTarget.getAttribute('data-seance');

		swal({
			title: "Voulez vous vraiment supprimer ce devoir?",
			text: "En supprimant ce devoir, vous supprimerez tous les fichiers liés à celui-ci",
			showCancelButton: true,
			closeOnConfirm: false,
			confirmButtonText: "Oui, je supprime",
			cancelButtonText: "Non",
			confirmButtonColor: "#ec6c62"
		}, function() {
			$.ajax({
					type: "get",
					url: profil_url
				})
				.done(function(data) {
					swal({
						title: "Supprimé!",
						text: "Le devoir a correctement été supprimé!",
						type: "success"
					}, function() {
						window.location.href = '/seance/'+seance+'/view';
					});
				})
				.error(function(data) {
					swal("Oops", "Une erreur s'est produite sur le serveur!", "error");
				});
		});

	} );




	$( '.action__deleteTest').click( function( e ){
		e.preventDefault();
		var profil_url = e.currentTarget.href;
		var seance = e.currentTarget.getAttribute('data-seance');

		swal({
			title: "Voulez vous vraiment supprimer cette interrogation?",
			text: "En supprimant cette interrogation, vous supprimerez tous les fichiers liés à celle-ci",
			showCancelButton: true,
			closeOnConfirm: false,
			confirmButtonText: "Oui, je supprime",
			cancelButtonText: "Non",
			confirmButtonColor: "#ec6c62"
		}, function() {
			$.ajax({
					type: "get",
					url: profil_url
				})
				.done(function(data) {
					swal({
						title: "Supprimé!",
						text: "L’interrogation a correctement été supprimée!",
						type: "success"
					}, function() {
						window.location.href = '/seance/'+seance+'/view';
					});
				})
				.error(function(data) {
					swal("Oops", "Une erreur s'est produite sur le serveur!", "error");
				});
		});

	} );




	// IF ACCESS ERROR
	function getquerystringParams () {
		var str = document.location.search;
		if ( str.charAt( 0 ) == '?' ) str = str.substring( 1 );
		var tab = str.split( '&' );
		var get = new Object();
		for ( var i=0; i < tab.length; i++ ) {
			var tab2 = tab[ i ].split( '=' );
			get[ tab2[ 0 ] ] = tab2[ 1 ];
		}
		return get;
	}

	qs = getquerystringParams(); //on appel la fonction
	if( qs['popupError'] ) //Verifie que la variable existe
	{
		if( qs['popupError'] == 'teacher' ) {
			swal("Oops...", "Il faut être professeur pour faire ça!", "error");
		}
		if( qs['popupError'] == 'userAccess' ) {
			swal("Oops...", "Vous n’avez pas les droits nécéssaire pour vous rendre là!", "error");
		}
		if( qs['popupError'] == 'logout' ) {
			swal("Oops...", "Vous devez être connecté pour vous rendre là!", "error");
		}
		if( qs['popupError'] == 'notCourse' ) {
			swal("Oops...", "Ce cours n’existe pas!", "error");
		}
		if( qs['popupError'] == 'notSeance' ) {
			swal("Oops...", "Cette séance n’existe pas!", "error");
		}
		if( qs['popupError'] == 'notWork' ) {
			swal("Oops...", "Ce devoir n’existe pas!", "error");
		}
		if( qs['popupError'] == 'notTest' ) {
			swal("Oops...", "Cette interrogation n’existe pas!", "error");
		}
		if( qs['popupError'] == 'notComment' ) {
			swal("Oops...", "Ce commentaire n’existe pas!", "error");
		}
		if( qs['popupError'] == 'commentAccess' ) {
			swal("Oops...", "Vous n’avez pas les droits nécéssaire supprimer ce commentaire!", "error");
		}
	}

} );