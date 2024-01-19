@extends('auth.template')

@section('container')
<div class="register-box">
    <div class="register-logo">
      <a href="{{ asset('AdminLTE') }}/index2.html"><b>Gallery</b>Login</a>
    </div>

    <div class="card">
      <div class="card-body register-card-body">
        <p class="login-box-msg">Login untuk User yang telah mendaftar</p>
            @if(session('gagal'))
                <div class="alert alert-danger">
                    {{ session('gagal') }}
                </div>
            @endif

        <form action="/login" method="post">
            @csrf
          <div class="input-group mb-3">
            <input type="text" class="form-control @error('nama') is-invalid @enderror" autofocus placeholder="Username" name="username" value="{{ old('username') }}">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
            @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
          </div>

          <div class="input-group mb-3">
            <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" value="{{ old('password') }}">
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

          <div class="row">
            <!-- /.col -->
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Login</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <a href="/register" class="text-center d-inline-block mb-3">Kamu belum mempunyai akun?</a>

        <a href="/guest" class="btn btn-warning btn-block text-white">Masuk sebagai tamu</a>

        </div>
      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>
  <!-- /.register-box -->
@endsection
