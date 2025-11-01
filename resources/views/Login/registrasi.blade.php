<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registrasi - GoMinGo</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/logo/logogo.png') }}" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to bottom right, #007bff, #00b4d8);
      background-image: url('{{ asset('assets/img/hero/2.png') }}');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: fixed;
      color: #fff;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      min-height: 100vh;
      padding: 20px;
      overflow-y: auto;
    }

    .register-container {
      display: flex;
      justify-content: space-between;
      align-items: stretch;
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
      width: 90%;
      max-width: 950px;
      overflow: visible;
      margin: 20px auto;
    }

    /* Kiri */
    .left-panel {
      flex: 1;
      background: rgba(0, 123, 255, 0.2);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 50px 30px;
      text-align: center;
    }

    .left-panel img {
      width: 140px;
      margin-bottom: 20px;
    }

    .left-panel h2 {
      font-weight: 700;
      font-size: 28px;
      margin-bottom: 15px;
    }

    .left-panel p {
      font-size: 15px;
      line-height: 1.6;
      max-width: 350px;
      margin: 0 auto 25px;
    }

    .left-panel a {
      text-decoration: none;
      color: white;
      background: #007bff;
      padding: 10px 25px;
      border-radius: 30px;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .left-panel a:hover {
      background: #0056b3;
      transform: scale(1.05);
    }

    /* Kanan */
    .right-panel {
      flex: 1;
      background: rgba(255, 255, 255, 0.1);
      padding: 50px 40px;
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
      min-height: auto;
    }

    .right-panel h3 {
      text-align: center;
      margin-bottom: 25px;
      font-weight: 700;
      color: #fff;
    }

    .form-control {
      width: 100%;
      padding: 12px;
      border-radius: 10px;
      border: none;
      margin-bottom: 15px;
      font-size: 14px;
    }

    select.form-control {
      color: #333;
    }

    .btn-primary {
      width: 100%;
      padding: 12px;
      background: #007bff;
      color: white;
      border: none;
      border-radius: 10px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      background: #0056b3;
      transform: scale(1.03);
    }

    .login-link {
      color: #fff;
      text-decoration: none;
      font-weight: 600;
      transition: 0.3s;
    }

    .login-link:hover {
      color: #00b4d8;
    }

    /* Error & Success Messages */
    .alert {
      padding: 12px 15px;
      border-radius: 10px;
      margin-bottom: 20px;
      font-size: 14px;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .alert-error {
      background: rgba(220, 53, 69, 0.9);
      color: #fff;
      border-left: 4px solid #dc3545;
    }

    .alert-success {
      background: rgba(40, 167, 69, 0.9);
      color: #fff;
      border-left: 4px solid #28a745;
    }

    .error-message {
      color: #ffd60a;
      font-size: 12px;
      margin-top: -10px;
      margin-bottom: 10px;
      display: block;
      font-weight: 500;
    }

    .form-control.error {
      border: 2px solid #dc3545;
      background: rgba(220, 53, 69, 0.1);
    }

    .form-control.error:focus {
      border-color: #dc3545;
      outline: none;
      box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.25);
    }

    .password-hint {
      font-size: 11px;
      color: rgba(255, 255, 255, 0.8);
      margin-top: -10px;
      margin-bottom: 10px;
    }

    @media (max-width: 768px) {
      .register-container {
        flex-direction: column;
      }
      .left-panel, .right-panel {
        padding: 40px 30px;
      }
      .left-panel {
        order: 2;
      }
    }
  </style>
</head>
<body>
  <div class="register-container">
    <!-- Bagian Kiri -->
    <div class="left-panel">
      <img src="{{ asset('assets/img/logo/logogo.png') }}" alt="GoMinGo Logo">
      <h2>Bergabung Bersama Kami!</h2>
      <p>Daftarkan tempat wisata Anda untuk tampil di platform GoMinGo, atau jadilah tour guide profesional dan bantu wisatawan menjelajahi keindahan Sumatera Barat.</p>
      <a href="{{ route('login') }}">Sudah Punya Akun?</a>
    </div>

    <!-- Bagian Kanan -->
    <div class="right-panel">
      <h3>Form Pendaftaran</h3>

      @if(session('success'))
        <div class="alert alert-success">
          <span>✓</span>
          <span>{{ session('success') }}</span>
        </div>
      @endif

      @if(session('error'))
        <div class="alert alert-error">
          <span>✕</span>
          <span>{{ session('error') }}</span>
        </div>
      @endif

      @if($errors->any())
        @if(!session('error'))
          <div class="alert alert-error">
            <span>✕</span>
            <span>Mohon perbaiki kesalahan berikut:</span>
          </div>
        @endif
      @endif

      <form method="POST" action="{{ route('registrasi') }}">
        @csrf
        
        <div style="margin-bottom: 15px;">
          <input 
            type="text" 
            name="name" 
            class="form-control {{ $errors->has('name') ? 'error' : '' }}" 
            placeholder="Nama Lengkap" 
            value="{{ old('name') }}"
            required
          >
          @error('name')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>

        <div style="margin-bottom: 15px;">
          <input 
            type="email" 
            name="email" 
            class="form-control {{ $errors->has('email') ? 'error' : '' }}" 
            placeholder="Email (contoh: nama@email.com)" 
            value="{{ old('email') }}"
            required
          >
          @error('email')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>

        <div style="margin-bottom: 15px;">
          <select 
            name="role" 
            class="form-control {{ $errors->has('role') ? 'error' : '' }}" 
            required
          >
            <option value="">Daftar Sebagai</option>
            <option value="tempat_wisata" {{ old('role') == 'tempat_wisata' ? 'selected' : '' }}>Tempat Wisata</option>
            <option value="tour_guide" {{ old('role') == 'tour_guide' ? 'selected' : '' }}>Tour Guide</option>
          </select>
          @error('role')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>

        <div style="margin-bottom: 15px;">
          <input 
            type="password" 
            name="password" 
            class="form-control {{ $errors->has('password') ? 'error' : '' }}" 
            placeholder="Password (minimal 8 karakter)" 
            required
          >
          @error('password')
            <span class="error-message">{{ $message }}</span>
          @enderror
          <span class="password-hint">Gunakan password yang kuat, minimal 8 karakter</span>
        </div>

        <div style="margin-bottom: 15px;">
          <input 
            type="password" 
            name="password_confirmation" 
            class="form-control {{ $errors->has('password_confirmation') ? 'error' : '' }}" 
            placeholder="Konfirmasi Password" 
            required
          >
          @error('password_confirmation')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>

        <button type="submit" class="btn-primary">Daftar Sekarang</button>
      </form>

      <p class="text-center mt-3">Sudah punya akun?
        <a href="{{ route('login') }}" class="login-link">Masuk</a>
      </p>
    </div>
  </div>
</body>
</html>
