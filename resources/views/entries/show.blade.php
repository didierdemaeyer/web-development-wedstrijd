@extends('layouts.master')

@section('title', 'Photo by ' . $photo->user->firstname)

@section('content')
  <div id="entries-container">

    <div class="entry entry-show container">
      <h1 class="big">
        Photo by {{ $photo->user->firstname }}
        <div class="info">
          @if($photo->isFromCurrentPeriod())
            <span class="like{{ (\Auth::check() && $photo->isLikedByUser(\Auth::user())) ? ' liked' : '' }}" data-photo-id="{{ $photo->id }}"></span>
          @endif
          <span class="likes">{{ count($photo->likes) }} {{ count($photo->likes) == 1 ? 'Like' : 'Likes' }}</span>
        </div>
      </h1>

    </div>

    <img class="photo" src="{{ asset($photo->url) }}">

  </div>
@stop