@extends('layouts.master')

@if(Request::is('entries/popular'))
  @section('title', 'Popular entries')
@elseif(Request::is('entries/latest'))
  @section('title', 'Latest entries')
@else
  @section('title', 'Oldest entries')
@endif

@section('content')
  <div id="entries-container">
    <header id="entries-header">

      <div class="overlay">
        <div class="call-to-action">
          <p>Share a beautiful landscape.</p>
          <a class="btn btn-cta btn-default" href="{{ route('participate') }}">Upload photo</a>
        </div>
      </div>

    </header>

    <div class="sort-entries">
      Sort by:
      <a {{ (Request::is('entries/popular') ? 'class=active' : '') }} href="{{ route('entries.popular') }}">Most Popular</a>
      <a {{ (Request::is('entries/latest') ? 'class=active' : '') }} href="{{ route('entries.latest') }}">Latest</a>
      <a {{ (Request::is('entries/oldest') ? 'class=active' : '') }} href="{{ route('entries.oldest') }}">Oldest</a>
    </div>

    <div class="entries-list">
      <div class="grid-sizer"></div>

      @forelse($photos as $photo)
        <div class="grid-item entry" style="background-image: url({{ $photo->url_small }})">
          <a href="{{ route('entries.show', $photo->id) }}"></a>
          <div class="info clearfix">
            @if($photo->isFromCurrentPeriod())
              <span class="like{{ (\Auth::check() && $photo->isLikedByUser(\Auth::user())) ? ' liked' : '' }}" data-photo-id="{{ $photo->id }}"></span>
            @endif
            <span class="likes">{{ count($photo->likes) }} {{ count($photo->likes) == 1 ? 'Like' : 'Likes' }}</span>
          </div>
        </div>
      @empty
        <p style="text-align: center;">No entries yet</p>
      @endforelse
    </div>

    <div class="pagination-wrapper">
      {{ $photos->links() }}
    </div>

  </div>
@stop
