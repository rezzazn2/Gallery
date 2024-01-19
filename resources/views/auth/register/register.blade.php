@extends('auth.template')

@section('container')
<div class="register-box">
    <div class="register-logo">
      <a href="{{ asset('AdminLTE') }}/index2.html"><b>Gallery</b>Login</a>
    </div>

    <div class="card">
      <div class="card-body register-card-body">
        <p class="login-box-msg">Register untuk member baru</p>

        <form action="register" method="post">
            @csrf
          <div class="input-group mb-3">
            <input type="text" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama" name="nama" required autofocus value="{{ old('nama') }}">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
            @error('nama')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
          </div>

          <div class="input-group mb-3">
            <input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Username" name="username" required value="{{ old('username') }}">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-pen"></span>
              </div>
            </div>
            @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
          </div>

          <div class="input-group mb-3">
            <input type="text" class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat" name="alamat" required value="{{ old('alamat') }}">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-map-marker-alt"></span>
              </div>
            </div>
            @error('alamat')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
          </div>

          <div class="input-group mb-3">
            <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" required value="{{ old('email') }}">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
          </div>

          <div class="input-group mb-3">
            <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required value="{{ old('password') }}">
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

          <div class="row justify-content-center my-4">
            <!-- /.col -->
            <div class="col-8">
              <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
            <!-- /.col -->
          </div>
        </form>



        <a href="/login" class="text-center mt-5">Halaman Login</a>
      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>
  <!-- /.register-box -->
@endsection
