@extends('layouts.master')

@section('title', 'Register')

@section('content')
  <div id="auth-container">

    <div class="form-container">
      <h1 class="big">Register</h1>

      <div class="social">
        <a href="{{ route('social.redirect', ['provider' => 'facebook']) }}" class="btn btn-block btn-social btn-facebook"><span class="fa fa-facebook"></span>Sign up with Facebook</a>
        <a href="{{ route('social.redirect', ['provider' => 'google']) }}" class="btn btn-block btn-social btn-google"><span class="fa fa-google"></span>Sign up with Google</a>
      </div>

      <hr class="or-line">

      {!! Form::open(['route' => 'auth.register.post']) !!}
        <div class="form-group">
          <label for="firstname">First name <span class="required" title="Required">*</span></label>
          {!! Form::text('firstname', null, ['id' => 'firstname', 'class' => 'form-control', 'placeholder' => 'First name', 'required']) !!}
        </div>
        <div class="form-group">
          <label for="lastname">Last name <span class="required" title="Required">*</span></label>
          {!! Form::text('lastname', null, ['id' => 'lastname', 'class' => 'form-control', 'placeholder' => 'Last name', 'required']) !!}
        </div>
        <div class="form-group">
          <label for="email">Email address <span class="required" title="Required">*</span></label>
          {!! Form::email('email', null, ['id' => 'email', 'class' => 'form-control', 'placeholder' => 'Email', 'required']) !!}
        </div>
        <div class="form-group">
          <label for="password">Password <span class="required" title="Required">*</span></label>
          {!! Form::password('password', ['id' => 'password', 'class' => 'form-control', 'placeholder' => 'Password', 'required']) !!}
        </div>
        <div class="form-group">
          <label for="confirm_password">Confirm password <span class="required" title="Required">*</span></label>
          {!! Form::password('confirm_password', ['id' => 'confirm_password', 'class' => 'form-control', 'placeholder' => 'Confirm password', 'required']) !!}
        </div>
        <div class="form-group">
          <label for="address">Address</label>
          {!! Form::text('address', null, ['id' => 'address', 'class' => 'form-control', 'placeholder' => 'Address']) !!}
        </div>
        <div class="form-group">
          <label for="city">City</label>
          {!! Form::text('city', null, ['id' => 'city', 'class' => 'form-control', 'placeholder' => 'City']) !!}
        </div>
        <div class="form-group">
          <label for="postcode">Postcode</label>
          {!! Form::text('postcode', null, ['id' => 'postcode', 'class' => 'form-control', 'placeholder' => 'Postcode']) !!}
        </div>
        <div class="form-group">
          <label for="country">Country</label>
          {!! Form::text('country', null, ['id' => 'country', 'class' => 'form-control', 'placeholder' => 'Country']) !!}
        </div>

        <button type="submit" class="btn btn-default">Register</button>
      {!! Form::close() !!}

      <p>Already have an account? <a href="{{ route('auth.login') }}">Log in</a></p>
    </div>

  </div>
@stop