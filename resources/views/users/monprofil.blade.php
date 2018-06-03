@extends($user['type']=="enseignant" ? 'defaultEnseignant' : 'defaultEleve')
@section('content')
<h1>Mon profil</h1>
<h2>Bienvenue {{$user['prenom']}}</h2>
<h3>Informations personnelles</h3>
<p>nom : {{$user['nom']}}</p>
<p>prénom : {{$user['prenom']}}</p>
<p>email : {{$user['email']}}</p>
@if(strcmp($user['type'],'eleve')==0)
<a href="{{route('testDepart')}}" class="btn btn-info">Test Départ</a>
@endif
@endsection