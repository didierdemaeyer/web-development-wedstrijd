@extends('layouts.master')

@section('title', 'Login')

@section('content')
  <div id="auth-container">

    <div class="form-container">
      <h1 class="big">Login</h1>

      <div class="social">
        <a href="{{ route('social.redirect', ['provider' => 'facebook']) }}" class="btn btn-block btn-social btn-facebook"><span class="fa fa-facebook"></span>Sign in with Facebook</a>
        <a href="{{ route('social.redirect', ['provider' => 'google']) }}" class="btn btn-block btn-social btn-google"><span class="fa fa-google"></span>Sign in with Google</a>
      </div>

      <hr class="or-line">

      {!! Form::open(['route' => 'auth.login.post']) !!}
        <div class="form-group">
          <label for="email">Email address <span class="required" title="Required">*</span></label>
          {!! Form::email('email', null, ['id' => 'email', 'class' => 'form-control', 'placeholder' => 'Email', 'required']) !!}
        </div>
        <div class="form-group">
          <label for="password">Password <span class="required" title="Required">*</span></label>
          {!! Form::password('password', ['id' => 'password', 'class' => 'form-control', 'placeholder' => 'Password', 'required']) !!}
        </div>

        <button type="submit" class="btn btn-default btn-submit">Log in</button>
      {!! Form::close() !!}

      <hr>

      <p>Don't have an account yet? <a href="{{ route('auth.register') }}">Register</a></p>
    </div>

  </div>
@stop