@extends('default')

@section('content')
  <h1>{{$title}}</h1>
  @if($module->matiere)
  <div>{{$module->matiere->name}}</div>
  @endif
  <p><a class="btn btn-primary" href="{{route('module.edit', $module)}}">Modifier</a></p>  
  </div>
@endsection

@section('title')
  PotaSchool - Modules
@endsection
