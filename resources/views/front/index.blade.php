@extends(session('user')['type']=="enseignant" ? 'defaultEnseignant' : 'defaultEleve')
@section('content')
<div class="row">

</div>
<div class="row">
  <div class="col-md-6">
    <p><img class="img-fluid" src="{{asset('resources/assets/images/garden.png')}}" alt=""></p>
  </div>
  <div class="col-md-6">
  @if (!(Auth::check()))
    <h2>Se connecter</h2>
    {!! Form::open(['route' => 'login', 'method' => 'post']) !!}
    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
      <label for="email" class="col-md-4 control-label">E-Mail</label>
      <div class="col-md-6">
          <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
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
      <div class="col-md-8 col-md-offset-4">
        <button type="submit" class="btn btn-primary">
          Se connecter
        </button>
      </div>
    </div>
    {!! Form::close() !!}
    @else
    <p>Vous êtes déjà connecté</p>
    @endif
  </div>
</div>
@endsection
@section('css')
<style>
body{
  background-image: url("{{asset('resources/assets/images/frontbackground.jpg')}}");
}
</style>
@endsection