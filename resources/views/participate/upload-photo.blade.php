@extends('layouts.master')

@section('title', 'Upload your photo')

@section('content')
  <div id="participate-container">

    <div class="form-container">
      <h1 class="big">Upload your photo</h1>

      {!! Form::open(['route' => 'participate.post', 'files' => true]) !!}
      <div class="form-group">
        <label for="photo">Photo (Max file size: 5MB, Accepted file types: JPEG, PNG, GIF)</label>
        {!! Form::file('photo', ['id' => 'photo', 'required']) !!}
      </div>

      <button type="submit" class="btn btn-default btn-submit">Submit</button>
      {!! Form::close() !!}
    </div>

  </div>
@stop