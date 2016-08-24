<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'Photo Contest - The North Face')</title>

  @include('includes.styles')
  @yield('styles')

</head>
<body>

<div id="wrapper">
  <nav id="main-nav" class="navbar navbar-default">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a href="{{ route('home') }}"><img id="nav-logo" src="{{ asset('assets/images/the-northface-logo-small.jpg') }}" alt="logo"></a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li {{ (Request::is('/') ? 'class=active' : '') }}><a href="{{ route('home') }}">Home</a></li>
          <li {{ (Request::is('entries/*') ? 'class=active' : '') }}><a href="{{ route('entries.popular') }}">Entries</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
          @if(\Auth::check())
            <li><a href="#">My entries</a></li>
            <li><a href="#">My votes</a></li>
            <li><a href="{{ route('settings') }}">Settings</a></li>
            <li><a href="{{ route('auth.logout') }}">Logout</a></li>
          @else
            <li><a href="{{ route('auth.login') }}">Login</a></li>
            <li class="bg-primary"><a href="{{ route('auth.register') }}">Sign up</a></li>
          @endif
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>


  <div id="content">

    @include('includes.notifications')

    @yield('content')

  </div>

  <footer id="footer">
    <img class="footer-logo" src="{{ asset('assets/images/the-northface-logo-small.jpg') }}" alt="logo">
    <a {{ (Request::is('/') ? 'class=active' : '') }} href="{{ route('home') }}">Home</a>
    <a {{ (Request::is('entries/*') ? 'class=active' : '') }} href="{{ route('entries.popular') }}">Entries</a>
  </footer>
</div>


@include('includes.scripts')
@yield('scripts')

</body>
</html>