<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte3') }}/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('adminlte3') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte3') }}/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="{{ asset('adminlte3') }}/index2.html" class="h1"><b>Van</b>Mart</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg"> </p>

      <form action="{{ route('cekLogin') }}" method="post" novalidate>
        @csrf
        <div class="input-group mb-3">
          <input type="email" class="form-control
          @error('email')
          is-invalid
          @enderror
          "placeholder="Email" name="email" id="email" value="{{ old('email')}}">

          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        @error('email')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
        <div class="input-group mb-3">
          <input type="password" class="form-control
          @error('password')
          is-invalid
          @enderror " 
          placeholder="Password" name="password" value="{{ old('password') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          @error('password')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
        </div>
        @error('nofound')
        <div class="row mb-2">
          <div class="col-12 text-center text-danger">
            {{ $message }}
          </div>
        </div>
        @enderror
        <div class="row">
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
        </div>
          <!-- /.col -->
          <!-- /.col -->
        </div>
      </form>    
      <!-- /.social-auth-links -->
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('adminlte3') }}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte3') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte3') }}/dist/js/adminlte.min.js"></script>
</body>
</html>
