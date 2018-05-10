@extends('defaultEnseignant')
@section('content')
<h1>Tableau de bord</h1>
<div class="row">
    <p><a class="btn btn-primary" href="{{ route('classes.create') }}">Ajouter une classe <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></p>
</div>
@endsection