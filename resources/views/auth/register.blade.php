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
        <div class="form-group{{ ($errors->has('firstname') ? ' has-error' : '') }}">
          <label for="firstname">First name <span class="required" title="Required">*</span></label>
          {!! Form::text('firstname', null, ['id' => 'firstname', 'class' => 'form-control', 'placeholder' => 'First name', 'required']) !!}
          @if ($errors->has('firstname'))
            @foreach($errors->get('firstname') as $error)
              <p class="error">{{ $error }}</p>
            @endforeach
          @endif
        </div>
        <div class="form-group{{ ($errors->has('lastname') ? ' has-error' : '') }}">
          <label for="lastname">Last name <span class="required" title="Required">*</span></label>
          {!! Form::text('lastname', null, ['id' => 'lastname', 'class' => 'form-control', 'placeholder' => 'Last name', 'required']) !!}
          @if ($errors->has('lastname'))
            @foreach($errors->get('lastname') as $error)
              <p class="error">{{ $error }}</p>
            @endforeach
          @endif
        </div>
        <div class="form-group{{ ($errors->has('email') ? ' has-error' : '') }}">
          <label for="email">Email address <span class="required" title="Required">*</span></label>
          {!! Form::email('email', null, ['id' => 'email', 'class' => 'form-control', 'placeholder' => 'Email', 'required']) !!}
          @if ($errors->has('email'))
            @foreach($errors->get('email') as $error)
              <p class="error">{{ $error }}</p>
            @endforeach
          @endif
        </div>
        <div class="form-group{{ ($errors->has('password') ? ' has-error' : '') }}">
          <label for="password">Password <span class="required" title="Required">*</span></label>
          {!! Form::password('password', ['id' => 'password', 'class' => 'form-control', 'placeholder' => 'Password', 'required']) !!}
          @if ($errors->has('password'))
            @foreach($errors->get('password') as $error)
              <p class="error">{{ $error }}</p>
            @endforeach
          @endif
        </div>
        <div class="form-group{{ ($errors->has('confirm_password') ? ' has-error' : '') }}">
          <label for="confirm_password">Confirm password <span class="required" title="Required">*</span></label>
          {!! Form::password('confirm_password', ['id' => 'confirm_password', 'class' => 'form-control', 'placeholder' => 'Confirm password', 'required']) !!}
          @if ($errors->has('confirm_password'))
            @foreach($errors->get('confirm_password') as $error)
              <p class="error">{{ $error }}</p>
            @endforeach
          @endif
        </div>
        <div class="form-group">
          <label for="address">Address</label>
          {!! Form::text('address', null, ['id' => 'address', 'class' => 'form-control', 'placeholder' => 'Address']) !!}
        </div>
        <div class="form-group">
          <label for="postcode">Postcode</label>
          {!! Form::text('postcode', null, ['id' => 'postcode', 'class' => 'form-control', 'placeholder' => 'Postcode']) !!}
        </div>
        <div class="form-group">
          <label for="city">City</label>
          {!! Form::text('city', null, ['id' => 'city', 'class' => 'form-control', 'placeholder' => 'City']) !!}
        </div>
        <div class="form-group">
          <label for="country">Country</label>
          <select name="country" id="country" class="form-control">
            <option value="" disabled selected>Select your country</option>
            @foreach($countries as $country)
              <option value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
          </select>
        </div>

        <button type="submit" class="btn btn-default btn-submit">Register</button>
      {!! Form::close() !!}

      <hr>

      <p>Already have an account? <a href="{{ route('auth.login') }}">Log in</a></p>
    </div>

  </div>
@stop