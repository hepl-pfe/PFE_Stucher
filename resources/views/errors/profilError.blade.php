@if(count($errors))
<div class="alert alert-danger fade in">
	<ul>
		@foreach($errors->all() as $error)
			<li><strong>Oups&nbsp;! </strong>{!! $error !!}</li>
		@endforeach
	</ul>
</div>
@endif