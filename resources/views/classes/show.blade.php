@extends('defaultEnseignant')
@section('content')
<h1>{{$classe->niveau}} - {{$classe->nom}}</h1>
<p>statut : {{$classe->statut}}</p>
<h2>Liste des élèves</h2>

@endsection