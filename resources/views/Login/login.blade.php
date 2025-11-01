<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - GoMinGo</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/logo/logogo.png') }}">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }

    body {
      background: url('{{ asset('assets/img/hero/2.png') }}') center/cover no-repeat;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      position: relative;
      overflow: hidden;
    }

    /* Overlay gradasi biru & kuning */
    body::before {
      content: "";
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      background: linear-gradient(135deg, rgba(0,123,255,0.8), rgba(255,214,10,0.7));
      backdrop-filter: blur(4px);
      z-index: 1;
    }

    .container {
      position: relative;
      z-index: 2;
      width: 900px;
      max-width: 95%;
      display: flex;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 15px 40px rgba(0,0,0,0.25);
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(15px);
    }

    .left {
      flex: 1;
      padding: 60px 40px;
      color: white;
      display: flex;
      flex-direction: column;
      justify-content: center;
      background: rgba(0,0,0,0.25);
    }

    .left h1 {
      font-size: 2.5rem;
      font-weight: 700;
      margin-bottom: 10px;
    }

    .left p {
      font-size: 1rem;
      line-height: 1.6;
      margin-bottom: 20px;
      opacity: 0.9;
    }

    .left .btn-learn {
      background: linear-gradient(90deg, #007bff, #ffd60a);
      color: #fff;
      border: none;
      padding: 10px 25px;
      border-radius: 30px;
      cursor: pointer;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .left .btn-learn:hover {
      transform: scale(1.05);
      opacity: 0.9;
    }

    .right {
      flex: 1;
      padding: 50px 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      color: #fff;
    }

    .right h2 {
      margin-bottom: 20px;
      font-weight: 600;
      text-align: center;
    }

    form .form-group {
      margin-bottom: 20px;
    }

    form label {
      font-weight: 500;
      margin-bottom: 5px;
      display: block;
    }

    form input {
      width: 100%;
      padding: 12px 15px;
      border-radius: 10px;
      border: none;
      outline: none;
      background: rgba(255,255,255,0.2);
      color: #fff;
      font-size: 1rem;
    }

    form input::placeholder {
      color: rgba(255,255,255,0.7);
    }

    .btn-submit {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 25px;
      background: linear-gradient(90deg, #007bff, #ffd60a);
      color: #fff;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn-submit:hover {
      transform: scale(1.05);
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }

    .text-center a {
      color: #ffd60a;
      font-weight: 600;
      text-decoration: none;
    }

    .text-center a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>

  
  <div class="container">
    <div class="left">
      <img src="{{ asset('assets/img/logo/logogo.png') }}" alt="GoMinGo" style="width: 130px; margin-bottom: 20px;">
      <h1>Selamat Datang di GoMinGo!</h1>
<p>
  GoMinGo memudahkan tempat wisata dan tour guide untuk berkembang! 
  Masuk sekarang untuk mengelola destinasi, jadwal tur, dan promosi wisata Anda dengan lebih praktis.
</p>
    </div>

    <div class="right">
      <h2>Login ke Akun Anda</h2>
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
          <label for="email">Email Address</label>
          <input type="email" id="email" name="email" placeholder="Masukkan email" required>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Masukkan password" required>
        </div>

        <button type="submit" class="btn-submit">Masuk</button>

        <div class="text-center mt-3">
          <p>Belum punya akun? <a href="{{ route('registrasi') }}">Daftar Sekarang</a></p>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
