@extends('layouts.master')

@section('title', 'My likes')

@section('content')
  <div id="profile-container">

    <h1 class="big">My likes</h1>

    <div class="entries-list">
      <div class="grid-sizer"></div>

      @foreach($photos as $photo)
        <div class="grid-item entry" style="background-image: url({{ $photo->url }})">
          <a href="{{ route('entries.show', $photo->id) }}"></a>
          <div class="info">
            <span class="like{{ $photo->isLikedByUser(\Auth::user()) ? ' liked' : '' }}" data-photo-id="{{ $photo->id }}"></span>
            <span class="likes">{{ count($photo->likes) }} {{ count($photo->likes) == 1 ? 'Like' : 'Likes' }}</span>
          </div>
        </div>
      @endforeach
    </div>

  </div>
@stop