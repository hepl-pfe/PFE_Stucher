@extends('layout')
@section('title', 'Nouveau message')
@section('content')

	<form method="POST" action="">
        {!! csrf_field() !!}

        <div class="form-group">
            <label for="sendto">À</label>
            <input type="text" class="form-control" disabled="disabled" value="Rémy Martins">
        </div>

        <div class="form-group">
            <label for="objet">Objet du message</label>
            <input class="form-control" disabled="disabled" type="text" name="objet" id="objet" value="Re: petite question">
        </div>

        <div class="form-group">
            <label for="message">message</label>
            <textarea class="form-control" placeholder="Entrez le contenu du message ici" name="message" id="message" cols="30" rows="10"></textarea>
        </div>

        <div class="form-group">
            <button class="btn btn-default" type="submit">Envoyer le message</button>
        </div>
        
    </form>

@endsection
