@extends('defaultEnseignant')
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
<div class="form-group{{ $errors->has('statut') ? ' has-error' : '' }}">
    {!! Form::label('label', 'Statut*') !!}
    {!! Form::select('statut', [
   'public' => 'Public',
   'prive' => 'Privé',
    ]
) !!}
    @if ($errors->has('statut'))
        <span class="help-block">
        <strong>{{ $errors->first('statut') }}</strong>
    </span>
    @endif
</div>
<div class="form-group{{ $errors->has('nom') ? ' has-error' : '' }}">
    {!!Form::label('label', 'Niveau*') !!}
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

    {!! Form::hidden('responsable', $user->id) !!}
    <button class="btn btn-primary" id="btnEnvoyer">Ajouter</button>
    {!! Form::close() !!}
</div>

@endsection