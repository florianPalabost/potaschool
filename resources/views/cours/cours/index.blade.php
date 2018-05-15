@extends('default')

@section('content')
  <h1>{{$title}}</h1>
  <p><a class="btn btn-primary" href="{{route('cours.create')}}">Ajout Cours</a></p>
  <div class="card-columns">
  @forelse($cours as $item)
  <div class="card ">
    <div class="card-header bg-primary text-white"><a class="text-white" href="{{route('cours.show',$item)}}"><h2>{{$item->name}}</a></h2></div>
    @if($item->module)
    <div class="card-body">
      <h3>{{$item->module->name}}</h3>
      <p>{{$item->content}}</p>
    </div>
    @endif
    <div class="card-footer">
      <p><a class="btn btn-primary" href="{{route('cours.edit', $item)}}">Modifier</a></p>
    </div>
  </div>
  @empty
    <h2>Aucun Cours</h2>
  @endforelse
  </div>
@endsection

@section('title')
  PotaSchool - Modules
@endsection
