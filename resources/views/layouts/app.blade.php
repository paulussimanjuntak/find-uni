<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/bulma.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/utility.css') }}" rel="stylesheet">
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/css/swiper.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
</head>
<body>
    <div id="app">
      <app-header photo="{{asset('storage/')}}" home="{{url('/')}}"></app-header>

        <main class="py-4">
            @yield('content')
        </main>


  <footer class="footer is-paddingless">
    <section class="section p-t-20 p-b-20">
      <div class="container">
        <p>&copy; 2019 Find UNI <span class="is-pulled-right">finduni.com</span></p>
      </div><!--/container-->
    </section>
  </footer>


    </div>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/bulma.js') }}"></script>
</body>
</html>
