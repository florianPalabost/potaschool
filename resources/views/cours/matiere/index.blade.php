@extends('default')

@section('content')
  <h1>{{$title}}</h1>
  <p><a class="btn btn-primary" href="{{route('newMatiere')}}">Ajout Matière</a></p>
  <div class="card-columns">
  @forelse($list as $matiere)
  <div class="card ">
    <div class="card-header bg-primary text-white"><a class="text-white" href="{{route('seeMatiere',$matiere)}}"><h2>{{$matiere->name}}</a></h2></div>
  </div>
  @empty
    <h2>Aucune Matière</h2>
  @endforelse
  </div>
@endsection

@section('title')
  PotaSchool - Matières
@endsection
