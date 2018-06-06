@extends('defaultEnseignant')

@section('content')
  <h1>{{$title}}</h1>
  <p><a class="btn btn-primary" href="{{route('module.create')}}">Ajout Module</a></p>
  <div class="card-columns">
  @forelse($modules as $module)
  <div class="card ">
    <div class="card-header bg-primary text-white"><a class="text-white" href="{{route('module.show',$module)}}"><h2>{{$module->nomModule}}</a></h2></div>
    @if($module->matiere)
    <div class="card-body">{{$module->matiere->name}}</div>
    @endif
    <div class="card-footer">
    <div class="row">
    <p><a class="btn btn-warning" href="{{route('module.edit', $module)}}"><i class="far fa-edit"></i></a></p>
      <div class="col-md-3">
            {!! Form::open(array('route' => array('module.destroy', $module->id), 'method' => 'delete')) !!}
            {!!Form::hidden('id',$module->id)!!}
            <button type="submit"  class="btn btn-danger" onclick="return confirm('Voulez vous vraiment supprimer ce module?');"><i class="far fa-trash-alt"></i></button>
            {!! Form::close() !!}
    </div>
    </div>

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
