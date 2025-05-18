<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Watchverse - Login / Register</title>
  <link rel="stylesheet" href="https://cdn.lineicons.com/4.0/lineicons.css">
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins");

    * {
      box-sizing: border-box;
    }

    body {
      display: flex;
      background: linear-gradient(to bottom, #2D2B40, #1E1C2F);
      justify-content: center;
      align-items: center;
      flex-direction: column;
      font-family: "Poppins", sans-serif;
      overflow: hidden;
      height: 100vh;
      margin: 0;
    }

    h1 {
      font-weight: 700;
      letter-spacing: -1.5px;
      margin: 0;
      margin-bottom: 15px;
    }

    h1.title {
        font-size: 45px;
        line-height: 45px;
        margin: 0;
        color: #fff; /* Pastikan teks overlay terlihat */
        text-shadow: 0 0 10px rgba(16, 64, 74, 0.5);
    }

    p {
        font-size: 14px;
        font-weight: 100;
        line-height: 20px;
        letter-spacing: 0.5px;
        margin: 20px 0 30px;
        color: #fff; /* Pastikan teks overlay terlihat */
        text-shadow: 0 0 10px rgba(16, 64, 74, 0.5);
    }

    span { /* Ini mungkin tidak terpakai lagi setelah integrasi */
        font-size: 14px;
        margin-top: 25px;
    }

    a {
        color: #333; /* Warna default link di dalam form */
        font-size: 14px;
        text-decoration: none;
        margin: 15px 0;
        transition: 0.3s ease-in-out;
    }

    a:hover {
        color: #686297; /* Warna hover disesuaikan */
    }

    .content { /* Untuk 'Remember me' dan 'Forgot password' */
        display: flex;
        width: 100%;
        height: auto; /* Sesuaikan tinggi otomatis */
        align-items: center;
        justify-content: space-between; /* Agar terpisah */
        margin-top: 10px;
        margin-bottom: 15px; /* Beri jarak ke tombol login */
    }

    .content .checkbox {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .content input[type="checkbox"] { /* Style spesifik untuk checkbox */
        accent-color: #686297;
        width: 16px; /* Sedikit lebih besar */
        height: 16px;
        margin-right: 5px; /* Jarak dari label */
    }

    .content label {
        font-size: 14px;
        user-select: none;
        color: #555; /* Warna teks label checkbox */
    }

    button {
        position: relative;
        border-radius: 20px;
        border: 1px solid #686297;
        background-color: #686297;
        color: #fff;
        font-size: 15px;
        font-weight: 700;
        margin-top: 15px; /* Sesuaikan margin */
        padding: 12px 80px;
        letter-spacing: 1px;
        text-transform: capitalize;
        transition: 0.3s ease-in-out;
        cursor: pointer;
    }

    button:hover {
        letter-spacing: 3px;
        background-color: #5a5482; /* Warna hover lebih gelap sedikit */
    }

    button:active {
        transform: scale(0.95);
    }

    button:focus {
        outline: none;
    }

    button.ghost {
        background-color: rgba(225, 225, 225, 0.2);
        border-color: #fff; /* Pastikan border ghost terlihat */
        color: #fff;
    }
    button.ghost:hover {
        background-color: rgba(225, 225, 225, 0.3); /* Hover untuk ghost */
        letter-spacing: 3px; /* Pertahankan efek hover */
    }

    /* ... (sisa style button.ghost i) ... */

    form {
        background-color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 0 40px; /* Sedikit kurangi padding horizontal */
        height: 100%;
        text-align: center;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] { /* Target input teks, email, password */
        background-color: #f0f0f0; /* Warna background input sedikit diubah */
        border-radius: 8px; /* Radius border disesuaikan */
        border: 1px solid #e0e0e0;
        padding: 12px 15px;
        margin: 8px 0;
        width: 100%;
        font-family: "Poppins", sans-serif; /* Pastikan font konsisten */
        font-size: 14px; /* Ukuran font input */
    }
    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="password"]:focus {
        outline: none;
        border-color: #686297;
        box-shadow: 0 0 0 2px rgba(104, 98, 151, 0.2); /* Efek shadow saat focus */
    }

    .container {
        background-color: #fff;
        border-radius: 25px;
        box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
        position: relative;
        overflow: hidden;
        width: 768px;
        max-width: 100%;
        min-height: 520px; /* Sedikit tambah tinggi untuk akomodasi error msg */
    }

    .form-container {
        position: absolute;
        top: 0;
        height: 100%;
        transition: all 0.6s ease-in-out;
    }

    .login-container {
        left: 0;
        width: 50%;
        z-index: 2;
    }

    .container.right-panel-active .login-container {
        transform: translateX(100%);
    }

    .register-container {
        left: 0;
        width: 50%;
        opacity: 0;
        z-index: 1;
    }

    .container.right-panel-active .register-container {
        transform: translateX(100%);
        opacity: 1;
        z-index: 5;
        animation: show 0.6s;
    }

    @keyframes show {
        0%, 49.99% { opacity: 0; z-index: 1; }
        50%, 100% { opacity: 1; z-index: 5; }
    }

    .overlay-container {
        position: absolute;
        top: 0;
        left: 50%;
        width: 50%;
        height: 100%;
        overflow: hidden;
        transition: transform 0.6s ease-in-out;
        z-index: 100;
    }

    .container.right-panel-active .overlay-container {
        transform: translateX(-100%);
    }

    .overlay {
        background-image: url('{{ asset('lilo.gif') }}'); /* Pastikan path ke lilo.gif benar */
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center; /* Pusatkan background image */
        color: #fff;
        position: relative;
        left: -100%;
        height: 100%;
        width: 200%;
        transform: translateX(0);
        transition: transform 0.6s ease-in-out;
    }

    .overlay:before { /* Overlay gradient untuk kontras teks */
        content: "";
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        background: linear-gradient(to top, rgba(30, 28, 47, 0.7) 0%, rgba(30, 28, 47, 0.3) 60%, transparent 100%);
    }

    .container.right-panel-active .overlay {
        transform: translateX(50%);
    }

    .overlay-panel {
        position: absolute;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 0 40px;
        text-align: center;
        top: 0;
        height: 100%;
        width: 50%;
        transform: translateX(0);
        transition: transform 0.6s ease-in-out;
    }

    .overlay-left { transform: translateX(-20%); }
    .container.right-panel-active .overlay-left { transform: translateX(0); }
    .overlay-right { right: 0; transform: translateX(0); }
    .container.right-panel-active .overlay-right { transform: translateX(20%); }

    .social-container { margin: 20px 0; }
    .social-container a { /* ... style social Anda ... */ }


    /* Untuk menampilkan error validasi Laravel */
    .laravel-errors {
        color: #e74c3c; /* Warna merah error yang lebih lembut */
        font-size: 0.85em; /* Ukuran font error */
        text-align: left;
        width: 100%;
        margin-bottom: 12px; /* Jarak dari input */
        padding: 8px 12px; /* Padding internal */
        background-color: #fceded; /* Background error yang lembut */
        border-left: 3px solid #e74c3c; /* Border kiri sebagai aksen */
        border-radius: 4px;
    }
    .laravel-errors ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }
    .laravel-errors li {
        margin-bottom: 4px;
    }
    .input-error { /* Style untuk input yang error */
        border-color: #e74c3c !important; /* Warna border merah, !important untuk override */
        background-color: #fceded !important; /* Background input error */
    }

    /* Pesan status sukses (misal dari reset password) */
    .session-status {
        margin-bottom: 15px;
        font-weight: 500;
        font-size: 0.9em;
        color: #2ecc71; /* Warna hijau untuk sukses */
        background-color: #eafaf1;
        padding: 10px;
        border-left: 3px solid #2ecc71;
        border-radius: 4px;
        width: 100%;
        text-align: left;
    }

  </style>
</head>
<body>
  {{-- Logika untuk menentukan panel aktif berdasarkan error validasi dari Laravel --}}
  @php
    $activePanel = ''; // Default tidak ada panel aktif
    if ($errors->any()) { // Jika ada error APAPUN
        // Cek apakah error berasal dari form registrasi
        // (baik karena old('form_type') atau karena ada error spesifik registrasi)
        if (old('form_type') === 'register' || $errors->has('name') || $errors->has('password_confirmation')) {
            $activePanel = 'right-panel-active';
        }
        // Jika tidak ada indikasi error dari registrasi, dan ada error, asumsikan dari login
        // (atau bisa juga dibuat lebih eksplisit jika old('form_type') === 'login')
        // Untuk saat ini, jika bukan error register, panel login akan tetap jadi default (tidak ada class 'right-panel-active')
    }
  @endphp

  <div class="container {{ $activePanel }}" id="container">

    <!-- Register Form -->
    <div class="form-container register-container">
      <form method="POST" action="{{ route('register') }}" novalidate> {{-- novalidate agar validasi browser tidak bentrok dg Laravel --}}
        @csrf
        <h1>Register here.</h1>

        {{-- Menampilkan Error Validasi Laravel untuk Registrasi --}}
        @if ($errors->any() && (old('form_type') === 'register' || $errors->has('name') || $errors->has('email') || $errors->has('password') || $errors->has('password_confirmation')))
            <div class="laravel-errors">
                <ul>
                    {{-- Tampilkan error spesifik field dulu jika ada --}}
                    @if($errors->has('name')) <li>{{ $errors->first('name') }}</li> @endif
                    @if($errors->has('email') && old('form_type') === 'register') <li>{{ $errors->first('email') }}</li> @endif
                    @if($errors->has('password') && old('form_type') === 'register') <li>{{ $errors->first('password') }}</li> @endif
                    @if($errors->has('password_confirmation')) <li>{{ $errors->first('password_confirmation') }}</li> @endif
                    {{-- Tampilkan error umum lainnya jika ada (jarang terjadi jika field spesifik sudah ditangani) --}}
                    @foreach ($errors->getMessages() as $field => $messages)
                        @if (!in_array($field, ['name', 'email', 'password', 'password_confirmation']) && old('form_type') === 'register')
                            @foreach ($messages as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        @endif
                    @endforeach
                </ul>
            </div>
        @endif
        <input type="hidden" name="form_type" value="register">

        <input type="text" id="name" name="name" placeholder="Full Name" value="{{ old('name') }}" required autofocus autocomplete="name" class="{{ $errors->has('name') ? 'input-error' : '' }}" />
        <input type="email" id="email_register" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" class="{{ $errors->has('email') && old('form_type') === 'register' ? 'input-error' : '' }}" />
        <input type="password" id="password_register" name="password" placeholder="Password" required autocomplete="new-password" class="{{ $errors->has('password') && old('form_type') === 'register' ? 'input-error' : '' }}" />
        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password" />
        <button type="submit">Register</button>
      </form>
    </div>

    <!-- Login Form -->
    <div class="form-container login-container">
      <form method="POST" action="{{ route('login') }}" novalidate>
        @csrf
        <h1>Login here.</h1>

        {{-- Menampilkan Error Validasi Laravel untuk Login --}}
        {{-- Kondisi ini memastikan error login hanya tampil jika bukan error dari form register --}}
        @if ($errors->any() && old('form_type', 'login') !== 'register' && !($errors->has('name') || $errors->has('password_confirmation')))
            <div class="laravel-errors">
                <ul>
                    {{-- Error spesifik untuk email dan password di login --}}
                    @if ($errors->has('email') && old('form_type','login') !== 'register') <li>{{ $errors->first('email') }}</li> @endif
                    @if ($errors->has('password') && old('form_type','login') !== 'register') <li>{{ $errors->first('password') }}</li> @endif

                    {{-- Tampilkan error umum lainnya dari sesi (misal 'auth.failed' dari Breeze) --}}
                    {{-- Breeze biasanya tidak memasukkan ini ke $errors->all() tapi ke session 'error' atau spesifik --}}
                    {{-- Kita bisa menangani ini dengan lebih baik jika tahu key session error dari Breeze jika ada --}}
                    {{-- Untuk sekarang, ini akan menampilkan semua error yang tidak spesifik field --}}
                     @foreach ($errors->getMessages() as $field => $messages)
                        @if (!in_array($field, ['email', 'password', 'name', 'password_confirmation']) && old('form_type','login') !== 'register')
                            @foreach ($messages as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        @endif
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Menampilkan pesan status sukses (misalnya dari reset password link terkirim) --}}
         @if (session('status'))
            <div class="session-status">
                {{ session('status') }}
            </div>
        @endif
        <input type="hidden" name="form_type" value="login">

        <input type="email" id="email_login" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus autocomplete="email" class="{{ $errors->has('email') && old('form_type','login') !== 'register' ? 'input-error' : '' }}" />
        <input type="password" id="password_login" name="password" placeholder="Password" required autocomplete="current-password" class="{{ ($errors->has('password') || $errors->has('email')) && old('form_type','login') !== 'register' ? 'input-error' : '' }}" /> {{-- Error email di login bisa jadi karena password salah juga --}}

        <div class="content">
          <div class="checkbox">
            <input type="checkbox" name="remember" id="remember_me" />
            <label for="remember_me">Remember me</label>
          </div>
          @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}">
                Forgot password?
            </a>
          @endif
        </div>
        <button type="submit">Login</button>
      </form>
    </div>

    <!-- Overlay Panel -->
    <div class="overlay-container">
      <div class="overlay" style="background-image: url('{{ asset('lilo.gif') }}');">
        <div class="overlay-panel overlay-left">
          <h1 class="title">Welcome <br> Back!</h1>
          <p>To keep connected with us please login with your personal info</p>
          <button class="ghost" id="loginBtn">Login <!-- Ganti ID agar unik dari elemen lain jika ada -->
            <i class="lni lni-arrow-left login"></i>
          </button>
        </div>
        <div class="overlay-panel overlay-right">
          <h1 class="title">Hello, <br> Friend!</h1>
          <p>Enter your personal details and start journey with us</p>
          <button class="ghost" id="registerBtn">Register <!-- Ganti ID agar unik -->
            <i class="lni lni-arrow-right register"></i>
          </button>
        </div>
      </div>
    </div>
  </div>

  <script>
    const registerButton = document.getElementById("registerBtn"); // Sesuaikan dengan ID baru
    const loginButton = document.getElementById("loginBtn");       // Sesuaikan dengan ID baru
    const container = document.getElementById("container");

    // Fungsi untuk mengaktifkan panel register jika ada error dari form register
    function activateRegisterPanelOnError() {
        @if ($errors->any() && (old('form_type') === 'register' || $errors->has('name') || $errors->has('password_confirmation')))
            if (container) {
                container.classList.add("right-panel-active");
            }
        @endif
    }

    if (registerButton && loginButton && container) {
        registerButton.addEventListener("click", () => {
            container.classList.add("right-panel-active");
        });

        loginButton.addEventListener("click", () => {
            container.classList.remove("right-panel-active");
        });

        // Panggil fungsi untuk cek error saat DOM siap
        activateRegisterPanelOnError();
    }
  </script>
</body>
</html>