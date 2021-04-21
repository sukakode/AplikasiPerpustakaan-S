<!DOCTYPE html> 
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>{{ env('APP_NAME') }}</title>

  <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('assets/favicon') }}/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('assets/favicon') }}/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/favicon') }}/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/favicon') }}/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assets/favicon') }}/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets/favicon') }}/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('assets/favicon') }}/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assets/favicon') }}/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicon') }}/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('assets/favicon') }}/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon') }}/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/favicon') }}/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon') }}/favicon-16x16.png">
  {{-- <link rel="manifest" href="{{ asset('assets/favicon') }}/manifest.json"> --}}
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="{{ asset('assets/favicon') }}/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">


  @include('backend.layouts.css')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  @include('backend.layouts.navbar')

  <aside class="main-sidebar sidebar-light-ungu elevation-4">
    <a href="{{ route('frontend.main') }}" class="brand-link navbar-ungu2">
      <img src="{{ asset('assets') }}/dist/img/MaLogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text pl-2" style="letter-spacing: 2px; font-weight: 500;">Web-Perpus</span>
    </a>
  
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('assets') }}/dist/img/UserLogo.png " class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->name }}</a> 
        </div>
      </div>
      
  
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          @include('backend.layouts.menu')
        </ul>
      </nav>
    </div>
  </aside>

  <div class="content-wrapper"> 

    <div class="content pt-2">
      <div class="container-fluid">
        <div class="row">
          @yield('content')
        </div>
      </div>
    </div>
  </div>

  @include('backend.layouts.sidebar')

  @include('backend.layouts.footer')
</div>

@include('backend.layouts.script')

</body>
</html>
