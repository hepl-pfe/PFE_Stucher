@extends( 'layout' )
	@section('title', $title)
    @section( 'content' )
    <h2><?php echo $title; ?></h2>
    <br>
    <a class="btn btn-success" href="">Récupérer un modèle existant</a>
    <br>
    <br>
	<form action="" method="post">
		<div class="form-group">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<label for="title">Ajouter le titre du devoir</label>
			<input type="text" class="form-control" name="title" id="title" placeholder="ex: Exercice de propabilité">
		</div>
		<div class="form-group">
            <label for="sendto">Pour quoi?</label>
            <select class="form-control" multiple="multiple" name="sendto" id="sendto" size="10">
            	<optgroup label="3TQ">
            		<option value="">Tous le groupe</option>
            		<option value="">David Lapin</option>
            		<option value="">Thomas Latour</option>
            		<option value="">Grégory Devis</option>
            	</optgroup>
            	<optgroup label="4TQ">
            		<option value="">Tous le groupe</option>
            		<option value="">Mélissa Neudo</option>
            		<option value="">Fanny Granjean</option>
            		<option value="">Kévin Delforge</option>
            	</optgroup>
            	<optgroup label="Par groupe">
            		<option value="">Tous mes groupes</option>
					<option value="">3TQ</option>
					<option value="">4TQ</option>
            	</optgroup>
            </select>
        </div>
		<div class="form-group">
			<label for="descr">Description du devoir</label>
			<textarea class="form-control" name="descr" id="descr" cols="30" rows="10" placeholder="ex: Pour ce travail, vous devez faire…"></textarea>
		</div>
		<div class="form-group">
			<label for="file">Fichier joins (facultatif - PDF, image ou Word)</label>
			<input type="file" id="file" name="file">
		</div>
		<div class="form-group">
			<label for="date">À rendre pour (date)</label>
			<select class="form-control" name="date" id="date">
            		<option value="">Le prochain cours</option>
            		<option value="">Le cours du 20 novembre</option>
            		<option value="">Le cours du 27 novembre</option>
            		<option value="">Le cours du 4 décembre</option>
            </select>
		</div>
		<div class="form-group text-center">
			<input type="submit" class="btn btn-primary" value="Créer le cours">
		</div>
	</form>
@stop