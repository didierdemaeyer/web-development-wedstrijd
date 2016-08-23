<div id="notifications">
  @if(session('data') != null)
    @if(session('data')['type'] == 'error')
      @foreach(session('data')['messages'] as $message)
        <div class="notification error">
          <div class="container">
            <p>{{ $message }} <span class="btn-close">X</span></p>
          </div>
        </div>
      @endforeach
    @elseif(session('data')['type'] == 'success')
      @foreach(session('data')['messages'] as $message)
        <div class="notification success">
          <div class="container">
            <p>{{ $message }} <span class="btn-close">X</span></p>
          </div>
        </div>
      @endforeach
    @elseif(session('data')['type'] == 'info')
      @foreach(session('data')['messages'] as $message)
        <div class="notification info">
          <div class="container">
            <p>{{ $message }} <span class="btn-close">X</span></p>
          </div>
        </div>
      @endforeach
    @endif
  @endif
</div>