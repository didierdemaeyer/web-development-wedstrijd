@extends('layouts.master')

@section('title', 'Participate')

@section('content')
  <div id="participate-container">

    <div class="form-container">
      <h1 class="big">Stap 1: Registreer</h1>
      <h1 class="big">Stap 2: Upload je foto</h1>

      {!! Form::open(['route' => 'auth.login.post']) !!}
      <div class="form-group">
        <label for="email">Email address</label>
        {!! Form::email('email', null, ['id' => 'email', 'class' => 'form-control', 'placeholder' => 'Email']) !!}
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        {!! Form::password('password', ['id' => 'password', 'class' => 'form-control', 'placeholder' => 'Password']) !!}
      </div>

      <button type="submit" class="btn btn-default">Submit</button>
      {!! Form::close() !!}
    </div>

  </div>
@stop