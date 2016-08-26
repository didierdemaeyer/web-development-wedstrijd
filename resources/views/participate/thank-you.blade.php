@extends('layouts.master')

@section('title', 'Thank you for participating')

@section('content')
  <div id="participate-container">

    <div class="form-container">
      <h1 class="big">Thank you for participating</h1>

      <p>View your photo: <a href="{{ route('entries.show', session('photo_id')) }}">Link</a></p>

    </div>
  </div>
@stop