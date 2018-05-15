@extends('default')

@section('content')
  <h1>{{$title}}</h1>
  <p><a class="btn btn-primary" href="{{route('module.create')}}">Ajout Module</a></p>
  <div class="card-columns">
  @forelse($modules as $module)
  <div class="card ">
    <div class="card-header bg-primary text-white"><a class="text-white" href="{{route('module.show',$module)}}"><h2>{{$module->name}}</a></h2></div>
    @if($module->matiere)
    <div class="card-body">{{$module->matiere->name}}</div>
    @endif
    <div class="card-footer">
      <p><a class="btn btn-primary" href="{{route('module.edit', $module)}}">Modifier</a></p>
    </div>
  </div>
  @empty
    <h2>Aucun Module</h2>
  @endforelse
  </div>
@endsection

@section('title')
  PotaSchool - Modules
@endsection
