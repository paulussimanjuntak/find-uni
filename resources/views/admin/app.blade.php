<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if(Auth::user()->role == 'sasAdmin')
      <title>SAS Admin</title>
    @endif
    @if(Auth::user()->role == 'uniAdmin')
      <title>University Admin</title>
    @endif
    <link rel="shortcut icon" href="{{asset("storage/find-uni.png")}}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/fontawesome/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/utility.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
</head>
<body>
    <div id="app">
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <a class="navbar-brand pt-0" href="{{url('/')}}">
        <img src="{{asset("storage/dashboard-finduni.png")}}" class="navbar-brand-img" alt="...">
      </a>
      <!-- User -->
      <ul class="nav align-items-center d-md-none">
        <li class="nav-item dropdown">
          <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ni ni-bell-55"></i>
          </a>
        </li>
      </ul>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="{{url('/')}}">
                <img src="{{asset("storage/dashboard-finduni.png")}}">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <!-- Navigation -->
        <ul class="navbar-nav">
          @if(Auth::user()->role == 'sasAdmin')
          <!--SAS ADMIN-->
          <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'admin/setup-qualification' ? 'active' : '' }}" 
              href="{{url('/admin/setup-qualification')}}">
              <i class="far fa-layer-plus text-danger"></i> Setup Qualification 
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'admin/register-university' ? 'active' : '' }}" 
              href="{{url('/admin/register-university')}}">
              <i class="far fa-university text-success"></i> Register University 
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'admin/verify-quals' ? 'active' : '' }}" 
              href="{{url('/admin/verify-quals')}}">
              <i class="far fa-clipboard-list-check text-primary"></i> Verify Qualification 
            </a>
          </li>
          @endif
          <!--SAS ADMIN-->

          <!--University ADMIN-->
          @if(Auth::user()->role == 'uniAdmin')
          <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'admin/record-programme' ? 'active' : '' }}" 
              href="{{url('/admin/record-programme')}}">
              <i class="far fa-video-plus text-primary"></i> Record Programme 
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link  {{ Request::path() == 'admin/review-applications' || Request::is('admin/review-applications/*') ? 'active' : '' }}" 
              href="{{url('/admin/review-applications')}}">
              <i class="far fa-clipboard-list-check text-warning"></i> Review Applications 
            </a>
          </li>
          @endif
          <!--/University ADMIN-->
        </ul>
      </div>
    </div>
  </nav>

  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark bg-gradient-primary" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        @if(Request::path() == 'admin/setup-qualification')
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Setup Qualification</a>
        @endif
        @if(Request::path() == 'admin/register-university')
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Register University</a>
        @endif
        @if(Request::path() == 'admin/verify-quals')
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Verify Qualification</a>
        @endif
        @if(Request::path() == 'admin/record-programme')
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Record Programme</a>
        @endif
        @if(Request::path() == 'admin/review-applications' || Request::is('admin/review-applications/*'))
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Review Applications</a>
        @endif

      </div>
    </nav>
    <!-- End Navbar -->
    <!-- Header -->

      @yield('content')
  </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{asset('js/sweetalert2.min.js')}}"></script>
    @include('sweet::alert')
</body>
</html>
