@extends('defaultEnseignant')
@section('content')
<h1>Mes classes</h1>
@foreach($classes as $classe)
<p><a href="{{route('classes.show',$classe->id)}}">{{$classe->nom}}</a></p>
@endforeach
@endsection