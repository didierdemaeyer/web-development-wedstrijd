@extends('layouts.master')

@if(Request::is('entries/popular'))
  @section('title', 'Popular entries - Photo Contest')
@elseif(Request::is('entries/latest'))
  @section('title', 'Latest entries - Photo Contest')
@else
  @section('title', 'Oldest entries - Photo Contest')
@endif

@section('content')
  <div id="entries-container">
    <header id="entries-header">

      <div class="overlay">
        <div class="call-to-action">
          <p>Share a beautiful landscape.</p>
          <button class="btn btn-cta"><a href="{{ route('participate') }}">Submit Photo</a></button>
        </div>
      </div>

    </header>

    <div class="sort-entries">
      <a {{ (Request::is('entries/popular') ? 'class=active' : '') }} href="{{ route('entries.popular') }}">Popular</a>
      <a {{ (Request::is('entries/latest') ? 'class=active' : '') }} href="{{ route('entries.latest') }}">Latest</a>
      <a {{ (Request::is('entries/oldest') ? 'class=active' : '') }} href="{{ route('entries.oldest') }}">Oldest</a>
    </div>

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
