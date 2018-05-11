@extends($user['type']=="enseignant" ? 'defaultEnseignant' : 'defaultEleve')
@section('content')
<h1>Mon profil</h1>
<h2>Binvenue {{$user['prenom']}}</h2>
<h3>Informations personnelles</h3>
<p>nom : {{$user['nom']}}</p>
<p>prénom : {{$user['prenom']}}</p>
<p>email : {{$user['email']}}</p>
@endsection