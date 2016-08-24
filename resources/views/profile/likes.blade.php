@extends('layouts.master')

@section('title', 'My likes')

@section('content')
  <div id="profile-container">

    <h1 class="big">My likes</h1>

    <div class="entries-list">
      <div class="grid-sizer"></div>

      @foreach($likes as $like)
        <div class="grid-item entry" style="background-image: url({{ $like->url }})">
          <a href="{{ route('entries.show', $like->id) }}"></a>
        </div>
      @endforeach
    </div>

  </div>
@stop