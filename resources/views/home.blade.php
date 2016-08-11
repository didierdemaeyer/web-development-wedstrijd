@extends('layouts.master')

@section('content')
  <div id="home-container">
    <header>

      <div class="overlay">
        <div class="call-to-action">
          <p>Share a beautiful landscape and win The North Face equipment.</p>
          <button class="btn btn-cta"><a href="{{ route('participate') }}">Submit Photo</a></button>
          <div class="period-end"></div>
        </div>
      </div>

    </header>

    <h1>Latest entries</h1>

    <div class="entries-list">
      <div class="grid-sizer"></div>

      <div class="grid-item entry">
        <img src="" alt="">
        <div class="btn-like">Like</div>
      </div>
      <div class="grid-item entry"><img src="" alt=""></div>
      <div class="grid-item entry"><img src="" alt=""></div>
      <div class="grid-item entry"><img src="" alt=""></div>
      <div class="grid-item entry"><img src="" alt=""></div>
      <div class="grid-item entry"><img src="" alt=""></div>
      <div class="grid-item entry"><img src="" alt=""></div>
      <div class="grid-item entry"><img src="" alt=""></div>
      <div class="grid-item entry"><img src="" alt=""></div>
      <div class="grid-item entry"><img src="" alt=""></div>
    </div>
  </div>
@stop