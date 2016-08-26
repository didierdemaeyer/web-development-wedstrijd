@extends('layouts.master')

@section('title', 'Entries from period ' . $selectedPeriod)

@section('content')
  <div id="entries-container" class="archived-entries">

    <h1 class="big">Archive</h1>

    <div class="select-period">
      Select period:
      @foreach($periods as $period)
        @if($period->id == $selectedPeriod)
          <a class="active" href="{{ route('entries.archived', $period->id) }}">
            {{ $period->period_number }}
            <span>({{ $period->startdate->format('d/m') }} - {{ $period->enddate->format('d/m') }})</span>
          </a>
        @else
          <a href="{{ route('entries.archived', $period->id) }}">
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
        <p>There are no photos in this period.</p>
      @endforelse
    </div>

    <div class="pagination-wrapper">
      {{ $photos->links() }}
    </div>

  </div>
@stop