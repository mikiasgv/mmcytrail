<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Trail') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
  <div id="app" class="wrapper ">
    @auth
        @include('layouts.sidebar')
    @endauth
    <div class="main-panel">
      <!-- Navbar -->
      @include('layouts.nav')
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <!-- your content here -->
          @yield('content')
        </div>
      </div>
      <footer class="footer">
        <div class="container-fluid">
          <nav class="float-left">
            <ul>
              <li>
                <a href="https://www.mmcytech.com/">
                  MMCY | Tech
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright float-right">
            <a href="https://www.mmcytech.com/" target="_blank">MMCY | Tech</a>
          </div>
          <!-- your footer here -->
        </div>
      </footer>
    </div>
  </div>
</body>
</html>
