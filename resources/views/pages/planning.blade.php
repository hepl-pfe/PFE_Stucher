@extends('layout')
@section('title', $title)
@section('content')
	<h2>Mon planning&nbsp;:</h2>
	@if( Auth::user()->status == 1 )
		<div class="dropdown text-right">
			<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Ajouter
			<span class="caret"></span></button>
			<ul class="dropdown-menu dropdown-menu-right">
				<li><a href="{!! action( 'CoursesController@create' ) !!}">Un cours</a></li>
				<li><a href="{!! action( 'CoursesController@addWork' ) !!}">Un devoir</a></li>
				<li><a href="{!! action( 'CoursesController@addTest' ) !!}">Une interrogation</a></li>
				<li><a href="{!! action( 'CoursesController@addNews' ) !!}">Une notification</a></li>
			</ul>
		</div>
	@endif
	<ul class="pager">
		<li><a href="#">Semaine du 18 mai</a></li>
		<li><a href="#">Semaine du 02 juin</a></li>
	</ul>
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th colspan="6">Semaine du 25 mai (cette semaine)</th>
			</tr>
			<tr>
				<th>Heure</th>
				<th style="width: 20%;">Lundi</th>
				<th style="width: 20%;">Mardi</th>
				<th style="width: 20%;">Mercredi</th>
				<th style="width: 20%;">Jeudi</th>
				<th style="width: 20%;">Vendredi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>8h</th>
				<td>
					<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal1">Le cours de français est annulé</button>
					<!-- Modal -->
					<div id="myModal1" class="modal fade" role="dialog">
						<div class="modal-dialog">

							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Le cours de français est annulé</h4>
								</div>
								<div class="modal-body">
									<p>Absence du professeur</p>
									@if ( Auth::user()->status == 1 )
										<a class="btn btn-primary" href="">Modifier la notification</a>
										<a class="btn btn-danger" href="">Supprimer la notification</a>
									@endif
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
								</div>
							</div>
						</div>
					</div>
				</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<th>9h</th>
				<td></td>
				<td></td>
				<td>
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal2">Interrogation pour le cours de sciences</button>
					<!-- Modal -->
					<div id="myModal2" class="modal fade" role="dialog">
						<div class="modal-dialog">

							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Interrogation pour le cours de sciences</h4>
								</div>
								<div class="modal-body">
									<p>Cette interrogation couvre la matière du chapitre 4-5 et 6.</p>
									@if ( Auth::user()->status == 1 )
										<a class="btn btn-primary" href="">Modifier l'interrogation</a>
										<a class="btn btn-danger" href="">Supprimer l'interrogation</a>
									@endif
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
								</div>
							</div>
						</div>
					</div>
				</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<th>10h</th>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<th>11h</th>
				<td></td>
				<td></td>
				<td></td>
				<td>
					<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal3">Devoir pour le cours de Math</button>
					<!-- Modal -->
					<div id="myModal3" class="modal fade" role="dialog">
						<div class="modal-dialog">

							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Devoir pour le cours de Math</h4>
								</div>
								<div class="modal-body">
									<p>Pour ce travail, vous devrez faire tous les exercices de la page 4 du manuel.</p>
									@if ( Auth::user()->status == 1 )
										<a class="btn btn-primary" href="">Modifier le devoir</a>
										<a class="btn btn-danger" href="">Supprimer le devoir</a>
									@endif
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
								</div>
							</div>
						</div>
					</div>
				</td>
				<td></td>
			</tr>
			<tr>
				<th>12h</th>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<th>13h</th>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<th>14h</th>
				<td></td>
				<td>
					<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal4">Devoir pour le cours de Sciences</button>
					<!-- Modal -->
					<div id="myModal4" class="modal fade" role="dialog">
						<div class="modal-dialog">

							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Devoir pour le cours de Sciences</h4>
								</div>
								<div class="modal-body">
									<p>Pour ce travail, vous devrez créer une ligne du temps qui affichera l'évolution de l'espèce humaine depuis la préhistoire (dans les grandes étapes).</p>
									@if ( Auth::user()->status == 1 )
										<a class="btn btn-primary" href="">Modifier le devoir</a>
										<a class="btn btn-danger" href="">Supprimer le devoir</a>
									@endif
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
								</div>
							</div>
						</div>
					</div>
				</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<th>15h</th>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<th>16h</th>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<th>17h</th>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</tbody>
	</table>
@endsection