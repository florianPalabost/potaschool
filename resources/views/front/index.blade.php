@extends('default')
@section('content')
<div class="row">
  <h1>PotaSchool</h1>
</div>
<div class="row">
  <div class="col-md-6">
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo quia ex magnam! Velit tempore ut libero, debitis odit ducimus voluptatibus sequi, voluptas quisquam tempora quo asperiores perspiciatis nam quas numquam.
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure, minus odit aut aperiam veniam, assumenda natus beatae dignissimos itaque animi facere facilis tenetur nemo eaque nostrum dolores consequuntur id iusto.
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam qui distinctio ad! Ratione esse, optio praesentium eum tempore numquam asperiores, cupiditate cumque consequatur laudantium non, unde libero dignissimos deserunt sunt.
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam asperiores error ullam temporibus necessitatibus impedit totam architecto corporis, recusandae soluta provident praesentium quod magni aliquid in vel repellat quos? Aut!
    </p>
  </div>
  <div class="col-md-6">
    <h2>Se connecter</h2>
    {!! Form::open(['route' => 'login', 'method' => 'post']) !!}
    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
      <label for="email" class="col-md-4 control-label">E-Mail Address</label>
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
        <label for="password" class="col-md-4 control-label">Password</label>
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
          Login
        </button>
      </div>
    </div>
    {!! Form::close() !!}
  </div>
</div>
@endsection