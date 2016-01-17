@if(count($errors))
	<ul>
		@foreach($errors->all() as $error)
			<li class="alert alert-danger fade in">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Oups&nbsp;! </strong>{!! $error !!}
			</li>
		@endforeach
	</ul>
@endif