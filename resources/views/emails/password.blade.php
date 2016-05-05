<!-- resources/views/emails/password.blade.php -->
<i>Bonjour, {{$user->username}},</i>
<p>Ce mail a été envoyé suite à une demande de changement de mot de passe.</p>
<br>
<p>Si c'est bien le cas, cliquez sur ce lien : {{ url('password/reset/'.$token) }}.</p>
<p>Si vous n'avez pas demandez de changer de mot de passe, ne prennez pas en compte cet email.</p>
<br>
<p>Bonne journée,</p>
<br>
<i>L'équipe Stucher</i>