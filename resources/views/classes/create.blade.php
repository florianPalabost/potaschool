@extends('default')
@section('content')
<h1>Création d'une classe</h1>
<div class="col-md-12">
{!!Form::open(['route' => 'classes.store','method'=>'POST']) !!}
<div class="form-group{{ $errors->has('nom') ? ' has-error' : '' }}">
    {!!Form::label('label', 'Nom*') !!}
    {!!Form::text('nom', null, ['class' => 'form-control','placeholder'=>"Nom de la classe"]) !!}
    @if ($errors->has('nom'))
        <span class="help-block">
        <strong>{{ $errors->first('nom') }}</strong>
    </span>
    @endif
</div>
<div class="form-group{{ $errors->has('nom') ? ' has-error' : '' }}">
    {!!Form::label('label', 'Rang*') !!}
    {!! Form::select('rang', [
   'cp' => 'CP',
   'ce1' => 'CE1',
   'ce2' => 'CE2']
) !!}
    @if ($errors->has('rang'))
        <span class="help-block">
        <strong>{{ $errors->first('rang') }}</strong>
    </span>
    @endif
    </div>

    {!! Form::hidden('invisible', 'secret') !!}
</div>


@endsection