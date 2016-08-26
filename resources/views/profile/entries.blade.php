@extends('layouts.master')

@section('title', 'My entries')

@section('content')
  <div id="profile-container">

    <h1 class="big">My entries</h1>

    <div class="select-period">
      Select period:
      @foreach($periods as $period)
        @if($period->id == $selectedPeriod)
          <a class="active" href="{{ route('profile.entries', $period->id) }}">
            {{ $period->period_number }}
            <span>({{ $period->startdate->format('d/m') }} - {{ $period->enddate->format('d/m') }})</span>
          </a>
        @else
          <a href="{{ route('profile.entries', $period->id) }}">
            {{ $period->period_number }}
            <span>({{ $period->startdate->format('d/m') }} - {{ $period->enddate->format('d/m') }})</span>
          </a>
        @endif
      @endforeach
    </div>

    <div class="entries-list">
      <div class="grid-sizer"></div>

      @forelse($photos as $photo)
        <div class="grid-item entry" style="background-image: url({{ $photo->url }})">
          <a href="{{ route('entries.show', $photo->id) }}"></a>
          <div class="info clearfix">
            @if($photo->isFromCurrentPeriod())
              <span class="like{{ $photo->isLikedByUser(\Auth::user()) ? ' liked' : '' }}" data-photo-id="{{ $photo->id }}"></span>
            @endif
            <span class="likes">{{ count($photo->likes) }} {{ count($photo->likes) == 1 ? 'Like' : 'Likes' }}</span>
          </div>
        </div>
      @empty
        <p>You haven't uploaded any photos in this period.</p>
      @endforelse
    </div>

    {{ $photos->links() }}

  </div>
@stop