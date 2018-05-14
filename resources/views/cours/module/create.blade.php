@extends('default')

@section('content')
  <h1>Ajout d'un module</h1>

  {!!Form::open(['url'=>route('module.store')])!!}
  <div class="form-group">
      {{ Form::label('name','Nom')}}
      {{ Form::text('name',"",['class'=>'form-control'])}}
  </div>
  <button class="btn btn-primary">Valider</button>
  {!!Form::close()!!}


@endsection

@section('title')
  PotaSchool - Ajout Module
@endsection
