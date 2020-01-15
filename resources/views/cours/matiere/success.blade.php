@extends('default')

@section('content')
    <h1>{{$title}}</h1>
    <p>
        <a class="btn btn-primary" href="{{action('Cours\MatiereController@get',['id'=>$matiere->id])}}">
            Allez à {{$matiere->name}}
        </a>
    </p>
@endsection

@section('title')
  PotaSchool - {{$title}}
@endsection
