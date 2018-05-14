@extends('default')

@section('content')
  <h1>{{$title}}</h1>

  @forelse($modules as $module)
    <h2>{{$module->name}}</h2>
    <p><a class="btn btn-primary" href="{{route('module.edit', $module)}}"></a></p>
  @empty
    <h2>Aucun Module</h2>
  @endforelse
  <p><a class="btn btn-primary" href="{{route('module.create')}}">Ajout Module</a></p>


@endsection

@section('title')
  PotaSchool - Modules
@endsection
