
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="{{ asset('assets') }}/plugins/fontawesome-free/css/all.min.css">

<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('assets') }}/dist/css/adminlte.min.css">

<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('assets') }}/plugins/toastr/toastr.min.css">

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets') }}/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{ asset('assets') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

<!-- daterange picker -->
<link rel="stylesheet" href="{{ asset('assets') }}/plugins/daterangepicker/daterangepicker.css">

@livewireStyles

<style>
  .borad {
    border-radius: 0px !important;
  }
  
  .select2-container .select2-selection--single {
    height: 38px !important;
  }

  .select2-selection__arrow {
    height: 38px !important;
  }

  .navbar-ungu {
    background-color: #5249b2 !important;
  }
  .navbar-ungu2 {
    background-color: #5249b2d4 !important;
  }

  .sidebar-light-ungu .nav-sidebar>.nav-item>.nav-link.active {
    background-color: #5249b2 !important;
  }

  .bg-lred, .bg-lred>a {
    color: #000000 !important;
    background-color: #ffcece5c !important;
    /* background-color: #ffbbd4b5 !important; */
  }
</style>

@yield('css')
@stack('css')