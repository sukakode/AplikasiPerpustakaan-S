<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ env('APP_NAME') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

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

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets') }}/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('assets') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets') }}/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="{{ route('login') }}"><b>Aplikasi Perpustakaan</b></a>
  </div>
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Silahkan Login Untuk Memulai Sesi</p>
      
      <form action="{{ route('login') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          {{-- <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukan E-Mail Pengguna..." name="email" value="{{ old('email') }}" required autocomplete="email" autofocus> --}}
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukan E-Mail Pengguna..." name="email" value="superadmin@mail.com" required autocomplete="email" autofocus>
          
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>

          @error('email')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>

        <div class="input-group mb-3">
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukan Password Pengguna.." name="password" value="superadmin" required autocomplete="current-password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          {{-- <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div> --}}
          <div class="col-12">
            <button type="submit" class="btn btn-secondary btn-block">Login</button>
          </div>
        </div>
      </form> 
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="{{ asset('assets') }}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets') }}/dist/js/adminlte.min.js"></script>

</body>
</html>
