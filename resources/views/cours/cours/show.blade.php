@extends('defaultEnseignant')

@section('content')
<h1>{{$cours['name']}}</h1>
<div class="row">
<p><button id="btnExos" class="btn btn-primary" href="{{ route('classes.create') }}">Ajout Exercice <i class="fa fa-plus" style="position:relative;z-index:99"></i></button></p>
</div>
<h2>Contenu du cours</h2>
<p>{{$cours['content']}}</p>
<h2>Les exercices enregistrés</h2>
@forelse($exercices as $exo)
<p>{{$exo['titre']}}</p>
@empty
@endforelse
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Ajouter un exercice </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
  
                    <form id="formRegister" class="form-horizontal" role="form" method="POST" action="{{ route('exercices.store') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
  
                        <div class="form-group{{ $errors->has('titre') ? ' has-error' : '' }}">
                          {!!Form::label('label', 'Titre') !!}
                          {!!Form::text('titre', null, ['class' => 'form-control','placeholder'=>"Titre de l'exercice"]) !!}
                          @if ($errors->has('titre'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('titre') }}</strong>
                              </span>
                           @endif
                        </div>
  
                        <div class="form-group{{ $errors->has('enonce') ? ' has-error' : '' }}">
                          {!!Form::label('label', 'Enoncé') !!}
                          {!! Form::textarea('enonce', null, ['class' => 'field']) !!}
                          @if ($errors->has('enonce'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('enonce') }}</strong>
                              </span>
                           @endif
                        </div>  
                        
                        <div class="form-group{{ $errors->has('typeRep') ? ' has-error' : '' }}">
                          {!!Form::label('label', 'Type Réponse') !!}
                           {!!Form::select('typeRep', [
                            'unique' => 'Unique',
                            'qcm' => 'QCM'],'qcm',['class' => 'field','id' => 'typeRep']
                          ) !!}
                          @if ($errors->has('typeRep'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('typeRep') }}</strong>
                              </span>
                           @endif
                        </div>  
                          <div class="form-group{{ $errors->has('reponse') ? ' has-error' : '' }}">
                            {!!Form::label('label', 'Réponse') !!}
                            {!!Form::text('reponse', null, ['class' => 'form-control','placeholder'=>"Réponse de l'énoncé"]) !!}
                            @if ($errors->has('reponse'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('reponse') }}</strong>
                                </span>
                            @endif
                          </div>
                        <div id="rep_qcm" style="display:none">
                        <div class="form-group{{ $errors->has('choix2') ? ' has-error' : '' }}">
                            {!!Form::label('label', 'Choix 2') !!}
                            {!!Form::text('choix2', null, ['class' => 'form-control','placeholder'=>"choix 2 de l'énoncé"]) !!}
                            @if ($errors->has('choix2'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('choix2') }}</strong>
                                </span>
                            @endif
                          </div>
                          <div class="form-group{{ $errors->has('choix3') ? ' has-error' : '' }}">
                            {!!Form::label('label', 'Choix 3') !!}
                            {!!Form::text('choix3', null, ['class' => 'form-control','placeholder'=>"choix 3 de l'énoncé"]) !!}
                            @if ($errors->has('choix3'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('choix3') }}</strong>
                                </span>
                            @endif
                          </div>
                          <div class="form-group{{ $errors->has('choix4') ? ' has-error' : '' }}">
                            {!!Form::label('label', 'Choix 4') !!}
                            {!!Form::text('choix4', null, ['class' => 'form-control','placeholder'=>"Choix 4 de l'énoncé"]) !!}
                            @if ($errors->has('choix4'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('choix4') }}</strong>
                                </span>
                            @endif
                          </div>
                        </div>
                        {{ Form::hidden('idCours', $cours['id']) }}
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Ajoute ton fucking exo
                                </button>
                            </div>
                        </div>
                    </form>                       
  
                </div>
            </div>
        </div>
@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function(){
  $('#btnExos').on('click',function(){
    $('#myModal').modal();
  });
  $('#typeRep').on('change',function(){
    if($(this).val()=='qcm'){
      $('#rep_qcm').show();
    }
    else{
       $('#rep_qcm').hide();
    }
  });
});
</script>
@endsection