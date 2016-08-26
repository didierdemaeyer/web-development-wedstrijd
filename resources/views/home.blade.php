@extends('layouts.master')

@section('content')
  <div id="home-container">
    <header>

      <div class="overlay">
        <div class="call-to-action">
          <p>Share a beautiful landscape and win The North Face&reg; equipment.</p>
          <a class="btn btn-cta btn-default" href="{{ route('participate') }}">Upload photo</a>
          <div class="period-end"></div>
        </div>
      </div>

    </header>

    <h1>How to win</h1>

    <div id="how-to-win" class="container">
      <div class="row">
        <div class="col-md-4">
          <h2>Step 1: Create an account</h2>
          <p><a href="{{ route('auth.register') }}">Create</a> or <a href="{{ route('auth.login') }}">log into</a> your account and fill in the necessary information. When you have an account you can also like photos of other people.</p>
        </div>
        <div class="col-md-4">
          <h2>Step 2: Upload your photo</h2>
          <p><a href="{{ route('participate') }}">Upload</a> your adventureous or beautiful landscape photos and have a chance at winning The North Face&reg; equipment.</p>
        </div>
        <div class="col-md-4">
          <h2>Step 3: Get likes</h2>
          <p>Get as much likes as you can on your photos! There are 4 periods and at the end of each period the photo with the most likes wins!.</p>
        </div>
      </div>
    </div>

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
              <a href="{{ route('entries.show', $previousPeriod->winning_photo->id) }}"></a>
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