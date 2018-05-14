@extends('defaultEnseignant')
@section('content')
<h1>{{$classe->niveau}} - {{$classe->nom}}</h1>
<p>statut : {{$classe->statut}}</p>
@if(strcmp($classe->statut,"prive")==0)
<p>Mot de passe : {{$classe->mdp}}</p>
@endif
<h2>Liste des élèves</h2>
<div class="row">
    <p><a class="btn btn-primary" href="{{ route('eleves.create') }}">Ajouter un élève <i class="fas fa-plus"></i></a></p>
</div>
@endsection