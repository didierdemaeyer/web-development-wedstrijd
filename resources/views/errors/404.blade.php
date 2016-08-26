@extends('layouts.master')

@section('title', '404 Page Not Found')

@section('content')

  <div id="error-page-container" class="container">

    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <h1 class="large">404 Page not found</h1>

        <p>Return to the <a href="{{ route('home') }}">homepage.</a></p>
      </div>
    </div>

  </div>

@stop