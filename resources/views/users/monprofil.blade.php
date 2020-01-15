@extends('default')
@section('content')
<h1>Mon profil</h1>
<h2>Binvenue {{$eleve['prenom']}}</h2>
<h3>Informations personnelles</h3>
<p>nom : {{$eleve['nom']}}</p>
<p>prénom : {{$eleve['prenom']}}</p>
<p>email : {{$eleve['email']}}</p>
@endsection