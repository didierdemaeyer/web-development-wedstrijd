@extends('layouts.master')

@section('title', 'My entries')

@section('content')
  <div id="profile-container">

    <h1 class="big">My entries</h1>

    <div class="entries-list">
      <div class="grid-sizer"></div>

      @foreach($photos as $photo)
        <div class="grid-item entry" style="background-image: url({{ $photo->url }})">
          <a href="{{ route('entries.show', $photo->id) }}"></a>
        </div>
      @endforeach
    </div>

  </div>
@stop