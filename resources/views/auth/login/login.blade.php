<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="gallery-c/css/login.css">
    <title>Login & Register Gallery Foto</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="/register" method="post">
                @csrf
                <h1>Sign Up</h1>
                
                <span>isi form di bawah ini untuk membuat akun</span>
                
                <input type="text" placeholder="nama" required name="nama" class="@error('nama') error @enderror">
                @error('nama')
                <span class="error">{{$message}}</span>
                @enderror
                <input type="text" placeholder="username" required name="username" class="@error('username') error @enderror">
                @error('username')
                <span class="error">{{$message}}</span>
                @enderror
                <input type="text" placeholder="alamat" required name="alamat" class="@error('alamat') error @enderror">
                @error('alamat')
                <span class="error">{{$message}}</span>
                @enderror
                <input type="email" placeholder="Email" required name="email" class="@error('email') error @enderror">
                @error('email')
                <span class="error">{{$message}}</span>
                @enderror
                <input type="password" placeholder="Password" required name="password" class="@error('password') error @enderror">
                @error('password')
                <span class="error">{{$message}}</span>
                @enderror
                <button>Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="/login" method="post">
                @csrf
                <h1>Sign In</h1>               
                <span>Masukan data akun yang telah dibuat</span>
                <input type="username" placeholder="Username" required name="username" class="@error('username') error @enderror">
                @error('username')
                <span class="error">{{$message}}</span>
                @enderror
                <input type="password" placeholder="Password" required name="password" class="@error('password') error @enderror">
                @error('password')
                <span class="error">{{$message}}</span>
                @enderror
                <a href="#">Lupa Password?</a>
                <button>Sign In</button>
                @if(session('gagal'))
                    <span class=" text-tengah">
                        {{ session('gagal') }}
                    </span>
                @endif
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Selamat Datang</h1>
                    <p>Masukkan detail pribadi Anda untuk masuk</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Selamat datang kembali</h1>
                    <p>Daftarkan dengan detail pribadi Anda untuk menggunakan semua fitur situs</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="gallery-c/js/login.js"></script>
</body>

</html>