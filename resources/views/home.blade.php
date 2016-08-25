@extends('layouts.master')

@section('content')
  <div id="home-container">
    <header>

      <div class="overlay">
        <div class="call-to-action">
          <p>Share a beautiful landscape and win The North Face&reg; equipment.</p>
          <button class="btn btn-cta"><a href="{{ route('participate') }}">Upload photo</a></button>
          <div class="period-end"></div>
        </div>
      </div>

    </header>

    <h1>How to participate</h1>

    @if(count($photos))
      <h1>Latest entries</h1>

      <div class="entries-list">
        <div class="grid-sizer"></div>

        @foreach($photos as $photo)
          <div class="grid-item entry" style="background-image: url({{ $photo->url }})">
            <a href="{{ route('entries.show', $photo->id) }}"></a>
            <div class="info">
              <span class="like{{ (\Auth::check() && $photo->isLikedByUser(\Auth::user())) ? ' liked' : '' }}" data-photo-id="{{ $photo->id }}"></span>
              <span class="likes">{{ count($photo->likes) }} {{ count($photo->likes) == 1 ? 'Like' : 'Likes' }}</span>
            </div>
          </div>
        @endforeach
      </div>
    @endif

    @if(count($previousPeriods))
      <h1>Previous winners</h1>

      <div class="entries-list previous-winners">
        <div class="grid-sizer"></div>

        @foreach($previousPeriods as $previousPeriod)
          @if(count($previousPeriod->winning_photo))
            <div class="grid-item entry" style="background-image: url({{ $previousPeriod->winning_photo->url }})">
              {{--<a href="{{ route('entries.show', $photo->id) }}"></a>--}}
              <div class="info">
                <h5>Period {{ $previousPeriod->period_number }}: {{ $previousPeriod->startdate->format('d/m/y') }} - {{ $previousPeriod->enddate->format('d/m/y') }}</h5>
                <span class="user">Photo by {{ $previousPeriod->winning_photo->user->firstname }}</span>
                <span class="likes">{{ count($previousPeriod->winning_photo->likes) }} {{ count($previousPeriod->winning_photo->likes) == 1 ? 'Like' : 'Likes' }}</span>
              </div>
            </div>
          @endif
        @endforeach
      </div>
    @endif

  </div>
@stop