@extends('default')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                <h1>Enregistrement</h1>
                </div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('nom') ? ' has-error' : '' }}">
                            <label for="nom" class="col-md-4 control-label">Nom</label>

                            <div class="col-md-6">
                                <input id="nom" type="text" class="form-control" name="nom" value="{{ old('nom') }}" required autofocus>

                                @if ($errors->has('nom'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nom') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('prenom') ? ' has-error' : '' }}">
                            <label for="prenom" class="col-md-4 control-label">Prénom</label>

                            <div class="col-md-6">
                                <input id="prenom" type="text" class="form-control" name="prenom" value="{{ old('prenom') }}" required autofocus>

                                @if ($errors->has('prenom'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('prenom') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Mot de Passe</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirmez le Mot de Passe</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">Vous êtes</label>

                            <div class="col-md-6">
                                {!! Form::select('type', ['eleve' => 'Elève', 'enseignant' => 'Enseignant'],null , ['class' => 'form-control','id' =>'typeUser']); !!}

                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('eleve') ? ' has-error' : '' }}" id="listClassesBlock" style="display:none">
                            <label for="eleve" class="col-md-4 control-label">Vous voulez rejoindre la classe</label>

                            <div class="col-md-6">
                                <select data-placeholder="Choisir la classe..."  class="chosen form-control" style="" tabindex="4" id="eleve" name="eleve">
                                    @foreach($classes as $key => $value)
                                        <option value="{{$value}}">{{$value}}</option>
                                     @endforeach
                                </select>

                                @if ($errors->has('eleve'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('eleve') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('mdp') ? ' has-error' : '' }}" id="mdpBlock" style="display:none">
                            <label for="mdp" class="col-md-4 control-label">Mot de passe</label>

                            <div class="col-md-6">
                                <input id="mdp" type="text" class="form-control" name="mdp">

                                @if ($errors->has('mdp'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mdp') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    S'enregistrer
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
$("#typeUser").on('change',function(){
    var val = $(this).val();
    if(val == "eleve"){
        console.log('eleve ok');
        $("#listClassesBlock").show();
        $("#listClassesBlock").on('change',function(){
            console.log('on est dans le select classe');
        });
        $("#mdpBlock").show();
    }
    else{
        $("#listClassesBlock").hide();
        $("#mdpBlock").hide();
    }
});
</script>
@endsection