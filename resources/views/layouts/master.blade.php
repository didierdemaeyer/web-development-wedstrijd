<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="like-photo-url" content="{{ route('entries.like') }}">
  <meta name="unlike-photo-url" content="{{ route('entries.unlike') }}">
  @if (\Auth::check())
    <meta name="user-id" content="{{ \Auth::user()->id }}">
  @endif

  <title>@yield('title', 'Home') - Photo Contest The North Face</title>

  <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}?v=2">
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
          @if(\App\ContestPeriod::getPreviousPeriod())
            <li {{ (Request::is('archived-entries/*') ? 'class=active' : '') }}><a href="{{ route('entries.archived', \App\ContestPeriod::getPreviousPeriod()->id) }}">Archive</a></li>
          @endif
        </ul>

        <ul class="nav navbar-nav navbar-right">
          @if(\Auth::check())
            @if(\Auth::user()->isAdmin())
              <li class="dropdown{{ Request::is('admin/*') ? ' active' : '' }}">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin panel <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a {{ (Request::is('admin/entries/*') ? 'class=active' : '') }} href="{{ route('admin.entries', \App\ContestPeriod::getCurrentPeriod()->id) }}">Manage entries</a></li>
                  <li><a href="#">Manage users</a></li>
                </ul>
              </li>
            @else
              <li {{ (Request::is('my-entries/*') ? 'class=active' : '') }}><a href="{{ route('profile.entries', \App\ContestPeriod::getCurrentPeriod()->id) }}">My entries</a></li>
              <li {{ (Request::is('my-likes/*') ? 'class=active' : '') }}><a href="{{ route('profile.likes', \App\ContestPeriod::getCurrentPeriod()->id) }}">My likes</a></li>
            @endif
            <li {{ (Request::is('settings') ? 'class=active' : '') }}><a href="{{ route('settings') }}">Settings</a></li>
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