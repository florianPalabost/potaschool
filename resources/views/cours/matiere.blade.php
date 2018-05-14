@extends('default')

@section('content')
    <h1>{{$title}}</h1>
    <p>
      Voici la liste actuelle des matières disponibles :
    </p>
    <ul>
      @forelse($list as $matiere)
        <li>{{$matiere->name}}</li>
      @empty
        <li>Aucune Matière</li>
      @endforelse
    </ul>
@endsection

@section('title')
  PotaSchool - Matières
@endsection
