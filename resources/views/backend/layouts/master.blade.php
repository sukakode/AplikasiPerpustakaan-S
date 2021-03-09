<!DOCTYPE html> 
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Program Perpus</title>

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
