@extends('defaultEnseignant')
@section('content')
<h1>Mes classes</h1>
<div class="row">
        <p><a class="btn btn-primary" href="{{ route('classes.create') }}">Ajouter une classe <i class="fas fa-plus"></i></a></p>
    </div>
@foreach($classes as $classe)
<p><a href="{{route('classes.show',$classe->id)}}">{{$classe->nom}}</a></p>
@endforeach
@endsection