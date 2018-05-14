@extends('default')

@section('content')
  <h1>Edition</h1>

  {!!Form::open(['method'=>'put','url'=>route('module.update',$module)])!!}
  <div class="form-group">
      {{ Form::label('name','Nom')}}
      {{ Form::text('name',$module->name,['class'=>'form-control'])}}
  </div>
  <button class="btn btn-primary">Valider</button>
  {!!Form::close()!!}


@endsection

@section('title')
  PotaSchool - {{$module->name}}
@endsection
